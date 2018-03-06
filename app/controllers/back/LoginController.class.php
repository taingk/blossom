<?php

class LoginController {
    private $aNotInclude = ["createAccount", "logIn"];
    
    public function indexAction() {
        $this->getView("logIn", "back");
    }

    public function getView($sView, $sTpl) {
        $oView = new View($sView, $sTpl);
        $oView->assign("notInclude", $this->aNotInclude);
    }

}