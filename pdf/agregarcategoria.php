<?php 
include ("arreglos.php");
include ("php_conexiones.php");
session_start();
$titulo="NUEVO";
$accion=18;
if(isset($_POST['editusua'])){
	$titulo="EDITAR";
	$accion=20;
	$numero=$_POST['indice'];
	
	
	$rol="";
	$nombre="";
	$usuario="";
	$conrasena="";
	$correo="";
	$result=$conn->query("SELECT * FROM usuarios WHERE id_usuario='$numero'");
	while ($ver=mysqli_fetch_row($result)) {
		$rol=$ver[5];
	    $nombre=$ver[1];
	    $usuario=$ver[2];
	    $conrasena=$ver[3];
	    $correo=$ver[4];
				
			}
	
	
}

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
background-color:#333333;
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
  margin-left: 0;
  padding: 1px 50px;
  height: auto;
  width: 900px;
  
}
.sidebar .icon {
  display: none;
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

 
<!-- Modal -->
   <div class="modal fade" id="agrusu" role="dialog">
                            <div class="modal-dialog">
                              <div class="modal-content modal-sm">
                                <div class="modal-header" align="left">
                                  
                                  <h2 class="modal-title">Error...</h2>
                                </div>
                                <div class="modal-body">
                                  <h3><b>Usuario y/o clave<br>Son incorrectos<br><br>Favor de verificarlos</b></h3>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                </div>
                              </div>
                              
                            </div>
                          </div>  

<center>

<div class="content pt-5" style="display: block;">
  	<div class="card">
		<div class="card-header"><?php echo $titulo;  ?>  USUARIO</div>
		<div class="card-body">
		  <form id="myP1" action="validar.php" method="post" enctype="multipart/form-data">
				<?php if(isset($_POST['editusua'])){?><div >ROL</div>
				<div>
					<select name="rolusu"  class="form-control" required>
						<option value='<?php if($numero==1){ echo "1";}else{echo "2";}?>' <?php if($accion==20 && $rol==1){ echo "selected";} ?>><?php if($numero==1){ echo "ADMINISTRADOR";}else{echo "VENDEDOR";}?></option>
					</select> 
					
					
					
				</div><?php }else{ ?> 
					 <select name="rolusu"  class="form-control" required>
						<option value="" disabled <?php if($accion==18){ echo "selected";} ?>>SELECCIONAR ROL</option>
						<option value="1" <?php if($accion==20 && $rol==1){ echo "selected";} ?>>ADMINISTRADOR</option>
						<option value="2" <?php if($accion==20 && $rol==2){ echo "selected";} ?>>VENDEDOR</option>
					</select>
				
				               <?php }  ?>
				<div>NOMBRE</div>
				<div>
				<input name="idusu" style="display:none;"  onkeyup="javascript:this.value=this.value.toUpperCase();" value='<?php   if(isset($_POST['editusua'])){echo $numero;} ?>'>
				<input type="text" name="nomusu"  style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();" value='<?php   if(isset($_POST['editusua'])){echo $nombre;} ?>' placeholder="NOMBRE USUARIO"class="form-control" required>
				
				</div>
				<div class="row">
					<div class="col-6">
						<div>USUARIO</div>
						<div><input type="text" name="nickusu" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();" value='<?php   if(isset($_POST['editusua'])){echo $usuario;} ?>' placeholder="USUARIO" class="form-control" required></div>
					</div>	
					<div class="col-6">
						<div>CONTRASEÑA</div>
						<div><input type="text" name="conusu" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();" value='<?php   if(isset($_POST['editusua'])){echo $conrasena;} ?>' placeholder="CONTRASEÑA" class="form-control" required></div>
					</div>		
				</div>
		  		<div>CORREO</div>
				<div><input type="text"  name="corusu"   value='<?php   if(isset($_POST['editusua'])){echo $correo;} ?>'  placeholder="CORREO USUARIO"class="form-control" required></div>
				<div class="row pt-3">
					<div class="col-6">
						<div><button type="button" class='btn btn-danger btn-lg' ng-click="regusu()">REGRESAR</button></div>
					</div>	
					<div class="col-6">
						<input name="accus" value='<?php echo $accion; ?>' style="display:none;">
						<div><button type="Upload File Now" class='btn btn-success btn-lg'><?php if(isset($_POST['editusua'])){ echo "EDITAR";}else{ echo "AGREGAR";}?></button></div>
					</div>		
				</div>
				
		  </form>
	  </div>
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
