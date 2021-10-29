#!/bin/bash

buildStagesDB() {
source .env.sh

mysql -u$dbuser -p$dbpw -e "drop database $stage_dbname;"
mysqldump -uxshootmediagbnet_user -p xshootmediagbnet_ppp_5 > backup3.sql

mysql -u$dbuser -p$dbpw $stage_dbname < $dbnme.sql
}



