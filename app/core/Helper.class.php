<?php

class Helper {
    private $oProduct;
    private $oCategory;

    static function getAge( $sBirthDay ) {
        return floor( ( time() - strtotime( $sBirthDay ) ) / 31556926 );
    }

    static function getSexe( $iSexe ) {
        return $iSexe ? "Femme" : "Homme";
    }

    static function getStatus( $iStatus ) {
        return $iStatus ? "Actif" : "Inactif";
    }

    static function getCategoryName( $iCategory ) {
        $oCategory = new Categories();
        $oCategory->setId($iCategory);
        $sCategoryName = $oCategory->select('category_name')[0];
        return $sCategoryName;
    }

}