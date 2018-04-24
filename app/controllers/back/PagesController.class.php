<?php

class PagesController {

    /*
    * View listing de produits
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("pages", "back");
    }

    /*
    * Formulaire d'ajout de produit
    */ 
    public function addAction( $aParams ) {
        $oView = new View("pagesAdd", "back");
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
}