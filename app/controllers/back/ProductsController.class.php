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
        $this->oImage1 = new Images();
        $this->oImage2 = new Images();
        $this->oImage3 = new Images();
        $this->oCapacity = new Capacities();
        $this->aConfigs = $this->oProduct->productFormAdd();

        $iId = $this->oProduct->getLastId();
        $iLastId = $iId[0]['id_product'];
        $iCurrentId = $iLastId + 1;


        if ( !empty( $aParams['POST'] ) ) {

            //$aFiles = Helper::uploadFiles($_FILES);

            //$this->oProduct->setProductName($aParams['POST']['name']);
            //$sNameCategorie = $this->oCategory->setCategoryName($aParams['POST']['category']);
            //$iIdCategorie = $this->oCategory->select('id_category')[0];
            //$this->oProduct->setCategoriesIdCategory($iIdCategorie);
            //$this->oProduct->setCategoriesIdCategory('1');
            //$this->oProduct->setDescription($aParams['POST']['description']);

            $sColor = $aParams['POST']['color'];
            $aColors = explode(';',$sColor);
            foreach( $aColors as $key => $value ){
                $aValue = explode(':',$value );
                //print_r($aValue);
                //$aColor[] = array($aValue[0]=>$aValue[1]);
                //print_r($aColor);
                //print_r($aValue[0]);
                //echo "<br>";
                //print_r($aValue[1]);
                //echo "<br>";
                //echo "{$key2} => {$value2} "."<br>";
                    //echo $value2."<br>";
                    $this->oColor->setName($aValue[0]);
                    $this->oColor->setColorHexa($aValue[1]);
                    $this->oColor->setStatus('1');
                    $this->oColor->setProductsIdProduct($iLastId);
                    $this->oColor->save();
            }

/*            $this->oImage1->setPath($aParams['POST']['image']);
            $this->oImage1->setStatus('1');
            $this->oImage2->setPath($aParams['POST']['image2']);
            $this->oImage2->setStatus('1');
            $this->oImage3->setPath($aParams['POST']['image3']);
            $this->oImage3->setStatus('1');
            $this->oProduct->setPrice($aParams['POST']['price']);
            $this->oProduct->setStatus(1);*/

            //$this->oProduct->save();

            //header('location: /back/products ');
            return;

        }

        $oView = new View("editing", "back");

        $oView->assign("aConfigs", $this->aConfigs);
        //$oView->assign("aErrors", $aErrors);
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