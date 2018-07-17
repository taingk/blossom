<?php

class CgvsController {
    private $oCgv;
    private $aConfigs;

    public function __construct() {
        $this->oCgv = new Cgvs();
    }

    /*
    * View page d'accueil
    */
    public function indexAction( $aParams ) {
        $oView = new View("text", "front");

        $this->oCgv->setIsUse(1);
        $this->aConfigs = $this->oCgv->select()[0];

        $oView->assign("aConfigs", $this->aConfigs );
    }

}
