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

            $iLogin = $oUser->isLoginValids($sEmail, $sPwd, true);
            if ( $iLogin ) {
                $oToken = new Token();

                $oToken->setTokenSession();
                $oToken->setIdSession( $sEmail );
                $oToken->setTokenDb();

                header('Location: /back/dashboard');
            } else if ( $iLogin === 0 ) {
                header('Location: /back?status=false');
            } else if ( $iLogin === -1 ) {
                header('Location: /back?validity=false');
            }
        }
    }

}