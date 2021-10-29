#!/bin/bash

pullmediafrombackup() {
nice -n19 rsync -avzP /volumes/daten/htdocs/b_ppptv/public/media /volumes/daten/htdocs/ppp_5/public
nice -n19 rsync -avzP /volumes/daten/htdocs/b_ppptv/public/videos /volumes/daten/htdocs/ppp_5/public
nice -n19 rsync -avzP /volumes/daten/htdocs/b_ppptv/public/uploads /volumes/daten/htdocs/ppp_5/public
nice -n19 php -dmemory_limit=-1 /volumes/daten/htdocs/ppp_5/bin/console cache:clear
}

pullmediafrombackup