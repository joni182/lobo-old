#!/bin/sh

BASE_DIR=$(dirname $(readlink -f "$0"))

api()
{
    OBJ_FILE="vendor/yiisoft/yii2/base/Object.php"
    mv -f $OBJ_FILE $OBJ_FILE.viejo
    vendor/bin/apidoc api .,vendor/yiisoft/yii2 docs/api \
        --pageTitle="API del proyecto" --guide=.. --guidePrefix= \
        --exclude="docs,vendor,tests" --interactive=0 \
        --template="project" \
        --readmeUrl="file://$BASE_DIR/README-api.md"
    mv -f $OBJ_FILE.viejo $OBJ_FILE
}

guide()
{
    vendor/bin/apidoc guide guia docs \
        --pageTitle="Guía del proyecto" --guidePrefix= --apiDocs=./api \
        --interactive=0 --template="project"
    mv docs/README.html docs/index.html
    ln -sf index.html docs/README.html
    rm docs/README-api.html
}

ACTUAL=$PWD
cd $BASE_DIR/..

if [ "$1" = "-a" ]
then
    rm -rf docs/api
    api
elif [ "$1" = "-g" ]
then
    if [ -d docs ]
    then
        find docs -maxdepth 1 -not -path "docs" -not -name "api" -print0 | xargs -0 rm -rf
    fi
    guide
else
    rm -rf docs/
    api
    guide
fi

touch docs/.nojekyll

cd $ACTUAL
