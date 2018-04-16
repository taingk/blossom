<?php 

class Token {
    private $sToken;

    public function getToken() {
        return $this->sToken;
    }

    public function __construct() {
        $this->sToken = bin2hex( random_bytes( 16 ) );
    }

    /**
     * Set Token en session
     */
    public function setTokenSession() {
        $_SESSION['token']['id'] = $this->sToken;
    }

    /**
     * Set Id utilisateur en session
     *
     * @param $oUser
     */
    public function setIdSession( $aParams, $oUser ) {
        $oUser->setEmail($aParams['POST']['email']);
        $iIdUser = $oUser->select(array('id_user'))[0]['id_user'];

        $_SESSION['id_user'] = $iIdUser;
    }

    /**
     * Get Email
     * Set Token en database
     *
     * @param $aParams
     * @param $oUser
     */
    public function setTokenDb( $oUser ) {
        $sToken = $_SESSION['token']['id'];
        $iIdUser = $_SESSION['id_user'];

        $oUser->setId($iIdUser);
        $oUser->setToken($sToken);
        $oUser->save();
    }

    /**
     * Check si les tokens session et database sont égaux pour un utilisateur
     *
     * @param $oUser
     *
     * @return int
     */
    public function checkToken( $oUser ) {
        $sToken = $_SESSION['token']['id'];
        $iIdUser = $_SESSION['id_user'];
        $oUser->setId( $iIdUser );
        $sDbToken = $oUser->select( array('token') )[0]['token'];

        return $sToken === $sDbToken ? 1 : 0;
    }
}