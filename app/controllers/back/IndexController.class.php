<?php

class IndexController {

    /*
    * Formulaire connexion admnistrateur
    */
    public function indexAction( $aParams ) {
        $oView = new View("adminLogIn", "auth");
        $oUser = new Users();
        $aConfigs = $oUser->userLoginForm();
        
        $oView->assign( "aConfigs", $aConfigs );
        
        $sEmail = $aParams['POST']['email'];
        $sPwd = $aParams['POST']['pwd'];

        if ( $sEmail && $sPwd ) {

            if ( $oUser->isLoginValids($sEmail, $sPwd, true) ) {
                $oToken = new Token();

                $oToken->setTokenSession();
                $oToken->setIdSession( $sEmail );
                $oToken->setTokenDb();

                header('Location: /back/dashboard');
            } else {
                header('Location: /back?validity=false');
            }
        }
    }

}