<?php

chdir(dirname(__FILE__));

//if ($_POST['payload']) {
	echo shell_exec('git reset --hard HEAD && git pull git@github.com:taingk/annuel.git master && cp ../../config/conf.inc.php ../');
//} else {
//	echo 'Not a post request';
//}

?>
