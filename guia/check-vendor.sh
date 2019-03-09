#!/bin/sh

if [ ! -d vendor ]
then
    echo "Ejecutando composer install..."
    composer install
fi
