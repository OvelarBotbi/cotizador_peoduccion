/*---------------------REGRESAR A COMPONENTES------------*/
 function regcom() {
    window.location.assign("productos.php");
}
/*---------------------REGRESAR A COMPONENTES------------*/
 function actopca(idcas) {
    if (document.getElementById("compopcc" + idcas).disabled == true) {
        document.getElementById("compopcc" + idcas).disabled = false;
    } else {
        document.getElementById("compopcc" + idcas).disabled = true;
        document.getElementById("compopcc" + idcas).value = 1;
    }

}
 function carga() {
    window.removeEventListener("beforeunload", bunload);
    window.removeEventListener("unload", unload);
    document.getElementById('contopc').style.display = 'none';
    var contenedor = document.getElementById('contenedor_carga');
    contenedor.style.visibility = 'visible';
    contenedor.style.position = 'fixed';
    contenedor.style.opacity = '1';

}
function myFunction() {
    var x = document.getElementById("mySidebar");
    if (x.className === "sidebar") {
        x.className += " responsive";
    } else {
        x.className = "sidebar";
    }
}

function recargarLista() {
    $.ajax({
        type: "POST",
        url: "validar.php",
        data: "sistemas=" + $('#sis').val(),
        success:  function (r) {
            $('#selpla').html(r);
            recargarTamanos();
            recargarUnidades();
            recargarBotton();
            //eliminartodoCarrito();
            document.getElementById('cardpla').style.display = 'block';
        }
    });
}

function recargarTamanos() {
    $.ajax({
        type: "POST",
        url: "validar.php",
        data: "plataformas=" + $('#pla').val(),
        success:  function (r) {
            $('#selcap').html(r);
            recargarUnidades();
            recargarBotton();

        }
    });
}

function recargarUnidades() {
    $.ajax({
        type: "POST",
        url: "validar.php",
        data: "tamanos=" + $('#cap').val(),
        success:  function (r) {
            $('#seluni').html(r);
            recargarBotton();

            //eliminartodoCarrito();
        }
    });
}

