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
        $this->oColor = new Colors();
        $this->oImage = new Images();
        $this->oCapacity = new Capacities();
        $this->aConfigs = $this->oProduct->productFormAdd();

        /*foreach($this->aConfigs as $sKey => &$aValue ) {
            $aCategory = ['id' => , 'name' => ];
        }*/

        //array_push($this->aConfigs['input']['category']['options'], $aCategory);

        //print_r($this->aConfigs);

        $sPathDirectory = 'public/uploads/';
        $aFiles = [];

        foreach ($_FILES as $aFile) {
            $sExt = strtolower(pathinfo($aFile['name'], PATHINFO_EXTENSION));
            $sName = basename(strtolower(uniqid() .'.'. $sExt));
            $sFullPath = $sPathDirectory . $sName;
            array_push($aFiles, $sFullPath);

            if ( !move_uploaded_file($aFile['tmp_name'], $sFullPath) ) {
                error_log("Erreur dans l'upload " . $aFile['name']);
            }
        }

        $aFiles[0];

        //$aAllId = $this->oProduct->select(array('id_product'));
       // print_r($aAllId);

        if ( !empty( $aParams['POST'] ) ) {



                //$this->oProduct->setProductName($aParams['POST']['name']);
                //$sNameCategorie = $this->oCategory->setCategoryName($aParams['POST']['category']);
                //$iIdCategorie = $this->oCategory->select('id_category')[0];
                //$this->oProduct->setCategoriesIdCategory($iIdCategorie);
                //$this->oProduct->setDescription($aParams['POST']['description']);
                //$this->oProduct->setPrice($aParams['POST']['price']);
                //$this->oProduct->setStatus(1);
                //$this->oProduct->save();

                header('location: /back/products ');
                return;

        }

        $oView = new View("editing", "back");

        $oView->assign("aConfigs", $this->aConfigs);
        $oView->assign("aErrors", $aErrors);
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
        //$this->aConfigs = $this->oProduct->unsetKeyColumns($this->aConfigs, array('date_inserted', 'date_updated', 'token', 'pwd'));
        $this->aConfigs['label'] = array('id', 'produit', 'categorie', 'prix', 'status', 'options');
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