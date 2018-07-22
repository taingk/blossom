<?php

class ImagesController {
    private $oImage;
    private $aConfigs;

    public function __construct() {
        $this->oImage = new Images();
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
        $oView->assign( "aParams", array('id' => 'id_image') );
    }

    /*
    * Listes tous les produits
    */

    public function listing() {
        $this->aConfigs = $this->oImage->select();
    }

    /*
    * On remplie aConfigs par la recherche
    */
    public function search( $sSearch ) {
        $this->oImage->setImageName( $sSearch );
        $this->aConfigs = $this->oImage->search();
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
            $aFiles = Helper::uploadFiles($_FILES);

            foreach ( $aFiles['success'] as $aFile ) {
                if ( $aFile['name'] == 'image' ) {
                    $this->oImage->setPath( $aFile['path'] );
                }
            }
            $this->oImage->setImageName( $aParams['POST']['image_name'] );
            $this->oImage->setStatus(1);
            $this->oImage->setProductsIdProduct( $aParams['POST']['product'] );
            $this->oImage->save();

            header('location: /back/images');
            return;
        }
        
        $this->aConfigs = $this->oImage->imageForm("Ajouter une nouvelle image", $this->allProductsAction());
        $oView = new View("editing", "back");
        $oView->assign("aConfigs", $this->aConfigs);
    }


    /*
    * Formulaire d'édition d'un produit 
    */ 
    public function updateAction( $aParams ) {        
        $sId = $aParams['GET']['id'];
        $this->oImage->setId( $sId );
        $aInfosProduct = $this->oImage->select()[0];
        $this->aConfigs = $this->oImage->imageForm("Editer l'image", $this->allProductsAction($aInfosProduct['products_idproduct']));
        
        foreach ( $this->aConfigs['input'] as $sKey => &$aValue ) {
            foreach ( $aInfosProduct as $sInfoKey => $sInfoValue ) {
                if ( $sKey == $sInfoKey ) {
                    $aValue['value'] = $sInfoValue;
                }
            }
        }

        if ( !empty( $aParams['POST'] ) ) {
            $aFiles = Helper::uploadFiles($_FILES);

            foreach ( $aFiles['success'] as $aFile ) {
                if ( $aFile['name'] == 'image' ) {
                    $this->oImage->setPath( $aFile['path'] );
                }
            }
            $this->oImage->setId( $sId );
            $this->oImage->setImageName( $aParams['POST']['image_name'] );
            $this->oImage->setProductsIdProduct( $aParams['POST']['product'] );
            $this->oImage->setStatus(1);
            $this->oImage->save();
            
            header('location: /back/images');
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
            $this->oImage->setId($_GET['id']);
            $sStatus = $this->oImage->select(array('status'))[0]['status'];

            $sStatus ? $this->oImage->setStatus(0) : $this->oImage->setStatus(1);
            $this->oImage->save();

            header('location: /back/images');
            return;
        }
    }
    
    /*
    * On get un appel AJAX pour filtrer un/des produit(s)
    */ 
    public function filterAction( $aParams ) {

    }
    public function refactorConfigs() {
        $this->aConfigs = $this->oImage->unsetKeyColumns($this->aConfigs, array('date_inserted', 'date_updated', 'path'));
        $this->aConfigs['label'] = array('id', 'Nom', 'référence produit', 'Status', 'Options');
        $this->aConfigs['update'] = array('url' => '/back/images/update?id=');
        $this->aConfigs['delete'] = array('url' => '/back/images/delete?id=');
        $this->aConfigs['add'] = array('url' => '/back/images/add');

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