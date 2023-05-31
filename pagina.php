<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualização de Graficos em JPGRAPH</title>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <?php
        $arquivo1 = 'grafico1.php';
        $arquivo2 = 'grafico2.php';
    ?>

<h1>Visualização dos Graficos</h1>
    <div id="grafico1">
        <iframe style="height:250px;width:400px;" src=<?php echo $arquivo1;?> ></iframe>
    </div>
    <br>
    <div id="grafico2">
        <iframe style="height:250px;width:500px;" src=<?php echo $arquivo2;?> ></iframe>
    </div>



</body>
</html>