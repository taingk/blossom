#!/bin/bash

cd ../ && git reset --hard HEAD && git pull git@github.com:taingk/annuel.git master && cp config/conf.inc.php app
