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
        $oToken->setTokenSession();
        
        $oUser = new Users();
        $oUser->setId(1);
        $oUser->setFirstname('Test');
		$oUser->setLastname('taing');
		$oUser->setEmail('Lol@gmail.com');
		$oUser->setPwd('Test1234');
		$oUser->setBirthdayDate('1996-01-05');
        $oUser->setToken($oToken->getToken());
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
    
    /**
     * Mail confirmation
     */
    public function confirmAction( $aParams ) {
        if ( count($aParams['GET']) > 6 ) {
            $oToken = new Token();
            $oUser = new Users();
            
            $oUser->setFirstname($aParams['GET']['firstname']);
            $oUser->setLastname($aParams['GET']['lastname']);
            $oUser->setSexe($aParams['GET']['sexe']);
            $oUser->setBirthdayDate($aParams['GET']['birthday_date']);
            $oUser->setEmail($aParams['GET']['email']);
            $oUser->setPwd($aParams['GET']['pwd']);
            $oUser->setToken($oToken->getToken());
            $oUser->setStatus(1);
            $oUser->save();
    
            header('Location: /back');
        }
    }
}