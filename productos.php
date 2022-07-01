<?php 
include ("arreglos.php");
session_start();
$active=3;
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/componentes.css">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.js"></script>
<script src="js/app.js"></script>
<script src="js/functioncomp.js"></script>
<style>

	
	
</style>
</head>
<body Onload="busquedacomp();">
<div id="contenedor_carga" style="position: absolute;">
       <div id="carga"></div>
    </div>
<div>
<?php if(isset($_SESSION['usuario'])){
	include("plantillas/barralateral.php"); 
?>


<div class="content pt-5" style="display: block;">

  
  <!--<form id="tippla" action="validar.php" method="post" enctype="multipart/form-data" >-->
  	<div class="card" id="cardcomp" style="display:none;">
		<div class="card-header tamu"><a>COMPONENTES</a><form style="float:right;"id='agrcom' action='nuevocomponente.php' method='post' >
		<button class='btn btn-success btn-sm' type='input' style="font-size:10px;"><o class='fa fa-plus'></o> AGREGAR</button>
		</form></div><br>
    
		<div class="card-body">
    <input  type='text' class='form-control buscador' id='txtpieza'  name='txtpieza' placeholder='Busqueda de componentes' value='' onkeyup='busquedacomp();' ><br>
		   <div id="moscom"></div> 
	  </div>
	  <!--</form>-->
  
 
  </div>



</div>


<script>
function myFunction() {
  var x = document.getElementById("mySidebar");
  if (x.className === "sidebar") {
    x.className += " responsive";
  } else {
    x.className = "sidebar";
  }
}
</script>

<script type="text/javascript">
	$(document).ready(function(){
    //recargarListacom();
     busquedacomp();
	})
	
</script>
  <script>
     
        window.onload=function(){
        var contenedor = document.getElementById('contenedor_carga');
        contenedor.style.visibility='hidden';
        contenedor.style.opacity='0';
            recargarListacom();
             
    }
    
   
    
    
    </script>






<?php }?>
</body>
</html>
