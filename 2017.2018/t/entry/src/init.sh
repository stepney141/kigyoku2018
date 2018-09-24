#!/bin/sh

echo "clear \'count.dat\'"
echo '0' > count.dat
echo "remove articles"
rm -f ./article*.txt
echo "Initialized."
