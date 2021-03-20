<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Geriatry salut</title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="vista/img/plantilla/logo_geriatry.png">

  

<!-- -------------------------------------------------------------------------- */
/*                                 PLUGINS CSS                                */
/* -------------------------------------------------------------------------- */-->
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vista/bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="vista/bower_components/font-awesome/css/font-awesome.min.css">



  <!-- Theme style -->
  <link rel="stylesheet" href="vista/dist/css/AdminLTE.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="vista/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

   <!-- DataTables -->
   <link rel="stylesheet" href="vista/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

   <link rel="stylesheet" href="vista/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">

  <!-- Full calendar interno -->
  <link rel="stylesheet" href="vista/bower_components/fullcalendar-3.8.2/css/fullcalendar.css">

  <link rel="stylesheet" href="vista/bower_components/fullcalendar-3.8.2/css/bootstrap-clockpicker.css">






  <!-- -------------------------------------------------------------------------- */
  /*                                 PLUGINS JS                                 */
  /* -------------------------------------------------------------------------- */-->
  <!-- jQuery 3 -->
  <script src="vista/bower_components/jquery/dist/jquery.min.js"></script>
  

  <!-- Bootstrap 3.3.7 -->
  <script src="vista/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>




  <!-- AdminLTE App -->
  <script src="vista/dist/js/adminlte.min.js"></script>
  

  <!-- DataTables -->
  <script src="vista/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

  <script src="vista/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

  <script src="vista/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  
  <script src="vista/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>

  <!-- Full calendar externo cdn -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/locales/en.js"></script> -->

  <!-- <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.3.2/main.min.js"></script> -->

  <!-- Full calendar interno -->
  <script src="vista/bower_components/fullcalendar-3.8.2/js/moment.min.js"></script>

  <script src="vista/bower_components/fullcalendar-3.8.2/js/fullcalendar.min.js"></script>

  <script src="vista/bower_components/fullcalendar-3.8.2/js/es.js"></script>

  <script src="vista/bower_components/fullcalendar-3.8.2/js/bootstrap-clockpicker.js"></script>

  <!-- Sweetalert 2 -->
  <script src="vista/plugins/sweetalert2/sweetalert2.all.js"></script>

</head>


<body class="hold-transition skin-blue-light sidebar-collapse sidebar-mini login-page">

