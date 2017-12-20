<?php

define('DBUSER', 'root');
define('DBPASSWORD', 'root');
define('DBHOST', 'mysql_simple');
define('DBNAME', 'app');
define('DBPORT', '3306');

define('DS', DIRECTORY_SEPARATOR);
$scriptName = (dirname($_SERVER["SCRIPT_NAME"]) == "/") ? "" : dirname($_SERVER["SCRIPT_NAME"]);
define('DIRNAME', $scriptName.DS);
