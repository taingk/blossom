<?php

class Helper {

    static function getAge( $sBirthDay ) {
        return floor( ( time() - strtotime( $sBirthDay ) ) / 31556926 );
    }

    static function getSexe( $iSexe ) {
        return $iSexe ? "Femme" : "Homme";
    }

    static function getStatus( $iStatus ) {
        return $iStatus ? "Actif" : "Inactif";
    }

    static function getIsUse( $iIsUse ) {
        return $iIsUse ? "Oui" : "Non";
    }
}