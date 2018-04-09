<?php

class AdminController {    
    
    /*
    * Formulaire inscription administrateur
    */
    public function indexAction( $aParams ) {
        $oUser = new Users();
		$aConfig = $oUser->adminFormAdd();
        $aErrors = [];

        if ( !empty( $aParams['POST'] ) ) {
            $aErrors = Validate::checkForm( $aConfig, $aParams["POST"] );

			if ( empty( $aErrors ) ) {
                $oToken = new Token();

                $oUser->setFirstname($aParams['POST']['firstname']);
                $oUser->setLastname($aParams['POST']['lastname']);
                $oUser->setSexe($aParams['POST']['sexe']);
                $oUser->setBirthdayDate($aParams['POST']['birthday_date']);
                $oUser->setEmail($aParams['POST']['email']);
                $oUser->setPwd($aParams['POST']['pwd']);
                $oUser->setToken($oToken->createToken());
                $oUser->setStatus(1);
                $oUser->save();    
            }
        }

        $oView = new View("adminAdd", "auth");

        $oView->assign("aConfig", $aConfig);
		$oView->assign("aErrors", $aErrors);
    }
    
}