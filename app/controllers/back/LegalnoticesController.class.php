<?php

class LegalnoticesController {
    private $oLegalNotice;
    private $aConfigs;

    public function __construct() {
        $this->oLegalNotice = new Legalnotices();
    }

    /*
    * View listing de Legalnotices
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
        $oView->assign( "aParams", array('id' => 'id_legal_notices') );
   }

    /*
    * Liste toutes les Legalnotices
    */ 
    public function listing() {
        $this->aConfigs = $this->oLegalNotice->select();
    }

    /*
    * On remplie aConfigs par la recherche
    */ 
    public function search( $sSearch ) {
        $this->oLegalNotice->setName( $sSearch );
        $this->aConfigs = $this->oLegalNotice->search();
    }

    /*
    * Formulaire d'ajout de Legalnotices
    */
    public function addAction( $aParams ) {
        if ( !empty( $aParams['POST'] ) ) {
            $this->disableAll();

            $oLegalNotice = new Legalnotices();

            $oLegalNotice->setName($aParams['POST']['name']);
            $oLegalNotice->setTitle($aParams['POST']['title']);
            $oLegalNotice->setDetails($aParams['POST']['details']);
            $oLegalNotice->setIsUse(1);
            $oLegalNotice->save();

            header('location: /back/legalnotices');
            return;
        }

        $this->aConfigs = $this->oLegalNotice->legalNoticesForm();
        $oView = new View("editing", "back");
        $oView->assign("aConfigs", $this->aConfigs);
    }

    public function disableAll() {
        $oSelect = new Legalnotices();
        $oSelect->setIsUse(1);
        $aIsUse = $oSelect->select();

        foreach ($aIsUse as $aPages) {
            $oPage = new Legalnotices();
            $oPage->setId($aPages['id_legal_notices']);
            $oPage->setIsUse(0);
            $oPage->save();
        }
    }

    /*
    * Formulaire d'édition de page
    */
    public function updateAction( $aParams ) {
        $this->aConfigs = $this->oLegalNotice->legalNoticesForm();
        $sId = $aParams['GET']['id'];

        $this->oLegalNotice->setId($sId);
        $aInfos = $this->oLegalNotice->select()[0];

        foreach ($this->aConfigs['input'] as $sKey => &$aValue) {
            foreach ($aInfos as $sInfoKey => $sInfoValue) {
                if ( $sKey == $sInfoKey ) {
                    $aValue['value'] = $sInfoValue;
                }
            }
        }

        if ( !empty( $aParams['POST'] ) ) {
            $oLegalNotice = new Legalnotices();

            $oLegalNotice->setId($sId);
            $oLegalNotice->setName($aParams['POST']['name']);
            $oLegalNotice->setTitle($aParams['POST']['title']);
            $oLegalNotice->setDetails($aParams['POST']['details']);
            $oLegalNotice->save();

            header('location: /back/legalnotices');
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
            $this->oLegalNotice->setId($_GET['id']);
            $sStatus = $this->oLegalNotice->select(array('is_use'))[0]['is_use'];            

            $this->disableAll();

            $sStatus ? $this->oLegalNotice->setIsUse(0) : $this->oLegalNotice->setIsUse(1);
            $this->oLegalNotice->save();

            http_response_code(200);
            echo json_encode(array('status' => 'ok'));
        } else {
            http_response_code(404);
        }
    }

    public function refactorConfigs() {
        if ( $this->aConfigs ) {
            $this->aConfigs = $this->oLegalNotice->unsetKeyColumns($this->aConfigs, array('title', 'details', 'status'));
            $this->aConfigs['label'] = array('id', 'nom', 'actif', 'options');
            $this->aConfigs['update'] = array('url' => '/back/legalnotices/update?id=');
            $this->aConfigs['add'] = array('url' => '/back/legalnotices/add');

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
            $this->aConfigs['update'] = array('url' => '/back/legalnotices/update?id=');
            $this->aConfigs['add'] = array('url' => '/back/legalnotices/add');
        }
    }
}
