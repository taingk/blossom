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
        $this->oProduct->setId( $sId );
        $aInfosProduct = $this->oProduct->select()[0];

        $oColor = new Colors();
        $oColor->setProductsIdProduct( $sId );
        $aInfosColor = $oColor->select( array('name','color_hexa') );

        $oCapacity = new Capacities();
        $oCapacity->setProductsIdProduct( $sId );
        $aInfosCapacity = $oCapacity->select( array('capacity_number','additional_price') );

        $sColor = '';
        foreach( $aInfosColor as $sInfoKey => $sInfoValue ) {
            $sColor .= $sInfoValue['name']. ":" . $sInfoValue['color_hexa'] . ";";
        }
        $sColor = substr( $sColor, 0, -1 );

        $sCapacity = '';
        foreach( $aInfosCapacity as $sInfoKey => $sInfoValue ) {
            $sCapacity .= $sInfoValue['capacity_number']. ":" . $sInfoValue['additional_price'] . ";";
        }
        $sCapacity = substr( $sCapacity, 0, -1 );


        foreach ( $this->aConfigs['input'] as $sKey => &$aValue ) {
            foreach ( $aInfosProduct as $sInfoKey => $sInfoValue ) {
                if ( $sKey == "color") {
                    $aValue['value'] = $sColor;
                }
                elseif ( $sKey == "capacity") {
                    $aValue['value'] = $sCapacity;
                }
                elseif ( $sKey == $sInfoKey ) {
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

            $oGetColor = new Colors();
            $oGetColor->setProductsIdProduct( $sId) ;
            $oGetColor->setStatus(1);
            $aGetColor = $oGetColor->select( array('id_color','name', 'color_hexa') );

            foreach( $aGetColor as $key => $value ) {
                $oSetColorId = new Colors();
                $oSetColorId->setId( $value['id_color'] );
                $oSetColorId->setStatus(0);
                $oSetColorId->save();
            }

            $sColor = $aParams['POST']['color'];
            $aColors = explode(';',$sColor);

            $oGetColor2 = new Colors();
            $oGetColor2->setProductsIdProduct( $sId) ;
            $oGetColor2->setStatus(0);
            $aGetColor2 = $oGetColor2->select( array('id_color','name', 'color_hexa') );

            $aColorsExploded = [];

            foreach( $aColors as $key => $value ){
                array_push($aColorsExploded, explode( ':', $value ));
            }

            print_r($aColorsExploded);
            echo "<br>";
            print_r($aGetColor2);
            foreach($aGetColor2 as $key => $value) {
                print_r($value['name']);
                echo "<br>";
                print_r($value['color_hexa']);
                echo "<br>";
                foreach($aColorsExploded as $key2 => $value2) {
//                    if( $value['name'] != $value2[0] || $value['color_hexa'] != $value2[1] ) {
//                        echo $value['name']." not equal ".$value2[0];
//                        echo $value['color_hexa']." not equal ".$value2[1];
//                    }
                    //print_r($value2[0]);
                    echo "<br>";
                    //print_r($value2[1]);
                    echo "<br>";
                }

            }

            //header('location: /back/products');
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
        $this->aConfigs = $this->oProduct->unsetKeyColumns($this->aConfigs, array('date_inserted', 'date_updated', 'max_quantity', 'description'));
        $this->aConfigs['label'] = array('id', 'produit', 'categorie', 'prix','quantité','status', 'options');
        $this->aConfigs['update'] = array('url' => '/back/products/update?id=');
        $this->aConfigs['delete'] = array('url' => '/back/products/delete?id=');
        $this->aConfigs['add'] = array('url' => '/back/products/add');

        foreach ( $this->aConfigs as $sKey => &$aValue ) {
            foreach ( $aValue as $sKey => $sValue ) {
                if ( $sKey === 'category' ) {
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