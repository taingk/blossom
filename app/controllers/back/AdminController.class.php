<?php

class AdminController {    
    
    /*
    * Formulaire inscription administrateur
    */
    public function indexAction( $aParams ) {
        $oView = new View("adminAdd", "back");
    }

    /*
    * Envoie les données à add
    */ 
    public function saveAction( $aParams ) {       
        $oUser = new Users();
        $oUser->setFirstname($_POST['firstname']);
		$oUser->setLastname($_POST['lastname']);
		$oUser->setEmail($_POST['email']);
		$oUser->setPwd($_POST['pwd']);
		$oUser->setToken("token");
		$oUser->setAge(Helper::getAge($_POST['age']));
		$oUser->setStatus(1);
		$oUser->save();
    }
    
}