#!/bin/bash

cd ~/www_root/pizero-weather/boxes/COVID-19/ && 
#/usr/bin/git pull && 
git fetch &&
git checkout origin/master -- dati-json/dpc-covid19-ita-andamento-nazionale.json 
#/usr/local/bin/keyF5

exit 0
