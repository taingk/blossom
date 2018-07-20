<?php

class ProductsController {
    private $oProduct;
    private $aConfigs;

    public function __construct() {
        $this->oProduct = new Products();
    }

    /*
    * View listing de produits
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("listing", "back");

        if ( !$aParams['POST']['search'] ) {
            $this->listing();
        } else {
            $this->search( $aParams['POST']['search'] );
        }

        $this->refactorConfigs();
        $oView->assign("aConfigs", $this->aConfigs );
    }

    /*
    * Listes tous les produits
    */

    public function listing() {
        $this->aConfigs = $this->oProduct->select();
    }

    /*
    * On remplie aConfigs par la recherche
    */
    public function search( $sSearch ) {
        $this->oProduct->setProductName( $sSearch );
        $this->aConfigs = $this->oProduct->search();
    }

    /*
    * View profil produit
    */ 
    public function profileAction( $aParams ) {

    }

    /*
    * Formulaire d'ajout de produit
    */
    public function addAction( $aParams ) {
        $this->oCategory = new Categories();
        $this->aConfigs = $this->oProduct->productFormAdd();

        // $iId = $this->oProduct->getLastId();
        // $iLastId = $iId[0]['id_product'];
        // $iCurrentId = $iLastId + 1;
        
        $aIdCategory = $this->oCategory->select(array('id_category'));

        if ( !empty( $aParams['POST']) && !empty($aIdCategory) ) {

            //print_r($aParams['POST']['category']);
            $this->oProduct->setProductName($aParams['POST']['name']);
            $this->oProduct->setCategoriesIdCategory($aParams['POST']['category']);
            $this->oProduct->setDescription($aParams['POST']['description']);
            $this->oProduct->setPrice($aParams['POST']['price']);
            $this->oProduct->setStatus('1');
            $this->oProduct->setQuantity($aParams['POST']['quantity']);
            $this->oProduct->setMaxQuantity($aParams['POST']['quantity']);
            // Ta variable qui contient l'id, ca save aussi :
            //$iLastId = $this->oProduct->save();

            $aFiles = Helper::uploadFiles($_FILES);
            foreach ( $aFiles['success'] as $aFile ) {
                $oImage = new Images();
                $oImage->setPath($aFile['path']);
                $oImage->setProductsIdProduct($iLastId);
                $oImage->setStatus('1');
                $oImage->setImageName('Test');
                //$this->oImage->save();
            }

            $sColor = $aParams['POST']['color'];
            $aColors = explode(';',$sColor);
            foreach( $aColors as $key => $value ){
                $aValue = explode( ':', $value );

                $oColor = new Colors();
                $oColor->setName($aValue[0]);
                $oColor->setColorHexa($aValue[1]);
                $oColor->setStatus('1');
                $oColor->setProductsIdProduct($iLastId);
                //$this->oColor->save();
            }

            $sCapacity = $aParams['POST']['capacity'];
            //print_r($sCapacity);
            $aCapacities = explode(';',$sCapacity);
            //print_r($aCapacities);
            foreach( $aCapacities as $key => $value ){
                $aValue = explode( ':', $value );

                $oCapacity = new Capacities();
                $oCapacity->setCapacityNumber($aValue[0]);
                $oCapacity->setAdditionalPrice($aValue[1]);
                $oCapacity->setStatus(1);
                $oCapacity->setProductsIdProduct(1);
                $oCapacity->save();
            }

            //header('location: /back/products ');
            return;

        }

        $oView = new View("editing", "back");

        $oView->assign("aConfigs", $this->aConfigs);
    }


    /*
    * Formulaire d'édition d'un produit 
    */ 
    public function updateAction( $aParams ) {

    }

    /*
    * Suppression d'un produit en bdd
    */ 
    public function deleteAction( $aParams ) {

    }
    
    /*
    * On get un appel AJAX pour filtrer un/des produit(s)
    */ 
    public function filterAction( $aParams ) {

    }
    public function refactorConfigs() {
        $this->aConfigs = $this->oProduct->unsetKeyColumns($this->aConfigs, array('date_inserted', 'date_updated', 'max_quantity', 'description'));
        $this->aConfigs['label'] = array('id', 'produit', 'categorie', 'prix','quantité','status', 'options');
        $this->aConfigs['update'] = array('url' => '/back/products/update?id=');
        $this->aConfigs['add'] = array('url' => '/back/products/add');

        foreach ( $this->aConfigs as $sKey => &$aValue ) {
            foreach ( $aValue as $sKey => $sValue ) {
                if ( $sKey === 'categorie' ) {
                    $aValue[$sKey] = Helper::getCategoryName($aValue[$sKey]);
                }
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