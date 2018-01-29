<?php

chdir(dirname(__FILE__));

if ($_POST['payload']) {
	//echo exec('git reset --hard HEAD && git pull git@github.com:taingk/annuel.git master && cp ../../config/conf.inc.php ../');
	//echo shell_exec("/usr/bin/git pull 2>&1");
	echo shell_exec("/usr/bin/git pull 2&gt;&amp;1");
	echo "\nPost ok";
} else {
	echo 'Not a post request';
}

?>
