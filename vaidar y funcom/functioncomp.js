function recargarListacom(){
   
		jQuery.ajax({
			type:"POST",
			url:"validar.php",
			data:"componentes=" + 11,
			success:function(r){
				$('#moscom').html(r);
			},
        error: function () {}
		});
}


function elimcompo(elim) {

    if (confirm('¿ESTAS SEGURO DE ELIMINAR ESTE COMPONENTE?')) {

        $.ajax({
            type: "POST",
            url: "validar.php",
            data: "elicomponente=" + elim,
            success: function (r) {
                recargarListacom();
            }
        });
    }
}

function editmcompo(edit) {
        $.ajax({
            type: "POST",
            url: "validar.php",
            data: "editcomponente=" + edit,
            success: function (r) {
                $('#moscom').html(r);
            }
        });
    
}

function regcom(){
     
       window.location.assign("productos");
     
     
}

function recargarListacat(){
    alert("hola");
   
		$.ajax({ 
            url:"validar.php",
            data:'moscat=' + 12,
			type:"POST",
			success:function(data){ 
                 alert("aios");
				$('#icat').html(data);
			},
        error: function () {
            alert("no mames falló");
        }
		});
}

function comprobarId(){
    
    var idcommp = document.getElementById("idcom").value;
    
	$("#loaderIcon").show();
	jQuery.ajax({
	url: "ComprobarDisponibilidad.php",
	data:'idcommp='+$("#idcom").val(),
	type: "POST",
	success:function(data){
		$("#estadoId").html(data);
		$("#loaderIcon").hide();
        //alert(data);
        if(data=='<div class="alert alert-success"> Id disponible.</div>'){
            document.getElementById('btnagrcom').style.display='block';
            
            
        }else{
            document.getElementById('btnagrcom').style.display='none';
            
        }
        
    
	},
	error:function (){}
	});
}




function busqueda(){
    var texto =document.getElementById("txtpieza").value;
    var id=document.getElementById("idcom").value;
    var id_cat=document.getElementById("cat").value;
    if(texto.length>1){
         var parametros={
        "texto": texto,
        "idmadero": id,   
        "idcat": id_cat   
    };
    }if(texto.length<2){
        var parametros={
                "texto": "",
            "idmadero": id,   
        "idcat": id_cat 
            };
    }
    $.ajax({
        data: parametros,
        url: "validar.php",
        method: "POST",
        success: function(r){
            $('#datosarticulos').html(r); 
        }
    });     
}
function busquedaa(){
    var texto =document.getElementById("txtpieza").value;
   // alert("hola");
   
    var id=document.getElementById("idcom").value;
    var id_cat=document.getElementById("cat").value;
    
   // alert(id);
   // alert(id_cat);
    if(texto.length>1){
       // alert("adios");
         var parametros={
        "texto": texto,
        "idmadero": id,   
        "idcat": id_cat   
    };
    }if(texto.length<2){
        //alert("popo");
        var parametros={
                "texto": "",
            "idmadero": id,   
        "idcat": id_cat 
            };
    }
    $.ajax({
        data: parametros,
        url: "validar.php",
        method: "POST",
        success: function(r){
            $('#datosarticuloss').html(r); 
        }
    });     
}

function agregarcomponente(){
    
    
    
    var idcate = document.getElementById("cat").value;
    var idcomp = document.getElementById("idcom").value;
    var nomcomp = document.getElementById("nomcom").value;
    var descomp = document.getElementById("descom").value;
   
     
    if(document.getElementById("cat").value>0){
        if(idcomp.length>0){
            if(nomcomp.length>0){
            if(descomp.length>0){
                    $.ajax({
                        method:"POST",
                        url: "validar.php",
                        data:{comcat: $('#cat').val(), comid:$('#idcom').val(), comnom:  $('#nomcom').val(), comdes:  $('#descom').val()},
                        success:function(r){
                            $('#barrabus').html(r);
                            
                                document.getElementById('btnagrcom').style.display='none';
                                document.getElementById('cancelar').style.display='none'
                                document.getElementById('selcom').style.display='block';
                                document.getElementById('newcomp').style.display='none';
                                document.getElementById("cat").disabled = true;
                                document.getElementById("imagen").disabled = true;
                                document.getElementById("descom").disabled = true;
                                document.getElementById("idcom").disabled = true;
                                document.getElementById("nomcom").disabled = true;
                            
                                document.getElementById("idcoma").value = $('#idcom').val();
                                document.getElementById("nomcoma").value = $('#nomcom').val();
                                document.getElementById("idcoma").disabled = true;
                                document.getElementById("nomcoma").disabled = true;
                            
                        }        
                    });
            }
                
            }
        
        }
    }
       
     
   
}
function agregarnuevocomponete(idnvo){
   //alert("ayuda");
    var id=document.getElementById("idcom").value;
    var accion=document.getElementById("opccion").value;
    var accion=document.getElementById("opccion").value;
    var categoria=document.getElementById("cat").value;
    if((accion==16 || accion==15) && (categoria==5 || categoria==8)){
        var numcom = document.getElementById("numcom"+idnvo).value;
    }else{
        var numcom = document.getElementById("numcom").value;
    }
     
   
    var parametros={
        "idnvo": idnvo,
        "idcom": id,
        "numcomp": numcom
            };
    $.ajax({
        method: "POST",
        url: "validar.php",
        data: parametros,
        success:function(r){
            if(accion==16){
                 busqueda();
            
            }else{
              busquedaa();  
            }
           
        }
    });
}


function sumarcantidad(id){
   // alert(id);
    var idcomp = document.getElementById("idcom").value;
    var accion=document.getElementById("opccion").value;
    var parametros={
        "idsuma": id,
        "idpadre": idcomp
            };
    $.ajax({
        method: "POST",
        url: "validar.php",
        data: parametros,
        success: function(r){
           
        }
    });
    if(accion==16){
                 busqueda();
            
            }else{
              busquedaa();  
            }
    //agregarcomponente();
}

function quitarcantidad(id){
    var accion=document.getElementById("opccion").value;
   // alert(id);
    var idcomp = document.getElementById("idcom").value;
    var parametros={
        "idresta": id,
        "idpadre": idcomp
            };
    $.ajax({
        method: "POST",
        url: "validar.php",
        data: parametros,
        success: function(r){
           
        }
    });
   if(accion==16){
                 busqueda();
            
            }else{
              busquedaa();  
            }
    //agregarcomponente();
}
function quitarcomp(id){
    var accion=document.getElementById("opccion").value;
    if (confirm('¿ESTAS SEGURO DE ELIMINAR?')){
    var idcomp = document.getElementById("idcom").value;
    var parametros={
        "idquitar": id,
        "idpadre": idcomp
            };
    $.ajax({
        method: "POST",
        url: "validar.php",
        data: parametros,
        success: function(r){
           
        }
    });}
    if(accion==16){
                 busqueda();
            
            }else{
              busquedaa();  
            }
    //agregarcomponente();
    
}