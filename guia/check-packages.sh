#!/bin/sh

VER="2.1.1"
FILE="pandoc-$VER-1-amd64.deb"

if ! dpkg -s pandoc > /dev/null 2>&1
then
    echo "Descargando e instalando Pandoc $VER..."
    wget -q "https://github.com/jgm/pandoc/releases/download/$VER/$FILE"
    sudo dpkg -i $FILE
    rm -f $FILE
    sudo apt -f install
fi

LISTA=$(gem list --local)

for p in concurrent-ruby asciidoctor asciidoctor-pdf
do
    if ! echo $LISTA | grep -qs "$p "
    then
        echo "Instalando $p..."
        sudo gem install $p --pre
    fi
done
