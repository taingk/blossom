<?php

class PagesController {

    /*
    * View listing de produits
    */
    public function indexAction( $aParams ) {
        $oView = new View("pages", "back");
        $oPage = new Pages();

        $oPage->setStatus(1);
        $aConfig = $oPage->select();
        $aConfig = $oPage->unsetKeyColumns($aConfig, array('content', 'status'));
        $aConfig['label'] = array('id', 'page', 'nom', 'actif', 'options');
        $aConfig['update'] = array('url' => '/back/pages/update?id=');
        $aConfig['add'] = array('url' => '/back/pages/add');
        
        
        foreach ( $aConfig as $sKey => &$aValue ) {
            foreach ( $aValue as $sKey => $sValue ) {
                if ( $sKey === 'is_use') {
                    $aValue[$sKey] = Helper::getIsUse($aValue[$sKey]);
                }
                if ( $aValue[$sKey] == '' ) {
                    $aValue[$sKey] = 'Non renseigné';
                }
            }
        }

        $oView->assign("aConfig", $aConfig);
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
        $oView = new View("pagesEditor", "back");
        $oPage = new Pages();
        $oSelectId = new Pages();
        $oUpdateIsUse = new Pages();
        $aConfig = $oPage->editorForm();
        $oSelect = new Pages();
        $aErrors = [];
        $sId = $aParams['GET']['id'];

        $oSelect->setId($sId);
        $aInfos = $oSelect->select()[0];

        foreach ($aConfig['input'] as $sKey => &$aValue) {
            foreach ($aInfos as $sInfoKey => $sInfoValue) {
                if ( $sKey == $sInfoKey) {
                    $aValue['value'] = $sInfoValue;
                }
            }
        }
    
        if (isset($_POST)){
            foreach($_POST as $sKey => $sValue) {
                $s .= $sKey.'|'.$sValue.';';
            }

            $s = substr($s, 0, -1);

            $oSelectId->setIsUse(1);
            $oSelectId->setType("homePage");
            $iIsUse = $oSelectId->select( array('id_page'));
            $oUpdateIsUse->setId($iIsUse[0]['id_page']);
            $oUpdateIsUse->setIsUse(0);
            $oUpdateIsUse->save();
            $oPage->setPageName("Page d'accueil");
            $oPage->setContent($s);
            $oPage->setType("homePage");
            $oPage->setIsUse(1);
            $oPage->setStatus(1);
            $oPage->save();

        }

        
        $oView->assign("aConfig", $aConfig);
    }

    /*
    * Suppression d'un produit en bdd
    */
    public function deleteAction( $aParams ) {
        if ($_GET['id']) {
            $oPage = new Pages();

            $oPage->setId($_GET['id']);
            $sStatus = $oPage->select(array('status'))[0]['status'];

            $sStatus ? $oPage->setStatus(0) : $oPage->setStatus(1);                
            $oPage->save();

            http_response_code(200);
            echo json_encode(array('status' => 'ok'));
        } else {
            http_response_code(404);            
        }
    }

    public function uploadAction ( $aParams ) {
       

    }
}
