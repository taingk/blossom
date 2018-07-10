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
                $oToken->setIdSession( $sEmail );
                $oToken->setTokenDb();
                print_r($_SESSION);
                // header('Location: /back/dashboard');
            } else {
                echo "Identifiants invalides";
            }
        }
    }

}