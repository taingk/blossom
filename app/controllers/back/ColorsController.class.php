<?php

class ColorsController {
    private $oColor;
    private $aConfigs;

    public function __construct() {
        $this->oColor = new Colors();
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
        $oView->assign( "aParams", array('id' => 'id_color') );
    }

    /*
    * Listes tous les produits
    */

    public function listing() {
        $this->aConfigs = $this->oColor->select();
    }

    /*
    * On remplie aConfigs par la recherche
    */
    public function search( $sSearch ) {
        $this->oColor->setName( $sSearch );
        $this->aConfigs = $this->oColor->search();
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
            $this->oColor = new Colors();
            
            $this->oColor->setName( $aParams['POST']['name'] );
            $this->oColor->setColorHexa( $aParams['POST']['color_hexa'] );
            $this->oColor->setProductsIdProduct( $aParams['POST']['product'] );
            $this->oColor->setStatus(1);
            $this->oColor->save();
            
            header('location: /back/colors');
            return;
        }
        
        $this->aConfigs = $this->oColor->colorForm("Ajouter une nouvelle couleur", $this->allProductsAction());
        $oView = new View("editing", "back");
        $oView->assign("aConfigs", $this->aConfigs);
    }


    /*
    * Formulaire d'édition d'un produit 
    */ 
    public function updateAction( $aParams ) {        
        $sId = $aParams['GET']['id'];
        $this->oColor->setId( $sId );
        $aInfosProduct = $this->oColor->select()[0];
        $this->aConfigs = $this->oColor->colorForm("Editer la couleur", $this->allProductsAction($aInfosProduct['products_idproduct']));
        
        foreach ( $this->aConfigs['input'] as $sKey => &$aValue ) {
            foreach ( $aInfosProduct as $sInfoKey => $sInfoValue ) {
                if ( $sKey == $sInfoKey ) {
                    $aValue['value'] = $sInfoValue;
                }
            }
        }

        if ( !empty( $aParams['POST'] ) ) {
            $this->oColor = new Colors();

            $this->oColor->setId( $sId );
            $this->oColor->setName( $aParams['POST']['name'] );
            $this->oColor->setColorHexa( $aParams['POST']['color_hexa'] );
            $this->oColor->setProductsIdProduct( $aParams['POST']['product'] );
            $this->oColor->setStatus(1);
            $this->oColor->save();
            
            header('location: /back/colors');
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
            $this->oColor->setId($_GET['id']);
            $sStatus = $this->oColor->select(array('status'))[0]['status'];

            $sStatus ? $this->oColor->setStatus(0) : $this->oColor->setStatus(1);
            $this->oColor->save();

            header('location: /back/Colors');
            return;
        }
    }
    
    /*
    * On get un appel AJAX pour filtrer un/des produit(s)
    */ 
    public function filterAction( $aParams ) {

    }
    public function refactorConfigs() {
        $this->aConfigs = $this->oColor->unsetKeyColumns($this->aConfigs, array('date_inserted', 'date_updated'));
        $this->aConfigs['label'] = array('id', 'Couleur', 'Hexadecimal', 'référence produit', 'status', 'options');
        $this->aConfigs['update'] = array('url' => '/back/colors/update?id=');
        $this->aConfigs['delete'] = array('url' => '/back/colors/delete?id=');
        $this->aConfigs['add'] = array('url' => '/back/colors/add');

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