<?php

define('DBUSER', 'root');
define('DBPASSWORD', 'root');
define('DBHOST', 'mysql_projet_annuel');
define('DBNAME', 'app');
define('DBPORT', '3306');
define('MAILUSER', 'contact.blossoom@gmail.com');
define('MAILPASSWORD', 'grp6-BlossomESGI');


define('DS', DIRECTORY_SEPARATOR);
$sScriptName = (dirname($_SERVER["SCRIPT_NAME"]) == "/") ? "" : dirname($_SERVER["SCRIPT_NAME"]);
define('DIRNAME', $sScriptName.DS);
