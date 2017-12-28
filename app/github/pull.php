<?php

    $exec = shell_exec( 'git reset --hard HEAD && git pull && cp /var/www/annuel/config/conf.inc.php /var/www/annuel/app/conf.inc.php' );
    echo $exec;


?>

Pull from github request
