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
    * View profil commande
    */ 
    public function profileActioshown( $aParams ) {

    }

    /*
    * Formulaire d'édition d'une commande
    */ 
    public function updateAction( $aParams ) {

    }

    /*
    * Suppression d'une commande en bdd 
    */ 
    public function deleteAction( $aParams ) {

    }
 
    /*
    * On get un appel AJAX pour rechercher dans la bdd un/des produit(s)
    */ 
    public function searchAction( $aParams ) {

    }
}