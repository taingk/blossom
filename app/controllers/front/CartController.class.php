<?php

class CartController {
    private $oCart;

    public function __construct() {
        $this->oCart = new Carts();
    }

    /*
    * View listing du panier 
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("cart", "front");
        $aProducts = [];
        
        $this->oCart->setUsersIdUser($_SESSION['id_user']);
        $this->oCart->setStatus(1);
        $aCarts = $this->oCart->select();

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

            $aProducts[] = $aProduct;
        }
        
        $oView->assign('aCarts', $aProducts);
    }

    /*
    * Suppression d'une ajout en panier
    */ 
    public function deleteAction( $aParams ) {
        if ($_GET['id']) {
            $this->oCart->setId($_GET['id']);
            $sStatus = $this->oCart->select(array('status'))[0]['status'];

            $sStatus ? $this->oCart->setStatus(0) : $this->oCart->setStatus(1);                
            $this->oCart->save();

            header('location: /front/cart');
            return;
        }
    }
}