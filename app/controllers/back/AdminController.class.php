<?php

class AdminController {    
    
    public function indexAction() {
        $oView = new View("adminLogIn", "back");
    }

    public function formAction() {
        $oView = new View("adminForm", "back");
    }

    public function addAction() {
        $oView = new View("adminAdd", "back");

        $oUser = new Users();
        // $oUser->setFirstname($_POST['firstname']);
		// $oUser->setLastname($_POST['lastname']);
		// $oUser->setEmail($_POST['email']);
		// $oUser->setPwd($_POST['pwd']);
		// $oUser->setToken("token");
		// $oUser->setAge($this->getAge($_POST['age']));
		// $oUser->setStatus(1);
		// $oUser->save();
    }

    public function getAge($sBirthDay) {
        // Création d'un objet dateTime a partir de la date de naissance
        $oDateTime = new DateTime($sBirthDay);
        // Que l'on va comparer avec la date d'aujourd'hui
        $oToday = new DateTime();
        // Calcul de la différence entre les deux dates
        $iDifference = $oToday->diff($oDateTime);        
        // On récupère la différence en année
        $iAge = $iDifference->y;
        
        return $iAge;
    }
}