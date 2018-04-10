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
        $oUser->setFirstname('Test');
		$oUser->setLastname('taing');
		$oUser->setEmail('Lol@gmail.com');
		$oUser->setPwd('Test1234');
		$oUser->setBirthdayDate('1996-01-05');
        $oUser->setToken($sToken);
        $oUser->setSexe(0);
        $oUser->setAddress('Address');
        $oUser->setCity('Ville');
        $oUser->setZipCode(01234);
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
    * On get un appel AJAX pour rechercher dans la bdd un/des produit(s)
    */ 
    public function searchAction( $aParams ) {

    }
    
}