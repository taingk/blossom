<?php

class PagesController {
    private $oPage;
    private $aConfigs;

    public function __construct() {
        $this->oPage = new Pages();
    }

    /*
    * View listing de produits
    */
    public function indexAction( $aParams ) {
        $oView = new View("pages", "back");

        if ( !$aParams['POST']['search'] ) {
            $this->listing();
        } else {
            $this->search( $aParams['POST']['search'] );
        }
        
        $this->refactorConfigs();
        $oView->assign("aConfigs", $this->aConfigs );
   }

    /*
    * Liste tous les utilisateurs
    */ 
    public function listing() {
        $this->aConfigs = $this->oPage->select();
    }

    /*
    * On remplie aConfigs par la recherche
    */ 
    public function search( $sSearch ) {
        $this->oPage->setPageName( $sSearch );
        $this->aConfigs = $this->oPage->search();
    }

    /*
    * Formulaire d'ajout de produit
    */
    public function addAction( $aParams ) {
        $oView = new View("pagesEditor", "back");


    }

    /*
    * Formulaire d'édition d'un produit
    */
    public function updateAction( $aParams ) {
        $oView = new View("pagesEditor", "back");
        $oPage = new Pages();
        $oSelectId = new Pages();
        $oUpdateIsUse = new Pages();
        $aConfig = $oPage->editorForm();

        $oView->assign("aConfig", $aConfig);

        foreach($_POST as $sKey => $sValue) {
            $s .= $sKey.'|'.$sValue.';';
        }

        $s = substr($s, 0, -1);

        $oSelectId->setIsUse(1);
        $oSelectId->setType("homePage");
        $iIsUse = $oSelectId->select( array('id_page'));
        print_r($iIsUse[0]['id_page']);
        $oUpdateIsUse->setId($iIsUse[0]['id_page']);
        $oUpdateIsUse->setIsUse(0);
        $oUpdateIsUse->save();

        if (isset($_POST)){
        $oPage->setPageName("Page d'accueil");
		$oPage->setContent($s);
        $oPage->setType("homePage");
        $oPage->setIsUse(1);
		$oPage->setStatus(1);
        $oPage->save();
        }
    }

    /*
    * Suppression d'un produit en bdd
    */
    public function deleteAction( $aParams ) {

    }

    public function uploadAction ( $aParams ) {
       

    }

    public function refactorConfigs() {        
        $this->aConfigs = $this->oPage->unsetKeyColumns($this->aConfigs, array('content', 'status'));
        $this->aConfigs['label'] = array('id', 'type', 'nom', 'statut', 'options');
        $this->aConfigs['update'] = array('url' => '/back/pages/update?id=');
        $this->aConfigs['add'] = array('url' => '/back/pages/add');

        foreach ( $this->aConfigs as $sKey => &$aValue ) {
            foreach ( $aValue as $sKey => $sValue ) {
                if ( $sKey === 'is_use' ) {
                    $aValue[$sKey] = Helper::getStatus($aValue[$sKey]);
                }
                if ( $aValue[$sKey] == '' ) {
                    $aValue[$sKey] = 'Non renseigné';
                }
            }
        }
    }
}
