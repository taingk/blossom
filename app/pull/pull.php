<?php

if ($_POST['payload']) {
	echo shell_exec('cd ../../ && git reset --hard HEAD && git pull git@github.com:taingk/annuel.git master && cp config/conf.inc.php app/');
} else {
	echo 'Not ok';
}

?>
