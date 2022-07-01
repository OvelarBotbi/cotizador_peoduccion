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
    alert(elim);
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
function mostrarDescuentoo(din,dan){
    document.getElementById('cardcarr').style.display='none';
    document.getElementById('carddesc').style.display='block';
     $.ajax({
        type:"POST",
        url:"validar.php",
        data:"descuento=" + 43,
        success:function(r){
            $('#descuento').html(r);
            document.getElementById("des").disabled = true;
            document.getElementById("des").value = din;
            document.getElementById("gas").value = dan;
            document.getElementById("gas").disabled = false;
        }
    });
    
    
}
function mostrarDescuentooo(din,dan){
    document.getElementById('cardcarr').style.display='none';
    document.getElementById('carddesc').style.display='block';
     $.ajax({
        type:"POST",
        url:"validar.php",
        data:"descuento=" + 43,
        success:function(r){
            $('#descuento').html(r);
            document.getElementById("des").disabled = true;
            document.getElementById("gas").disabled = true;
            document.getElementById("gas").value = din;
            document.getElementById("des").value = dan;
            document.getElementById("btnsig").style.display = 'block';
        }
    });
    
    
}

function descuento() {
     var din =document.getElementById("des").value;
     var dan =document.getElementById("gas").value;
    
    
    if (confirm('¿ESTAS SEGURO DE ASIGNAR EL  %'+din+' DE DESCUENTO')){
     // alert($('#des').val());
        $.ajax({
        type:"POST",
        url:"validar.php",
        data:"cantdescuento=" + din,
        success:function(r){
            // alert("HAY PUTO");
          mostrarDescuentoo(din,dan);  
         
        }
    });
    }
    }
function gastos() {
     var din =document.getElementById("gas").value;
     var dan =document.getElementById("des").value;
    if (confirm('¿ESTAS SEGURO DE ASIGNAR  $'+din+' DE GISTOS DE INSTALACION')){
     // alert($('#des').val());
        $.ajax({
        type:"POST",
        url:"validar.php",
        data:"cantgasto=" + din,
        success:function(r){
            // alert("HAY PUTO");
          mostrarDescuentooo(din,dan);  
         
        }
    });
    }
    }
function siguientepdf(){
           window.location.assign("reportecotizacion");

}