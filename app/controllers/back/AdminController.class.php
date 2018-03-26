<?php

class AdminController {    
    
    /*
    * View profil administrateur dans la bdd
    */ 
    public function indexAction( $aParams ) {

    }

    /*
    * Formulaire inscription administrateur
    */
    public function formAction( $aParams ) {
        $oView = new View("adminForm", "back");
    }

    /*
    * Ajout de l'administrateur dans la bdd
    */ 
    public function addAction( $aParams ) {
        $oView = new View("adminAdd", "back");
        
        $oUser = new Users();
        // $oUser->setFirstname($_POST['firstname']);
		// $oUser->setLastname($_POST['lastname']);
		// $oUser->setEmail($_POST['email']);
		// $oUser->setPwd($_POST['pwd']);
		// $oUser->setToken("token");
		// $oUser->setAge(Helper::getAge($_POST['age']));
		// $oUser->setStatus(1);
		// $oUser->save();
    }
    
    /*
    * Formulaire update de l'administrateur
    */ 
    public function updateFormAction( $aParams ) {

    }

    /*
    * Update de l'administrateur dans la bdd
    */ 
    public function updateAction( $aParams ) {

    }

}