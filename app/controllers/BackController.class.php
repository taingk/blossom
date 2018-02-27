<?php

class BackController {

    public function indexAction( $aParams ) {
        $oView = new View("dashboard", "back");
    }

    public function dashboardAction( $aParams ) {
        $oView = new View("dashboard", "back");
    }

    public function productsAction( $aParams ) {
        $oView = new View("products", "back");
    }

    public function addProductsAction( $aParams ) {
        $oView = new View("addProducts", "back");
    }

}