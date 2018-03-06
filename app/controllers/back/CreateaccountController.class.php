<?php

class CreateaccountController {    
    
    public function indexAction() {
        $oView = new View("createAccount", "back");
    }

    public function addUserAction() {
        $oView = new View("createAccount", "back");

        $oUser = new Users();
        // $oUser->setFirstname("Kevin");
		// $oUser->setLastname("Taing");
		// $oUser->setEmail("ktaing2@myges.fr");
		// $oUser->setPwd("motdepasse");
		// $oUser->setToken("token");
		// $oUser->setAge(22);
		// $oUser->setStatus(1);
		// $oUser->save();

    }
}