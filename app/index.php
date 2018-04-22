<?php

session_start();
require 'conf.inc.php';

function autoloader( $sClass ) {
    $sClass = $sClass . ".class.php";
 
    if ( file_exists( "core/" . $sClass ) ) {
        include "core/" . $sClass;

    } else if ( file_exists( "models/" . $sClass ) ) {
        include "models/" . $sClass;
    }
}

spl_autoload_register("autoloader");

$sUri = urldecode($_SERVER["REQUEST_URI"]);
$sUri = ltrim($sUri, "/");
$aUri = explode("?", $sUri);
$aUriExploded = explode("/", $aUri[0]);

$sStructure = (empty($aUriExploded[0]) ? "front" : $aUriExploded[0]);
$sController = (empty($aUriExploded[1]) ? "index" : $aUriExploded[1]);
$sAction = (empty($aUriExploded[2]) ? "index" : $aUriExploded[2]);

$sStructure = strtolower($sStructure);
$sController = ucfirst(strtolower($sController)) . "Controller";
$sAction = strtolower($sAction) . "Action";

unset($aUriExploded[0]);
unset($aUriExploded[1]);
unset($aUriExploded[2]);

$aUriExploded = array_values($aUriExploded);

$aParams = [
    "GET" => $_GET,
    "POST" => $_POST,
    "URL" => $aUriExploded
];

// Si l'utilisateur à une session, automatiquement redirigé vers dashboard
// Sinon, automatiquement redirigé vers la page de connexion
if ( $sStructure === "back") {
    $oToken = new Token();

    if ( !$_SESSION['token'] ) {
        include "controllers/back/IndexController.class.php";
        $oIndex = new IndexController();
        $oIndex->indexAction( $aParams );
    
        return;
    } else if ( $sController === "IndexController" ) {
        $oToken->checkToken();

        include "controllers/back/DashboardController.class.php";
        $oDashboard = new DashboardController();
        $oDashboard->indexAction( $aParams );
    
        return;
    }

    $oToken->checkToken();
}


if ( file_exists( "controllers/" . $sStructure . "/" . $sController . ".class.php" ) ) {
    include "controllers/" . $sStructure . "/" . $sController . ".class.php";
    
    if ( class_exists( $sController ) ) {
        $oController = new $sController();

        if ( method_exists( $oController, $sAction ) ) {
            $oController->$sAction( $aParams );

        } else {
            die ("L'action " . $sAction . " n'existe pas");
        }
    } else {
        die ("La class " . $sController . " n'existe pas");
    }
} else {
    die ("Le fichier " . $sController . " n'existe pas");
}