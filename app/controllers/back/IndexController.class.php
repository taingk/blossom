<?php

class IndexController {

    /*
    * Formulaire connexion admnistrateur
    */
    public function indexAction( $aParams ) {
        $oView = new View("adminLogIn", "back");
        $sEmail = $aParams['POST']['email'];
        $sPwd = $aParams['POST']['pwd'];

        if ($sEmail && $sPwd) {
            $oUsers = new Users();

            if ( $oUsers->isLoginValids($sEmail, $sPwd) ) {
                $oToken = new Token();
                $sToken = $oToken->createToken();

                $oToken->insertTokenSession( $aParams, $sToken );
                $oToken->insertTokenDb( $aParams, $oUsers, $sToken );
                echo "Identifiants valides";
            } else {
                echo "Identifiants invalides";
            }
        }
    }
}