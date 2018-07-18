<?php

class LegalnoticesController {
    private $oLegalNotice;
    private $aConfigs;

    public function __construct() {
        $this->oLegalNotice = new Legalnotices();
    }

    /*
    * View page d'accueil
    */
    public function indexAction( $aParams ) {
        $oView = new View("text", "front");

        $this->oLegalNotice->setIsUse(1);
        $this->aConfigs = $this->oLegalNotice->select()[0];

        $oView->assign("aConfigs", $this->aConfigs );
    }

}
