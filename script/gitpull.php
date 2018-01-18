<?php


$exec = shell_exec('cd ../ && git reset --hard HEAD && git pull git@github.com:taingk/annuel.git master && cp config/conf.inc.php app');
echo $exec;
echo 'ok';

?>
