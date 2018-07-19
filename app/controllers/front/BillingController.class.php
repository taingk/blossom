<?php

class BillingController {
    private $oOrder;

    public function __construct() {
        $this->oOrder = new Orders();
    }

    /*
    * On récupère les informations pour les commandes
    * et on ajoute dans la bdd la commande concernée
    */ 
    public function indexAction( $aParams ) {
        $oOrder = new Orders();
        $aConfigs = $oOrder->checkoutForm();
        $aErrors = [];

        if ( !empty( $aParams['POST'] ) ) {
            $aErrors = Validator::checkForm( $aConfigs, $aParams["POST"] );

            if ( empty( $aErrors ) ) {
                // $oUser->setFirstname($aParams['POST']['firstname']);
                // $oUser->setLastname($aParams['POST']['lastname']);
                // $oUser->setSexe($aParams['POST']['sexe']);
                // $oUser->setBirthdayDate($aParams['POST']['birthday_date']);
                // $oUser->setEmail($aParams['POST']['email']);
                // $oUser->setAddress($aParams['POST']['address']);
                // $oUser->setZipCode($aParams['POST']['zip_code']);
                // $oUser->setCity($aParams['POST']['city']);
                // $oUser->setPwd($aParams['POST']['pwd']);
                // $oUser->setToken($oToken->getToken());
                // $oUser->setStatus(0);
                // $oUser->save();

                header('/');
                return;
            }
        }

        $oView = new View("billing", "front");

        $oView->assign( "aConfigs", $aConfigs );
        $oView->assign( "aErrors", $aErrors );
    }

    public function isValid($num) {
        $num = preg_replace('/[^\d]/', '', $num);
        $sum = '';
    
        for ($i = strlen($num) - 1; $i >= 0; -- $i) {
            $sum .= $i & 1 ? $num[$i] : $num[$i] * 2;
        }
    
        return array_sum(str_split($sum)) % 10 === 0;
    }
}