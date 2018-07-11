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

    static function getActif( $iActif ) {
        return $iActif ? "Oui" : "Non";
    }

    static function uploadFiles($FILES) {
        $sPathDirectory = '/public/uploads/';
        $aFiles = [];

        foreach ($FILES as $aFile) {
            $sFileName = strtolower(explode('.', $aFile['name'])[0]);
            $sName = basename(strtolower($sFileName . '.' . uniqid() .'.png'));
            $sFullPath = $sPathDirectory . $sName;
            array_push($aFiles, $sFullPath);

            $sUploadPath = substr($sFullPath, 1);
            if ( !move_uploaded_file($aFile['tmp_name'], $sUploadPath ) ) {
                error_log( "Erreur dans l'upload " . $aFile['name'] . "\n path : " . $sUploadPath );
            }
        }

        return $aFiles;
    }

}
