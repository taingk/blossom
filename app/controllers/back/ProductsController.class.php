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
        $oView->assign( "aConfigs", $this->aConfigs );
        $oView->assign( "aParams", array('id' => 'id_product') );
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

    public function allCategoriesAction( $iSelected = "" ) {
        $oCategory = new Categories();
        $aCategories = [];
        $aSelects = $oCategory->select(array('id_category','category_name'));

        foreach($aSelects as $key => $value) {
            if ( $iSelected == $value['id_category'] ) {
                array_push($aCategories, ['id' => $value['id_category'], 'name' => $value['category_name'], 'selected' => 'true' ]);
            } else {
                array_push($aCategories, ['id' => $value['id_category'], 'name' => $value['category_name']]);
            }
        }

        return $aCategories;
    }

    /*
    * Formulaire d'ajout de produit
    */
    public function addAction( $aParams ) {
        $this->aConfigs = $this->oProduct->productForm("Ajouter un nouveau produit", $this->allCategoriesAction());
        $this->oCategory = new Categories();
        $aIdCategory = $this->oCategory->select(array('id_category'));

        if ( !empty( $aParams['POST']) && !empty($aIdCategory) ) {

            $this->oProduct->setProductName( $aParams['POST']['product_name'] );
            $this->oProduct->setCategoriesIdCategory( $aParams['POST']['category'] );
            $this->oProduct->setDescription( $aParams['POST']['description'] );
            $this->oProduct->setPrice( $aParams['POST']['price'] );
            $this->oProduct->setStatus('1');
            $this->oProduct->setQuantity( $aParams['POST']['max_quantity'] );
            $this->oProduct->setMaxQuantity( $aParams['POST']['max_quantity'] );
            $this->oProduct->save();

            header('location: /back/products');
            return;
        }

        $oView = new View("editing", "back");
        $oView->assign("aConfigs", $this->aConfigs);
    }


    /*
    * Formulaire d'édition d'un produit 
    */ 
    public function updateAction( $aParams ) {        
        $sId = $aParams['GET']['id'];
        $this->oProduct->setId( $sId );
        $aInfosProduct = $this->oProduct->select()[0];
        $this->aConfigs = $this->oProduct->productForm("Editer le produit", $this->allCategoriesAction($aInfosProduct['categories_idcategory']));

        foreach ( $this->aConfigs['input'] as $sKey => &$aValue ) {
            foreach ( $aInfosProduct as $sInfoKey => $sInfoValue ) {
                if ( $sKey == $sInfoKey ) {
                    $aValue['value'] = $sInfoValue;
                }
            }
        }

        if ( !empty( $aParams['POST'] ) ) {
            $oProduct = new Products();

            $oProduct->setId( $sId );
            $oProduct->setProductName( $aParams['POST']['product_name'] );
            $oProduct->setCategoriesIdCategory( $aParams['POST']['category'] );
            $oProduct->setPrice( $aParams['POST']['price'] );
            $oProduct->setDescription( $aParams['POST']['description'] );
            $oProduct->setQuantity( $aParams['POST']['max_quantity'] );
            $oProduct->setMaxQuantity( $aParams['POST']['max_quantity'] );
            $oProduct->save();

            header('location: /back/products');
            return;
        }

        $oView = new View("editing", "back");
        $oView->assign("aConfigs", $this->aConfigs);
    }

    /*
    * Suppression d'un produit en bdd
    */ 
    public function deleteAction( $aParams ) {
        if ($_GET['id']) {
            $this->oProduct->setId($_GET['id']);
            $sStatus = $this->oProduct->select(array('status'))[0]['status'];

            $sStatus ? $this->oProduct->setStatus(0) : $this->oProduct->setStatus(1);
            $this->oProduct->save();

            header('location: /back/products');
            return;
        }
    }
    
    /*
    * On get un appel AJAX pour filtrer un/des produit(s)
    */ 
    public function filterAction( $aParams ) {

    }

    public function refactorConfigs() {
        $this->aConfigs = $this->oProduct->unsetKeyColumns($this->aConfigs, array('date_inserted', 'date_updated', 'description'));
        $this->aConfigs['label'] = array('id', 'produit', 'categorie', 'prix','qté actuelle', 'qté max','status', 'options');
        $this->aConfigs['update'] = array('url' => '/back/products/update?id=');
        $this->aConfigs['delete'] = array('url' => '/back/products/delete?id=');
        $this->aConfigs['add'] = array('url' => '/back/products/add');

        foreach ( $this->aConfigs as $sKey => &$aValue ) {
            foreach ( $aValue as $sKey => $sValue ) {
                if ( $sKey === 'price' ) {
                    $aValue[$sKey] = $sValue . '€';
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