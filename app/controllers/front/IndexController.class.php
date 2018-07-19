<?php

class IndexController {
    private $oHomePage;
    private $aConfigs;
    private $oProduct;

    public function __construct() {
        $this->oHomePage = new Homepages();
        $this->oProduct = new Products();
    }

    /*
    * View page d'accueil
    */
    public function indexAction( $aParams ) {
        $oView = new View("homePage", "front");

        $this->oHomePage->setIsUse(1);
        $this->aConfigs = $this->oHomePage->select()[0];

        $oView->assign("aConfigs", $this->aConfigs );
    }

    public function searchAction( $aParams ) {
        $oView = new View("Category", "front");
        $sResults = $aParams['POST']['search'];

        $this->oProduct->setProductName( $sResults );
        $sResultsSearch = $this->oProduct->search($sResults);
        
        $aLabels = ['label' => "Resultat(s) de la recherche pour : " . $sResults];
        $aConfigs = [];
        array_push($aConfigs, $aLabels);
        
        $aProducts = ['products' => $sResultsSearch];
        array_push($aConfigs, $aProducts);

        $aConfigs[0]['label'] .= "<br> Nombre de résultat(s) trouvé(s) : " . count($aConfigs[1]['products']);
        $oView->assign('aConfigs', $aConfigs);
    }

}
