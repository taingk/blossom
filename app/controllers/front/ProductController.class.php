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
        $oComment = new Comments();

        $sId = $aParams['GET']['is'];
        $oProduct->setId( $sId );
        $aResultProduct = $oProduct->select();

        $oComment->setId( $sId );
        $aResultComment = $oComment->select();

        $oColor->setProductsIdProduct( $sId );
        $aResultColor = $oColor->select();
        
        $oCapacity->setProductsIdProduct( $sId );
        $aResultCapacity = $oCapacity->select();

        $aConfigs = [];

        $aProducts = ['products' => $aResultProduct];
        array_push($aConfigs, $aProducts);

        $aColors = ['colors' => $aResultColor];
        array_push($aConfigs, $aColors);

        $aCapacities = ['capacities' => $aResultCapacity];
        array_push($aConfigs, $aCapacities);

        $aComments = ['comment' => $aResultComment];
        array_push($aConfigs, $aComments); 

        print_r($aConfigs);
      $oView->assign('aConfigs', $aConfigs);
    }

    public function allAction($aParams) {

    }

    /*
    * On get un appel AJAX pour rechercher dans la bdd un/des produit(s)
    */ 
    public function searchAction( $aParams ) {

    }

    /*
    * Ajout d'un commentaire
    */ 
    public function addCommentAction( $aParams ) {
        $oUser = new Users();
        $oComment = new Comments();
        $oProduct = new Products();

        $sId = $aParams['GET']['is'];

        if ( !empty( $aParams['POST'] )) {
            $oComment->setComment($aParams['POST']['Comment']);
            $oComment->setUsersIdUsers($_SESSION['id_user']);
            $oComment->setProductsIdProduct($sId);
            $oComment->setStatus(0);
            $oComment->save();

            header('location: /front/product?is='.$sId);
            return;
        }

    }

}