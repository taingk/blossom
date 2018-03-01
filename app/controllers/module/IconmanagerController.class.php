<?php

class IconManagerController {

    public function indexAction( $aParams ) {
        $aIcons = array_slice(scandir('public/icon'), 2); 
        
        echo json_encode($aIcons);
    }

}
