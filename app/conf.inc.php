<?php

define('DBUSER', 'blossomofrannuel');
define('DBPASSWORD', 'JOHNcena242');
define('DBHOST', 'blossomofrannuel.mysql.db');
define('DBNAME', 'blossomofrannuel');
define('DBPORT', '3306');

define('DS', DIRECTORY_SEPARATOR);
$scriptName = (dirname($_SERVER["SCRIPT_NAME"]) == "/") ? "" : dirname($_SERVER["SCRIPT_NAME"]);
define('DIRNAME', $scriptName.DS);
