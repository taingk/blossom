<?php

require 'conf.inc.php';

try {
    $bdd = new PDO('mysql:host='.DBHOST.';dbname='.DBNAME.';charset=utf8', DBUSER, DBPASSWORD);
    phpinfo();
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
