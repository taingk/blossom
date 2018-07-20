<?php

class OrdersController {
    private $oOrder;
    private $aConfigs;

    public function __construct() {
        $this->oOrder = new Orders();
    }

    /*
    * View listing de Orders
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
        $oView->assign( "aParams", array('id' => 'id_order') );
   }

    /*
    * Liste toutes les Orders
    */ 
    public function listing() {
        $this->aConfigs = $this->oOrder->select();
    }

    /*
    * On remplie aConfigs par la recherche
    */ 
    public function search( $sSearch ) {
        $this->oOrder->setTrackingNumber( $sSearch );
        $this->aConfigs = $this->oOrder->search();
    }

    /*
    * Formulaire d'édition d'une commande
    */ 
    public function updateAction( $aParams ) {
        $oView = new View("orders", "back");
        $iId = $aParams['GET']['id'];

        $this->oOrder->setId($iId);
        $aOrders = $this->oOrder->select()[0];

        $oUser = new Users();
        $oUser->setId($aOrders['users_idusers']);
        $aUsers = $oUser->select()[0];

        $oCart = new Carts();
        $oCart->setOrdersIdOrder($aOrders['id_order']);
        $aCarts = $oCart->select();

        $aProducts = [];
        $iFinalPrice = 0;

        foreach ($aCarts as $aCart) {
            $aProduct = [];
            $iAdditionalPrice = 0;
            
            foreach ($aCart as $sKey => $sValue) {
                if ($sKey == 'id_cart') {
                    $aProduct['id_cart'] = $sValue;
                }
                if ($sKey == 'capacities_id_capacity') {
                    $oCapacity = new Capacities();
                    $oCapacity->setId($sValue);
                    $aProduct['capacity_number'] = $oCapacity->select()[0]['capacity_number'];
                    $iAdditionalPrice = $oCapacity->select()[0]['additional_price'];
                    $aProduct['additional_price'] = $iAdditionalPrice;
                }
                if ($sKey == 'products_id_product') {
                    $oProduct = new Products();
                    $oProduct->setId($sValue);

                    $iId = $oProduct->select()[0]['categories_idcategory'];
                    $oCategory = new Categories();
                    $oCategory->setId($iId);
                    
                    $iPrice = $oProduct->select()[0]['price'];
                    $aProduct['category_name'] = $oCategory->select()[0]['category_name'];
                    $aProduct['id_product'] = $oProduct->select()[0]['id_product'];
                    $aProduct['product_name'] = $oProduct->select()[0]['product_name'];
                    $aProduct['price'] = $iPrice;
                    $aProduct['final_price'] = $iPrice + $iAdditionalPrice;
                }
                if ($sKey == 'colors_id_color') {
                    $oColor = new Colors();
                    $oColor->setId($sValue);
                    $aProduct['color_name'] = $oColor->select()[0]['name'];
                }
            }
            $iFinalPrice += $aProduct['final_price'];
            $aProducts[] = $aProduct;
        }

        $oView->assign("aOrders", $aOrders);
        $oView->assign("aUsers", $aUsers);
        $oView->assign("aProducts", $aProducts);
    }

    /*
    * Commande livrée 
    */ 
    public function deleteAction( $aParams ) {
        if ($_GET['id']) {
            $this->oOrder->setId($_GET['id']);
            $sStatus = $this->oOrder->select(array('status'))[0]['status'];

            $sStatus ? $this->oOrder->setStatus(0) : $this->oOrder->setStatus(1);                
            $this->oOrder->save();

            header('location: /back/orders');
            return;
        }
    }

    public function refactorConfigs() {
        if ( $this->aConfigs ) {
            $this->aConfigs = $this->oOrder->unsetKeyColumns($this->aConfigs, array('date_inserted', 'date_updated'));
            $this->aConfigs['label'] = array('id', 'réference', 'utilisateur', 'status', 'options');
            $this->aConfigs['update'] = array('url' => '/back/orders/update?id=');
            $this->aConfigs['delete'] = array('url' => '/back/orders/delete?id=');
            
            foreach ( $this->aConfigs as $sKey => &$aValue ) {
                foreach ( $aValue as $sKey => $sValue ) {
                    if ( $sKey === 'users_idusers' ) {
                        $oUser = new Users();
                        $oUser->setId($sValue);
                        $aValue[$sKey] = $oUser->select()[0]['email'];
                    }
                    if ( $sKey === 'status' ) {
                        $aValue[$sKey] = Helper::getOrder($aValue[$sKey]);
                    }
                        if ( $aValue[$sKey] == '' ) {
                        $aValue[$sKey] = 'Non renseigné';
                    }
                }
            }
        } else {
            $this->aConfigs['label'] = array('id', 'nom', 'actif', 'options');
            $this->aConfigs['update'] = array('url' => '/back/orders/update?id=');
            $this->aConfigs['delete'] = array('url' => '/back/orders/delete?id=');
        }
    }
}