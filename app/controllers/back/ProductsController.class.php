<?php

class ProductsController {

    public function indexAction( $aParams ) {
        $oView = new View("products", "back");
    }

    public function formAction( $aParams ) {
        $oView = new View("productsForm", "back");
    }
    
}