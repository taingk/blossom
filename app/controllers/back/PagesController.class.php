<?php

class PagesController {

    /*
    * View listing de produits
    */ 
    public function indexAction( $aParams ) {
        $oView = new View("pagesEditor", "back");
        $oPage = new Pages();
        $aConfig = $oPage->editorForm();
        
        $oView->assign("aConfig", $aConfig);

        foreach($_POST as $sKey => $sValue) {
            $s .= $sKey.'|'.$sValue.';';
        }

        $s = substr($s, 0, -1);

        $oPage->setPageName("Page d'accueil 1");
		$oPage->setContent($s);
        $oPage->setType("homePage");
        $oPage->setIsUse(1);
		$oPage->setStatus(1); 
        $oPage->save();
    }

    /*
    * Formulaire d'ajout de produit
    */ 
    public function addAction( $aParams ) {
        $oView = new View("pagesEditor", "back");
       
        
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
}