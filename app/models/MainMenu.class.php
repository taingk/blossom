<?php

class MainMenu {

    public function mainMenuConfigs() {
        $oCategory = new Categories();
        $aCategories = $oCategory->select();
        
        $aConfigs[ 'logo' ] = [ 'url' => '/public/img/logo.png' ];

        foreach ( $aCategories as $sKey => $aValue ) {
            $aConfigs[ $aValue['category_name'] ] = [ 'url' => '/front/category?is=' . $aValue['category_name'] ];
        }

        return $aConfigs;
    }

}

?>