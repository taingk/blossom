<?php

class OrdersController {

    /*
    * View listing des différentes commandes par produit
    * et par utilisateur
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("orders", "back");

    }

    /*
    * Formulaire d'édition d'une commande
    */ 
    public function updateFormAction( $aParams ) {

    }

    /*
    * Update d'une commande en bdd 
    */ 
    public function updateAction( $aParams ) {

    }

    /*
    * Suppression d'une commande en bdd 
    */ 
    public function deleteAction( $aParams ) {

    }
    
}