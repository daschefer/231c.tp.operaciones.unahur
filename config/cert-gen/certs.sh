#!/bin/sh

# GENERA CERTIFICADO SELF-SIGNED PARA wp.localdev.me
if [ ! -f /certificates/wp.localdev.me.key ]
then
  cd /certificates

  openssl req -x509 -newkey rsa:2048  -days 3650 -nodes \
    -keyout wp.localdev.me.key -out wp.localdev.me.crt -subj "/CN=wp.localdev.me" \
    -addext "subjectAltName=DNS:wp.localdev.me"

  echo "wp.localdev.me.key Certificates generated"
else
  echo "wp.localdev.me.key Certificates already generated"
fi


# GENERA CERTIFICADO SELF-SIGNED PARA phpmyadmin.localdev.me
if [ ! -f /certificates/phpmyadmin.localdev.me.key ]
then
  cd /certificates

  openssl req -x509 -newkey rsa:2048  -days 3650 -nodes \
    -keyout phpmyadmin.localdev.me.key -out phpmyadmin.localdev.me.crt -subj "/CN=phpmyadmin.localdev.me" \
    -addext "subjectAltName=DNS:phpmyadmin.localdev.me"

  echo "phpmyadmin.localdev.me.key Certificates generated"
else
  echo "phpmyadmin.localdev.me.key Certificates already generated"
fi