function recargarBotton() {
    $.ajax({
        type: "POST",
        url: "validar.php",
        data: "unidades=" + $('#cap').val(),
        success:  function (r) {
            $('#botsel').html(r);
            // eliminartodoCarrito();
            //document.getElementById('btnmoscar').style.display='block';
            // document.getElementById('seluni').style.display='none';
            //document.getElementById('uni').style.display='none';
            //document.getElementById('uni').disabled = true;


        }
    });
}
function cambiarCantidadProducto(id_prod, cant, colapse) {
    console.log(colapse);
    console.log(id_prod);
    if (cant > 0) {
        $.ajax({
            type: "POST",
            url: "validar.php",
            data: { nuevacantidad_id: id_prod, nuevacantidad: cant },
            success:  function (r) {
                mostrarCarritoel(colapse);
            }
        });
    }
}

 function mostrarCarrito() {
    $.ajax({
        type: 'POST',
        url: 'validar.php',
        data: 'eliminartodo=' + 7,
        success:  function (returned) {
            var contenedor = document.getElementById('contenedor_carga');
            contenedor.style.visibility = 'visible';
            contenedor.style.position = 'fixed';
            contenedor.style.opacity = '1';
            var nomcli = document.getElementById('nomclient').value;

            document.getElementById('btnmoscar').style.display = 'none';
            document.getElementById('cardpla').style.display = 'none';
            $.ajax({
                type: "POST",
                url: "validar.php",
                data: { carrito: + $('#btnmoscar').val(), sistema: $('#sis').val(), plataforma: $('#cap').val(), capacidad: $('#pla').val(), unidad: $('#cap').val(), nomclient: nomcli },
                success:  function (r) {
                    if (r == 0) {
                        //alert("no contiene");
                        regresar();
                    } else {
                        $('#carrito').html(r);
                        document.getElementById('cardcarr').style.display = 'block';
                        contenedor.style.visibility = 'hidden';
                        contenedor.style.position = 'fixed';
                        contenedor.style.opacity = '0';
                    }


                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Error: " + errorThrown); 
                    console.log(textStatus);
                    console.log(XMLHttpRequest);
                }       
            });
        }
    });

}

 function mostrarCarritoRegreso(id) {
    console.log(id);
    mostrarOpcionales(true);

}
 function checkEliminarCarrito(elic, nivel, colapse) {
    if (document.getElementById("checkEli" + elic).value == 1) {
        document.getElementById("checkEli" + elic).value = 0;
        document.getElementById("checkEli" + elic).checked = false;
    } else {
        document.getElementById("checkEli" + elic).value = 1;
        document.getElementById("checkEli" + elic).checked = true;
    }
    $.ajax({
        type: "POST",
        url: "validar.php",
        data: { updatecheck: elic, upvalor: document.getElementById("checkEli" + elic).value, nivel: nivel },
        success:  function (r) {
            mostrarCarritoel(colapse);
        }
    });
}
 function actualizarSubtotal(subnuevo) {
    document.getElementById('txtsubtotal').value = subnuevo;
}
 function eliminarCarrito(elicar) {
    if (confirm('¿ESTAS SEGURO DE ELIMINAR ESTA COMPONENTE DEL CARRITO?')) {
        $.ajax({
            type: "POST",
            url: "validar.php",
            data: { eliminar: elicar, acci: 2 },
            success:  function (r) {
                //$('#carrito').html(r);
                mostrarCarritoel(elicar);
            }
        });
    }
}
 function eliminarCarritoo(elicar) {

    if (confirm('¿ESTAS SEGURO DE ELIMINAR ESTA COMPONENTE DEL CARRITO?')) {
        $.ajax({
            type: "POST",
            url: "validar.php",
            data: { eliminar: elicar, acci: 1 },
            success:  function (r) {
                //$('#carrito').html(r);
                mostrarCarritoel(elicar);
            }
        });
    }
}

 function eliminarPrtcomp(elicar) {
    $.ajax({
        type: "POST",
        url: "validar.php",
        //{sistema: $('#sis').val(), plataforma:  $('#pla').val(),capacidad:  $('#cap').val(),unidad:  $('#uni').val()},
        data: { eliminar: elicar, acci: 1, carritos: $('#btnmoscar').val() },
        success:  function (r) {
            $('#carrito').html(r);
            mostrarCarritoel(elicar);
        }
    });
}

 function mostrarCarritoel(colapse) {
    console.log(colapse);
    $.ajax({
        type: "POST",
        url: "validar.php",
        data: { carritoel: $('#btnmoscar').val(), colapse: colapse },
        success:  function (r) {
            if (r == 0) {
                regresar();
            } else {
                $('#carrito').html(r);
                document.getElementById('btnmoscar').style.display = 'none';
            }


        }
    });
}

 function eliminartodoCarrito(num) {
    console.log(num);
    if (num == 1) {
        $.ajax({
            type: "POST",
            url: "validar.php",
            data: "eliminartodo=" + 7,
            success:  function (r) {
                $('#carrito').html(r);

            }
        });
    }
}

 function regresar() {
    eliminartodoCarrito(1);
    document.getElementById('cardpla').style.display = 'block';
    document.getElementById('cardcarr').style.display = 'none';
    recargarTamanos();

}

 function regresarCarritoInicial() {
    document.getElementById('cardpla').style.display = 'none';
    document.getElementById('cardcarr').style.display = 'block';
    document.getElementById('contplat').style.display = 'block';
    document.getElementById('contopc').style.display = 'none';
}

 function elimCat(elimC) {
    if (confirm('¿ESTAS SEGURO DE ELIMINAR ESTA CATEGORIA?' + elimC)) {
        $.ajax({
            type: "POST",
            url: "validar.php",
            data: "elicat=" + elimC,
            success:  function (r) {
                $('#moscat').html(r);
            }
        });
    }
}

 function eliminarUsuario(elim) {

    if (confirm('¿ESTAS SEGURO DE ELIMINAR ESTE USUARIO?')) {

        $.ajax({
            type: "POST",
            url: "validar.php",
            data: "eliusuario=" + elim,
            success:  function (r) {
                $('#mosusu').html(r);
            }
        });
    }
}


