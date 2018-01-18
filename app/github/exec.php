<?php

if ($_POST['payload']) {
	shell_exec('sh script.sh');
	echo 'ok';
}
?>
