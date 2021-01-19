#!/bin/bash
function tratar_doc(){
mysql -h localhost -u vela -padmin <<EOF> /var/www/documentos/temporal.txt
use proyecto_estacion;
SELECT MAX(Id_RegistroH) FROM Registro_H;
SELECT IdEstacion FROM Estaciones WHERE Mac = '$1';
quit
EOF
id_estacion=`awk 'NR==4' /var/www/documentos/temporal.txt`
mysql -h localhost -u vela -padmin <<EOF>> /var/www/documentos/temporal.txt
use proyecto_estacion;
SELECT MAX(Registro_H.num_registro) FROM Registro_H INNER JOIN Enlace_H ON Registro_H.Id_RegistroH = Enlace_H.Id_Registro_H WHERE Enlace_H.Id_Estacion = $id_estacion;
quit
EOF
}




function procesar_temporal(){
id_registro=`awk 'NR==2' /var/www/documentos/temporal.txt`
num_registro=`awk 'NR==6' /var/www/documentos/temporal.txt`
num=1
if [ $id_registro = NULL ]; then
	id_registro=$num
else 
	id_registro=`expr $id_registro + $num`
fi
if [ $num_registro = NULL ]; then
	num_registro=$num
else 
	num_registro=`expr $num_registro + $num`
fi
rm /var/www/documentos/temporal.txt
datos=`cat /var/www/documentos/documento/$1`
datos="${datos}#${id_estacion}#${num_registro}#${id_registro}"
echo $datos > /var/www/documentos/documento/$1
}




function insertar_sql(){
id=`cat /var/www/documentos/documento/$1 | cut -d "#" -f7`
temp=`cat /var/www/documentos/documento/$1 | cut -d "#" -f2`
pres=`cat /var/www/documentos/documento/$1 | cut -d "#" -f3`
hume=`cat /var/www/documentos/documento/$1 | cut -d "#" -f4`
fecha=`cat /var/www/documentos/documento/$1 | cut -d "#" -f5`
hora1=`cat /var/www/documentos/documento/$1 | cut -d "#" -f6`
id_registro=`cat /var/www/documentos/documento/$1 | cut -d "#" -f9`
mysql -h localhost -u vela -padmin <<EOF
use proyecto_estacion;
INSERT INTO Registro_H (Id_RegistroH, Temperatura_H, Presion_H, Humedad_H, fecha, num_registro, hora) VALUES ('$id_registro', '$temp', '$pres', '$hume', '$fecha', '$num_reg', '$hora1');
INSERT INTO Enlace_H(Id_Estacion, Id_Registro_H) VALUES ('$id', '$id_registro');
quit
EOF
}
















