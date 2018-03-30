<?php

class IndexController {

    /*
    * View page d'accueil
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("homePage", "front");
    }
    
}