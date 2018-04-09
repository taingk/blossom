<?php

class AdminController {    
    
    /*
    * Formulaire inscription administrateur
    */
    public function indexAction( $aParams ) {
        $oView = new View("adminAdd", "auth");

        if ( $aParams['POST']['email'] ) {
            $oUser = new Users();
            $oToken = new Token();
    
            $oUser->setFirstname($_POST['firstname']);
            $oUser->setLastname($_POST['lastname']);
            $oUser->setEmail($_POST['email']);
            $oUser->setPwd($_POST['pwd']);
            $oUser->setBirthdayDate($_POST['birthday_date']);
            $oUser->setToken($oToken->createToken());
            $oUser->setStatus(1);
            $oUser->save();    
        }
    }
    
}