<?php

  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){

    if($_SESSION["perfil"] == "Administrador"){

      echo '<div class="wrapper">';

      /* -------------------------------------------------------------------------- */
      /*                                  CABEZOTE                                  */
      /* -------------------------------------------------------------------------- */
      include("modulos/cabezote.php");


      /* -------------------------------------------------------------------------- */
      /*                                MENU LATERAL                                */
      /* -------------------------------------------------------------------------- */
      include("modulos/menu_lateral.php");


      /* -------------------------------------------------------------------------- */
      /*                                  CONTENIDO                                 */
      /* -------------------------------------------------------------------------- */


      if(isset($_GET["ruta"])){

        $ruta = $_GET["ruta"];

        if($ruta == "inicio" 
          || $ruta == "usuarios"
          || $ruta == "calendario"
          || $ruta == "pacientes"
          || $ruta == "pacientes_medico"
          || $ruta == "pacientes_psicologo"
          || $ruta == "pacientes_enfermero"
          || $ruta == "pacientes_auxiliar"
          || $ruta == "incidencias_admin"
          || $ruta == "salir"){
          
          include("modulos/" . $ruta . ".php");

        }else{

            include("modulos/404.php");
        }

      }else{

        include("modulos/inicio.php"); //no se manda ningun $_get por lo tanto es como poner ruta = /

      }
    
  



      /* -------------------------------------------------------------------------- */
      /*                                   FOOTER                                   */
      /* -------------------------------------------------------------------------- */
      include("modulos/pie.php"); 
    
      echo '</div>';

    }else if($_SESSION["perfil"] == "Administrativo"){

      echo '<div class="wrapper">';

      /* -------------------------------------------------------------------------- */
      /*                                  CABEZOTE                                  */
      /* -------------------------------------------------------------------------- */
      include("modulos/cabezote.php");


      /* -------------------------------------------------------------------------- */
      /*                                MENU LATERAL                                */
      /* -------------------------------------------------------------------------- */
      include("modulos/menu_lateral_pacientes.php");


      /* -------------------------------------------------------------------------- */
      /*                                  CONTENIDO                                 */
      /* -------------------------------------------------------------------------- */


      if(isset($_GET["ruta"])){

        $ruta = $_GET["ruta"];

        if($ruta == "inicio" 
          || $ruta == "pacientes"
          || $ruta == "calendario"
          || $ruta == "incidencias"
          || $ruta == "salir"){
          
          include("modulos/" . $ruta . ".php");

        }else{

            include("modulos/404.php");
        }

      }else{

        include("modulos/inicio.php"); //no se manda ningun $_get por lo tanto es como poner ruta = /

      }
    
  
      /* -------------------------------------------------------------------------- */
      /*                                   FOOTER                                   */
      /* -------------------------------------------------------------------------- */
      include("modulos/pie.php"); 
    
      echo '</div>';

    }else if ($_SESSION["perfil"] == "Enfermero"){


      echo '<div class="wrapper">';

      /* -------------------------------------------------------------------------- */
      /*                                  CABEZOTE                                  */
      /* -------------------------------------------------------------------------- */
      include("modulos/cabezote.php");


      /* -------------------------------------------------------------------------- */
      /*                                MENU LATERAL                                */
      /* -------------------------------------------------------------------------- */
      include("modulos/menu_lateral_pacientes.php");


      /* -------------------------------------------------------------------------- */
      /*                                  CONTENIDO                                 */
      /* -------------------------------------------------------------------------- */


      if(isset($_GET["ruta"])){

        $ruta = $_GET["ruta"];

        if($ruta == "inicio" 
          || $ruta == "pacientes_enfermero"
          || $ruta == "calendario"
          || $ruta == "incidencias"
          || $ruta == "salir"){
          
          include("modulos/" . $ruta . ".php");

        }else{

            include("modulos/404.php");
        }

      }else{

        include("modulos/inicio.php"); //no se manda ningun $_get por lo tanto es como poner ruta = /

      }
    
  
      /* -------------------------------------------------------------------------- */
      /*                                   FOOTER                                   */
      /* -------------------------------------------------------------------------- */
      include("modulos/pie.php"); 
    
      echo '</div>';

    }else if ($_SESSION["perfil"] == "Medico"){

      echo '<div class="wrapper">';

      /* -------------------------------------------------------------------------- */
      /*                                  CABEZOTE                                  */
      /* -------------------------------------------------------------------------- */
      include("modulos/cabezote.php");


      /* -------------------------------------------------------------------------- */
      /*                                MENU LATERAL                                */
      /* -------------------------------------------------------------------------- */
      include("modulos/menu_lateral_pacientes.php");


      /* -------------------------------------------------------------------------- */
      /*                                  CONTENIDO                                 */
      /* -------------------------------------------------------------------------- */


      if(isset($_GET["ruta"])){

        $ruta = $_GET["ruta"];

        if($ruta == "inicio" 
          || $ruta == "pacientes_medico"
          || $ruta == "calendario"
          || $ruta == "incidencias"
          || $ruta == "salir"){
          
          include("modulos/" . $ruta . ".php");

        }else{

            include("modulos/404.php");
        }

      }else{

        include("modulos/inicio.php"); //no se manda ningun $_get por lo tanto es como poner ruta = /

      }
    
  
      /* -------------------------------------------------------------------------- */
      /*                                   FOOTER                                   */
      /* -------------------------------------------------------------------------- */
      include("modulos/pie.php"); 
    
      echo '</div>';

    }else if ($_SESSION["perfil"] == "Auxiliar"){

      echo '<div class="wrapper">';

      /* -------------------------------------------------------------------------- */
      /*                                  CABEZOTE                                  */
      /* -------------------------------------------------------------------------- */
      include("modulos/cabezote.php");


      /* -------------------------------------------------------------------------- */
      /*                                MENU LATERAL                                */
      /* -------------------------------------------------------------------------- */
      include("modulos/menu_lateral_pacientes.php");


      /* -------------------------------------------------------------------------- */
      /*                                  CONTENIDO                                 */
      /* -------------------------------------------------------------------------- */


      if(isset($_GET["ruta"])){

        $ruta = $_GET["ruta"];

        if($ruta == "inicio" 
          || $ruta == "pacientes_auxiliar"
          || $ruta == "calendario"
          || $ruta == "incidencias"
          || $ruta == "salir"){
          
          include("modulos/" . $ruta . ".php");

        }else{

            include("modulos/404.php");
        }

      }else{

        include("modulos/inicio.php"); //no se manda ningun $_get por lo tanto es como poner ruta = /

      }
    
  
      /* -------------------------------------------------------------------------- */
      /*                                   FOOTER                                   */
      /* -------------------------------------------------------------------------- */
      include("modulos/pie.php"); 
    
      echo '</div>';

    }else if ($_SESSION["perfil"] == "Psicologo"){

      echo '<div class="wrapper">';

      /* -------------------------------------------------------------------------- */
      /*                                  CABEZOTE                                  */
      /* -------------------------------------------------------------------------- */
      include("modulos/cabezote.php");


      /* -------------------------------------------------------------------------- */
      /*                                MENU LATERAL                                */
      /* -------------------------------------------------------------------------- */
      include("modulos/menu_lateral_pacientes.php");


      /* -------------------------------------------------------------------------- */
      /*                                  CONTENIDO                                 */
      /* -------------------------------------------------------------------------- */

      if(isset($_GET["ruta"])){

        $ruta = $_GET["ruta"];

        if($ruta == "inicio" 
          || $ruta == "pacientes_psicologo"
          || $ruta == "calendario"
          || $ruta == "incidencias"
          || $ruta == "salir"){
          
          include("modulos/" . $ruta . ".php");

        }else{

            include("modulos/404.php");
        }

      }else{

        include("modulos/inicio.php"); //no se manda ningun $_get por lo tanto es como poner ruta = /

      }
    
  
      /* -------------------------------------------------------------------------- */
      /*                                   FOOTER                                   */
      /* -------------------------------------------------------------------------- */
      include("modulos/pie.php"); 
    
      echo '</div>';

    }


  }else{

    include("modulos/login.php");


  }


?>


<!-- Estas son los js personalizados propios -->
<script src="vista/js/plantilla.js"></script>

<script src="vista/js/usuarios.js"></script>

<script src="vista/js/pacientes.js"></script>

<script src="vista/js/pacientes_medico.js"></script>

<script src="vista/js/pacientes_psicologo.js"></script>

<script src="vista/js/historiales.js"></script>

<script src="vista/js/medicamentos.js"></script>

<script src="vista/js/seguimientos.js"></script>

<script src="vista/js/curas.js"></script>

<script src="vista/js/incidencias_admin.js"></script>






</body>
</html>
