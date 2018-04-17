<?php

class ProductsController {

    /*
    * View listing de produits
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("products", "back");
    }

    /*
    * View profil produit
    */ 
    public function profileAction( $aParams ) {

    }

    /*
    * Formulaire d'ajout de produit
    */ 
    public function addAction( $aParams ) {
        $oView = new View("productsAdd", "back");
        $oProduct = new Products();
        $oProduct->setProductName('iPhone 11');
		$oProduct->setCategoriesIdCategory(1);
		$oProduct->setDescription('test');
		$oProduct->setPrice('150');
        $oProduct->setRam("8");
		$oProduct->setStatus(1);
        $oProduct->save();
    }

    /*
    * Formulaire d'édition d'un produit 
    */ 
    public function updateAction( $aParams ) {

    }

    /*
    * Suppression d'un produit en bdd
    */ 
    public function deleteAction( $aParams ) {

    }
    
    /*
    * On get un appel AJAX pour filtrer un/des produit(s)
    */ 
    public function filterAction( $aParams ) {

    }
 
    /*
    * On get un appel AJAX pour rechercher dans la bdd un/des produit(s)
    */ 
    public function searchAction( $aParams ) {
        $_POST['search'] = "iPhone";
        if ($_POST['search']) {
            $oProduct = new Products(); 
            $oProduct->setProductName("CONCAT('%' + '" . $_POST['search'] . "' + '%')");
            $oAllProducts = $oProduct->select(array('product_name'));   

            http_response_code(200);
            echo json_encode($oAllProducts);
        }
    }
}