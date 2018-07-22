<?php

class CapacitiesController {
    private $oCapacity;
    private $aConfigs;

    public function __construct() {
        $this->oCapacity = new Capacities();
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
        $oView->assign( "aParams", array('id' => 'id_capacity') );
    }

    /*
    * Listes tous les produits
    */

    public function listing() {
        $this->aConfigs = $this->oCapacity->select();
    }

    /*
    * On remplie aConfigs par la recherche
    */
    public function search( $sSearch ) {
        $this->oCapacity->setId( $sSearch );
        $this->aConfigs = $this->oCapacity->search();
    }

    /*
    * View profil produit
    */ 
    public function profileAction( $aParams ) {

    }

    public function allProductsAction( $iSelected = "" ) {
        $oProduct = new Products();
        $aProducts = [];
        $aSelects = $oProduct->select(array('id_product','product_name'));

        foreach($aSelects as $key => $value) {
            if ( $iSelected == $value['id_product'] ) {
                array_push($aProducts, ['id' => $value['id_product'], 'name' => $value['product_name'], 'selected' => 'true' ]);
            } else {
                array_push($aProducts, ['id' => $value['id_product'], 'name' => $value['product_name']]);
            }
        }

        return $aProducts;
    }

    /*
    * Formulaire d'ajout de produit
    */
    public function addAction( $aParams ) {
        if ( !empty( $aParams['POST'] ) ) {
            $this->oCapacity = new Capacities();

            $this->oCapacity->setCapacityNumber( $aParams['POST']['capacity_number'] );
            $this->oCapacity->setAdditionalPrice( $aParams['POST']['additional_price'] );
            $this->oCapacity->setProductsIdProduct( $aParams['POST']['product'] );
            $this->oCapacity->setStatus(1);
            $this->oCapacity->save();
            
            header('location: /back/capacities');
            return;
        }
        
        $this->aConfigs = $this->oCapacity->capacityForm("Ajouter une nouvelle couleur", $this->allProductsAction());
        $oView = new View("editing", "back");
        $oView->assign("aConfigs", $this->aConfigs);
    }


    /*
    * Formulaire d'édition d'un produit 
    */ 
    public function updateAction( $aParams ) {        
        $sId = $aParams['GET']['id'];
        $this->oCapacity->setId( $sId );
        $aInfosProduct = $this->oCapacity->select()[0];
        $this->aConfigs = $this->oCapacity->capacityForm("Editer la couleur", $this->allProductsAction($aInfosProduct['products_idproduct']));
        
        foreach ( $this->aConfigs['input'] as $sKey => &$aValue ) {
            foreach ( $aInfosProduct as $sInfoKey => $sInfoValue ) {
                if ( $sKey == $sInfoKey ) {
                    $aValue['value'] = $sInfoValue;
                }
            }
        }

        if ( !empty( $aParams['POST'] ) ) {
            $this->oCapacity = new Capacities();

            $this->oCapacity->setId( $sId );
            $this->oCapacity->setCapacityNumber( $aParams['POST']['capacity_number'] );
            $this->oCapacity->setAdditionalPrice( $aParams['POST']['additional_price'] );
            $this->oCapacity->setProductsIdProduct( $aParams['POST']['product'] );
            $this->oCapacity->setStatus(1);
            $this->oCapacity->save();
            
            header('location: /back/capacities');
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
            $this->oCapacity->setId($_GET['id']);
            $sStatus = $this->oCapacity->select(array('status'))[0]['status'];

            $sStatus ? $this->oCapacity->setStatus(0) : $this->oCapacity->setStatus(1);
            $this->oCapacity->save();

            header('location: /back/capacities');
            return;
        }
    }
    
    /*
    * On get un appel AJAX pour filtrer un/des produit(s)
    */ 
    public function filterAction( $aParams ) {

    }
    public function refactorConfigs() {
        $this->aConfigs = $this->oCapacity->unsetKeyColumns($this->aConfigs, array('date_inserted', 'date_updated'));
        $this->aConfigs['label'] = array('id', 'stockage', 'prix additionnel', 'référence produit', 'status', 'options');
        $this->aConfigs['update'] = array('url' => '/back/capacities/update?id=');
        $this->aConfigs['delete'] = array('url' => '/back/capacities/delete?id=');
        $this->aConfigs['add'] = array('url' => '/back/capacities/add');

        foreach ( $this->aConfigs as $sKey => &$aValue ) {
            foreach ( $aValue as $sKey => $sValue ) {
                if ( $sKey === 'capacity_number' ) {
                    $aValue[$sKey] = $sValue . 'go';
                }
                if ( $sKey === 'additional_price' ) {
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