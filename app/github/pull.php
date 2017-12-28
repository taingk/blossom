<?php

if ( $_POST['payload'] ) {
    $exec = shell_exec( 'git reset --hard HEAD && git pull && cp /var/www/annuel/config/conf.inc.php /var/www/annuel/app/conf.inc.php' );
    echo $exec;
} else {
    echo 'NOT OK';
}

?>

Pull from github request
