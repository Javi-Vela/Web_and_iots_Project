<?php
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_line.php');
include_once './clases.php';
include_once './conexion_consultas.php';

$k=0;
for($i=0; $i<=count($registroH); $i++){
	if ($registroH[$i]->idEstacion2 == $_GET["id2"]){
		$hora_g[$k] = $registroH[$i]->hora;
		$presion_g[$k] = $registroH[$i]->presion;
		$k++;
	}
}

 
// Setup the graph
$graph = new Graph(955,350);
$graph->SetScale("textlin");
 
$theme_class=new UniversalTheme;
 
$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Evolucion de la presion por horas');
$graph->SetBox(false);
 
$graph->img->SetAntiAliasing();
 
$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);
 
$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels($hora_g);
$graph->xgrid->SetColor('#E3E3E3');
 
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
