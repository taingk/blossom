<?php

class View {
    private $sView;
	private $sTpl;
    
	public function __construct( $sView, $sTpl ) {
		$this->sView = $sView . ".view.php";
		$this->sTpl = $sTpl . ".tpl.php";

        if ( !file_exists( "views/" . $sTpl . "/" . $this->sView ) ) {
			die( "La vue :" . $this->sView . " n'existe pas" );
		}
		if ( !file_exists( "views/templates/" . $this->sTpl ) ) {
			die( "Le template :" . $this->sTpl . " n'existe pas" );
		}
    }
    
	public function __destruct(){
		include("views/templates/" . $this->sTpl);
    }
}