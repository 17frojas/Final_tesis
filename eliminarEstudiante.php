<?php
require 'conexion.php';
require 'validations.php';
session_start();

if (!isset($_SESSION['id'])) {
  header("Location:login.php");
}
// $Id_Usuario = $_SESSION['id'];
// $Nombre_Usuario = $_SESSION['username'];
// $Tipo_Usuario = $_SESSION['tipoUser'];
// $nombre="";
// $nom_pro="";
$error="";
$mensaje="";
$id_Tesis=0;
$id_doc=0;
$id_est=0;
$id = $_GET['id'];
$tipo = $_GET['tipo'];

  $sql="SELECT * FROM  estudiantes WHERE id = $id";
  $resultado = $mysqli-> query ($sql);

  while ($row=$resultado->fetch_assoc() ) {
      $id_Tesis = $row['idTesis'];
      $id_doc = $row['idDocente'];    
  }
  
  $sqlDelete="DELETE FROM  estudiantes WHERE id = $id";
  $resultadoDelete = $mysqli-> query ($sqlDelete);
  if($id_Tesis>0){
      // $sqlTesis="SELECT * FROM  tesis WHERE numTesis = $id_Tesis";
      // $resultadoTesis = $mysqli-> query ($sqlTesis);
      // while ($row=$resultadoTesis->fetch_assoc() ) {
      //     $nom_pro = $row['nombre'];    
      // }
      
      $sqlDeleteTesis="DELETE FROM  tesis WHERE numTesis = $id_Tesis";
      $resultadoDeleteTesis = $mysqli-> query ($sqlDeleteTesis);
      ////////////////eliminar archivos del estudiante/////
      $ruta = 'files/'.$id.'/';
      if(file_exists($ruta)){
        eliminarDir('files/'.$id);
      }
  }
  if($id_doc>0){
    $sqlDocente="UPDATE docentes SET idEstudiante='', idTesis='' WHERE id = $id_doc";
    $resultadoDocente = $mysqli-> query ($sqlDocente);
  }
  
  if($resultadoDelete){
      $mensaje = "Se eliminó exitosamente al estudiante";
  }else {
      $mensaje = "No Se eliminó";
  }



        
?>



</html>
