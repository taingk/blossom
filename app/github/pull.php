<?php

if ($_POST['payload']) {
    $exec = shell_exec( 'git reset --hard HEAD && git pull && cp ../../config/conf.inc.php ../' );
    echo $exec;
    echo "ok";
}

?>

Pull from github request
