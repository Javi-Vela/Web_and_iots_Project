<?php

$con = mysqli_connect('proyectoestacion.ddns.net', 'vela', 'vela', 'proyecto_estacion');
if (!$con) {
	die('Error de conexión a la base de datos');
}


////////////////////////////////////////introducimos las estacion en su clase///////////////////////////////////////////
$sql1 = 'SELECT MAX(IdEstacion) FROM Estaciones';
$qry1 = mysqli_query($con, $sql1);
$row = mysqli_fetch_assoc($qry1);
$max_id = $row['MAX(IdEstacion)'];


for($i=1; $i <= $max_id; $i++){
	$sql2 = 'SELECT IdEstacion, Latitud, Longitud, Nom_dueno FROM Estaciones WHERE IdEstacion = "'.$i.'"';
	$qry2 = mysqli_query($con, $sql2);
	$row = mysqli_fetch_assoc($qry2);
	$id_e = $row['IdEstacion'] - 1;
	$estacion[] = new Estacion($id_e, $row['Latitud'], $row['Longitud'], $row['Nom_dueno']);
}




////////////////////////////////////////introducimos los registros por horas en su clase///////////////////////////////////
	$sql3 = 'SELECT MAX(Id_RegistroH), MIN(Id_RegistroH) FROM Registro_H';
	$qry3 = mysqli_query($con, $sql3);
	$row = mysqli_fetch_assoc($qry3);
	$max_id2 = $row['MAX(Id_RegistroH)'];
	$min_id = $row['MIN(Id_RegistroH)'];

	for($i=$min_id; $i <= $max_id2; $i++){
		$sql4 = 'SELECT Enlace_H.Id_Estacion, Registro_H.Id_RegistroH, Registro_H.Temperatura_H, Registro_H.Presion_H, 
			Registro_H.Humedad_H, Registro_H.fecha, Registro_H.hora FROM Registro_H 
			INNER JOIN Enlace_H ON Registro_H.Id_RegistroH = Enlace_H.Id_Registro_H 
			WHERE Registro_H.Id_RegistroH = "'.$i.'"';
		$qry4 = mysqli_query($con, $sql4);
		$row = mysqli_fetch_assoc($qry4);
		$id_e2 = $row['Id_Estacion'] - 1;
		$id_R = $row['Id_RegistroH'] - 1;
		$registroH[] = new Registro($id_e2, $id_R, $row['Temperatura_H'], 
			$row['Presion_H'], $row['Humedad_H'], $row['fecha'], $row['hora']);
	}




////////////////////////////////////////introducimos el ultimo registro por horas en su clase/////////////////////////////
	for($i=1; $i <= $max_id; $i++){
		$sql4 = 'SELECT Registro_H.Id_RegistroH, max(Registro_H.Id_RegistroH) FROM Registro_H 
			INNER JOIN Enlace_H ON Registro_H.Id_RegistroH = Enlace_H.Id_Registro_H 
			WHERE Enlace_H.Id_Estacion = "'.$i.'" GROUP BY Enlace_H.Id_Estacion';
		$qry4 = mysqli_query($con, $sql4);
		$row = mysqli_fetch_assoc($qry4);
		$maximo_idR = $row['max(Registro_H.Id_RegistroH)'];
		$maximo_idE = $i - 1;
	
	
		$sql5 = 'SELECT Temperatura_H, Presion_H, Humedad_H FROM Registro_H 
			WHERE Id_RegistroH="'.$maximo_idR.'"';
		$qry5 = mysqli_query($con, $sql5);
		$row = mysqli_fetch_assoc($qry5);
		$ultimo_registro[] = new Ultimo_registro($maximo_idE, $maximo_idR, $row['Temperatura_H'], 
			$row['Presion_H'], $row['Humedad_H']);
	}






////////////////////////////////////////introducimos los registros por dias en su clase///////////////////////////////////
	$sql6 = 'SELECT MAX(Id_Registro_D), MIN(Id_Registro_D) FROM Registro_D';
	$qry6 = mysqli_query($con, $sql6);
	$row = mysqli_fetch_assoc($qry6);
	$max_id3 = $row['MAX(Id_Registro_D)'];
	$min_id2 = $row['MIN(Id_Registro_D)'];

	for($i=$min_id2; $i <= $max_id3; $i++){
		$sql7 = 'SELECT Enlace_D.Id_Estacion, Registro_D.Id_Registro_D, Registro_D.Temperatura_med_D, 
			Registro_D.Presion_med_D, Registro_D.Humedad_media_D, Registro_D.fecha
			FROM Registro_D INNER JOIN Enlace_D ON Registro_D.Id_Registro_D = Enlace_D.Id_Registro_D 
			WHERE Registro_D.Id_Registro_D = "'.$i.'"';
		$qry7 = mysqli_query($con, $sql7);
		$row = mysqli_fetch_assoc($qry7);
		$id_e3 = $row['Id_Estacion'] -1;
		$id_D = $row['Id_Registro_D'] -1;
		$registroD[] = new Registro_D($id_e3, $id_D, $row['Temperatura_med_D'], 
			$row['Presion_med_D'], $row['Humedad_media_D'], $row['fecha']);
	}





////////////////////////////////////////introducimos el ultimo registro por dias en su clase/////////////////////////////
	for($i=1; $i <= $max_id3; $i++){
		$sql8 = 'SELECT Registro_D.Id_Registro_D, max(Registro_D.Id_Registro_D) FROM Registro_D 
			INNER JOIN Enlace_D ON Registro_D.Id_Registro_D = Enlace_D.Id_Registro_D 
			WHERE Enlace_D.Id_Estacion = "'.$i.'" GROUP BY Enlace_D.Id_Estacion';
		$qry8 = mysqli_query($con, $sql8);
		$row = mysqli_fetch_assoc($qry8);
		$maximo_idD = $row['max(Registro_D.Id_Registro_D)'];
		$maximo_idE2 = $i - 1;
	
	
		$sql9 = 'SELECT Temperatura_med_D, Presion_med_D, Humedad_media_D, Temp_max_D, Tem_min_D
			FROM Registro_D WHERE Id_Registro_D="'.$maximo_idD.'"';
		$qry9 = mysqli_query($con, $sql9);
		$row = mysqli_fetch_assoc($qry9);
		$ultimo_registroD[] = new Ultimo_registro_D($maximo_idE2, $maximo_idD, $row['Temperatura_med_D'], 
			$row['Presion_med_D'], $row['Humedad_media_D'], $row['Temp_max_D'], $row['Tem_min_D']);
	}
	
?>
