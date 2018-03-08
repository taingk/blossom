<?php

class AdminController {    
    
    public function indexAction( $aParams ) {
        $oView = new View("adminLogIn", "back");
    }

    public function formAction( $aParams ) {
        $oView = new View("adminForm", "back");
    }
    
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
    
    public function updateFormAction( $aParams ) {

    }

    public function updateAction( $aParams ) {

    }

}