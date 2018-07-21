<?php

class ProductController {

    /*
    * View page produit
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("products", "front");

        $oProduct = new Products();
        $oColor = new Colors();
        $oCapacity = new Capacities();

        $sId = $aParams['GET']['is'];
        $oProduct->setId( $sId );
        $aResultProduct = $oProduct->select();

        $oColor->setProductsIdProduct( $sId );
        $aResultColor = $oColor->select();

        $oCapacity->setProductsIdProduct( $sId );
        $aResultCapacity = $oCapacity->select();

        $aConfigs = [];

        $aProducts = ['products' => $aResultProduct];
        array_push($aConfigs, $aProducts);

        $aColors = ['colors' => $aResultColor];
        array_push($aConfigs, $aColors);

        $aCapacities = ['capacities' => $aResultCapacity];
        array_push($aConfigs, $aCapacities);
//
      $oView->assign('aConfigs', $aConfigs);
    }

    public function allAction($aParams) {

    }

    /*
    * On get un appel AJAX pour rechercher dans la bdd un/des produit(s)
    */ 
    public function searchAction( $aParams ) {

    }

}