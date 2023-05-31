<?php
//INFORMACOES NECESSARIAS PARA CRIAR TABELA
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_bar.php');


//Gerar conexao com o banco de Dados
try
{
    $pdo = new PDO("mysql:dbname=agenda;host=localhost","root","123456");
}
catch(PDOException $e)
{
    echo "Erro com banco de dados: ".$e->getMessage();
}
catch (Exception $e)
{
    echo "Erro generico: ".$e->gerMessage();
}



//Pegar informacoes dde quantidade de genero
$lista = array();

$cmd = $pdo->prepare("SELECT cd_sexo, COUNT(*) AS qtd FROM tb_pessoa GROUP BY cd_sexo");
$cmd->execute();
$lista = $cmd->fetchAll(PDO::FETCH_ASSOC);

//TESTE
//var_dump($lista);
//echo"<br>";
//echo($lista[0]["cd_sexo"]);
//echo"<br>";


$qtdM = $lista[0]["qtd"];
$qtdF = $lista[1]["qtd"];
//echo $qtdM;




//Fazer tabela
//Codigo baseado nos exemplos de jpgraph
//ACRESCENTEI OS REQUIRES NECESSARIOS NAS LINHAS INICIAIS DO CODIGO

$datay=array($qtdM,$qtdF);

// We need some data
$datay=array($qtdM,$qtdF);
$datax=array("Masculino","Feminino");

// Setup the graph.
$graph = new Graph(400,240);
$graph->clearTheme();
$graph->img->SetMargin(60,20,35,75);
$graph->SetScale("textlin");
$graph->SetMarginColor("lightblue:1.1");
$graph->SetShadow();

// Set up the title for the graph
$graph->title->Set("Quantidade de pessoas por genero");
$graph->title->SetMargin(8);
$graph->title->SetFont(FF_VERDANA,FS_BOLD,12);
$graph->title->SetColor("darkred");

// Setup font for axis
$graph->xaxis->SetFont(FF_VERDANA,FS_NORMAL,10);
$graph->yaxis->SetFont(FF_VERDANA,FS_NORMAL,10);

// Show 0 label on Y-axis (default is not to show)
$graph->yscale->ticks->SupressZeroLabel(false);

// Setup X-axis labels
$graph->xaxis->SetTickLabels($datax);
$graph->xaxis->SetLabelAngle(50);

// Create the bar pot
$bplot = new BarPlot($datay);
$bplot->SetWidth(0.6);

// Setup color for gradient fill style
$bplot->SetFillGradient("navy:0.9","navy:1.85",GRAD_LEFT_REFLECTION);

// Set color for the frame of each bar
$bplot->SetColor("white");
$graph->Add($bplot);

// Finally send the graph to the browser
$graph->Stroke();




?>