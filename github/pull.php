<?php

if ( $_POST['payload'] ) {
    shell_exec( 'cd ../ && git reset --hard HEAD && git pull && cp config/conf.inc.php app/conf.inc.php' );
}

?>

Pull from github request
