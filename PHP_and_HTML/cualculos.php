<?php

	///////////////parametros iniciales//////////////////
    if (empty($_GET["id"])){
		$inicio1 = 40.416728;
		$inicio2 = -3.703801;
		$inicio3 = 0;
	} else {
		$inicio1 = $estacion[$_GET["id"]]->latitud;
		$inicio2 = $estacion[$_GET["id"]]->longitud;
		$inicio3 = $estacion[$_GET["id"]]->idEstacion;
	};
	if (empty($_GET["d_h"])){
		$inicio4 = 0;
	}else{
		$inicio4 = $_GET["d_h"];
	};
	if (empty($_GET["insertar"])){
		$insertar =0;
	}else{
		$insertar = $_GET["insertar"];
	};
	
	
	
	
	////////////imagenes//////////////
/*	$hoy = date('z');
	if($hoy < 79){
		$imagen = "invierno";
	}elseif($hoy < 172){
		$imagen = "primavera";
	}elseif($hoy < 265){
		$imagen = "verano";
	}elseif($hoy < 352){
		$imagen = "otono";
	}else{
		$imagen = "invierno";
	}*/
		
		
		
		
/////////////////////////////////////volcamos los datos del utimo registro en variables////////////////////////////
	if($_GET["d_h"] == 0){
		for($i=0; $i<count($ultimo_registro); $i++){
			if ($ultimo_registro[$i]->ultimo_idEstacion == $inicio3){
				$final_temperatura = $ultimo_registro[$i]->ultimo_temperatura;
				$final_presion = $ultimo_registro[$i]->ultimo_presion;
				$final_humedad = $ultimo_registro[$i]->ultimo_humedad;
			}
		}
	}else{
		for($i=0; $i<count($ultimo_registroD); $i++){
			if ($ultimo_registroD[$i]->ultimo_idEstacion == $inicio3){
				$final_temperatura = $ultimo_registroD[$i]->ultimo_temperatura;
				$final_presion = $ultimo_registroD[$i]->ultimo_presion;
				$final_humedad = $ultimo_registroD[$i]->ultimo_humedad;
				$ultimo_maximo = $ultimo_registroD[$i]->max_temperatura;
				$ultimo_minimo = $ultimo_registroD[$i]->min_temperatura;
			}
		}
	}
	
	
	
	
	
	///////////////////nueva estacion///////////////////////
	if ($insertar == 1){
		$max_id = $max_id + 1;
		$sql10 = 'INSERT INTO Estaciones (IdEstacion, Mac, Latitud, Longitud, Correo, Nom_dueno) 
			VALUES ('.$max_id.', "'.$_GET["mac"].'", '.$_GET["latutid_n"].', '.$_GET["longitud_n"].',
				"'.$_GET["correo_n"].'", "'.$_GET["nom_usu"].'")';
		$qry10 = mysqli_query($con, $sql10);
		if (!$qry10) {
			?><script>alert("No se ha podido introducir la nueva estación")</script><?php
		}else{
			?><script>alert("Se ha introducido la estación correctamente")</script><?php
			$max_id = $max_id - 1;
			$estacion[] = new Estacion($max_id, $_GET["latutid_n"], $_GET["longitud_n"], $_GET["nom_usu"]);
			$max_id = $max_id + 1;
		}
		
	}
?>

