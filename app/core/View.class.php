<?php

class View {
    private $sView;
	private $sTpl;
    
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
    
	public function __destruct(){
		include("views/templates/" . $this->sTpl . ".tpl.php");
    }
}