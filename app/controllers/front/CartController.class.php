<?php

class CartController {
    
    /*
    * View listing des articles 
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("cart", "front");
        $oProduct = new Products();
        $aResult = $oProduct->select();
        $oView->assign('products', $aResult);
    }



}