<?php

class LegalnoticesController {
    private $oLegalNotices;
    private $aConfigs;

    public function __construct() {
        $this->oLegalNotices = new Legalnotices();
    }

    /*
    * View page d'accueil
    */
    public function indexAction( $aParams ) {
        $oView = new View("text", "front");

        $this->oLegalNotices->setIsUse(1);
        $this->aConfigs = $this->oLegalNotices->select()[0];

        $oView->assign("aConfigs", $this->aConfigs );
    }

}
