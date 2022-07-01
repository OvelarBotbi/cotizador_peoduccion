<?php
include("php_conexiones.php");
$idusuario=$_POST['indice'];

$rol="";
$nombre="";
$usuario="";
$pass="";
$correo="";
$result= $conn->query("SELECT * FROM usuarios WHERE id_usuario='$idusuario'");
while ($var=mysqli_fetch_row($result)){
    $rol=$var[5];
    $nombre=$var[1];
    $usuario=$var[2];
    $pass=$var[3];
    $correo=$var[4];
}

if($rol==1){
    $roll="ADMINISTRADOR";
}else{
    $roll="VENDEDOR";
}

?>


<!DOCTYPE html>
<html lang="es">
    <thead>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>FORMULARIO DE REGISTRO</title>
        <link rel="stylesheet" href="css/agrusu.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
        <script src="js/functionusers.js"></script>
        

        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.min.js"></script> 
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.js"></script>
    </thead>
    <body>
        
            <form action="validar.php" method="post"  class="form-register" enctype="multipart/form-data">
                <h2 class="form-titulo">EDITAR USUARIO</h2>
                
                <div class="contenedor-input">
                  
                  
                  
                   <select name="rolusu"  class="input-100" required >
						<option value='<?php echo $rol; ?>' selected><?php echo $roll; ?></option>
						<?php if($rol==2){ ?>
						<option value="1" >ADMINISTRADOR</option>
						<?php }else{ ?>
						<option value="2" >VENDEDOR</option>
						<?php } ?>
					</select>
                   
                    <input type="text" id="nombre" name="nomusu"  placeholder="NOMBRE" class="input-100" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value='<?php echo $nombre; ?>' required>
                    <span class="input-100"id="estadousuario"></span> 
                    
                    <input type="text" id="usuario" name="nickusu" style="text-transform:uppercase;"  onkeyup="comprobarUsuario()" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="USUARIO" class="input-48" value='<?php echo $usuario; ?>' required>
                    
                    <input type="password" name="conusu" placeholder="COTRASEÑA" class="input-48" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value='<?php echo $pass; ?>'required>
                    <input type="email" name="corusu" placeholder="CORREO" class="input-100" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" value='<?php echo $correo; ?>'required>
                    <input id="accus" name="accus" value="20" style="display:none;">
                    <input name="idusu" value='<?php echo $idusuario; ?>' style="display:none;">
                    
                    <input id="cancelar" Onclick="regusu()" value="CANCELAR" class="btn-cancelar input-48" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"style="display:none;"> 
                    
                    <input id="registrar" type="submit" value="REGISTRAR" class="btn-enviar input-48" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"style="display:none;"> 
                    
                </div>
            </form>
    </body>        
</html>