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

		$aConfig = $oUser->adminFormAdd();
        $aErrors = [];

        if ( !empty( $aParams['POST'] ) ) {
            $aErrors = Validator::checkForm( $aConfig, $aParams["POST"] );

			if ( empty( $aErrors ) ) {
                $oMailer = new Mailer();

                $oMailer->sendMail( $aParams );

                include "controllers/back/IndexController.class.php";
                $oIndex = new IndexController();
                $oIndex->indexAction( $aParams );

                return;
            }
        }

        $oView = new View("adminAdd", "auth");

        $oView->assign("aConfig", $aConfig);
		$oView->assign("aErrors", $aErrors);
    }

    public function logOutAction( $aParams ) {
        session_destroy();
        $_SESSION = [];
        header('Location: /back');
    }
    
}