//mostrar carrito ya con el rotatorio
 function mostrarCarritorot() {

    document.getElementById('contplat').style.display = 'none';
    var contenedor = document.getElementById('contenedor_carga');
    contenedor.style.visibility = 'visible';
    contenedor.style.position = 'fixed';
    contenedor.style.opacity = '1';



    $.ajax({
        method: "POST",
        url: "validar.php",
        data: { sistema: $('#sis').val(), plataforma: $('#pla').val(), capacidad: $('#cap').val(), unidad: $('#uni').val() },
        success:  function (r) {
            $('#moscarl').html(r);
            mostrarOpcionales(false);
            contenedor.style.visibility = 'hidden';
            contenedor.style.position = 'fixed';
            contenedor.style.opacity = '0';
            //document.getElementById('contopc').style.display='block';
        }
    });
}

 function mostrarOpcionales(isregreso) {
    $.ajax({
        method: "POST",
        url: "validar.php",
        data: "opcionalesc=" + 23,
        success:  function (r) {
            $('#mosopc').html(r);
            document.getElementById('cardpla').style.display = 'none';
            document.getElementById('contopc').style.display = 'block';
            if (isregreso)
                document.getElementById('regIni').style.display = 'none';
        }
    });
}
/*----------------------BUSQUEDA DE ARTICULOS--------------------*/
 function busqueda() {

    var texto = document.getElementById("txtpieza").value;
    var id = document.getElementById("idcom").value;
    var id_cat = document.getElementById("cat").value;


    if (texto.length > 5) {
        var parametros = {
            "texto": texto,
            "idmadero": id,
            "idcat": id_cat
        };
    } if (texto.length < 6) {
        var parametros = {
            "texto": "",
            "idmadero": id,
            "idcat": id_cat
        };
    }
    $.ajax({
        data: parametros,
        url: "validar.php",
        method: "POST",
        success:  function (r) {
            $('#componentes').DataTable();
            $('#datosarticulos').html(r);


        }
    });


}
 function busquedaa() {
    var texto = document.getElementById("txtpieza").value;
    var id = document.getElementById("idcom").value;
    var id_cat = document.getElementById("cat").value;
    //alert(id_cat);

    if (texto.length > 1) {
        var parametros = {
            "texto": texto,
            "idmadero": id,
            "idcat": id_cat
        };
    } if (texto.length < 2) {
        var parametros = {
            "texto": "",
            "idmadero": id,
            "idcat": id_cat
        };
    }
    $.ajax({
        data: parametros,
        url: "validar.php",
        method: "POST",
        success:  function (r) {
            $('#componentes').DataTable();
            $('#datosarticulos').html(r);


        }
    });


}

/* AGREGAR UN NUEVO COMPONENTE*/
 function agregarcomponente() {
    var idcate = document.getElementById("cat").value;
    var idcomp = document.getElementById("idcom").value;
    var nomcomp = document.getElementById("nomcom").value;
    var descomp = document.getElementById("descom").value;

    if (document.getElementById("cat").value > 0) {
        if (idcomp.length > 0) {
            if (nomcomp.length > 0) {
                if (descomp.length > 0) {
                    $.ajax({
                        method: "POST",
                        url: "validar.php",
                        data: { comcat: $('#cat').val(), comid: $('#idcom').val(), comnom: $('#nomcom').val(), comdes: $('#descom').val() },
                        success:  function (r) {
                            $('#barrabus').html(r);

                            document.getElementById('btnagrcom').style.display = 'none';
                            document.getElementById("cat").disabled = true;
                            document.getElementById("imagen").disabled = true;
                            document.getElementById("descom").disabled = true;
                            document.getElementById("idcom").disabled = true;
                            document.getElementById("nomcom").disabled = true;
                        }
                    });
                }

            }

        }
    }



}
 function agregarnuevocomponete(idnvo) {
    alert("hola");
    var id = document.getElementById("idcom").value;
    var parametros = {
        "idnvo": idnvo,
        "idcom": id
    };
    $.ajax({
        method: "POST",
        url: "validar.php",
        data: parametros,
        success:  function (r) {
            busqueda();
        }
    });
}


 function sumarcantidad(id) {
    // alert(id);
    var idcomp = document.getElementById("idcom").value;
    var parametros = {
        "idsuma": id,
        "idpadre": idcomp
    };
    $.ajax({
        method: "POST",
        url: "validar.php",
        data: parametros,
        success:  function (r) {

        }
    });
    busquedaa();
    //agregarcomponente();
}

 function quitarcantidad(id) {
    // alert(id);
    var idcomp = document.getElementById("idcom").value;
    var parametros = {
        "idresta": id,
        "idpadre": idcomp
    };
    $.ajax({
        method: "POST",
        url: "validar.php",
        data: parametros,
        success:  function (r) {

        }
    });
    busqueda();
    //agregarcomponente();
}

