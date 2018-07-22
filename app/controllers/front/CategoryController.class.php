<?php

class CategoryController {

    /*
    * View listing produit d'une catégorie
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("category", "front");
        $oProduct = new Products();
        $oCategory = new Categories();

        $sId = $aParams['GET']['is'];
        $oProduct->setCategoriesIdCategory($sId);
        $aResults = $oProduct->select();
        

        $oCategory->setId($sId);
        $sCategoryName = $oCategory->select()[0]['category_name'];
        
        $aLabels = ['label' => $sCategoryName];
        $aConfigs = [];
        array_push($aConfigs, $aLabels);

        $aProducts = ['products' => $aResults];
        array_push($aConfigs, $aProducts);

        $oView->assign('aConfigs', $aConfigs);
    }
    
    /*
    * On get un appel AJAX pour filtrer un/des produit(s)
    */ 
    public function filterAction( $aParams ) {

    }

}