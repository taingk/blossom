<?php

if ( $_POST['payload'] ) {
    shell_exec( 'cd ../ && git reset --hard HEAD && git pull' );
}

?>

Pull from github request