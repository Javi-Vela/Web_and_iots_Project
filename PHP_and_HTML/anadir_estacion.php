<?php 	
	$insertar = 1;
	$id = $_GET["id"];
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Añadir Estación</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="./n_estacion.css" />	
	</head>
	<body>
		<h1 align="center">Introduce los datos de una nueva Estación</h1><br><br>
		<form action="index.php" method="get">
			<h4 align="center">Datos del usuario: </h4>
			<p align = "center">
			Direccion Mac: <input size="15" name="mac" value=""><br><br><br>
			Nombre de usuario: <input size="15" name="nom_usu" value=""><br><br><br>
			Correo: <input size="15" name="correo_n" value=""></p><br><br><br>
			<h4 align="center">Cooredenadas de la estación meteorologica:</h4>
			<p align="center">Latitud: <input size="15" name="latutid_n" value=""><br><br><br>
			Longitud: <input size="15" name="longitud_n" value=""></p><br><br><br>
			<h4 align="center">Nota: Asegurese de tener los siguientes sensores: </h4>
			<p align="center"><input type=checkbox value=si name=temperatura> Temperatura<br>
			<input type=checkbox value=si name=presion> Presión<br>
			<input type=checkbox value=si name=humedad> Humedad</p><br>
			
			<input type="hidden" value=<?php echo $insertar?> name="insertar">
			<input type="hidden" value=<?php echo $id?> name="id">
			<input type="hidden" value="0" name=d_h>
			<p  align="center"><input type="submit" value="Enviar"></p>
		</form>
	</body>
</html>
