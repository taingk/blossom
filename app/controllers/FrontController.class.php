<?php

class FrontController {

    public function indexAction( $aParams ) {
        $oView = new View("homePage", "front");
    }

    public function homePageAction( $aParams ) {
        $oView = new View("homePage", "front");
    }
}