<?php
session_start();
include "conexion.php";

$data = file_get_contents("php://input"); 
$objData = json_decode($data);
    $action = $_POST["submit"]; 
    $id=$_POST["idprod"];
    $idcat=$_POST["nompro"];
    $nombre=$_POST["despro"];
    $descripcion=$_POST["prepro"];
    $precio=$_POST["catpro"];

    echo $action."<br>";
    echo $id."<br>";
    echo $idcat."<br>";
    echo $nombre."<br>";
    echo $descripcion."<br>";
    echo $precio."<br>";

    switch ($action){
        case 1:
                $sql="INSERT INTO productos(id,id_cat,nombre,descripcion)
                      VALUES('$id','$idcat','$nombre','$descripcion')"; 
                $conn->query($sql);               
        
      
   
            

        break;

    }
?>