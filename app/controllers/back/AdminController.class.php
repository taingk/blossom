<?php

class AdminController {    
    
    /*
    * Formulaire inscription administrateur
    */
    public function indexAction( $aParams ) {
        $oUser = new Users();

        if ( $oUser->select() ) {
            $oToken = new Token();
            $oToken->checkToken();

            include "controllers/back/DashboardController.class.php";
            $oDashboard = new DashboardController();
            $oDashboard->indexAction( $aParams );

            return;
        }

		$aConfigs = $oUser->adminFormAdd();
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
                $oUser->setPwd($aParams['POST']['pwd']);
                $oUser->setToken($oToken->getToken());
                $oUser->setRights(1);
                $oUser->setStatus(0);
                $oUser->save();
    
                include "controllers/back/IndexController.class.php";
                $oIndex = new IndexController();
                $oIndex->indexAction( [] );

                return;
            }
        }

        $oView = new View("adminAdd", "auth");

        $oView->assign("aConfigs", $aConfigs);
		$oView->assign("aErrors", $aErrors);
    }

    public function logOutAction( $aParams ) {
        session_destroy();
        $_SESSION = [];
        header('Location: /back');
    }

    public function siteMapAction()
        {

            echo $_SERVER['SERVER_NAME'];
            header('Content-Type: text/xml; charset=UTF-8');
            echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        }
    
}