#!/bin/bash
#Dejamos unos segundos de espear mientras se genera el archivo que queremos enviar
sleep 5
#Definimos los parametros de la conexion
Host='proyectoestacion.ddns.net'
USER='vela'
PASSWD='vela'
ORIGEN='/home/pi/sensores/logs'
FILE=$(date +%Y%m%d%H%M)".txt"
RUTA='/var/www/documentos/documento/'
#Iniciamos la conexion
ftp -n $Host <<END_SCRIPT
quote USER $USER
quote PASS $PASSWD
binary
cd $RUTA
lcd $ORIGEN
put $FILE
quit
END_SCRIPT
exit 0
