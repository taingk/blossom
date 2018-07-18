<?php

class MainMenu {

    public function mainMenuConfigs() {
        $oCategory = new Categories();
        $oCategory->setStatus(1);
        $aCategories = $oCategory->select();
        
        $oSite = new Sites();
        $oSite->setIsUse(1);
        $sPath = $oSite->select()[0]['logo'];

        $aConfigs[ 'logo' ] = [ 'url' => $sPath ? $sPath : '/public/img/logo.png' ];

        foreach ( $aCategories as $sKey => $aValue ) {
            $aConfigs[ $aValue['category_name'] ] = [ 'url' => '/front/category?is=' . strtolower($aValue['category_name']) ];
        }

        return $aConfigs;
    }

}

?>