<?php 
include ("arreglos.php");
session_start();
$accion="NUEVO";
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
<script src="js/funciones.js"></script>
<script src="js/function.js"></script>
<style>
body {
  margin: 0;
  font-family: "Lato", sans-serif;
  background-color:#ffffff;
}

.card {
	 max-height: auto;
     width: 1000px;
	}
	 /*tbody {
      display:block;
      max-height:350px;
      overflow-y:auto;
		 
  }
  thead, tbody tr {
      display:table;
      width:100%;
      table-layout:fixed;
  }
  thead {
      width: calc( 100% - 1em )
  }
	tbody {
  display:block;
  max-height:350px;
  overflow-y:auto;
}
thead, tbody tr {
  display:table;
  width: var(--table-width);
  table-layout:fixed;
}*/
	
	.tam {
		font-size: 15px;
	}




@media screen and (max-width:1000px){
.sidebar{
  margin: 0;
  padding: 0;
  width: 100px;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}
	.sidebar c{
		display: none;
	}
	div.content {
  margin-left: 100px;
  padding: 1px 50px;
  height: auto;
  width: auto;
}
	

} 
@media screen and (max-width:900px){
	.row {
		align-content: space-around;
	}

}
@media screen and (max-width: 700px) {
  .sidebar {
    width: 100%;
    height: auto;
    position: relative;
  }
  .sidebar a {float: left;}
  div.content {margin-left: 0;}
	.sidebar a{
		font-size: 10px;
		
	}
	.sidebar .icon{
		font-size: 20px;
		
	}
	.sidebar c{
		display: block;
		
	}
}
	
	
@media screen and (max-width: 700px) {
	.sidebar a:not(:first-child) {display: none;}
	.sidebar  a.icon {
    float: right;
    display: block;
		font-size: 15PX;
  }
	.sidebar.responsive .icon {
    position: absolute;
    background-color: #514F4F;
    color: white;
    right: 0;
    top: 0;
		
  }
	.sidebar a{
		font-size: 15PX;
		
	}
	.sidebar.responsive a{
    float: none;
    display: block;
    text-align: left;
    font-size: 15px;
 
  } 

	
	
}
	
	
	
  
	
	
/*@media screen and (max-width: 400px) {
  .sidebar a {
    text-align: center;
    float: none;
  }
}*/
	
	
</style>
</head>
<body>
<div ng-app="myApp" 
		ng-controller="controlador" 
        ng-cloak 
        ng-ini="correcto=1">
<?php if(isset($_SESSION['usuario'])){
	
?>

<center>
<div class="content pt-5" style="display: block;">

  
  <!--<form id="tippla" action="validar.php" method="post" enctype="multipart/form-data" >-->
  	<div class="card">
		<div class="card-header"><?php echo $accion; ?>  COMPONENTE</div>
		<div class="card-body">
          <div class="row">
              <div class="col-2">
                  <button style="float:left;" class="btn btn-warning" Onclick="regcom()">
                      <li class=" fas fa-reply"></li>
                  </button>
              </div>
          </div>
		  <form id="newcomp" name="newcomp">
		      <div>CATEGORIA</div>
		      <div id="icat"></div>
		      <div class="row">
		          <div class="col-6">
		              <div>ID MADERO</div>
		              <div><input id="idcom" type="text" name="idcom" placeholder="DESCRIPCION COMPONENTE" class="form-control" onkeyup="comprobarId()" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required></div>
		              <div id="estadoId"></div>
		              <div id="loaderIcon"></div>
		              <div>DESCRIPCION</div>
		              <div><input id="descom" type="text" name="descom" placeholder="DESCRIPCION COMPONENTE" class="form-control" required></div>
		          </div>
		          <div class="col-6">
		              <div>NOMBRE</div>
		              <div><input id="nomcom" type="text" name="nomcom" placeholder="NOMBRE COMPONENTE" class="form-control" required></div>
		              <div>IMAGEN</div>
		             <input class="submit-bxtc" type="file" name="imagen" id='imagen'>		              
		          </div>
		         
		          
		          

		  </form> 
		   <div class="col-12 pt-2">
		              <div> <button style="display:none;"id="btnagrcom"  class="btn btn-success btn-block" Onclick="agregarcomponente();">AGREGAR</button></div>
           </div> 		
		  	</div>
		  	 <div class="col-12 pt-2">
                    <div id="barrabus"></div>
                    <div id="datosarticulos"></div>
            </div>
		  
	  </div>
	  <!--</form>-->
  
 
  </div>



</div></center>


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
		recargarLista();
        
        
        
	})
	$('#icat').change(function(){
			moscatcom();
		});
	$('#icom').change(function(){
			moscom();
		});
</script>

<script type="text/javascript">
  
    
	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"validar.php",
			data:"moscat=" + 12,
			success:function(r){
				$('#icat').html(r);
			}
		});
	}
	function moscatcom(){
		$.ajax({
			type:"POST",
			url:"validar.php",
			data:"catcom=" + 13,
			success:function(r){
				$('#icom').html(r);
			}
		});
	}
	function moscom(){
		$.ajax({
			type:"POST",
			url:"validar.php",
			data:"compo=" + 14,
			success:function(r){
				$('#icom').html(r);
			}
		});
	}
</script>





<?php }?>
</body>
</html>
