<?php

class CommentsController {

    /*
    * View listing des commentaires pour tel produit
    * par tel utilisateur inscrit
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("comments", "back");
        
    }

    /*
    * Formulaire d'ajout de commentaire
    */ 
    public function formAction( $aParams ) {

    }

    /*
    * Ajout d'un commentaire en bdd 
    */ 
    public function addAction( $aParams ) {

    }

    /*
    * Formulaire d'édition d'un commentaire 
    */ 
    public function updateFormAction( $aParams ) {

    }

    /*
    * Update d'un commentaire en bdd 
    */ 
    public function updateAction( $aParams ) {

    }

    /*
    * Suppression d'un commentaire en bdd
    */ 
    public function deleteAction( $aParams ) {

    }
    
}