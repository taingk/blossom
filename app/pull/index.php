<?php

chdir(dirname(__FILE__));

if ($_POST['payload']) {
	echo shell_exec('/usr/bin/git pull  2>&1 && cp ../../config/conf.inc.php ../');
	//echo shell_exec("/usr/bin/git pull 2>&1");
	//echo shell_exec("/usr/bin/git pull 2&gt;&amp;1");
	//echo shell_exec("/usr/bin/git status");
	echo "\nPost";
} else {
	echo 'Not a post request';
}

?>
