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


<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Notes App</title>
  <!-- GOOGLE FONTS -->
  <link href="https://fonts.googleapis.com/css?family=Oswald" rel="stylesheet">
  <!-- BOOTSTRAP 4 -->
  <link rel="stylesheet" href="css/bootstrap4.css">
  <!-- FONT AWESOME 5 -->
  <link rel="stylesheet" href="css/font-awesome.css">
  <!-- STYLES -->
  <link rel="stylesheet" href="css/styles.css">

  
</head>

<body class="fondo">
  <!-- Barra de navegacion oscura -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="#">
        UDENAR TESISS
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
              aria-haspopup="true" aria-expanded="false">
              OPCIONES
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="listadoE.php">MOSTRAR ESTUDIANTES </a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="listadoD.php">MOSTRAR JURADOS</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="listadoT.php">MOSTRAR TESIS</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="perfilA.php">PERFIL</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="modal" data-target="#logout" href="#">SALIR</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- Barra de navegacion oscura -->
  <div class="container p-4">
    <div class="row">
      <div class="col-md-4 mx-auto">
        <div class="card text-center">
          <div class="text-center">
            <p class="alert-danger">
              <?php echo $error; ?>
            </p>
          </div>
          <div class="text-center">
            <p class="alert-primary">
              <?php echo $mensaje; ?>
            </p>
          </div>
          <div class="form-group">
            <div class="col-sm-6 mx-auto">Mostrar
              <a class="btn btn-primary btn-block" href="listadoE.php">ESTUDIANTES</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Logout Modal-->
  <div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">¿Seguro quieres cerrar sesión?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Volver</button>
          <a class="btn btn-primary" href="logout.php">Cerrar Sesión</a>
        </div>
      </div>
    </div>
  </div>

  <!-- SCRIPTS -->
  <script src="scripts/jquery-3.3.1.slim.min.js"></script>
  <script src="scripts/popper.min.js"></script>
  <script src="scripts/bootstrap.min.js"></script>
</body>

</html>
