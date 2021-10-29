#!/bin/bash

# git commit & push
# yarn build
# db backup on server
# rsync to server(s)
# composer on server
# db_clone db for Stages
# migrations

. .deploy/yarn.sh
. .deploy/git.sh
. .deploy/filesync.sh

#Menu options
options[0]="stages"
options[1]="production"

#Actions to take based on selection
function ACTIONS {
    if [[ ${choices[0]} ]]; then

        echo "Stages wurde ausgewählt"

        dogit
        doyarn
        filestostage


    fi
    if [[ ${choices[1]} ]]; then
        #Option 2 selected
        echo "Productions wurde ausgewählt"

        # dogit
        # doyarn
        filestoprod

    fi


}

#Variables
ERROR=" "

#Clear screen for menu
clear

#Menu function
function MENU {
echo ">> xshoot Media <<"


echo "M A I N - M E N U"

    for NUM in "${!options[@]}"; do
        echo "[""${choices[NUM]:- }""]" $(( NUM+1 ))") ${options[NUM]}"
    done
    echo "$ERROR"
}

#Menu loop
while MENU && read -e -p "Auswahl: " -n1 SELECTION && [[ -n "$SELECTION" ]]; do
    clear
    if [[ "$SELECTION" == *[[:digit:]]* && $SELECTION -ge 1 && $SELECTION -le ${#options[@]} ]]; then
        (( SELECTION-- ))
        if [[ "${choices[SELECTION]}" == "+" ]]; then
            choices[SELECTION]=""
        else
            choices[SELECTION]="+"
        fi
            ERROR=" "
    else
        ERROR="Invalid option: $SELECTION"
    fi
done

ACTIONS