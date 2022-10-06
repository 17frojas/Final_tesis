<?php
require 'conexion.php';
require 'validations.php';
session_start();


if (!isset($_SESSION['id'])) {
    header("Location:login.php");
}
$Id_Usuario = $_SESSION['id'];
// $Nombre_Usuario = $_SESSION['username'];
// $Tipo_Usuario = $_SESSION['tipoUser'];
$error="";
$mensaje="";
$id_Tesis=0;


$sql="SELECT * FROM  estudiantes WHERE id = $Id_Usuario";
$resultado = $mysqli-> query ($sql);

while ($row=$resultado->fetch_assoc() ) {
    $id_Tesis = $row['idTesis'];  
}

$sql2 = "UPDATE tesis SET nombre='', descripcion='', url='', calificacion='' WHERE numtesis = '$id_Tesis'";
$resultado2=$mysqli->query($sql2);

// $path = 'recycle';
// if (!is_dir($path)) {
//     @mkdir($path);
// }
$ruta = 'files/'.$Id_Usuario.'/';
if(file_exists($ruta)){
  eliminarDir('files/'.$Id_Usuario);
}
 

  
if($resultado2){
    $mensaje = "Se eliminó el documento de su tesis";
}else {
    $mensaje = "No Se eliminó";
}

        
?>



