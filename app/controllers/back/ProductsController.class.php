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

    /*
    * Formulaire d'ajout de produit
    */
    public function addAction( $aParams ) {
        $this->aConfigs = $this->oProduct->productForm("Ajouter un nouveau produit");
        $this->oCategory = new Categories();
        $aIdCategory = $this->oCategory->select(array('id_category'));

        if ( !empty( $aParams['POST']) && !empty($aIdCategory) ) {

            $this->oProduct->setProductName( $aParams['POST']['name'] );
            $this->oProduct->setCategoriesIdCategory( $aParams['POST']['category'] );
            $this->oProduct->setDescription( $aParams['POST']['description'] );
            $this->oProduct->setPrice( $aParams['POST']['price'] );
            $this->oProduct->setStatus('1');
            $this->oProduct->setQuantity( $aParams['POST']['quantity'] );
            $this->oProduct->setMaxQuantity( $aParams['POST']['quantity'] );
            //Save l'id du dernier produit inséré :
            $iLastId = $this->oProduct->save();

            $aFiles = Helper::uploadFiles( $_FILES );

            foreach ( $aFiles['success'] as $aFile ) {

                $oImage = new Images();
                $oImage->setPath( $aFile['path'] );
                $oImage->setProductsIdProduct( $iLastId );
                $oImage->setStatus('1');
                $oImage->setImageName('Test');
                $oImage->save();

            }

            $sColor = $aParams['POST']['color'];
            $aColors = explode(';',$sColor);

            foreach( $aColors as $key => $value ){

                $aValue = explode( ':', $value );
                $oColor = new Colors();
                $oColor->setName( $aValue[0] );
                $oColor->setColorHexa( $aValue[1] );
                $oColor->setStatus('1');
                $oColor->setProductsIdProduct( $iLastId );
                $oColor->save();

            }

            $sCapacity = $aParams['POST']['capacity'];
            $aCapacities = explode(';',$sCapacity);

            foreach( $aCapacities as $key => $value ) {

                $aValue = explode( ':', $value );
                $oCapacity = new Capacities();
                $oCapacity->setCapacityNumber( $aValue[0] );
                $oCapacity->setAdditionalPrice( $aValue[1] );
                $oCapacity->setStatus(1);
                $oCapacity->setProductsIdProduct( $iLastId );
                $oCapacity->save();

            }

            header('location: /back/products ');
            return;

        }

        $oView = new View("editing", "back");

        $oView->assign("aConfigs", $this->aConfigs);
    }


    /*
    * Formulaire d'édition d'un produit 
    */ 
    public function updateAction( $aParams ) {
        $this->aConfigs = $this->oProduct->productForm("Editer le produit");
        $sId = $aParams['GET']['id'];
        $this->oProduct->setId($sId);
        $aInfosProduct = $this->oProduct->select()[0];
        $oColor = new Colors();
        $oColor->setProductsIdProduct($sId);
        $aInfosColor = $oColor->select(array('name','color_hexa'));
        $oCapacity = new Capacities();
        $oCapacity->setProductsIdProduct($sId);
        $aInfosCapacity = $oCapacity->select(array('capacity_number','additional_price'));

        $sColor = '';
        foreach( $aInfosColor as $sInfoKey => $sInfoValue ){
            $sColor .= $sInfoValue['name']. ":" . $sInfoValue['color_hexa'] . ";";
        }
        $sColor = substr($sColor, 0, -1);

        $sCapacity = '';
        foreach( $aInfosCapacity as $sInfoKey => $sInfoValue ){
            $sCapacity .= $sInfoValue['capacity_number']. ":" . $sInfoValue['additional_price'] . ";";
        }
        $sCapacity = substr($sCapacity, 0, -1);


        foreach ($this->aConfigs['input'] as $sKey => &$aValue) {
            foreach ($aInfosProduct as $sInfoKey => $sInfoValue) {
                if ( $sKey == "color") {
                    $aValue['value'] = $sColor;
                }
                elseif ( $sKey == "capacity") {
                    $aValue['value'] = $sCapacity;
                }
                elseif ($sKey == $sInfoKey) {
                    $aValue['value'] = $sInfoValue;
                }
            }
        }

        if ( !empty( $aParams['POST'] ) ) {
            $oProduct = new Products();
            $aFiles = Helper::uploadFiles($_FILES);

            $oProduct->setId($sId);
            $oProduct->setProductName( $aParams['POST']['name'] );
            $oProduct->setCategoriesIdCategory( $aParams['POST']['category'] );
            $oProduct->setPrice( $aParams['POST']['price'] );
            $oProduct->setDescription( $aParams['POST']['description'] );
            $oProduct->setQuantity( $aParams['POST']['quantity'] );
            $oProduct->setMaxQuantity( $aParams['POST']['quantity'] );
            $oProduct->save();

            $colorUpdate = new Colors();
            $colorUpdate->setProductsIdProduct( $sId) ;
            $aColorsUpdate = $colorUpdate->select( array('id_color') );
            foreach( $aColorsUpdate as $key => $value ) {
                $colorUpdate->setId($value['id_color']);
                $colorUpdate->setStatus(0);
                $colorUpdate->save();
            }

            $colorUpdate = new Colors();
            $colorUpdate->setProductsIdProduct( $sId) ;
            $aColorsUpdate = $colorUpdate->select( array('id_color') );
            foreach( $aColorsUpdate as $key => $value ) {
                $colorUpdate->setId($value['id_color']);
                $colorUpdate->setStatus(0);
                $colorUpdate->save();
            }


            $sColor = $aParams['POST']['color'];
            $aColors = explode(';',$sColor);
            foreach( $aColors as $key => $value ){

                $aValue = explode( ':', $value );
                $oColorInsert = new Colors();
                $oColorInsert->setName( $aValue[0] );
                $oColorInsert->setColorHexa( $aValue[1] );
                $oColorInsert->setStatus('1');
                $oColorInsert->setProductsIdProduct( $sId );
                $oColorInsert->save();


            }

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