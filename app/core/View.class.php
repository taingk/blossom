<?php

class View {
    private $sView;
	private $sTpl;
	private $aData = [];
	private $sSiteName;
	private $sFaviconPath;
	private $bCustomCss;

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
		
		$oSite = new Sites();
		$oSite->setIsUse(1);
		$this->sSiteName = $oSite->select()[0]['name'];
		$this->sFaviconPath = $oSite->select()[0]['favicon'];
		$oSite->select()[0] ? $this->bCustomCss = true : $this->bCustomCss = false;

		include("views/templates/" . $this->sTpl . ".tpl.php");
	}
	
	public function assign($sKey, $sValue) {
		// Prends en paramètre une clée et une valeur et insert dans $aData
		$this->aData[$sKey] = $sValue;
	}
	
	public function tplPath() {
		return $this->sTpl . "/" . $this->sView;
	}
	
	public function addModal( $sModal, $aConfigs, $aErrors = [], $aParams = null ) {
	    if ( $sModal === 'sideMenu') {
	        $oSideMenu = new SideMenu();
	        $aConfigs = $oSideMenu->sideMenuConfigs();
        }
	    if ( $sModal === 'mainMenu') {
	        $oMainMenu = new MainMenu();
			$aConfigs = $oMainMenu->MainMenuConfigs();
        }

		include("views/modals/" . $sModal . ".mdl.php");
	}

}