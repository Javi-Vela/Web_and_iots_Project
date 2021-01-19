# Cargamos los modulos de cada sensor
from dht22 import dht22
from ds18b20 import ds18b20
from bmp280 import bmp280
# Obtenemos la fecha y hora con el formato elegido
from datetime import datetime
now=datetime.now()
fecha=now.strftime('%Y-%m-%d')
hora=now.strftime('%H:%M')
fechahora=now.strftime('%Y%m%d%H%M')
#Cargados datos obtenidos por sensor dht22
dht22=dht22()
#Separamos la informacion de temperatura
temp1=(dht22[0])
#Separamos humedad
humedad=(dht22[1])
#Cargamos datos temperatura obtenidos por el sensor ds18b20
temp2=ds18b20()
#Cargados datos obtenidos por sensor bmp280
bmp280=bmp280()
#Separamos temperatura
temp3=(bmp280[0])
#Separamos presion
presion=(bmp280[1])
presion=round(presion /10,2)
#Obtenemos la direccion mac de la interfaz
with open('/sys/class/net/wlan0/address') as wlan:
mac=wlan.read()
mac=mac[:-1]
#Obtenemos media temperatura 3 sensores
temps=[temp1,temp2,temp3]
ltemp=len(temps)
tmedia=(round(sum(temps)*1.0/ltemp,2))
#Convertimos valores a string
tmedia=str(tmedia)
presion=str(presion)
#Generamos el archivo con los valores obtenidos.
from io import open
log=open("/home/pi/sensores/logs/"+fechahora + ".txt","w")
line=mac+"#"+tmedia+"#"+presion+"#"+humedad+"#"+fecha+"#"+hora
log.write(line)
log.close()
#Con el archivo generado, llamamos al proceso de conexion FTP
import subprocess
subprocess.call(['/home/pi/sensores/conexion.sh'])
