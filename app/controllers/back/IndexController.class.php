<?php

class IndexController {

    /*
    * Formulaire connexion admnistrateur
    */
    public function indexAction( $aParams ) {
        $oView = new View("adminLogIn", "auth");
        
        $sEmail = $aParams['POST']['email'];
        $sPwd = $aParams['POST']['pwd'];

        if ($sEmail && $sPwd) {
            $oUser = new Users();

            if ( $oUser->isLoginValids($sEmail, $sPwd) ) {
                $oToken = new Token();
                
                $oToken->setTokenSession();
                $oToken->setIdSession( $aParams, $oUser );
                $oToken->setTokenDb( $oUser );
                echo "Identifiants valides";
            } else {
                echo "Identifiants invalides";
            }
        }
    }
}