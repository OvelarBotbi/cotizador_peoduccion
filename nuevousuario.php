    <!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <title>FORMULARIO DE REGISTRO</title>
        <link rel="stylesheet" href="css/agrusu.css">
        <script src="js/functionusers.js"></script>
        <link rel="icon" type="image/png" href="./img/logo.png" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-animate.min.js"></script> 
        <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular-aria.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/angular_material/1.0.0/angular-material.min.js"></script>
    </head>
    <body>
      
       <?php 
        session_start();
        if(isset($_SESSION['usuario'])){
	       
        ?>
        
            <form action="validar.php" method="post"  class="form-register" enctype="multipart/form-data">
                <h2 class="form-titulo">NUEVO USUARIO</h2>
                <div class="contenedor-input">
                   <select name="rolusu"  class="input-100" required >
						<option value="" disabled selected>SELECCIONAR ROL</option>
						<option value="1" >ADMINISTRADOR</option>
						<option value="2" >VENDEDOR</option>
                        <option value="3" >CONSULTAS</option>
					</select>
                   
                    <input type="text" id="nombre" name="nomusu"  placeholder="NOMBRE" class="input-100" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" required>
                    <span class="input-100"id="estadousuario"></span> 
                    
                    <input type="text" id="usuario" name="nickusu" style="text-transform:uppercase;"  onkeyup="comprobarUsuario()" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="USUARIO" class="input-48" required>
                    
                    <input type="password" name="conusu" placeholder="COTRASEÑA" class="input-48" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"required>
                    <input type="email" name="corusu" placeholder="CORREO" class="input-100" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"required>
                    <input id="accus" name="accus" value="18" style="display:none;">
                    <input id="cancelar" Onclick="regusu()" value="CANCELAR" class="btn-cancelar input-48" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"style="display:none;"> 
                    <input id="registrar" type="submit" value="REGISTRAR" class="btn-enviar" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();"style="display:none;">
                </div>
            </form>
            <?php  }else{
   header("Refresh:1; url=index.php");
}?>

    </body>        
</html>