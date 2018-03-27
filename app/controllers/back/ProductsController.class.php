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
    * Envoie les données à add/update/delete
    */ 
    public function saveAction( $aParams ) {

    }
    
}