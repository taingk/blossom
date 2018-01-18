<?php

    $exec = shell_exec( 'git reset --hard HEAD && git pull && cp ../../config/conf.inc.php ../' );
    echo $exec;


?>

Pull from github request
