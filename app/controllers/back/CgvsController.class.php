<?php

class CgvsController {
    private $oCgv;
    private $aConfigs;

    public function __construct() {
        $this->oCgv = new Cgvs();
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
        $oView->assign( "aParams", array('id' => 'id_cgv') );
   }

    /*
    * Liste toutes les Cgvs
    */ 
    public function listing() {
        $this->aConfigs = $this->oCgv->select();
    }

    /*
    * On remplie aConfigs par la recherche
    */ 
    public function search( $sSearch ) {
        $this->oCgv->setName( $sSearch );
        $this->aConfigs = $this->oCgv->search();
    }

    /*
    * Formulaire d'ajout de Cgvs
    */
    public function addAction( $aParams ) {
        if ( !empty( $aParams['POST'] ) ) {
            $this->disableAll();

            $oCgv = new Cgvs();

            $oCgv->setName($aParams['POST']['name']);
            $oCgv->setTitle($aParams['POST']['title']);
            $oCgv->setDetails($aParams['POST']['details']);
            $oCgv->setIsUse(1);
            $oCgv->save();

            header('location: /back/cgvs');
            return;
        }

        $this->aConfigs = $this->oCgv->cgvsForm();
        $oView = new View("editing", "back");
        $oView->assign("aConfigs", $this->aConfigs);
    }

    public function disableAll() {
        $oSelect = new Cgvs();
        $oSelect->setIsUse(1);
        $aIsUse = $oSelect->select();

        foreach ($aIsUse as $aPages) {
            $oPage = new Cgvs();
            $oPage->setId($aPages['id_cgv']);
            $oPage->setIsUse(0);
            $oPage->save();
        }
    }

    /*
    * Formulaire d'édition de page
    */
    public function updateAction( $aParams ) {
        $this->aConfigs = $this->oCgv->cgvsForm();
        $sId = $aParams['GET']['id'];

        $this->oCgv->setId($sId);
        $aInfos = $this->oCgv->select()[0];

        foreach ($this->aConfigs['input'] as $sKey => &$aValue) {
            foreach ($aInfos as $sInfoKey => $sInfoValue) {
                if ( $sKey == $sInfoKey ) {
                    $aValue['value'] = $sInfoValue;
                }
            }
        }

        if ( !empty( $aParams['POST'] ) ) {
            $oCgv = new Cgvs();
            
            $oCgv->setId($sId);
            $oCgv->setName($aParams['POST']['name']);
            $oCgv->setTitle($aParams['POST']['title']);
            $oCgv->setDetails($aParams['POST']['details']);
            $oCgv->save();

            header('location: /back/cgvs');
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
            $this->oCgv->setId($_GET['id']);
            $sStatus = $this->oCgv->select(array('is_use'))[0]['is_use'];            

            $this->disableAll();

            $sStatus ? $this->oCgv->setIsUse(0) : $this->oCgv->setIsUse(1);
            $this->oCgv->save();

            http_response_code(200);
            echo json_encode(array('status' => 'ok'));
        } else {
            http_response_code(404);
        }
    }

    public function refactorConfigs() {
        if ( $this->aConfigs ) {
            $this->aConfigs = $this->oCgv->unsetKeyColumns($this->aConfigs, array('date_inserted', 'date_updated', 'title', 'details', 'status'));
            $this->aConfigs['label'] = array('id', 'nom', 'actif', 'options');
            $this->aConfigs['update'] = array('url' => '/back/cgvs/update?id=');
            $this->aConfigs['add'] = array('url' => '/back/cgvs/add');

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
            $this->aConfigs['update'] = array('url' => '/back/cgvs/update?id=');
            $this->aConfigs['add'] = array('url' => '/back/cgvs/add');
        }
    }
}
