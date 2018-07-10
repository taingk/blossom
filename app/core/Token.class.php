<?php 

class Token {
    private $sToken;

    public function getToken() {
        return $this->sToken;
    }

    public function __construct() {
        $this->sToken = bin2hex(openssl_random_pseudo_bytes(16));
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
    public function setIdSession( $sEmail ) {
        $oUser = new Users();

        $oUser->setEmail( $sEmail );
        $iIdUser = $oUser->select(array('id_user'))[0]['id'];

        $_SESSION['id_user'] = $iIdUser;
    }

    /**
     * Get Email
     * Set Token en database
     *
     * @param $aParams
     * @param $oUser
     */
    public function setTokenDb() {
        $oUser = new Users();
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
    public function checkToken() {
        $sToken = $_SESSION['token']['id'];
        $iIdUser = $_SESSION['id_user'];
        $oUser = new Users();

        $oUser->setId( $iIdUser );
        $aSelects = $oUser->select( array('token', 'status') );
        $sDbToken = $aSelects[0]['token'];
        $sDbStatus = $aSelects[0]['status'];

        $bCheck = $sToken === $sDbToken && $sDbStatus == '1' ? true : false;

        if ( $bCheck ) {
            $this->setTokenSession();
            $this->setTokenDb();
        } else {
            session_destroy();
            $_SESSION = [];
            die('Connexion non permise');
        }
    }
}