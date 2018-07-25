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

        $aProducts = [];
        foreach ( $aResults as $aProduct ) {
            $oImage = new Images();
            $oImage->setStatus(1);
            $oImage->setProductsIdProduct($aProduct['id_product']);
            $aImage = $oImage->select()[0]['path'];

            array_push($aProducts, [
                'id_product' => $aProduct['id_product'],
                'product_name' => $aProduct['product_name'],
                'path' => $aImage
            ]);
        }
        array_push($aConfigs, [ 'products' => $aProducts ]);

        $oView->assign('aConfigs', $aConfigs);
    }
    
    /*
    * On get un appel AJAX pour filtrer un/des produit(s)
    */ 
    public function filterAction( $aParams ) {

    }

}