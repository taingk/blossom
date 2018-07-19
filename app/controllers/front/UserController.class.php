<?php

class UserController {

    /*
    * View connexion utilisateur
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("userLogin", "auth");

        $sEmail = $aParams['POST']['email'];
        $sPwd = $aParams['POST']['pwd'];

        if ($sEmail && $sPwd) {
            $oUser = new Users();

            if ( $oUser->isLoginValids($sEmail, $sPwd) ) {
                $oToken = new Token();

                $oToken->setTokenSession();
                $oToken->setIdSession( $sEmail );
                $oToken->setTokenDb();

                header('Location: /');
            } else {
                echo "Identifiants invalides";
            }
        }
    }

    /*
    * View connexion utilisateur
    */ 
    public function subscribeAction( $aParams ) {
        $oUser = new Users();

        // if ( $oUser->select() ) {
        //     $oToken = new Token();
        //     $oToken->checkToken();

        //     include "controllers/back/DashboardController.class.php";
        //     $oDashboard = new DashboardController();
        //     $oDashboard->indexAction( $aParams );

        //     return;
        // }


        $aConfigs = $oUser->userFormAdd("form col-md-8");
        $aErrors = [];

        if ( !empty( $aParams['POST'] ) ) {
            $aErrors = Validator::checkForm( $aConfigs, $aParams["POST"] );

            if ( empty( $aErrors ) ) {
                $oMailer = new Mailer();
                $oToken = new Token();
                
                $oMailer->sendMail($aParams, $oToken->getToken());
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

    }

    /*
    * View formulaire création de compte utilisateur
    */ 
    public function addAction( $aParams ) {

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
    
    /*
    * Envoie les données à add/update/delete
    */ 
    public function saveAction( $aParams ) {

    }

    public function logOutAction( $aParams ) {
        session_destroy();
        $_SESSION = [];
        header('Location: /front');
    }
}