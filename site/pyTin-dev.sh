#!/bin/bash

echo "!!!!!!! pyTin-dev.sh triggered"
rm -rf bin/
rm -rf bin/*
rm -rf bin/.*
echo "bin folder removed"
mkdir bin/
cp -rf ~/Sites/jajouka/pyTin ./bin
echo "bin folder copied"
rm -rf bin/.git*
chmod -Rf 777 bin
echo "!!!!!!! pyTin-dev.sh completed"
