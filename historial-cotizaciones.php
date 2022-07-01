<?php 
include ("arreglos.php");
session_start();
$active=5;
?>
<!DOCTYPE html>
<html>
<head>
<title>Historial de Cotizaciones</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="css/hiscot.css">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="icon" type="image/png" href="./img/logo.png" />

<!-- Custom fonts for this template -->
<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <!-- <link href="css/sb-admin-2.min.css" rel="stylesheet"> -->

  <!-- Custom styles for this page -->
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.js"></script>
<script src="js/app.js"></script>
<script src="js/funciones.js"></script>
<script src="js/hiscot.js"></script>
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
  	<div class="card" id="cardhist" style="display:none">
  	    <div class="card-header tamu"><a >HISTORIAL COTIZACIONES</a></div>
  	    <div class="card-body">
            <div id="histcot"></div>
            <!-- <div class='table-responsive'>
                  <table class='table table-striped table-bordered' id="dataTable" style='margin-bottom: 0' >
                      <thead>
                          <tr class='titulos'>
                              <th>NUM</th>
                              <th>NOMBRE SISTEMA</th>
                              <th>TOTAL</th>
                              <th>CLIENTE</th>
                              <th>FECHA</th>
                              <th></th>
                          </tr>
                      </thead>
                      <tfoot>
                          <tr class='titulos'>
                              <th>NUM</th>
                              <th>NOMBRE SISTEMA</th>
                              <th>TOTAL</th>
                              <th>CLIENTE</th>
                              <th>FECHA</th>
                              <th></th>
                          </tr>
                      </tfoot>
                      <tbody>
                          <?php
                              $user=$_SESSION['usuario'];
                              $ressull=$conn->query("SELECT * FROM usuarios WHERE usuario='$user'");
                              while($vat = $ressull->fetch_array(MYSQLI_ASSOC)) {
                                  $iduss=$vat['id_usuario'];
                               }
                              $result=$conn->query("SELECT * FROM histrotatorio WHERE id_usuario='$iduss' ORDER BY numcotizacion ASC");
                              while($his= $result->fetch_array(MYSQLI_ASSOC)){
                                   $decimales_sub = number_format($his['total'],2);
                                   print "
                                                  <tr class='contenido'>
                                                      <td>".$his['numcotizacion']."</td>
                                                      <td>".$his['nombre']."</td>
                                                      <td style='aling:right;'>$$decimales_sub</td>
                                                      <td style='aling:right;'>".$his['cliente']."</td>
                                                      <td style='aling:right;'>".$his['fecha']."</td>
                                                      <td><button id='elicar' class='btn btn-success btn-sm' Onclick='elimcompo()' data-toggle='modal' data-target='#myModal".$his['numcotizacion']."'>VER PDFS</button>
                                                      </td>
                                                      
                                                  </tr>";
                              }
                          ?>
                      </tbody>
                  </table>
            </div> -->
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
		moshist();
    $('#dataTable').DataTable();
	})
	
</script>
<script>
     
        window.onload=function(){
        var contenedor = document.getElementById('contenedor_carga');
        contenedor.style.visibility='hidden';
        contenedor.style.opacity='0';
            moshist();
             
    }
    
   
    
    
    </script>
<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
  

  <!-- Core plugin JavaScript-->
  
  <!-- Custom scripts for all pages-->
 
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>





<?php }else{
   header("Refresh:1; url=index.php");
}?>
</body>
</html>
