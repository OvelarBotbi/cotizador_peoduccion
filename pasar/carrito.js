function mostrarcarritofinal(){
    $.ajax({
        type:"POST",
        url:"validar.php",
        data:"carritofinal=" + 40,
        success:function(r){
            $('#carrito').html(r);
            
        }
    });
}

function eliminarCarritooo(elim){
   if (confirm('¿ESTAS SEGURO DE ELIMINAR ESTA COMPONENTE DEL CARRITO?')) {
    $.ajax({
        type:"POST",
        url:"validar.php",
        data:"elimcompfinal=" + elim,
        success:function(r){
            $('#carrito').html(r);
            mostrarcarritofinal();
        }
    });
}
}

function eliminarCarrit(elim){
    alert(elim);
     $.ajax({
        type:"POST",
        url:"validar.php",
        data:"elimpartfinal=" + elim,
        success:function(r){
            $('#carrito').html(r);
            mostrarcarritofinal();
        }
    });
}

function mostrarDescuento(){
    document.getElementById('cardcarr').style.display='none';
    document.getElementById('carddesc').style.display='block';
     $.ajax({
        type:"POST",
        url:"validar.php",
        data:"descuento=" + 43,
        success:function(r){
            $('#descuento').html(r);
           
        }
    });
    
    
}
function aplicardescuento(){
    var des =document.getElementById("des").value;
    $.ajax({
        type:"POST",
        url:"validar.php",
        data:"cantdescuento=" + des,
        success:function(r){
            mostrarDescuento();
           //$('#descuento').html(r);
        }
    });
}

function aplicargastos(){
    var gas =document.getElementById("gas").value;
    $.ajax({
        type:"POST",
        url:"validar.php",
        data:"cantgasto=" + gas,
        success:function(r){
            mostrarDescuento();
           
        }
    });
}

function siguientepdf(){
    siguientepdff();
    //    window.location.assign("Cotizador/generar/generar-pdf.php");
    
    window.location.assign("cotizaciones.php");

}
function siguientepdff(){
    //    window.location.assign("Cotizador/generar/generar-pdf.php");
    window.open('Cotizador/generar/generar-pdf.php', '_blank');

}
