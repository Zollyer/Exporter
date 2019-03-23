<?php
include_once '../sql.php'; //iniciando conexiones a base de datos
?>

<head>
	<meta charset="UTF-8">
	<title>Exporter 1</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">  
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Source+Code+Pro:400,600'>
	<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'>
    <link rel="stylesheet" href="css/style.css">  
</head>

<body>
<script>
function actualizar(){ //mostrar datos en mediante JS del proceso de PHP
	document.getElementById('resultado').innerHTML = p;
}
</script>
<div class="container">
  <div class="console">
    <div class="console-head">
      <div class="console-title">Exporter 1.7</div>
      <div class="console-actions"></div>
    </div>
    <div class="console-body">
      
<div class="console-text" style="color:#fbff00; font-size:25px;">   
⦉𝐸xͥρoͣrͫ†er⦊ 1.7
</div>
<div class="console-text">Exporter 1.7 Dev by B.S<span class="console-input"></span></div>
	  <?php
 $porcen = 0;
//comienza la exportacion
	$bus = 0; //debug flush() <- con esto solucionamos el mensaje de buffer vacio.
    if(isset($_POST['submit']))
    {
				
        //Aquí es donde seleccionamos nuestro csv
         $fname = $_FILES['sel_file']['name'];
         echo '<div class="console-text">Analisando archivo: '.$fname.' </div>';
         $chk_ext = explode(".",$fname); //saber el tipo de archivo que hay luego del punto separando en dos el nombre -> ['sel_file'].['name']
		
		 
		 //debug a buffer vacio
		 if(!$bus == 0){
			 //sobrecarga de buffer en navegador Estilo consola
			ob_flush();
			echo 'ok';
			flush();
			sleep(0.000001);
		 } $bus = 1;//debug
			
			
         if(strtolower(end($chk_ext)) == "csv")
         {
			 
			 //mostrar barra de progreso
			 
			 //preparar tabla
				$sql = "TRUNCATE TABLE stock";
				mysqli_query($mysqli, $sql) or die('<div class="console-text" style="color:red;">Error: '.mysql_error());
				echo '<div class="console-text">Datos de tabla borrados.</div>';
		
			 
             //si es correcto, entonces damos permisos de lectura para subir
             $filename = $_FILES['sel_file']['tmp_name'];
             $handle = fopen($filename, "r");
             $contar_x = 0; //contador
			 
			 //evitando saturacion del servidor.... cargando en una variable todos los valores
			 $sql = "INSERT into stock(
				VC,Articulo,Descripcion_Material,Estilo_Proveedor,Sociedad,
				Grupo_Material,Categoria,Descripcion_Categoria,Division,
				Descripcion_Division,Genero,Descripcion_Genero,
				Codigo_EAN_UPC,Material_Anterior,Generico,Stock_Contable,
				Valor_Stock_Contable_PC,Valor_Stock_Contable_PV,
				Stock_Ticket_Vta_DEV,Stock_Real,Valor_Stock_Real_PC,
				Valor_Stock_Real_PV
				) 
				values";			
			 echo '<div class="console-text" style="color:white;">Analisando:'; //contador;
             while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) //aqui se indica por que se encuentra separado el archivo csv
             {
			
               //Insertamos los datos con los valores...
			   $contar_x++;
                $sql =$sql." (
				'".$mysqli->real_escape_string($data[0])."',
				'".$mysqli->real_escape_string($data[1])."',
				'".$mysqli->real_escape_string($data[2])."',
				'".$mysqli->real_escape_string($data[3])."',
				'".$mysqli->real_escape_string($data[4])."',
				'".$mysqli->real_escape_string($data[5])."',
				'".$mysqli->real_escape_string($data[6])."',
				'".$mysqli->real_escape_string($data[7])."',
				'".$mysqli->real_escape_string($data[8])."',
				'".$mysqli->real_escape_string($data[9])."',
				'".$mysqli->real_escape_string($data[10])."',
				'".$mysqli->real_escape_string($data[11])."',
				'".$mysqli->real_escape_string($data[12])."',
				'".$mysqli->real_escape_string($data[13])."',
				'".$mysqli->real_escape_string($data[14])."',
				'".$mysqli->real_escape_string($data[15])."',
				'".$mysqli->real_escape_string($data[16])."',
				'".$mysqli->real_escape_string($data[17])."',
				'".$mysqli->real_escape_string($data[18])."',
				'".$mysqli->real_escape_string($data[19])."',
				'".$mysqli->real_escape_string($data[20])."',
				'".$mysqli->real_escape_string($data[21])."'
				),"; // agregamos  una coma al final para formar un (),(), <- listado asi.
							
				//consulatar imagen y guardarla en base de datos de img buscando primero en base de imagenes y si no exite exportarla
				
				
				echo '<script> p='.$contar_x.'; actualizar();</script>'; //almacenar numero de datos analizados en js	
				echo '<span style="color:#fbff00;" id="resultado"></span>'; //numero progresivo
				
             } //termina analisis de archivo
			 echo '</div>';
			 
			 //dar ultimo toque de formato SQL
			 $sql = substr($sql, 0, -1);// quitamos ultima coma (), <-  
			 //echo $sql; <- mostrar cadena de texto para hacer debug
			 //$sql = $sql.';'; // agregamos punto y coma para terminar la consulta  tipo : (),(),(),(); <-
			 mysqli_query($mysqli, $sql) or die('<div class="console-text" style="color:red;">Error: '.mysqli_error());
			 
			 
			//eliminar espacios de los estilos
			 $sql = "UPDATE stock SET Estilo_Proveedor=REPLACE(Estilo_Proveedor,' ','')";		 
			 mysqli_query($mysqli, $sql) or die('<div class="console-text" style="color:red;">Error: '.mysqli_error());			 
			 echo '<div class="console-text" style="color:green;">Parchando de tabla " " -> ""</div>';
			 
			 
			 //Mesaje final
			 echo '<div class="console-text" style="color:green;">Datos analizados: '.$contar_x.' actualización exitosa!</div>';
             
			 
			//cerramos la lectura del archivo "abrir archivo" con un "cerrar archivo"
             fclose($handle);
         }
         else
         {
            //si aparece esto es posible que el archivo no tenga el formato adecuado, inclusive cuando es cvs, revisarlo para             
			//ver si esta separado por " , "
             echo '<div class="console-text" style="color:red;">Archivo invalido!';
         }
    }
 ?>
	 </div>
  </div>
</div>
</body>

</html>
