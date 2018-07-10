<?php

class IndexController {
    private $oHomePage;
    private $aConfigs;

    public function __construct() {
        $this->oHomePage = new Homepages();
    }

    /*
    * View page d'accueil
    */
    public function indexAction( $aParams ) {
        $oView = new View("homePage", "front");

        $this->oHomePage->setIsUse(1);
        $this->aConfigs = $this->oHomePage->select()[0];

        $oView->assign("aConfigs", $this->aConfigs );
    }

}
