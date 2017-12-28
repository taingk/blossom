<?php

if ( $_POST['payload'] ) {
    $exec = shell_exec( 'cd ../../ && git reset --hard HEAD && git pull && cp config/conf.inc.php app/conf.inc.php' );
    echo $exec;
} else {
    echo 'NOT OK';
}

?>

Pull from github request
