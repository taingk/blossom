<?php 

class Token {
    
    public function createToken() {
        return bin2hex( random_bytes( 16 ) );
    }

    public function insertTokenSession( &$aParams, $sToken ) {
        $aParams['TOKEN']['id'] = $sToken;
    }

    public function insertTokenDb( $aParams, $oUsers, $sToken ) {
        $sEmail = $aParams['POST']['email'];

        $sQuery = "UPDATE " . $oUsers->getTable() . " SET token = :token WHERE email = :email";
        $oRequest = $oUsers->getPdo()->prepare($sQuery);
        $oRequest->execute(array(':token' => $sToken, ':email' => $sEmail));
    }

}