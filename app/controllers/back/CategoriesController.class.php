<?php

class CategoriesController {
    private $oCategory;
    private $aConfigs;

    public function __construct() {
        $this->oCategory = new Categories();
    }
    /*
    * View listing des categories 
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("categories", "back");

        if ( !$aParams['POST']['search'] ) {
            $this->listing();
        } else {
            $this->search( $aParams['POST']['search'] );
        }
        
        $this->refactorConfigs();
        $oView->assign( "aConfigs", $this->aConfigs );
        $oView->assign( "aParams", array('id' => 'id_category') );
    }

    /*
    * Liste toutes les categories
    */ 
    public function listing() {
        $this->aConfigs = $this->oCategory->select();
    }

    /*  
    * View profil categorie
    */ 
    public function profileAction( $aParams ) {

    }

    /*
    * On get un appel AJAX pour rechercher dans la bdd un/des categorie(s)
    */ 
    public function search( $sSearch ) {
        $this->oCategory->setCategoryName( $sSearch );
        $this->aConfigs = $this->oCategory->search();
    }

    /*
    * Formulaire d'ajout d'une categorie
    */ 
    public function addAction( $aParams ) {
        $this->aConfigs = $this->oCategory->categoryFormAdd();

        if ( !empty( $aParams['POST'] ) ) {
            
                $this->oCategory->setId($sId);
                $this->oCategory->setCategoryName($aParams['POST']['category_name']);
                $this->oCategory->setStatus(1);
                $this->oCategory->save();
    
                header('location: /back/categories ');
                return;
            
        }

        $oView = new View("categoriesAdd", "back");
        $oView->assign("aConfigs", $this->aConfigs);     
    }

    /*
    * Update d'une categorie en bdd 
    */ 
    public function updateAction( $aParams ) {
        $this->aConfigs = $this->oCategory->categoryFormUpdate();
        $aErrors = [];
        $sId = $aParams['GET']['id'];

        $this->oCategory->setId($sId);
        $aInfos = $this->oCategory->select()[0];

        foreach ($this->aConfigs['input'] as $sKey => &$aValue) {
            foreach ($aInfos as $sInfoKey => $sInfoValue) {
                if ( $sKey == $sInfoKey) {
                    $aValue['value'] = $sInfoValue;
                }
            }
        }

        if ( !empty( $aParams['POST'] ) ) {
            $aErrors = Validator::checkForm( $this->aConfigs, $aParams["POST"], true );

			if ( empty( $aErrors ) ) {
                $this->oCategory->setId($sId);
                $this->oCategory->setCategoryName($aParams['POST']['category_name']);
                $this->oCategory->save();

                header('location: /back/categories');
                return;
            }
        }

        $oView = new View("categoriesUpdate", "back");
        $oView->assign("aConfigs", $this->aConfigs);
    }

    /*
    * Suppression d'une categorie en bdd
    */ 
    public function deleteAction( $aParams ) {
        if ($_GET['id']) {
            $this->oCategory->setId($_GET['id']);
            $sStatus = $this->oCategory->select(array('status'))[0]['status'];

            $sStatus ? $this->oCategory->setStatus(0) : $this->oCategory->setStatus(1);                
            $this->oCategory->save();

            http_response_code(200);
            echo json_encode(array('status' => 'ok'));
        } else {
            http_response_code(404);            
        }
    }

    public function refactorConfigs() {        
        $this->aConfigs['label'] = array('id', 'nom de la categorie', 'status', 'options');
        $this->aConfigs['update'] = array('url' => '/back/categories/update?id=');
        $this->aConfigs['add'] = array('url' => '/back/categories/add');

        foreach ( $this->aConfigs as $sKey => &$aValue ) {
            foreach ( $aValue as $sKey => $sValue ) {
                if ( $sKey === 'status' ) {
                    $aValue[$sKey] = Helper::getStatus($aValue[$sKey]);
                }
                if ( $aValue[$sKey] == '' ) {
                    $aValue[$sKey] = 'Non renseigné';
                }
            }
        }
    }
}