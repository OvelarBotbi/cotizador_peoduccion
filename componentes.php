<?php 
include ("arreglos.php");
session_start();
$active=3;
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Componentes</title>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/componentes.css">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.js"></script>
<script src="vendor/jquery/jquery.min.js"></script>
<!-- Custom fonts for this template -->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="icon" type="image/png" href="./img/logo.png" />
  <!-- Custom styles for this template -->
  <!-- <link href="css/sb-admin-2.min.css" rel="stylesheet"> -->

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<script src="js/app.js"></script>
<script src="js/functioncomp.js"></script>
<style>
</style>
</head>
<body>
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
            <div class="card-header tamu"><a>COMPONENTES</a>
                <form style="float:right;"id='agrcom' action='nuevocomponente.php' method='post' >
                    <button class='btn btn-success btn-sm' type='input' style="font-size:10px;"><o class='fa fa-plus'></o> AGREGAR</button>
                </form>
            </div><br>    
            <div class="card-body">
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


	
</script>
  <script>
     
        window.onload=function(){
        var contenedor = document.getElementById('contenedor_carga');
        contenedor.style.visibility='hidden';
        contenedor.style.opacity='0';
            recargarListacom();
             
    }
    
   
    
    
    </script>






<?php }else{
   header("Refresh:1; url=index.php");
}?>


<!-- Bootstrap core JavaScript-->

  

  <!-- Core plugin JavaScript-->
  
  <!-- Custom scripts for all pages-->
 
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>


</body>
</html>
