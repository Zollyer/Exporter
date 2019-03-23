<head>
  <title>Exporter</title>
 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<div class="jumbotron text-center">
  <img src="../logo.png" style="width:150px;">
</div>

<div class="container">
  <h2>Exportador de Stock</h2>   
  <div class="panel panel-default">
    <div class="panel-heading">Exportador</div>
    <div class="panel-body">
	<p>Seleccione su archivo CSV MS-DOS <b>Archivo separado por comas</b></p> 
	<form action='paso2.php' method='post' enctype="multipart/form-data">   
    <input type='file' name='sel_file' size='200'><hr>
    <input type='submit' class="btn btn-success" name='submit' value='Iniciar Analisis'>
    </form>
		
	</div>
  </div>
</div>
</html>
