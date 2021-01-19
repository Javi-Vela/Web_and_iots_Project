<?php 	
	include_once './clases.php';
	include_once './conexion_consultas.php';
	include './cualculos.php';
	

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Principal</title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="../estilos.css" />
	</head>
	
	
	<body>
		
		
		<!----------------------------insertar imagenes (version antigua)------------------------------------------------>
		<!--img src="<?= "./imagenes/".$imagen.".jpg"?>" width=100% height="250"-->
		 
		 
		 
		 
		 
		<!----------------------------Mostrar datos los ultimos datos--------------------------------------------------->
		<?php if($inicio4 == 0){ ?>
			<table class="datos" height="150" width=100%>
				<tr>
					<td width=33.33% align="center">Ultima temperatura: <?php echo $final_temperatura;?>° C</td>
					<td width=33.33% align="center">Ultima Presion: <?php echo $final_presion;?> kPa</td>
					<td width=33.33% align="center">Ultima humedad: <?php echo $final_humedad;?> %</td>
				</tr>
			</table>
		<?php }else{ ?>
			<table class="datos" height="125" width=100%>
				<tr>
					<td width=33.33% align="center">Temperatura media del dia anterior anterior: <?php echo $final_temperatura;?> °C</td>
					<td width=33.33% align="center">Presion media del dia anterioranterior: <?php echo $final_presion;?> kPa</td>
					<td width=33.33% align="center">humedad media del dia anterior anterior: <?php echo $final_humedad;?> %</td>
				</tr>
			</table>
			<table class="datos" height="125" width=100%>
				<tr>
					<td width=50% align="center">Temperatura maxima del dia anteriror: <?php echo $ultimo_maximo;?> °C</td>
					<td width=50% align="center">Temperatura minima del dia anterior: <?php echo $ultimo_minimo;?> °C</td>
				</tr>
			</table>
		<?php }?>
			
		
		
		
		<!----------------------------barra de opciones------------------------------------------------------------------>
		<table class="menu" height="70" width=100%>
			<tr>
			<?php if($inicio4 == 0){ ?>
				<form action="./index.php?id=<?php echo $inicio3?>&d_h=1" method="post">
					<td width=33.33% align="center"><input class="boton" type="submit" value="Registro Diario"></td>
					<td class="informacion" width=33.33% align="center">Te muestra el regitro por horas</td>
				</form>
			<?php }else{ ?>
				<form action="./index.php?id=<?php echo $inicio3?>&d_h=0" method="post">
					<td width=33.33% align="center"><input class="boton" type="submit" value="Registro Horario"></td>
					<td class="informacion" width=33.33% align="center">Te muestra el registro por dias</td>
				</form>
			<?php }; ?>
			<form action="./anadir_estacion.php?id=<?php echo $inicio3?>" method="post">
				<td width=33.33% align="center"><input class="boton" type="submit" value="Nueva Estación"></td>
			</form>
			</tr>
		</table>		
		
		
		
		<!----------------------------Mapa para mostrar las estaciones------------------------------------------------>
		<?php include './mapa.js'; ?>
		<div class="mapa" id="map" style="width:100%;height:400px;"></div>
		<script src="http://maps.google.com/maps/api/js?sensor=false&callback=iniciar"></script>

	
		
		
		<!----------------------------grafico apara mostrar los datos historicos-------------------------------------->
		<?php if($inicio4 == 0){ ?>
			<img class="grafica" src="./grafico.php?id2=<?php echo $inicio3?>" alt="" width=100% align="center">
		<?php }else{ ?>
			<img class="grafica" src="./grafico_D.php?id2=<?php echo $inicio3?>" alt="" width=100% align="center">
		<?php }?>
		
		
		
	</body>
	<footer>
		<br><br><br><p align="center">Proyecto desarrollado por Ángel Gutiérrez Martín y Javier Vela Calcerrada.<br>
			Estación meteorologica desarrollada por Ángel Gutiérrez Martín.<br>
			Pagina desarrollada por Javier Vela Calcerrada.</p>
	</footer>
</html>
