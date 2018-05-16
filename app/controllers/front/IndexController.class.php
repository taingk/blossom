<?php

class IndexController {

    /*
    * View page d'accueil
    */
    public function indexAction( $aParams ) {
        $oView = new View("homePage", "front");
        $oPage = new Pages();


        $oPage->setType("homePage");
        $oPage->setIsUse(1);
        $aContent = $oPage->select( array('content') )[0]['content'];

        $aContentExplode = explode(';', $aContent);
        // print_r($a);
        $aFinal = [];
        foreach($aContentExplode as $sValue) {
            $aTemp = explode('|', $sValue);
            $aFinal[$aTemp[0]] = $aTemp[1];
        }

        //print_r($aFinal);

        $oView->assign("Final", $aFinal);


        // $oView->assign("test", $a);
        // $oView->assign("final", $aFinal);

    }

    public function searchAction( $aParams ) {
        print_r($aParams);
    }
}
