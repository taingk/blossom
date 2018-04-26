<?php

class CartController {
    
    /*
    * View listing des articles 
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("cart", "front");
        $oOrders= new Orders();
        $oOrders->setUsersIdUsers($_SESSION['id_user']);
        $aResult = $oOrders->select();
        $oView->assign('cart', $aResult);
    }
}