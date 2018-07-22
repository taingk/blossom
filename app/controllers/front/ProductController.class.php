<?php

class ProductController {

    /*
    * View page produit
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("products", "front");

        $oProduct = new Products();
        $oColor = new Colors();
        $oCapacity = new Capacities();

        $sId = $aParams['GET']['is'];
        $oProduct->setId( $sId );
        $aResultProduct = $oProduct->select();

        $oColor->setProductsIdProduct( $sId );
        $aResultColor = $oColor->select();

        $oCapacity->setProductsIdProduct( $sId );
        $aResultCapacity = $oCapacity->select();

        $aConfigs = [];

        $aProducts = ['products' => $aResultProduct];
        array_push($aConfigs, $aProducts );

        $aColors = ['colors' => $aResultColor];
        array_push($aConfigs, $aColors );

        $aCapacities = ['capacities' => $aResultCapacity];
        array_push($aConfigs, $aCapacities );

        $oView->assign('aConfigs', $aConfigs);
    }

    public function allAction($aParams) {

    }

    public function addAction($aParams) {
        $sId = $aParams['GET']['is'];
        if ( !empty( $aParams['POST'] ) && !empty($_SESSION['id_user'])) {
            $oColor = new Colors();
            $oColor->setProductsIdProduct( $sId );
            $oColor->setName( $aParams['POST']['color'] );
            $aIdColor = $oColor->select( array('id_color') );

            $oCapacity = new Capacities();
            $oCapacity->setProductsIdProduct( $sId );
            $oCapacity->setCapacityNumber( $aParams['POST']['capacity'] );
            $aIdCategory = $oCapacity->select(array('id_capacity'));

            $idUser = $_SESSION['id_user'];

            $oCart = new Carts();
            $oCart->setProductsIdProduct( $sId );
            $oCart->setUsersIdUser( $idUser );
            $oCart->setCapacitiesIdCapacity( $aIdCategory[0]['id_capacity'] );
            $oCart->setColorsIdColor( $aIdColor[0]['id_color'] );
            $oCart->setStatus(1);
            $oCart->save();

            $oProduct = new Products();
            $oProduct->setId($sId);
            $aQuantity = $oProduct->select(array('quantity'));
            $iQuantity = $aQuantity[0]['quantity'];
            $iNewQuantity = $iQuantity - 1;
            $oProduct->setQuantity($iNewQuantity);
            $oProduct->save();


            header('location: /front/product?is='.$sId);
            return;

        }

        $oView = new View("products", "front");
        //$oView->assign('aConfigs', $aConfigs);

    }

    /*
    * On get un appel AJAX pour rechercher dans la bdd un/des produit(s)
    */ 
    public function searchAction( $aParams ) {

    }

}