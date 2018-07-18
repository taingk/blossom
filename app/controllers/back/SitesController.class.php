<?php

class SitesController {
    private $oSite;
    private $aConfigs;

    public function __construct() {
        $this->oSite = new Sites();
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
        $oView->assign( "aParams", array('id' => 'id_site') );
   }

    /*
    * Liste toutes les Legalnotices
    */ 
    public function listing() {
        $this->aConfigs = $this->oSite->select();
    }

    /*
    * On remplie aConfigs par la recherche
    */ 
    public function search( $sSearch ) {
        $this->oSite->setName( $sSearch );
        $this->aConfigs = $this->oSite->search();
    }

    /*
    * Formulaire d'ajout de Legalnotices
    */
    public function addAction( $aParams ) {
        if ( !empty( $aParams['POST'] ) ) {
            $this->disableAll();

            $oSite = new Sites();
            $aFiles = Helper::uploadFiles($_FILES);

            $oSite->setName($aParams['POST']['name']);
            foreach ( $aFiles['success'] as $aFile ) {
                if ( $aFile['name'] == 'logo' ) {
                    $oSite->setLogo($aFile['path']);
                }
                if ( $aFile['name'] == 'favicon' ) {
                    $oSite->setFavicon($aFile['path']);
                }
            }
            $oSite->setMainColor($aParams['POST']['main_color']);
            $oSite->setSecondaryColor($aParams['POST']['secondary_color']);
            $oSite->setThirdColor($aParams['POST']['third_color']);
            $oSite->setBackgroundColor($aParams['POST']['background_color']);
            $oSite->setIsUse(1);
            $oSite->save();

            $this->setColors();

            header('location: /back/sites');
            return;
        }

        $this->aConfigs = $this->oSite->sitesForm();
        $oView = new View("editing", "back");
        $oView->assign("aConfigs", $this->aConfigs);
    }

    public function disableAll() {
        $oSelect = new Sites();
        $oSelect->setIsUse(1);
        $aIsUse = $oSelect->select();

        foreach ($aIsUse as $aPages) {
            $oPage = new Sites();
            $oPage->setId($aPages['id_site']);
            $oPage->setIsUse(0);
            $oPage->save();
        }
    }

    public function setColors() {
        $this->oSite->setIsUse(1);
        $aSites = $this->oSite->select(array('main_color', 'secondary_color', 'third_color', 'background_color'))[0];

        $sCssPath = getcwd() . '/public/css/customColors.css';
        $sCss = ":root {
            --main-color: " . $aSites['main_color'] . ";
            --secondary-color: " . $aSites['secondary_color'] . ";
            --third-color: " . $aSites['third_color'] . ";
            --background-color: " . $aSites['background_color'] . ";
        }";

        file_put_contents($sCssPath, $sCss);    
    }

    /*
    * Formulaire d'édition de page
    */
    public function updateAction( $aParams ) {
        $this->aConfigs = $this->oSite->sitesForm();
        $sId = $aParams['GET']['id'];

        $this->oSite->setId($sId);
        $aInfos = $this->oSite->select()[0];

        foreach ($this->aConfigs['input'] as $sKey => &$aValue) {
            foreach ($aInfos as $sInfoKey => $sInfoValue) {
                if ( $sKey == $sInfoKey ) {
                    $aValue['value'] = $sInfoValue;
                }
            }
        }

        if ( !empty( $aParams['POST'] ) ) {
            $oSite = new Sites();
            $aFiles = Helper::uploadFiles($_FILES);

            $oSite->setId($sId);
            $oSite->setName($aParams['POST']['name']);
            foreach ( $aFiles['success'] as $aFile ) {
                if ( $aFile['name'] == 'logo' ) {
                    $oSite->setLogo($aFile['path']);
                }
                if ( $aFile['name'] == 'favicon' ) {
                    $oSite->setFavicon($aFile['path']);
                }
            }
            $oSite->setMainColor($aParams['POST']['main_color']);
            $oSite->setSecondaryColor($aParams['POST']['secondary_color']);
            $oSite->setThirdColor($aParams['POST']['third_color']);
            $oSite->setBackgroundColor($aParams['POST']['background_color']);
            $oSite->save();

            $this->setColors();

            header('location: /back/sites');
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
            $this->oSite->setId($_GET['id']);
            $sStatus = $this->oSite->select(array('is_use'))[0]['is_use'];            

            $this->disableAll();

            $sStatus ? $this->oSite->setIsUse(0) : $this->oSite->setIsUse(1);
            $this->oSite->save();
            
            if ( !$sStatus ) {
                $this->setColors();
            }

            header('location: /back/sites');
            return;
        }
    }

    public function refactorConfigs() {
        if ( $this->aConfigs ) {
            $this->aConfigs = $this->oSite->unsetKeyColumns($this->aConfigs, array('date_inserted', 'date_updated', 'logo', 'favicon', 'main_color', 'secondary_color', 'third_color', 'background_color', 'status'));
            $this->aConfigs['label'] = array('id', 'nom', 'actif', 'options');
            $this->aConfigs['update'] = array('url' => '/back/sites/update?id=');
            $this->aConfigs['delete'] = array('url' => '/back/sites/delete?id=');
            $this->aConfigs['add'] = array('url' => '/back/sites/add');

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
            $this->aConfigs['update'] = array('url' => '/back/sites/update?id=');
            $this->aConfigs['delete'] = array('url' => '/back/sites/delete?id=');
            $this->aConfigs['add'] = array('url' => '/back/sites/add');
        }
    }
}
