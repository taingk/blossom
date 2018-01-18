<?php

if ($_POST['payload']) {
    $exec = shell_exec( 'cd ../../ && git reset --hard HEAD && git pull' );
    shell_exec('cp ../../config/conf.inc.php ../');
    echo $exec;
    echo "ok";
}

?>

Pull from github request
