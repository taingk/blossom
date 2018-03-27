<?php

class IndexController {

    /*
    * Formulaire connexion admnistrateur
    */
    public function indexAction( $aParams ) {
        $oView = new View("adminLogIn", "back");

        if ($_POST['email'] && $_POST['pwd']) {
            header('Location: /back/dashboard'); 
        }
    }
   
}