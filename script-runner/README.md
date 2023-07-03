# Imagen que ejecuta scripts
Esta imagen genera un contenedor efimero que ejecuta todos los shell scripts ubicados en el directorio `/docker-entrypoint.d` y luego finaliza.

## IMPORTANTE
Aveces los script dan not found . Esto se debe a que en la interaccion con windows el fin de linea de los arhicov `*.sh` pasa de `LF` a `CRLF` para corregir esto se puede hacer usando vs code [VER](https://medium.com/bootdotdev/how-to-get-consistent-line-breaks-in-vs-code-lf-vs-crlf-e1583bf0f0b6)