<?php 
include ("arreglos.php");
session_start();
$active=4;
?>
<!DOCTYPE html>
<html>
<head>
<title>Usuarios</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="./img/logo.png" />
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
    *,*:after, * before{
   margin: 0;
    padding: 0;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    -o-box-sizing: border-box;
    box-sizing: border-box;
}
#contenedor_carga{
    background-color: rgba(255,255,255,0.9);
    height: 100%;
    width: 100%;
    position: fixed;
    -webkit-transition: all 1s ease;
    -moz-transition: all 1s ease;
    -o-transition: all 1s ease;
    transition: all 1s ease;
    z-index: : 10000;
}

#carga{
    border: 15px solid #ccc;
    border-top-color: #00528b;
    border-top-style: groove;
    height: 100px;
    width: 100px;
    border-radius: 100%;
    
    position: fixed;
    top:0;
    left: 0;
    right: 0;
    bottom: 0;
    margin: auto;
    
    -webkit-animation: girar 1.5s linear infinite;
    -moz-animation: girar 1.5s linear infinite;
    -o-animation: girar 1.5s linear infinite;
    animation: girar 1.5s linear infinite;
}
@keyframes girar{
    from{transform: rotate(0deg);}
    to{transform: rotate(360deg);}
}
body {
  margin: 0;
  font-family: arial;
    font-size: 15px;
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
	 max-height: auto;
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
	
	.tamu {
		font-size: 20px;
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
    font-size: 13px;
}
.sidebar .icon {
  display: none;
}
@media screen and (max-width:1000px){
.sidebar{
  margin: 0;
  padding: 0;
 /* width: 100px;*/
  background-color: #f1f1f1;
  position: fixed;
  height: 100%;
  overflow: auto;
}
	.sidebar c{
		/*display: none;*/
	}
	div.content {
  /*margin-left: 100px;
  padding: 1px 50px;*/
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
<div id="contenedor_carga" style="position: absolute;">
       <div id="carga"></div>
    </div>
<div>
<?php if(isset($_SESSION['usuario'])){
	 include("plantillas/barralateral.php"); 
?>
 


<div class="content pt-5" style="display: block;">
 
  
  
  <!--<form id="tippla" action="validar.php" method="post" enctype="multipart/form-data" >-->
  	<div class="card" id="cardusu" style="display:none;">
  	    <div class="card-header tamu"><a >USUARIOS</a> <form style="float:right;" id='agrcom' action='nuevousuario.php' method='post' >
		<button class='btn btn-success btn-sm' type='input'><o class='fa fa-plus'></o> AGREGAR</button>
		</form></div>
  	    <div class="card-body">
  	        <div id="mosusu"></div>
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
//		recargarLista();
	})
	
</script>
<script type="text/javascript">
	function recargarLista(){
		$.ajax({
			type:"POST",
			url:"validar.php",
			data:"usuarios=" + 16,
			success:function(r){
				$('#mosusu').html(r);
                document.getElementById('cardusu').style.display='block';
			}
		});
	}
	
</script>
<script>
     
        window.onload=function(){
        var contenedor = document.getElementById('contenedor_carga');
        contenedor.style.visibility='hidden';
        contenedor.style.opacity='0';
           recargarLista();
             
    }
    
   
    
    
    </script>





<?php }else{
   header("Refresh:1; url=index.php");
}?>
</body>
</html>
