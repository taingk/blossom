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
    * View profil commentaire
    */ 
    public function profileAction( $aParams ) {

    }

    /*
    * Formulaire d'ajout de commentaire
    */ 
    public function addAction( $aParams ) {

    }

    /*
    * Formulaire d'édition d'un commentaire 
    * Edite, accepte et refuse un commentaire
    */
    public function updateAction( $aParams ) {

    }

    /*
    * Suppression d'un commentaire en bdd
    */ 
    public function deleteAction( $aParams ) {

    }

}