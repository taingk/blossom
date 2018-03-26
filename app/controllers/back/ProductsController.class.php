<?php

class ProductsController {

    /*
    * View listing de produits
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("products", "back");
    }

    /*
    * Formulaire d'ajout de produit
    */ 
    public function formAction( $aParams ) {
        $oView = new View("productsForm", "back");
    }
    
    /*
    * Ajout d'un produit en bdd 
    */ 
    public function addAction( $aParams ) {

    }

    /*
    * Formulaire d'édition d'un produit 
    */ 
    public function updateFormAction( $aParams ) {

    }

    /*
    * Update d'un produit en bdd 
    */ 
    public function updateAction( $aParams ) {

    }

    /*
    * Suppression d'un produit en bdd
    */ 
    public function deleteAction( $aParams ) {

    }
    
}