/*-------------COMPROBAR SI EL NICKNAME DEL USUARIO EXISTE-----------------------*/
 function comprobarUsuario() {
    var usu = document.getElementById("usuario").value;

    $("#loaderIcon").show();
    jQuery.ajax({
        url: "ComprobarDisponibilidad.php",
        data: 'usuario=' + $("#usuario").val(),
        type: "POST",
        success:  function (data) {
            $("#estadousuario").html(data);
            $("#loaderIcon").hide();
            //alert(data);
            if (data == '<div class="alert alert-success"> Usuario  disponible.</div>') {

                btnagrusu();

            } else {
                nbtnagrusu();
            }


        },
        error: function () { }
    });
}
 function btnagrusu() {
    $.ajax({
        method: "POST",
        url: "validar.php",
        data: "btnagrusu=" + 27,
        success:  function (r) {
            $('#aauu').html(r);



        }
    });

}  function nbtnagrusu() {
    $.ajax({
        method: "POST",
        url: "validar.php",
        data: "nbtnagrusu=" + 28,
        success:  function (r) {
            $('#aauu').html(r);



        }
    });

}
 function comprobarEmail() {
    $("#loaderIconEmail").show();
    jQuery.ajax({
        url: "ComprobarDisponibilidad.php",
        data: 'email=' + $("#email").val(),
        type: "POST",
        success:  function (data) {
            $("#estadoemail").html(data);
            $("#loaderIconEmail").hide();
        },
        error: function () { }
    });
}
/*-------------COMPROBAR SI EL NICKNAME DEL USUARIO EXISTE-----------------------*/


/*-------------COMPROBAR SI EL ID EXISTEEXISTE-----------------------*/
 function comprobarId() {
    var idcommp = document.getElementById("idcom").value;

    $("#loaderIcon").show();
    jQuery.ajax({
        url: "ComprobarDisponibilidad.php",
        data: 'idcommp=' + $("#idcom").val(),
        type: "POST",
        success: function (data) {
            $("#estadoId").html(data);
            $("#loaderIcon").hide();
            //alert(data);
            if (data == '<div class="alert alert-success"> Id disponible.</div>') {
                document.getElementById('btnagrcom').style.display = 'block';


            } else {
                document.getElementById('btnagrcom').style.display = 'none';

            }


        },
        error: function () { }
    });
}
 function btnagrid() {
    $.ajax({
        method: "POST",
        url: "validar.php",
        data: "btnagrusu=" + 27,
        success:  function (r) {
            $('#aauu').html(r);



        }
    });

} function nbtnagrid() {
    $.ajax({
        method: "POST",
        url: "validar.php",
        data: "nbtnagrusu=" + 28,
        success: function (r) {
            $('#aauu').html(r);



        }
    });

}
 function comprobarEmail() {
    $("#loaderIconEmail").show();
    jQuery.ajax({
        url: "ComprobarDisponibilidad.php",
        data: 'email=' + $("#email").val(),
        type: "POST",
        success:  function (data) {
            $("#estadoemail").html(data);
            $("#loaderIconEmail").hide();
        },
        error: function () { }
    });
}
/*-------------COMPROBAR SI EL ID EXISTEEXISTE----------------------*/


