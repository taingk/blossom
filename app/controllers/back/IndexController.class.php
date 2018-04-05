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
                header('Location: /back/dashboard');
            } else {
                echo "Identifiants invalides";
            }
        }
    }
}