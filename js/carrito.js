function mostrarcarritofinal(colapse){
    $.ajax({
        type:"POST",
        url:"validar.php",
        data:{carritofinal: 40,colapse:colapse},
        success:function(r){
            $('#carrito').html(r);
             document.getElementById('cardcarr').style.display='block';
             autoguardarBorrador();
        }
    });
}
function checkEliminarCarritoFinal(elic,nivel,colapse){
    console.log(elic);
    if(nivel==1){
    if(document.getElementById("checkEli"+elic).value == 1){
        document.getElementById("checkEli"+elic).value = 0;
        document.getElementById("checkEli"+elic).checked = false;
    }else{
        document.getElementById("checkEli"+elic).value = 1;
        document.getElementById("checkEli"+elic).checked = true;
    }
}else{
    if(document.getElementById("checkEli"+elic+colapse).value == 1){
        document.getElementById("checkEli"+elic+colapse).value = 0;
        document.getElementById("checkEli"+elic+colapse).checked = false;
    }else{
        document.getElementById("checkEli"+elic+colapse).value = 1;
        document.getElementById("checkEli"+elic+colapse).checked = true;
    }
    }
    if(nivel==1){
    $.ajax({
        type:"POST",
        url:"validar.php", 
        data:{updatecheckfinal: elic, upvalor:document.getElementById("checkEli"+elic).value,nivel:nivel,padreprod:colapse},
        success:function(r){
            mostrarcarritofinal(colapse);
        }
    });
}else{
    $.ajax({
        type:"POST",
        url:"validar.php", 
        data:{updatecheckfinal: elic, upvalor:document.getElementById("checkEli"+elic+colapse).value,nivel:nivel,padreprod:colapse},
        success:function(r){
            mostrarcarritofinal(colapse);
        }
    });
}
}
function cambiarCantidadProductoFinal(id_prod,cant,colapse){
    console.log(colapse);
    console.log(id_prod);
    if(cant>0){
        $.ajax({
            type:"POST",
            url:"validar.php",
            data:{nuevacantidad_id: id_prod, nuevacantidad: cant, padreprod: colapse},
            success:function(r){
                mostrarcarritofinal(colapse);
            }
        });
    }
}
function eliminarCarritooo(elim){
   if (confirm('¿ESTAS SEGURO DE ELIMINAR ESTA COMPONENTE DEL CARRITO?')) {
    $.ajax({
        type:"POST",
        url:"validar.php",
        data:"elimcompfinal=" + elim,
        success:function(r){
            $('#carrito').html(r);
            mostrarcarritofinal(elim);
            igualarcero();
        }
    });
}
}

function eliminarCarrit(elim){
    alert('¿ESTAS SEGURO DE ELIMINAR ESTA PARTE DEL COMPONENTE?');
     $.ajax({
        type:"POST",
        url:"validar.php",
        data:"elimpartfinal=" + elim,
        success:function(r){
            //$('#carrito').html(r);
            mostrarcarritofinal(elim);
            igualarcero();
        }
    });
}

function mostrarDescuento(){
    document.getElementById('cardcarr').style.display='none';
    var contenedor = document.getElementById('contenedor_carga');
        contenedor.style.visibility='visible';
        contenedor.style.position='fixed';
       contenedor.style.opacity='1';
       
     $.ajax({
        type:"POST",
        url:"validar.php",
        data:"descuento=" + 43,
        success:function(r){
            $('#descuento').html(r);
            
            document.getElementById('carddesc').style.display='block';
            contenedor.style.visibility='hidden';
                contenedor.style.position='fixed';
               contenedor.style.opacity='0';

               var box = document.getElementById('obs');
       var charlimit = 95; // char limit per line
       box.onkeyup = function() {
           var lines = box.value.split('\n');
           for (var i = 0; i < lines.length; i++) {
               if (lines[i].length <= charlimit) continue;
               var j = 0; space = charlimit;
               while (j++ <= charlimit) {
                   if (lines[i].charAt(j) === ' ') space = j;
               }
               lines[i + 1] = lines[i].substring(space + 1) + (lines[i + 1] || '');
               lines[i] = lines[i].substring(0, space);
           }
           box.value = lines.slice(0, 10).join('\n');
       };
        }
    });
    
    
}
function guardarBorrador() {
    $.ajax({
        type: "POST",
        url: "validar.php",
        data: { insertborra: 1 },
        success: function (r) {
            //alert("Borrador guardado");
            document.getElementById('toast').style.opacity = '1';
                setTimeout(function() {
                    document.getElementById('toast').style.opacity = '0';
                }, 3000);
        }
    });
}
function aplicardescuento(){
    var des =document.getElementById("des").value;
    var des2 =document.getElementById("des2").value;
    $.ajax({
        type:"POST",
        url:"validar.php",
        data:{cantdescuento: des, cantdescuento2: des2},
        success:function(r){
            mostrarDescuento();
           //$('#descuento').html(r);
        }
    });
}

function checkMostrarDescripcion(val){
    console.log(val);
    if(document.getElementById("checkdescripc").value == 1){
        document.getElementById("checkdescripc").value = 0;
    }else{
        document.getElementById("checkdescripc").value = 1;
        document.getElementById("checkdescripc").checked = true;
    }
    $.ajax({
        type:"POST",
        url:"validar.php",
        data:{showinfopdf:  document.getElementById("checkdescripc").value, show_tipo: 1},
        success:function(r){
            mostrarDescuento();
           //$('#descuento').html(r);
        }
    });
}
function checkMostrarDescuento(val){
    console.log(val);
    if(document.getElementById("checkdescuento").value == 1){
        document.getElementById("checkdescuento").value = 0;
    }else{
        document.getElementById("checkdescuento").value = 1;
        document.getElementById("checkdescuento").checked = true;
    }
    $.ajax({
        type:"POST",
        url:"validar.php",
        data:{showinfopdf: document.getElementById("checkdescuento").value, show_tipo: 2},
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
function aplicarnota(){
    var obs =document.getElementById("obs").value;
    $.ajax({
        type:"POST",
        url:"validar.php",
        data:"nota=" + obs,
        success:function(r){
            mostrarDescuento();
           
        }
    });
}
function autoguardarBorrador(){
    setTimeout(function() {
        guardarBorrador();
   }, 600000);
}
function finalizar(){
     $.ajax({
        type:"POST",
        url:"validar.php",
        data:"guarot=" + 47,
        success:function(r){
            
    window.location.href="https://cotizaciones.maderoequipos.com.mx/cotizador/historial-cotizaciones.php";
           
        }
         
    });
     
}
function igualarcero(){
    $.ajax({
        type:"POST",
        url:"validar.php",
        data:"igualar="+0,
        success:function(r){
            
        }
    });
}

function regresar(){
    document.getElementById('cardcarr').style.display='block';
    document.getElementById('carddesc').style.display='none'; 
}

 function regcot(id){
   // window.removeEventListener("beforeunload",bunload);
    //window.removeEventListener("unload",unload);
       window.location.assign("cotizaciones.php?tp=opc&id="+id);
    }
function siguientepdfcli(){
    //    window.location.assign("Cotizador/generar/generar-pdf.php");
    window.open('Cotizador/generar/generar-pdf-cliente.php', '_blank');
}
function siguientepdfint(){
    //    window.location.assign("Cotizador/generar/generar-pdf.php");
    window.open('Cotizador/generar/generar-pdf-interna.php', '_blank');
}
function siguientepdfcos(){
    //    window.location.assign("Cotizador/generar/generar-pdf.php");
    window.open('Cotizador/generar/generar-pdf-costos.php', '_blank');
}
