<?php

class UserController {

    /*
    * View connexion utilisateur
    */
    public function indexAction( $aParams ) {
        $oView = new View("userLogin", "auth");
        $oUser = new Users();
        $aConfigs = $oUser->userLoginForm();

        $oView->assign( "aConfigs", $aConfigs );
        $sEmail = $aParams['POST']['email'];
        $sPwd = $aParams['POST']['pwd'];

        if ($sEmail && $sPwd) {
            $oUser = new Users();

            $iLogin = $oUser->isLoginValids($sEmail, $sPwd);
            if ( $iLogin ) {
                $oToken = new Token();

                $oToken->setTokenSession();
                $oToken->setIdSession( $sEmail );
                $oToken->setTokenDb();

                header('Location: /');
            } else if ( $iLogin === 0 ) {
                header('Location: /front/user?status=false');
            } else if ( $iLogin === -1 ) {
                header('Location: /front/user?validity=false');
            }
        }
    }

    /*
    * View connexion utilisateur
    */
    public function subscribeAction( $aParams ) {
        $oUser = new Users();
        $aConfigs = $oUser->userForm();
        $aErrors = [];

        if ( !empty( $aParams['POST'] ) ) {
            $aErrors = Validator::checkForm( $aConfigs, $aParams["POST"]);
            unset($_SESSION['captcha']);
            if ( empty( $aErrors ) ) {
                $oMailer = new Mailer();
                $oToken = new Token();

                $oMailer->confirmMail($aParams, $oToken->getToken());
                $oUser->setFirstname($aParams['POST']['firstname']);
                $oUser->setLastname($aParams['POST']['lastname']);
                $oUser->setSexe($aParams['POST']['sexe']);
                $oUser->setBirthdayDate($aParams['POST']['birthday_date']);
                $oUser->setEmail($aParams['POST']['email']);
                $oUser->setAddress($aParams['POST']['address']);
                $oUser->setZipCode($aParams['POST']['zip_code']);
                $oUser->setCity($aParams['POST']['city']);
                $oUser->setPwd($aParams['POST']['pwd']);
                $oUser->setToken($oToken->getToken());
                $oUser->setRights(0);
                $oUser->setStatus(0);
                $oUser->save();

                include "controllers/back/IndexController.class.php";
                $oIndex = new IndexController();
                $oIndex->indexAction( [] );

                return;
            }
        }

        $oView = new View("userAdd", "auth");

        $oView->assign("aConfigs", $aConfigs);
        $oView->assign("aErrors", $aErrors);
    }

    /*
    * View profil utilisateur
    */
    public function profileAction( $aParams ) {
        $oUsers = new Users();
        $oUsers->setId($_SESSION['id_user']);
        $aUsers = $oUsers->select()[0];

        $oOrders = new Orders();
        $oOrders->setUsersIdUsers($_SESSION['id_user']);
        $aOrders = $oOrders->select();

        $oView = new View('user', 'front');
        $oView->assign("aUsers", $aUsers);
        $oView->assign("aOrders", $aOrders);
      }

    /*
    * View formulaire édition profil utilisateur
    */
    public function updateAction( $aParams ) {

    }

    /*
    * Suppression de son compte utilisateur
    */
    public function deleteAction( $aParams ) {

    }

    public function logOutAction( $aParams ) {
        session_destroy();
        $_SESSION = [];
        header('Location: /');
    }
}
