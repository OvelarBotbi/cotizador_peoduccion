<?php
include("php_conexiones.php");
session_start();
$idcomponente=$_POST['indice'];

$id="";
$id_cat="";
$nombre="";
$descripcion="";

$result= $conn->query("SELECT * FROM productos WHERE id='$idcomponente'");
while ($var=mysqli_fetch_row($result)){
    
    $id=$var[0];
    $id_cat=$var[1];
    $nombre=$var[2];
    $descripcion=$var[3];
}


				
				
    $ressss=$conn->query("SELECT * FROM categoria WHERE id_cat='$id_cat'");
    $nomcategoria="";
    while($varo=mysqli_fetch_row($ressss)){
        
            $nomcategoria=$varo[1];
        
    }
    
    $imagen=$conn->query("SELECT * FROM imagenes WHERE id_comp='$idcomponente'");
    $dir="";
    while($img = $imagen->fetch_array(MYSQLI_ASSOC)) {
        $dir=$img['dir_img'];
    }

?>

<!DOCTYPE html>
<html lang="es">
    <thead>
        <meta charset="utf-8">
        <title>FORMULARIO DE REGISTRO</title>
        <link rel="stylesheet" href="css/editcomp.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
       <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
          
          
                  
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>   
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.min.js"></script> 
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.js"></script>
        <script src="js/functioncomp.js"></script>
        <style>
            img.center {
                display: block;
                margin-left: auto;
                margin-right: auto;
            }
        </style>
    </thead>
    <body>
    <?php if(isset($_SESSION['usuario'])){
	 
    ?>  
            <form action="validar.php" method="post"  class="form-registerr" enctype="multipart/form-data">
                <h2 class="form-titulo"><a class="letraa">EDITAR COMPONENTE</a></h2>
                <button Onclick="regresar()" class="btn btn-warning">
                        <li class=" fas fa-reply"></li>
                </button>
                <div class="contenedor-input">
                   
                  
                   
                    <a class="input-100 letr mb-2" ><img class="input-100 letr center pt-2" style="width:200px;"  src='<?php echo $dir;?>'></a>
                   
                    <input class="input-100 letr" type="file" name="image" id='image'>	
                    
                    <select name="categoria" id="cat" class="input-48 letr" required disabled >
						<option value='<?php echo $id_cat; ?>' selected><?php echo $nomcategoria; ?></option>
					</select>
                  
                    <input type="text" id="idcom" name="idcomp" style="text-transform:uppercase;"  onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="ID MADERO" class="input-48 letr" value='<?php echo $id; ?>' disabled required>
                    
                   
                    
                    <input type="text" id="idcom" name="idcompp" style="text-transform:uppercase; display:none;"  onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="ID MADERO" class="input-48 letr " value='<?php echo $id; ?>'   required>
                    
                    <input type="text" id="nombre" name="nomcomp"  placeholder="NOMBRE" class="input-100 letr" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value='<?php echo $nombre; ?>' required>
                    
                    <input type="text" name="descomp" placeholder="DESCRIPCION" class="input-100 letr" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value='<?php echo $descripcion; ?>'>
                    
                    <input id="actcomp" name="actcomp" value="20" style="display:none;">
                    <input id="opccion" type="text" value="15" style="display:none;">
                     <br><input type="text" name="txtpieza" id="txtpieza" class="input-100 letr" placeholder="TECLEA EL NOMBRE DEL COMPONENTE" value="" onkeyup="busquedaa();" ><br>
                    <div id="datosarticuloss" class="input-100"></div>
                    
                                
                    
                    <!--<button id="cancelar" type="button" Onclick="regcom();"  class="btn-cancelar input-48" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();">CANCELAR</button> -->
                    
                    <input id="registrar" type="submit" value="ACEPTAR" class="btn-enviar input-48" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"style="display:none;"> 
                    
                </div>
            </form>
<script type="text/javascript">
$(document).ready(function(){
busquedaa();
    $('#componentes').DataTable();
//document.getElementById('registrar').style.display='none';
})
</script>
<?php }else{
   header("Refresh:1; url=index.php");
}?>

    </body>        
</html>