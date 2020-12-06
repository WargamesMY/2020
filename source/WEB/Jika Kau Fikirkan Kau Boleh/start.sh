#!/bin/bash
redis-server --daemonize yes
KEY=`head /dev/urandom | tr -dc A-Za-z0-9 | head -c 13`
FLAG=`cat /flag`
redis-cli set $KEY "$FLAG"
echo "Hey I just met you, this is crazy, but this is not the flag, really :)" > /flag
/usr/sbin/apache2ctl -D FOREGROUND
