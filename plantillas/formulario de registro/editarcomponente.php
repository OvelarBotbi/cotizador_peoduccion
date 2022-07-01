<!DOCTYPE html>
<html lang="es">
    <thead>
        <meta charset="utf-8">
        <title>FORMULARIO DE REGISTRO</title>
        <link rel="stylesheet" href="estilos.css">
    </thead>
    <body>
        <h1>FORMULARIO DE REGISTRO</h1>
            <form action="validar.php" method="post"  class="form-register">
                <h2 class="form-titulo">CREA UNA CUENTA</h2>
                <div class="contenedor-input">
                    <input type="text" name="nombre" placeholder="NOMBRE" class="input-48" required>
                    <input type="text" name="apellidos" placeholder="APELLIDOS" class="input-48" required>
                    <input type="email" name="correo" placeholder="CORREO" class="input-100" required>
                    <input type="text" name="usuario" placeholder="USUARIO" class="input-48" required>
                    <input type="password" name="clave" placeholder="CONTRASEÑA" class="input-48" required>
                    <input type="text" name="telefono" placeholder="TELEFONO" class="input-100" required>
                    <input type="submit" value="REGISTRAR" class="btn-enviar">
                    <p class="form-link">¿YA TIENES UNA CUENTA? <a href="#">ingresa aqui</a></p>
                </div>
            </form>
    </body>        
</html>