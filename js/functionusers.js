function comprobarUsuario() {
    jQuery.ajax({
        url: "ComprobarDisponibilidad.php",
        data:{usuario: $("#usuario").val(), accion: 18},
        type: "POST",
        success: function (data) {
            $("#estadousuario").html(data);
            //alert(data);
            if (data == '<div class="alert alert-success"> Usuario  disponible.</div>') {

                document.getElementById('registrar').style.display = 'block';

            } else {
                document.getElementById('registrar').style.display = 'none';
            }


        },
        error: function () {}
    });
}

 function regusu(){
       window.location.assign("usuarios.php");
     
     return false;
    }









