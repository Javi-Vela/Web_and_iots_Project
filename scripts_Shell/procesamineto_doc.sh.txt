#!/bin/bash
. /var/www/documentos/scripts/consultas_sql.sh
for file in `ls /var/www/documentos/documento`; do
	mac=`cat /var/www/documentos/documento/$file | cut -d "#" -f1`
	tratar_doc $mac 
	procesar_temporal $file
	insertar_sql $file
	rm /var/www/documentos/documento/$file
done

