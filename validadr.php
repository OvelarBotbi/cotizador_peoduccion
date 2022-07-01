<?php
include("php_conexiones.php");
if (($_FILES["file"]["type"] == "image/pjpeg")
    || ($_FILES["file"]["type"] == "image/jpeg")
    || ($_FILES["file"]["type"] == "image/png")
    || ($_FILES["file"]["type"] == "image/gif")) {
    $id=$_POST['idcom'];
    $nombre_archivo = "img";
    $nombre_archivo.=$id.".jpg";
    if (move_uploaded_file($_FILES["file"]["tmp_name"], "img/".$nombre_archivo)) {
        //more code here...
        $dir="img/".$nombre_archivo;
        $result= $conn->query("INSERT INTO imagenes(id_comp,dir_img) VALUES('$id','$dir')");
        echo "img/".$nombre_archivo;
    } else {
        echo 1;
    }
} else {
    echo 1;
}