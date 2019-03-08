#!/bin/sh

if [ "$1" = "travis" ]; then
    psql -U postgres -c "CREATE DATABASE lobo_test;"
    psql -U postgres -c "CREATE USER lobo PASSWORD 'lobo' SUPERUSER;"
else
    sudo -u postgres dropdb --if-exists lobo
    sudo -u postgres dropdb --if-exists lobo_test
    sudo -u postgres dropuser --if-exists lobo
    sudo -u postgres psql -c "CREATE USER lobo PASSWORD 'lobo' SUPERUSER;"
    sudo -u postgres createdb -O lobo lobo
    sudo -u postgres psql -d lobo -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    sudo -u postgres createdb -O lobo lobo_test
    sudo -u postgres psql -d lobo_test -c "CREATE EXTENSION pgcrypto;" 2>/dev/null
    LINE="localhost:5432:*:lobo:lobo"
    FILE=~/.pgpass
    if [ ! -f $FILE ]; then
        touch $FILE
        chmod 600 $FILE
    fi
    if ! grep -qsF "$LINE" $FILE; then
        echo "$LINE" >> $FILE
    fi
fi
