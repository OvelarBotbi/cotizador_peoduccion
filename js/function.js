/*---------------------REGRESAR A COMPONENTES------------*/
function regcom() {
    window.location.assign("productos.php");
}
/*---------------------REGRESAR A COMPONENTES------------*/
function actopca(idcas) {
    const s = document.getElementById("compopcc" + idcas);
    console.log(s);
    if (document.getElementById("compopcc" + idcas).disabled == true) {
        document.getElementById("compopcc" + idcas).disabled = false;
    } else {
        document.getElementById("compopcc" + idcas).disabled = true;
        document.getElementById("compopcc" + idcas).value = 1;
    }
}
var previousValue = 0;
function prevValue(input) {
    previousValue = input.value;
}
function multiplicarTodo(idcas, id_input_cant) {
    let nuevaCant = id_input_cant.value;//2
    const cbs = document.querySelectorAll('input[id="opc_sap' + idcas + '"]');
    cbs.forEach((cb) => {
        let viejaCant = cb.value;//400
        let cantidadAUno = 0;

        if (parseInt(nuevaCant) > parseInt(previousValue))
            {
                let diferencia=nuevaCant-previousValue;
                cantidadAUno = (viejaCant / (parseInt(nuevaCant) - diferencia));
            }
        else
            {
                let diferencia=previousValue-nuevaCant;
                cantidadAUno = (viejaCant / (parseInt(nuevaCant) + diferencia));
            }
        let resultado = cantidadAUno * nuevaCant;
        cb.value = resultado;


    });
    previousValue = nuevaCant;
}
function todoOpc(idcas) {
    if (document.getElementById("selectTodoOpc" + idcas).value == 1) {
        document.getElementById("selectTodoOpc" + idcas).value = 0;
        checkOpc(false, idcas);
    } else {
        document.getElementById("selectTodoOpc" + idcas).value = 1;
        checkOpc(true, idcas);
    }

}
function checkOpc(checked = true, idcas) {

    const cbs = document.querySelectorAll('input[id="compopc' + idcas + '"]');
    cbs.forEach((cb) => {
        cb.checked = checked;


    });
    if (checked == true) {
        const cantidades = document.querySelectorAll('input[id="compopcc' + idcas + '"]');
        cantidades.forEach((cb) => {
            cb.disabled = false;
            console.log(cb);
        });
    }
    else {
        const cantidades = document.querySelectorAll('input[id="compopcc' + idcas + '"]');
        cantidades.forEach((cb) => {
            cb.disabled = true;
            console.log(cb);
            cb.value = 1;
        });
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
        success: function (r) {
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
        success: function (r) {
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
        success: function (r) {
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
        success: function (r) {
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
            data: { nuevacantidad_id: id_prod, nuevacantidad: cant,padreprod: colapse },
            success: function (r) {
                mostrarCarritoel(colapse);
            }
        });
    }
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
function eliminarBorrador(id_borra) {
    $.ajax({
        type: "POST",
        url: "validar.php",
        data: { deleteborra: id_borra },
        success: function (r) {
            mostrarBorradores();
        }
    });
}

function mostrarCarrito() {
    var contenedor = document.getElementById('contenedor_carga');
    contenedor.style.visibility = 'visible';
    contenedor.style.position = 'fixed';
    contenedor.style.opacity = '1';
    
    var nomcli = document.getElementById('nomclient').value;
    console.log(nomcli);
    document.getElementById('btnmoscar').style.display = 'none';
    document.getElementById('cardpla').style.display = 'none';
    $.ajax({
        type: "POST",
        url: "validar.php",
        data: { carrito: + $('#btnmoscar').val(), sistema: $('#sis').val(), plataforma: $('#cap').val(), capacidad: $('#pla').val(), unidad: $('#cap').val(), nomclient: nomcli },
        success: async function (r) {
            if (r == 0) {
                //alert("no contiene");
                regresar();
            } else {
                $('#carrito').html(r);
                document.getElementById('cardcarr').style.display = 'block';
                contenedor.style.visibility = 'hidden';
                contenedor.style.position = 'fixed';
                contenedor.style.opacity = '0';
                autoguardarBorrador();
            }


        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
            console.log(textStatus);
            console.log(XMLHttpRequest);
        }
    });

}
function autoguardarBorrador(){
    setTimeout(function() {
        guardarBorrador();
   }, 600000);
}

function mostrarCarritoRegreso(id) {
    console.log(id);
    mostrarOpcionales(true);

}
function mostrarBorradores() {
    var contenedor = document.getElementById('contenedor_carga');
    contenedor.style.visibility = 'visible';
    contenedor.style.position = 'fixed';
    contenedor.style.opacity = '1';
    contenedor.style.zIndex = '999';
    
    setTimeout(function() {
        document.getElementById('cardpla').style.display = 'none';
    $.ajax({
        type: "POST",
        url: "validar.php",
        data: { showBorradores:1},
        success: async function (r) {
            if (r == 0) {
                //alert("no contiene");
                alert("No tienes borradores");
                window.location.href="cotizaciones.php";
            } else {
                document.getElementById('cardpla').style.display = 'none';
                $('#borrador-t').html(r);
                document.getElementById('cardborrador').style.display = 'block';
                contenedor.style.visibility = 'hidden';
                contenedor.style.position = 'fixed';
                contenedor.style.opacity = '0';
                contenedor.style.zIndex = '0';
                $('#dataTable').DataTable();
            }


        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
            console.log(textStatus);
            console.log(XMLHttpRequest);
        }
    });


   }, 1000);
    
}

function abrirCotizacionBorrador(idborra) {
    var contenedor = document.getElementById('contenedor_carga');
    contenedor.style.visibility = 'visible';
    contenedor.style.position = 'fixed';
    contenedor.style.opacity = '1';
    

    document.getElementById('cardborrador').style.display = 'none';
    
    $.ajax({
        type: "POST",
        url: "validar.php",
        data: { abrirBorra: idborra},
        success: async function (r) {
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
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
            console.log(textStatus);
            console.log(XMLHttpRequest);
        }
    });



}
function selectCliente(){
    // Find all inputs on the DOM which are bound to a datalist via their list attribute.
var inputs = document.querySelectorAll('input[list]');
for (var i = 0; i < inputs.length; i++) {
  // When the value of the input changes...
  inputs[i].addEventListener('change', function() {
    var optionFound = false,
      datalist = this.list;
    // Determine whether an option exists with the current value of the input.
    for (var j = 0; j < datalist.options.length; j++) {
        if (this.value == datalist.options[j].value) {
            optionFound = true;
            break;
        }
    }
    // use the setCustomValidity function of the Validation API
    // to provide an user feedback if the value does not exist in the datalist
    if (optionFound) {
      this.setCustomValidity('');
    } else {
      this.setCustomValidity('Please select a valid value.');
      alert("Este cliente no existe seleccione otro");
      this.value="";
    }
  });
}
}
function checkEliminarCarrito(elic, nivel, colapse) {
    if(nivel==1){
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
        data: { updatecheck: elic, upvalor: document.getElementById("checkEli" + elic).value, nivel: nivel,padreprod:colapse },
        success: function (r) {
            mostrarCarritoel(colapse);
        }
    });
}else{
    if (document.getElementById("checkEli" + elic+colapse).value == 1) {
        document.getElementById("checkEli" + elic+colapse).value = 0;
        document.getElementById("checkEli" + elic+colapse).checked = false;
    } else {
        document.getElementById("checkEli" + elic+colapse).value = 1;
        document.getElementById("checkEli" + elic+colapse).checked = true;
    }
    $.ajax({
        type: "POST",
        url: "validar.php",
        data: { updatecheck: elic, upvalor: document.getElementById("checkEli" + elic+colapse).value, nivel: nivel,padreprod:colapse },
        success: function (r) {
            mostrarCarritoel(colapse);
        }
    });
}
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
            success: function (r) {
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
            success: function (r) {
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
        success: function (r) {
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
        success: function (r) {
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
            success: function (r) {
                $('#carrito').html(r);

            }
        });
    }
}

function regresar() {
    eliminartodoCarrito(1);
    document.getElementById('cardpla').style.display = 'block';
    document.getElementById('cardcarr').style.display = 'none';
    document.getElementById('cardborrador').style.display = 'none';
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
            success: function (r) {
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
            success: function (r) {
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
        success: function (r) {
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
    
        let contenedor = document.getElementById('contenedor_carga');
        contenedor.style.visibility = 'visible';
        contenedor.style.position = 'fixed';
        contenedor.style.opacity = '1';
        contenedor.style.zIndex = '999';

    
    $.ajax({
        method: "POST",
        url: "validar.php",
        data: "opcionalesc=" + 23,
        success: function (r) {
            $('#mosopc').html(r);
            document.getElementById('cardpla').style.display = 'none';
            document.getElementById('contopc').style.display = 'block';
            if (isregreso) 
                document.getElementById('regIni').style.display = 'none';
            contenedor.style.visibility = 'hidden';
            contenedor.style.position = 'absolute';
            contenedor.style.opacity = '0';
            contenedor.style.zIndex = '0';
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Error: ayuda" + errorThrown);
            console.log(textStatus);
            console.log(XMLHttpRequest);
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
        success: function (r) {
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
        success: function (r) {
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
                        success: function (r) {
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
        success: function (r) {
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
        success: function (r) {

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
        success: function (r) {

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
        success: function (data) {
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
        success: function (r) {
            $('#aauu').html(r);



        }
    });

} function nbtnagrusu() {
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
        success: function (data) {
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
        success: function (r) {
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
        success: function (data) {
            $("#estadoemail").html(data);
            $("#loaderIconEmail").hide();
        },
        error: function () { }
    });
}
/*-------------COMPROBAR SI EL ID EXISTEEXISTE----------------------*/


