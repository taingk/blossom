<?php

class CreateaccountController {
    private $aNotInclude = ["createAccount", "logIn"];
    
    public function indexAction() {
        $this->getView("createAccount", "back");
    }

    public function addUserAction() {
        $this->getView("createAccount", "back");

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

    public function getView($sView, $sTpl) {
        $oView = new View($sView, $sTpl);
        $oView->assign("notInclude", $this->aNotInclude);
    }

}