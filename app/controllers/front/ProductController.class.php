<?php

class ProductController {

    /*
    * View page produit
    */ 
    public function indexAction( $aParams ) {

    }

    public function allAction($aParams) {
        $oView = new View("products", "front");
        $oProduct = new Products();
        $aResult = $oProduct->select();
        $oView->assign('products', $aResult);
    }

    /*
    * On get un appel AJAX pour rechercher dans la bdd un/des produit(s)
    */ 
    public function searchAction( $aParams ) {

    }

}