<?php

class ContactsController {
    private $oContact;
    private $aConfigs;

    public function __construct() {
        $this->oContact = new Contacts();
    }

    /*
    * View listing de Cgvs
    */
    public function indexAction( $aParams ) {
        $oView = new View("listing", "back");

        if ( !$aParams['POST']['search'] ) {
            $this->listing();
        } else {
            $this->search( $aParams['POST']['search'] );
        }

        $this->refactorConfigs();
        $oView->assign( "aConfigs", $this->aConfigs );
        $oView->assign( "aParams", array('id' => 'id_contact') );
   }

    /*
    * Liste toutes les Cgvs
    */ 
    public function listing() {
        $this->aConfigs = $this->oContact->select();
    }

    /*
    * On remplie aConfigs par la recherche
    */ 
    public function search( $sSearch ) {
        $this->oContact->setName( $sSearch );
        $this->aConfigs = $this->oContact->search();
    }

    /*
    * Formulaire d'ajout de Cgvs
    */
    public function addAction( $aParams ) {
        if ( !empty( $aParams['POST'] ) ) {
            $this->disableAll();

            $oContact = new Contacts();

            $oContact->setName($aParams['POST']['name']);
            $oContact->setTitle($aParams['POST']['title']);
            $oContact->setDetails($aParams['POST']['details']);
            $oContact->setIsUse(1);
            $oContact->save();

            header('location: /back/contacts');
            return;
        }

        $this->aConfigs = $this->oContact->contactsForm();
        $oView = new View("editing", "back");
        $oView->assign("aConfigs", $this->aConfigs);
    }

    public function disableAll() {
        $oSelect = new Contacts();
        $oSelect->setIsUse(1);
        $aIsUse = $oSelect->select();

        foreach ($aIsUse as $aPages) {
            $oPage = new Contacts();
            $oPage->setId($aPages['id_contact']);
            $oPage->setIsUse(0);
            $oPage->save();
        }
    }

    /*
    * Formulaire d'édition de page
    */
    public function updateAction( $aParams ) {
        $this->aConfigs = $this->oContact->contactsForm();
        $sId = $aParams['GET']['id'];

        $this->oContact->setId($sId);
        $aInfos = $this->oContact->select()[0];

        foreach ($this->aConfigs['input'] as $sKey => &$aValue) {
            foreach ($aInfos as $sInfoKey => $sInfoValue) {
                if ( $sKey == $sInfoKey ) {
                    $aValue['value'] = $sInfoValue;
                }
            }
        }

        if ( !empty( $aParams['POST'] ) ) {
            $oContact = new Contacts();
            
            $oContact->setId($sId);
            $oContact->setName($aParams['POST']['name']);
            $oContact->setTitle($aParams['POST']['title']);
            $oContact->setDetails($aParams['POST']['details']);
            $oContact->save();

            header('location: /back/contacts');
            return;
        }

        $oView = new View("editing", "back");
        $oView->assign("aConfigs", $this->aConfigs);
    }

    /*
    * Suppression d'un produit en bdd
    */
    public function deleteAction() {
        if ($_GET['id']) {
            $this->oContact->setId($_GET['id']);
            $sStatus = $this->oContact->select(array('is_use'))[0]['is_use'];            

            $this->disableAll();

            $sStatus ? $this->oContact->setIsUse(0) : $this->oContact->setIsUse(1);
            $this->oContact->save();

            header('location: /back/contacts');
            return;
        }
    }

    public function refactorConfigs() {
        if ( $this->aConfigs ) {
            $this->aConfigs = $this->oContact->unsetKeyColumns($this->aConfigs, array('date_inserted', 'date_updated', 'title', 'details', 'status'));
            $this->aConfigs['label'] = array('id', 'nom', 'actif', 'options');
            $this->aConfigs['update'] = array('url' => '/back/contacts/update?id=');
            $this->aConfigs['delete'] = array('url' => '/back/contacts/delete?id=');
            $this->aConfigs['add'] = array('url' => '/back/contacts/add');
            
            foreach ( $this->aConfigs as $sKey => &$aValue ) {
                foreach ( $aValue as $sKey => $sValue ) {
                    if ( $sKey === 'is_use' ) {
                        $aValue[$sKey] = Helper::getActif($aValue[$sKey]);
                    }
                    if ( $aValue[$sKey] == '' ) {
                        $aValue[$sKey] = 'Non renseigné';
                    }
                }
            }
        } else {
            $this->aConfigs['label'] = array('id', 'nom', 'actif', 'options');
            $this->aConfigs['update'] = array('url' => '/back/contacts/update?id=');
            $this->aConfigs['delete'] = array('url' => '/back/contacts/delete?id=');
            $this->aConfigs['add'] = array('url' => '/back/contacts/add');
        }
    }
}
