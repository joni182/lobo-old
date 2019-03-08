#!/bin/sh

BASE_DIR=$(dirname "$(readlink -f "$0")")
if [ "$1" != "test" ]; then
    psql -h localhost -U lobo -d lobo < $BASE_DIR/lobo.sql
fi
psql -h localhost -U lobo -d lobo_test < $BASE_DIR/lobo.sql
