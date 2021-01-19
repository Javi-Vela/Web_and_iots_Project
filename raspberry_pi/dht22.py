def dht22():
import Adafruit_DHT
humidity, temperature = Adafruit_DHT.read_retry(22,17)
temperatura=("{0:0.2f}".format(temperature))
temperatura=float(temperatura)
humedad=("{0:0.2f}".format( humidity))
#print(temperatura)
#print(type(temperatura))
#print(humedad)
return temperatura,humedad
