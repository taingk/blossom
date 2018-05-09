<?php

class View {
    private $sView;
	private $sTpl;
	private $aData = [];

	public function __construct( $sView, $sTpl ) {
		$this->sView = $sView;
		$this->sTpl = $sTpl;

        if ( !file_exists( "views/" . $this->sTpl . "/" . $this->sView . ".view.php" ) ) {
			die( "La vue :" . $this->sView . " n'existe pas" );
		}
		if ( !file_exists( "views/templates/" . $this->sTpl . ".tpl.php" ) ) {
			die( "Le template :" . $this->sTpl . " n'existe pas" );
		}
    }
    
	public function __destruct() {
		extract($this->aData);

        include("views/templates/" . $this->sTpl . ".tpl.php");
	}
	
	public function assign($sKey, $sValue) {
		// Prends en paramètre une clée et une valeur et insert dans $aData
		$this->aData[$sKey] = $sValue;
	}
	
	public function tplPath() {
		return $this->sTpl . "/" . $this->sView;
	}
	
	public function addModal( $sModal, $aConfig, $aErrors = [] ) {
	    if ( $sModal === 'sideMenu') {
            $oUser = new Users();
            $oUser->setId( $_SESSION['id_user'] );
            $oIdentity = $oUser->select(array('firstname', 'lastname'))[0];
            $sFirstname = $oIdentity['firstname'];
            $sLastname = $oIdentity['lastname'];
            $sFirstnameLetter = substr($sFirstname, 0, 1);
            $sLastnameLetter = substr($sLastname, 0, 1);

            $aProfile = array('fName' => $sFirstname, 'lName' => $sLastname, 'sName' => $sFirstnameLetter . $sLastnameLetter);
        }

        include("views/modals/" . $sModal . ".mdl.php");
	}

}