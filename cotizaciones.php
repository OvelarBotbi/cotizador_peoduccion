<?php
include("arreglos.php");
include("app/Usuario.inc.php");
include("php_conexiones.php");
$active = 1;
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Cotizacion</title>
    <style>
        body {
            margin: 0;
            font-family: arial;
        }

        .sidebar {
            margin: 0;
            padding: 0;
            width: 200px;
            background-color: #f1f1f1;
            position: fixed;
            height: 100%;
            overflow: auto;
            font-size: 15px;
            font-family: arial;
        }
    </style>
    <script>
        var getParams = function(url) {
            console.log(url);
            var params = {};
            var parser = document.createElement('a');
            parser.href = url;
            var query = parser.search.substring(1);
            var vars = query.split('&');
            for (var i = 0; i < vars.length; i++) {
                var pair = vars[i].split('=');
                params[pair[0]] = decodeURIComponent(pair[1]);
            }
            return params;


        };
        var parames = {};
        parames = getParams(window.location.href);
        
    </script>
    <?php 
            $url=$_SERVER['REQUEST_URI'];
            $sub=substr($url,-5);
            if($sub=='bor=1')
                $active=6;
            ?>
    <?php

    include("js/direcciones.php");
    ?>
    <link rel="icon" type="image/png" href="./img/logo.png" />
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>

</head>

<body>
    <div id="contenedor_carga" style="position: absolute;">
        <div id="carga"></div>
    </div>

    <div>
        <?php if (isset($_SESSION['usuario'])) {
            include("plantillas/barralateral.php");
        ?>
            <div id="contplat" class="content pt-5" style="display: block;">
                <div class="card " id="cardpla" style="display:none">
                    <div class="card-header"><img style="width:20px" src="img/milking.png">TIPO DE PLATAFORMA
                        <button type="button" style="float: right;" class="btn btn-info" onclick="mostrarBorradores()">Mostrar Borradores</button>
                    </div>
                    <div class="card-body">
                        <div><a class="letche" style="font-size: 16px;">CLIENTE</a>
                         <input type="text" style="font-size: 14px;" id="nomclient">
                            <!--input list="brow" style="font-size: 14px;" id="nomclient">
                            <datalist id="brow">
                                <?php
                                //$clientes = $conn->query("SELECT * FROM clientes");

                                //while ($nombres = $clientes->fetch_array(MYSQLI_ASSOC)) {
                                  //  $nombre = $nombres['card_name'];
                                    //$id = $nombres['card_code'];

                                ?>
                                    <option value='<?php //echo $id; ?>'><?php //echo $nombre; ?></option>
                                <?php //} ?>
                            </datalist-->
                        </div>
                        <div><a class="letche">SISTEMA</a>
                            <select id="sis" name="idsistema" class="form-control">
                                <option value="0" class="quince" disabled selected>SELECCIONAR</option>
                                <?php
                                for ($i = 0; $i < count($relaciones); $i++) {
                                    $sistemas = $relaciones[$i];
                                    $ids = ($sistemas->id()) == "-" ? "N/A" : ($sistemas->id());
                                    $idcat = ($sistemas->id_cat()) == "-" ? "N/A" : ($sistemas->id_cat());
                                    $nombres = ($sistemas->nombre()) == "-" ? "N/A" : ($sistemas->nombre());
                                    $idpadre = ($sistemas->padre()) == "-" ? "N/A" : ($sistemas->padre());

                                ?>
                                    <option class="quince" value='<?php echo $ids; ?>'><span><?php echo $nombres; ?></span></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="pt-4" id="selpla"></div>
                        <div class="pt-4" id="selcap"></div>
                        <div class="pt-4" id="seluni"></div>
                        <div class="pt-4" id="botsel"></div>
                    </div>
                </div>
                <div id="cardcarr" class="card card2" style="display: none;">
                    <div class="card-header"><i class="fa fa-cart-plus"></i>CARRITO
                        <button type="button" style="float: right;" class="btn btn-info" onclick="guardarBorrador()">Guardar Borrador</button>
                        <div class="toast" id="toast" role="alert" aria-live="assertive" aria-atomic="true" style="margin-left:35%; position:absolute; min-width:240px; font-size:1.8rem;margin-top:-50px">
  <div class="toast-header">
    
    <strong class="mr-auto">Borrador</strong>
    <small>Ahora</small>
  </div>
  <div class="toast-body" style="text-align: center;">
    Borrador Guardado
  </div>
</div>
                    </div>
                    <div class="card-body">
                        <button Onclick="regresar()" class="btn btn-warning">
                            <li class=" fas fa-reply"></li>
                        </button>
                        <div id="carrito"></div>
                    </div>
                </div>
                <div id="cardborrador" class="card card2" style="display: none;">
                    <div class="card-header"><img style="width:20px" src="img/milking.png"></i>BORRADORES

                    </div>
                    <div class="card-body">
                        <div id="borrador-t"></div>
                    </div>
                </div>
            </div>

            <div id="contopc" class="content pt-5" style="display:none;">

                <div class="card">
                    <div class="card-header"><i class="fas fa-clipboard-check"></i>OPCIONALES</div>
                    <div class="card-body tco">
                        <form action="validar.php" method="post">
                            <input name="opcionalesp" value="1" style="display:none;">
                            <div class="pt-4" id="mosopc"></div>
                        </form>
                    </div>
                    <!-- <div class="card-footer">
                        hola
                    </div>-->
                </div>

            </div>
            


            





















    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            selectCliente();
            if (parames.tp == 'opc') {
                console.log(parames);
                mostrarCarritoRegreso(parames.id);

            } else {
                $('#sis').change(function() {
                    recargarLista();
                });

                $('#selpla').change(function() {
                    recargarTamanos();
                });

                $('#selcap').change(function() {
                    //recargarUnidades();
                    recargarBotton();
                });
                $('#seluni').change(function() {
                    recargarBotton();
                });
            }
            if( parames.bor=='1'){
                mostrarBorradores();
                document.getElementById('cardpla').style.display = 'none';
                
            }
        })
    </script>
    <script>
        window.onload = function() {
            var contenedor = document.getElementById('contenedor_carga');
            contenedor.style.visibility = 'hidden';
            contenedor.style.opacity = '0';
            $('#sis').val(0);
            if (parames.tp == 'opc') {
                eliminartodoCarrito(0);
            } else {
                eliminartodoCarrito(1);
            }
            recargarLista();

        }
    </script>
<?php } else {
            header("Refresh:1; url=index.php");
        } ?>
</body>

</html>