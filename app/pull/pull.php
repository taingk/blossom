<?php

if ($_POST['payload']) {
	$exec = shell_exec('cd ../../ && git reset --hard HEAD && git pull git@github.com:taingk/annuel.git master && cp config/conf.inc.php app/');
	echo $exec;
	$test = shell_exec("Salut");
	echo $test;
	echo 'ok';
} else {
	echo 'Not a post request';
}

?>
