<?php

class HomepagesController {
    private $oHomePage;
    private $aConfigs;

    public function __construct() {
        $this->oHomePage = new Homepages();
    }

    /*
    * View listing de homepages
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
        $oView->assign( "aParams", array('id' => 'id_homepage') );
   }

    /*
    * Liste toutes les homepages
    */ 
    public function listing() {
        $this->aConfigs = $this->oHomePage->select();
    }

    /*
    * On remplie aConfigs par la recherche
    */ 
    public function search( $sSearch ) {
        $this->oHomePage->setName( $sSearch );
        $this->aConfigs = $this->oHomePage->search();
    }

    /*
    * Formulaire d'ajout de homepages
    */
    public function addAction( $aParams ) {
        if ( !empty( $aParams['POST'] ) ) {
            $this->disableAll();

            $oHomePage = new Homepages();
            $aFiles = Helper::uploadFiles($_FILES);

            $oHomePage->setName($aParams['POST']['name']);
            $oHomePage->setDescriptionTopBanner($aParams['POST']['description_top_banner']);
            $oHomePage->setDescriptionImages($aParams['POST']['description_images']);
            $oHomePage->setDescriptionBottomBanner($aParams['POST']['description_bottom_banner']);
            foreach ( $aFiles['success'] as $aFile ) {
                if ( $aFile['name'] == 'banner' ) {
                    $oHomePage->setBanner($aFile['path']);
                }
                if ( $aFile['name'] == 'left_image' ) {
                    $oHomePage->setLeftImage($aFile['path']);
                }
                if ( $aFile['name'] == 'right_image' ) {
                    $oHomePage->setRightImage($aFile['path']);
                }
                if ( $aFile['name'] == 'bottom_banner' ) {
                    $oHomePage->setBottomBanner($aFile['path']);
                }
            }
            $oHomePage->setIsUse(1);
            $oHomePage->save();

            header('location: /back/homepages');
            return;
        }

        $this->aConfigs = $this->oHomePage->homePageForm("Ajouter une nouvelle page d'accueil");
        $oView = new View("editing", "back");
        $oView->assign("aConfigs", $this->aConfigs);
    }

    public function disableAll() {
        $oSelect = new Homepages();
        $oSelect->setIsUse(1);
        $aIsUse = $oSelect->select();

        foreach ($aIsUse as $aPages) {
            $oPage = new Homepages();
            $oPage->setId($aPages['id_homepage']);
            $oPage->setIsUse(0);
            $oPage->save();
        }
    }

    /*
    * Formulaire d'édition de page
    */
    public function updateAction( $aParams ) {
        $this->aConfigs = $this->oHomePage->homePageForm("Editer la page d'accueil");
        $sId = $aParams['GET']['id'];

        $this->oHomePage->setId($sId);
        $aInfos = $this->oHomePage->select()[0];

        foreach ($this->aConfigs['input'] as $sKey => &$aValue) {
            foreach ($aInfos as $sInfoKey => $sInfoValue) {
                if ( $sKey == $sInfoKey ) {
                    $aValue['value'] = $sInfoValue;
                }
            }
        }

        if ( !empty( $aParams['POST'] ) ) {
            $oHomePage = new Homepages();
            $aFiles = Helper::uploadFiles($_FILES);

            $oHomePage->setId($sId);
            $oHomePage->setName($aParams['POST']['name']);
            $oHomePage->setDescriptionTopBanner($aParams['POST']['description_top_banner']);
            $oHomePage->setDescriptionImages($aParams['POST']['description_images']);
            $oHomePage->setDescriptionBottomBanner($aParams['POST']['description_bottom_banner']);
            foreach ( $aFiles['success'] as $aFile ) {
                if ( $aFile['name'] == 'banner' ) {
                    $oHomePage->setBanner($aFile['path']);
                }
                if ( $aFile['name'] == 'left_image' ) {
                    $oHomePage->setLeftImage($aFile['path']);
                }
                if ( $aFile['name'] == 'right_image' ) {
                    $oHomePage->setRightImage($aFile['path']);
                }
                if ( $aFile['name'] == 'bottom_banner' ) {
                    $oHomePage->setBottomBanner($aFile['path']);
                }
            }
            $oHomePage->save();

            header('location: /back/homepages');
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
            $this->oHomePage->setId($_GET['id']);
            $sStatus = $this->oHomePage->select(array('is_use'))[0]['is_use'];            

            $this->disableAll();

            $sStatus ? $this->oHomePage->setIsUse(0) : $this->oHomePage->setIsUse(1);
            $this->oHomePage->save();

            header('location: /back/homepages');
            return;
        }
    }

    public function refactorConfigs() {
        if ( $this->aConfigs ) {
            $this->aConfigs = $this->oHomePage->unsetKeyColumns($this->aConfigs, array('date_inserted', 'date_updated', 'description_top_banner', 'description_images',
                'description_bottom_banner', 'banner', 'left_image', 'right_image', 'bottom_banner',
                'status'));
            $this->aConfigs['label'] = array('id', 'nom', 'actif', 'options');
            $this->aConfigs['update'] = array('url' => '/back/homepages/update?id=');
            $this->aConfigs['delete'] = array('url' => '/back/homepages/delete?id=');
            $this->aConfigs['add'] = array('url' => '/back/homepages/add');
            
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
            $this->aConfigs['update'] = array('url' => '/back/homepages/update?id=');
            $this->aConfigs['delete'] = array('url' => '/back/homepages/delete?id=');
            $this->aConfigs['add'] = array('url' => '/back/homepages/add');
        }
    }
}
