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
        $this->oOrder = new Orders();
        $aConfigs = $this->oOrder->checkoutForm();
        $aErrors = [];

        if ( !empty( $aParams['POST'] ) ) {
            if ( !$this->isValid( $aParams["POST"]["card_number"] ) ) {
                $aErrors[] = "Numéro de carte de crédit invalide";
            } else {
                $aErrors = Validator::checkForm( $aConfigs, $aParams["POST"] );
                
                if ( empty( $aErrors ) ) {
                    $this->oOrder->setTrackingNumber(bin2hex(openssl_random_pseudo_bytes(6)));
                    $this->oOrder->setUsersIdUsers($_SESSION['id_user']);
                    $this->oOrder->setStatus(1);
                    $iIdOrder = $this->oOrder->save();

                    $oCart = new Carts();
                    $oCart->setStatus(1);
                    $oCart->setUsersIdUser($_SESSION['id_user']);
                    $aIsUse = $oCart->select();
                    
                    foreach ($aIsUse as $aCarts) {
                        $oC = new Carts();
                        $oC->setId($aCarts['id_cart']);
                        $oC->setStatus(0);
                        $oC->setOrdersIdOrder($iIdOrder);
                        $oC->save();
                    }

                    $oUser = new Users;
                    $oUser->setId($_SESSION['id_user']);
                    $aUser = $oUser->select()[0];

                    $oMailer = new Mailer();
                    $oMailer->paymentSuccessfulMail($aUser);    

                    header('Location: /?payment=true');
                    return;
                }
            }
        }

        $oView = new View("billing", "front");

        $oView->assign( "aConfigs", $aConfigs );
        $oView->assign( "aErrors", $aErrors );
    }

    private function isValid($num) {
        $num = preg_replace('/[^\d]/', '', $num);
        $sum = '';
    
        for ($i = strlen($num) - 1; $i >= 0; -- $i) {
            $sum .= $i & 1 ? $num[$i] : $num[$i] * 2;
        }

        return array_sum(str_split($sum)) % 10 === 0;
    }
}