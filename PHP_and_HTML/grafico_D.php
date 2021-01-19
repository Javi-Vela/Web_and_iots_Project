<?php
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_line.php');
include_once './clases.php';
include_once './conexion_consultas.php';

//////////////////////////////volcamos datos en arrays///////////////////////////////
$k=0;
for($i=0; $i<=count($registroD); $i++){
	if ($registroD[$i]->idEstacion2 == $_GET["id2"]){
		$temperatura_g[$k] = $registroD[$i]->temperatura;
		$humeda_g[$k] = $registroD[$i]->humedad;
		$presion_g[$k] = $registroD[$i]->presion;
		$fecha_g[$k] = $registroD[$i]->fecha;
		$k++;
	}
}

 
// Setup the graph
$graph = new Graph(925,350);
$graph->SetScale("textlin");
 
$theme_class=new UniversalTheme;
 
$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Evolucion del clima por Dias');
$graph->SetBox(false);
 
$graph->img->SetAntiAliasing();
 
$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);
 
$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels($fecha_g);
$graph->xgrid->SetColor('#E3E3E3');


 
// Create the first line

$p1 = new LinePlot($temperatura_g);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend('Temperatura');


 
// Create the second line
$p2 = new LinePlot($humeda_g);
$graph->Add($p2);
$p2->SetColor("#B22222");
$p2->SetLegend('Humedad');


 
// Create the third line
$p3 = new LinePlot($presion_g);
$graph->Add($p3);
$p3->SetColor("#FF1493");
$p3->SetLegend('Presion');
 
$graph->legend->SetFrameWeight(1);
 
$graph->legend->SetPos(0.5,0.98,'center','bottom');


 
// Output line
$graph->Stroke();
?>
