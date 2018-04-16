<?php 

class Token {
    private $sToken;
    private $sEmail;
    private $iIdUser;

    public function getToken() {
        return $this->sToken;
    }

    public function getIdUser() {
        return $this->iIdUser;
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
    public function setIdSession( $oUser ) {
        $this->iIdUser = $oUser->getUserId( $this->sEmail );
        $_SESSION['id_user'] = $this->iIdUser;
    }

    /**
     * Get Email
     * Set Token en database
     *
     * @param $aParams
     * @param $oUser
     */
    public function setTokenDb( $aParams, $oUser ) {
        $this->sEmail = $aParams['POST']['email'];
        $sToken = $_SESSION['token']['id'];

        $oUser->setTokenDb( $this->sEmail, $sToken );
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
        $sDbToken = $oUser->getTokenDb( $iIdUser );

        return $sToken === $sDbToken ? 1 : 0;
    }
}