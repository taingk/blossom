<?php

try {
    $bdd = new PDO('mysql:host=mysql_projet_annuel;dbname=app;charset=utf8', 'root', 'root');
    phpinfo();
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
