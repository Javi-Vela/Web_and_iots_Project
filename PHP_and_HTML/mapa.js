<script src="http://maps.google.com/maps?file=api&v=2&key=COLOCAR_AQUI_NUESTRA_KEY" type="text/javascript"></script>
<script type="text/javascript">
	function iniciar() {
		
		var latitud;
		
		//opciones iniciales 
		var opcionesDeMapa = {
			center: new google.maps.LatLng(<?= $inicio1;?>, <?= $inicio2;?>),
			zoom: 10,
			mapTypeId: google.maps.MapTypeId.HYBRID
		};
		
		
		
		
		
		//instancia un nuevo objeto mapa con las opciones iniciales
		var map = new google.maps.Map(document.getElementById("map"),opcionesDeMapa);	
		
		//iniciamosla clase localizacion
		var localizacion = [
			<?php for ( $j=0; $j < $max_id; $j++){?>
				{title: '<?= $estacion[$j]->nom_dueno;?>', lat:<?= $estacion[$j]->latitud;?>, 
					lng:<?= $estacion[$j]->longitud;?>, id:<?= $estacion[$j]->idEstacion;?>},
			<?php }?>
		];
		
		
		
		
				
		//marcar los puntos donde hay una estacion
		for( var i = 0; i < localizacion.length; i++){
			var marcador = new google.maps.Marker({
				position: new google.maps.LatLng(localizacion[i].lat, localizacion[i].lng),
				map: map,
				title: localizacion[i].title
			});
			
			
			
			
			
			//ponemos a la escucha el mapa y desencadena la accion "al hacer click"
			(function(i, marcador) {
				marcador.addListener('click', function() {
					map.setZoom(15);
					map.setCenter(marcador.getPosition());
					window.location.href="index.php"+"?id="+localizacion[i].id+"&d_h="+<?php echo $inicio4;?>;
				});
			})(i, marcador);
		}
	}	
	
	
</script>
