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

// Some data
$datay=array($qtdM,$qtdF);

// Create the graph and setup the basic parameters
$graph = new Graph(460,200,'auto');
$graph->clearTheme();
$graph->img->SetMargin(40,30,30,40);
$graph->SetScale("textint");
$graph->SetShadow();
$graph->SetFrame(false); // No border around the graph

// Add some grace to the top so that the scale doesn't
// end exactly at the max value.
$graph->yaxis->scale->SetGrace(100);

// Setup X-axis labels
$a =array("Masculino","Feminino"); //$gDateLocale->GetShortMonth();
$graph->xaxis->SetTickLabels($a);
$graph->xaxis->SetFont(FF_FONT2);

// Setup graph title ands fonts
$graph->title->Set("Quantidade de pessoas por genero");
$graph->title->SetFont(FF_FONT2,FS_BOLD);
$graph->xaxis->title->Set("Genero");
$graph->xaxis->title->SetFont(FF_FONT2,FS_BOLD);

// Create a bar pot
$bplot = new BarPlot($datay);
$bplot->SetFillColor("orange");
$bplot->SetWidth(0.5);
$bplot->SetShadow();

// Setup the values that are displayed on top of each bar
$bplot->value->Show();
// Must use TTF fonts if we want text at an arbitrary angle
$bplot->value->SetFont(FF_ARIAL,FS_BOLD);
$bplot->value->SetAngle(45);
// Black color for positive values and darkred for negative values
$bplot->value->SetColor("black","darkred");
$graph->Add($bplot);

// Finally stroke the graph
$graph->Stroke();




?>