#!/bin/bash

filestostage() {
    currentdir=$(pwd)
    logdatei=deploy-$(date +%F_%H-%M-%S).log

    rsync -avzP $currentdir/.??* --log-file="$logdatei" --delete --exclude-from=exclude-file.txt -e "ssh" ppptv:/home/ppptv/public_html/stages
    rsync -avzP $currentdir/* --log-file=deploy.log --delete --exclude-from=exclude-file.txt -e "ssh" ppptv:/home/ppptv/public_html/stages
}


filestoprod() {
    currentdir=$(pwd)
    logdatei=deploy-$(date +%F_%H-%M-%S).log

   	rsync -avzP $currentdir/.??* --log-file="$logdatei"  --exclude-from=exclude-file.txt -e "ssh" uthlede:/httpdocs
    rsync -avzP $currentdir/* --log-file=deploy.log --exclude-from=exclude-file.txt -e "ssh" uthlede:/httpdocs
}


