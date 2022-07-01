<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
<style>
body {
  margin: 0;
  font-family: "Lato", sans-serif;
}

.sidebar {
  margin: 0;
  padding: 0;
  width: 200px;
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}
	.card {
	 max-height: 600px;
	}
	divv {
      display:block;
      max-height:400px;
      overflow-y:auto;
  }
  divv {
      display:table;
      width:90%;
      table-layout:fixed;
  }
  divv {
      width: calc( 90% - 1em )
  } 
	.tam {
		font-size: 15px;
	}

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.madero {
  background-color: #262121;
  color: white;
}
.sidebar a.active{
	 background-color: #474747;
  color: white;
}
.sidebar a:hover:not(.active) {
  background-color: #A7A7A7;
  color: white;
}

div.content {
  margin-left: 200px;
  padding: 1px 50px;
  height: auto;
  width: auto;
}
.sidebar .icon {
  display: none;
}
@media screen and (max-width:1198px){
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
@media screen and (max-width: 736px) {
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
	
	
@media screen and (max-width: 736px) {
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
@media screen and (max-width: 820px){
.letra{
	font-size: 13px;
}
@media screen and (max-width: 644px){
.precio{
	display:none;
}
@media screen and (max-width: 520px){
	
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
<div class="sidebar" id="mySidebar">
  <a class="madero" href="/cotizador/cotizaciones.php">MADERO</a>
  <a class="active" href="cotizaciones.php" ><i class="fa fa-money tamano"></i>
<span class="menu"><c>COTIZACION</c></span></a>
  <a href="categorias.php"><i class="fa fa-tags tamano"></i><span class="menu"><c>CATEGORIAS</c></span></a>
  <a href="productos.php"><i class="fas fa-clipboard-check tamano"></i><span class="menu"><c>COMPONENTES</c></span></a> 	
  <a href="usuarios.php"><i class="fa fa-users tamano"></i><span class="menu"><c>USUARIOS</c></span></a>
  
 		<form id="cerrar" action="validar.php" method="post" >
			<input name="cerrar" value="2" style="display:none;">
			<a href="#" type="submit" onclick="document.getElementById('cerrar').submit();" ><i class="fas fa-door-open ico tamano"></i><span class="menu"><c>SALIR</c></span></a>
		</form>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<div class="content pt-5" style="display: block;">
 	
  	
  			<!--<form id="tippla" action="validar.php" method="post" enctype="multipart/form-data" >-->
			<div class="card" id="cardpla">
				<div class="card-header">TIPO DE PLATAFORMA</div>
					<div class="card-body">
						<div>SISTEMA
							<select id="sis" name="idsistema" class="form-control" >
								<option value="0"disabled selected>SELECCIONAR</option>
								615								<option value='2'><span >PREMIUM</span></option>
																<option value='1'><span >INTEGRA</span></option>
																<option value='3'><span >JOSE LUIS</span></option>
															</select>
						</div>
						<div class="pt-4" id="selpla"></div>
						<div class="pt-4" id="selcap"></div>
						<div class="pt-4" id="seluni"></div>
						<div class="pt-4" id="botsel"></div>
					</div> 
			</div>
			<!--</form>-->
		
			<div id="cardcarr" class="card card2" style="display: none;">
				<div class="card-header">CARRITO</div>
				<div class="card-body"><button Onclick="regresar()">Regresar</button><div  id="carrito"></div></div> 
				<!--<div class="card-footer">Footer</div>-->
			</div>
			
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
		$('#sis').val(0);
		recargarLista();
		$('#sis').change(function(){
			recargarLista();
		});

		$('#selpla').change(function(){
			recargarTamanos();
		});

		$('#selcap').change(function(){
			recargarUnidades();
		});
		$('#seluni').change(function(){
			recargarBotton();
		});
		
	})
	
</script>
<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"validar.php",
			data:"sistemas=" + $('#sis').val(),
			success:function(r){
				$('#selpla').html(r);
				recargarTamanos();
		        recargarUnidades();
				recargarBotton();
				eliminartodoCarrito();
			}
		});
	}
	function recargarTamanos(){
		$.ajax({
			type:"POST",
			url:"validar.php",
			data:"plataformas=" + $('#pla').val(),
			success:function(r){
				$('#selcap').html(r);
				 recargarUnidades();
				 recargarBotton();
				 eliminartodoCarrito();
			}
		});
		
	} 	
	function recargarUnidades(){
		$.ajax({
			type:"POST",
			url:"validar.php",
			data:"tamanos=" + $('#cap').val(),
			success:function(r){
				$('#seluni').html(r);
				recargarBotton();
				
				eliminartodoCarrito();
			}
		});
		
	} 	
	function recargarBotton(){
		$.ajax({
			type:"POST",
			url:"validar.php",
			data:"unidades=" + $('#uni').val(),
			success:function(r){
				$('#botsel').html(r);
				document.getElementById('btnmoscar').style.display='block';
				
				eliminartodoCarrito();
			}
		});
		
	} 
	function mostrarCarrito(){
		$.ajax({
			type:"POST",
			url:"validar.php", 
			data:"carrito=" + $('#btnmoscar').val(),
			success:function(r){
				$('#carrito').html(r);
				document.getElementById('btnmoscar').style.display='none';
				document.getElementById('cardpla').style.display='none';
				document.getElementById('cardcarr').style.display='block';
				
			}
		});
		
	}
	
	function eliminarCarrito(){
		$.ajax({
			type:"POST",
			url:"validar.php",
			data:"eliminar=" + $('#elicar').val(),
			success:function(r){
				$('#carrito').html(r);
				mostrarCarritoel();
			}
		});
		
	}
	function mostrarCarritoel(){
		$.ajax({
			type:"POST",
			url:"validar.php", 
			data:"carritoel=" +10,
			success:function(r){
				$('#carrito').html(r);
				document.getElementById('btnmoscar').style.display='none';
			}
		});
		
	}
	function eliminartodoCarrito(){
		$.ajax({
			type:"POST",
			url:"validar.php",
			data:"eliminartodo=" + 7,
			success:function(r){
				$('#carrito').html(r);
				
			}
		});
		
	}
	function regresar(){
		document.getElementById('cardpla').style.display='block';
		document.getElementById('cardcarr').style.display='none';

		
		$('#sis').val(0);
		recargarLista();
		
		
	}
</script>


</body>
</html>
