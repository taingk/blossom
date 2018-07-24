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

    static function getRights( $iStatus ) {
        return $iStatus ? "Administrateur" : "Utilisateur";
    }

    static function getOrder( $iStatus ) {
        return $iStatus ? "En cours de livraison" : "Commande livrée";
    }

    static function getCancelled( $iStatus ) {
        return $iStatus ? "Annulée" : "En cours";
    }

    static function getActif( $iActif ) {
        return $iActif ? "Oui" : "Non";
    }

    static function getCategoryName( $iCategory ) {
        $oCategory = new Categories();
        $oCategory->setId($iCategory);
        $sCategoryName = $oCategory->select('category_name')[0];
        return $sCategoryName;
    }

    static function uploadFiles( $FILES ) {
        $sPathDirectory = '/public/uploads/';
        $aFiles = [];
        $aErrors = [];
        $aAllowedExts =  array('gif', 'png', 'jpg', 'jpeg', 'ico');

        if ( !is_dir( getcwd() . $sPathDirectory) ) {
            mkdir( getcwd() . $sPathDirectory);
        }
        
        foreach ( $FILES as $sKey => $aFile ) {
            $sFileExt = pathinfo( $aFile['name'], PATHINFO_EXTENSION );

            if ( preg_match("`^[-0-9A-Z_\.]+$`i", $aFile['name']) ? true : false ) {
                if ( !$aFile['error'] && $aFile['size'] && in_array($sFileExt, $aAllowedExts) ) {
                    $sFileName = strtolower(explode('.', $aFile['name'])[0]);
                    $sName = basename(strtolower(uniqid() . '.' . $sFileExt));
                    $sFullPath = $sPathDirectory . $sName;
                    array_push($aFiles, array( 'name' => $sKey, 'path' => $sFullPath));
        
                    if ( !move_uploaded_file($aFile['tmp_name'], getcwd() . $sFullPath ) ) {
                        error_log( "Erreur dans l'upload " . $aFile['name'] . "/ path : " . getcwd() . $sFullPath );
                    }
                }
            } else {
                array_push($aErrors, array('name' => $sKey, 'path' => $aFile['name']));
            }
        }

        return array('success' => $aFiles, 'errors' => $aErrors );
    }

}
