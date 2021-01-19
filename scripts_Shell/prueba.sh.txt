mysql -h localhost -u vela -padmin <<EOF> /var/www/documentos/documento/temporal.txt
use Estacion_Meteorologica;
SELECT MAX(Id_RegistroH) FROM Registro_H;
SELECT MAX(Registro_H.num_registro) FROM Registro_H INNER JOIN Enlace_H ON Registro_H.Id_RegistroH = Enlace_H.Id_Registro_H WHERE Enlace_H.Id_Estacion = 4;
SELECT MAX(Id_RegistroH) FROM Registro_H;
quit
EOF

s_linea=`awk 'NR==2' /var/www/documentos/documento/temporal.txt`
c_linea=`awk 'NR==4' /var/www/documentos/documento/temporal.txt`
echo $s_linea
echo $c_linea






