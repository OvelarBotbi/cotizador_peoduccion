<?php 
include_once 'arreglos.php';
?>
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

.sidebar a {
  display: block;
  color: black;
  padding: 16px;
  text-decoration: none;
}
 
.sidebar a.active {
  background-color: #262121;
  color: white;
}

.sidebar a:hover:not(.active) {
  background-color: #555;
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
	
	
}
	
	
@media screen and (max-width: 580px) {
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

<div class="sidebar" id="mySidebar">
  <a class="active madero" href="#home">MADERO</a>
  <a href="#news" ng-click="plataforma()"><i class="fa fa-money tamano"></i>
<span class="menu">COTIZACION</span></a>
  <a href="#news"><i class="fa fa-tags tamano"></i><span class="menu">CATEGORIAS</span></a>
  <a href="#contact"><i class="fas fa-clipboard-check tamano"></i><span class="menu">PRODUCTOS</span></a> 	
  <a href="#about"><i class="fa fa-users tamano"></i><span class="menu">USUARIOS</span></a>
   <a href="#about"><i class="fa fa-users tamano"></i><span class="menu">SALIR</span></a>
  <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i class="fa fa-bars"></i>
  </a>
</div>

<div class="content pt-4">
 <div class="row">
  <div class="col-5">
  	<div class="card">
		<div class="card-header">TIPO DE PLATAFORMA</div>
		<div class="card-body">
		   <div>SISTEMA
			<select  ng-model="idsistema" name="idsistema" class="form-control"  ng-click="sistema()">
			   <option value=""disabled selected>SELECCIONAR</option>
			   <option ng-model="idsistema" name="idsistema" ng-repeat="x in sistemas" value="{{x.id}}" ng-var="{{padre=x.id}}"  ng-click="plataforma(padre)"><span >{{x.nombre}} </span></option>
			</select>
			</div>
			<div class="pt-4">PLATAFORMA
			<select  ng-model="idplataforma" name="idplataforma" class="form-control">
			   <option value=""disabled selected>SELECCIONAR</option>
			   <option ng-model="idplataforma" name="idplataforma" ng-repeat="x in plataforma" value="{{y.id}}" ng-var="{{e=y.id}}" ng-click="mospro()"><span >{{x.nombre}} </span></option>
			</select>
			</div>
		</div> 
		<div class="card-footer">Footer</div>
	  </div>
  </div>
  <div class="col-7">
  	<div class="card">
		<div class="card-header">Header</div>
		<div class="card-body">Content</div> 
		<div class="card-footer">Footer</div>
	  </div>
  </div>
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

</body>
</html>
