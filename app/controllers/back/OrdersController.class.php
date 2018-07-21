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

                    $iCatId = $oProduct->select()[0]['categories_idcategory'];
                    $oCategory = new Categories();
                    $oCategory->setId($iCatId);
                    
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
                if ($sKey == 'cancelled') {
                    $aProduct['cancelled'] = $sValue;
                }
            }
            $iFinalPrice += $aProduct['final_price'];
            $this->aConfigs[] = $aProduct;
        }

        $this->refactorConfigs( true, $iId );
        $oView->assign("aOrders", $aOrders);
        $oView->assign( "aParams", array('id' => 'id_cart') );
        $oView->assign( "aConfigs", $this->aConfigs );
    }

    /*
    * Commande livrée 
    */ 
    public function deleteAction( ) {
        if ( !$_GET['product'] ) {
            $this->oOrder->setId($_GET['id']);
            $iCancelled = $this->oOrder->select(array('cancelled'))[0]['cancelled'];

            $iCancelled ? $this->oOrder->setCancelled(0) : $this->oOrder->setCancelled(1);
            $this->oOrder->save();

            $oSelect = new Carts();
            $oSelect->setOrdersIdOrder($_GET['id']);
            $aCarts = $oSelect->select();

            foreach ($aCarts as $aCart) {
                $oCart = new Carts();
                $oCart->setId($aCart['id_cart']);
                !$iCancelled ? $oCart->setCancelled(1) : $oCart->setCancelled(0);
                $oCart->save();
            }

            header('location: /back/orders');
            return;
        } else {
            $oCart = new Carts();
            $oCart->setId($_GET['id']);
            $iCancelled = $oCart->select()[0]['cancelled'];

            $iCancelled ? $oCart->setCancelled(0) : $oCart->setCancelled(1);                
            $oCart->save();

            $oAllCarts = new Carts();
            $oAllCarts->setOrdersIdOrder($_GET['product']);
            $aCarts = $oAllCarts->select();
            $sCheck = '';

            foreach ($aCarts as $aCart) {
                if ( $aCart['cancelled'] ) {
                    $sCheck .= $aCart['cancelled'];
                }
            }

            $oOrder = new Orders;
            $oOrder->setId($_GET['product']);
            
            if ( count($aCarts) == strlen($sCheck) ) {
                $oOrder->setCancelled(1);
            } else {
                $oOrder->setCancelled(0);
            }

            $oOrder->save();

            header('location: /back/orders/update?id=' . $_GET['product']);
            return;
        }
    }

    public function refactorConfigs( $bType = false, $iId = '' ) {
        if ( $this->aConfigs ) {
            if ( !$bType ) {
                $this->aConfigs = $this->oOrder->unsetKeyColumns($this->aConfigs, array('date_inserted', 'date_updated'));
                $this->aConfigs['label'] = array('id', 'réference', 'utilisateur', 'Status', 'Livraison', 'options');
                $this->aConfigs['update'] = array('url' => '/back/orders/update?id=');
                $this->aConfigs['delete'] = array('url' => '/back/orders/delete?id=');
                
                foreach ( $this->aConfigs as $sKey => &$aValue ) {
                    foreach ( $aValue as $sKey => $sValue ) {
                        if ( $sKey === 'users_idusers' ) {
                            $oUser = new Users();
                            $oUser->setId($sValue);
                            $aValue[$sKey] = $oUser->select()[0]['email'];
                        }
                        if ( $sKey === 'cancelled' ) {
                            $aValue[$sKey] = Helper::getCancelled($aValue[$sKey]);
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
                $this->aConfigs = $this->oOrder->unsetKeyColumns($this->aConfigs, array('category_name'));
                $this->aConfigs['label'] = array('id', 'Capacités', 'Prix additionnel', 'id produit', 'produit', 'prix', 'prix total', 'couleur', 'status', 'option');
                $this->aConfigs['search'] = array('url' => '');
                $this->aConfigs['delete'] = array('url' => '/back/orders/delete?product='. $iId .'&id=');

                foreach ( $this->aConfigs as $sKey => &$aValue ) {
                    foreach ( $aValue as $sKey => $sValue ) {
                        if ( $sKey === 'capacity_number' ) {
                            $aValue[$sKey] = $sValue . 'go';
                        }
                        if ( $sKey === 'additional_price' || $sKey === 'price' || $sKey === 'final_price' ) {
                            $aValue[$sKey] = $sValue . '€';
                        }
                        if ( $sKey === 'cancelled' ) {
                            $aValue[$sKey] = Helper::getCancelled($aValue[$sKey]);
                        }
                        if ( $aValue[$sKey] == '' ) {
                            $aValue[$sKey] = 'Non renseigné';
                        }
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