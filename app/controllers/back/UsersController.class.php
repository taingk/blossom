<?php

class UsersController {

    /*
    * View listing des utilisateurs
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("users", "back");

    }

    /*
    * View profil utilisateur
    */ 
    public function profileAction( $aParams ) {

    }

    /*
    * Formulaire d'ajout utilisateur 
    */ 
    public function addAction( $aParams ) {

    }

    /*
    * Update d'un utilisateur en bdd 
    */ 
    public function updateAction( $aParams ) {
        $oToken = new Token();
        $sToken = $oToken->createToken();
        $oToken->insertTokenSession( $aParams, $sToken );
        
        $oUser = new Users();
        $oUser->setId(1);
        $oUser->setFirstname('Update');
		$oUser->setLastname('taing');
		$oUser->setEmail('taingkn@gmail.com');
		$oUser->setPwd('test');
		$oUser->setBirthdayDate('1996-01-05');
        $oUser->setToken($sToken);
        $oUser->setSexe(1);
        $oUser->setAddress('Oui');
        $oUser->setCity('Non');
        $oUser->setZipCode(12345);
		$oUser->setStatus(1);
		$oUser->save();
    }

    /*
    * Update des droits utilisateur en bdd 
    */ 
    public function updateRightsAction( $aParams ) {

    }

    /*
    * Suppression d'un utilisateur en bdd
    */ 
    public function deleteAction( $aParams ) {

    }

    /*
    * Envoie les données à add/update/delete
    */ 
    public function saveAction( $aParams ) {

    }

}