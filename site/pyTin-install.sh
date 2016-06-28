#!/bin/bash

echo "!!!!!!! pyTin-install.sh triggered"
rm -rf bin/
rm -rf bin/*
rm -rf bin/.*
echo "bin folder removed"
mkdir bin/
git clone https://jajouka@bitbucket.org/jajouka/pytin.git bin/
rm -rf bin/.git*
chmod -Rf 777 bin
echo "!!!!!!! pyTin-install.sh completed"
