#!/bin/bash

buildStagesDB() {
source .env.sh
mysqldump -uppptv_xshoot_ppp5 -pB@Sd[NOKjKE9 ppptv_ppp_5 > ppptv_ppp_5_backup.sql
mysql -uppptv_xshoot_ppp5 -pB@Sd[NOKjKE9 -e "drop database ppptv_ppp_5_stages;"
./bin/console doctrine:database:create

mysql -uppptv_xshoot_ppp5 -pB@Sd[NOKjKE9 ppptv_ppp_5_stages < ppptv_ppp_5_backup.sql
}

