<?php

class ContactsController {
    private $oContact;
    private $aConfigs;

    public function __construct() {
        $this->oContact = new Contacts();
    }

    /*
    * View page d'accueil
    */
    public function indexAction( $aParams ) {
        $oView = new View("text", "front");

        $this->oContact->setIsUse(1);
        $this->aConfigs = $this->oContact->select()[0];

        $oView->assign("aConfigs", $this->aConfigs );
    }

}
