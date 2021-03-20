<?php
//session_start();

$inactividad = 30600;  //30600 tiempo en segundos, se pondrá 8 horas y media.

  // Comprobar si $_SESSION["timeout"] está establecida
  if(isset($_SESSION["timeout"])){
      // Calcular el tiempo de vida de la sesión (TTL = Time To Live)
      $sessionTTL = time() - $_SESSION["timeout"];
      if($sessionTTL > $inactividad){
        session_destroy();

        //header("Location:salir");
        echo '<script>

                swal({
                    
                  type: "error",
                  title: "Ha expirado el tiempo de sesión.",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar",
                  closeOnConfirm: false

                }).then((result)=>{

                  if(result.value){

                    window.location = "login";

                  }

                });

        </script>';
      }
}
?>
<div class="content-wrapper">
    
  <section class="content-header">

    <h1>
      Bienvenido Usuario <?php echo $_SESSION["nombre"];?><br>
      <small>Buenos días</small>
    </h1>

  
    <?php
    
  
    if($_SESSION["foto"] != ""){

      echo '<img src="'. $_SESSION["foto"].'"  class="user-image" style="height:200px; border-radius:10%; ">';


    }else{

    echo '<img src="vista/img/usuarios/default/anonymous.png" class="user-image">';
    }

    ?>

    
    
    


    

  </section>


  <section class="content">

      <div class="box box-tools">

        <?php

        echo '<h3>Fecha y hora de entrada: </h3>';

        echo '<h4> ' .  "&nbsp&nbsp" . $_SESSION["entradaFecha"] . '</h4>';

        echo '<h4> ' .  "&nbsp&nbsp" . $_SESSION["entradaHora"] . '</h4>';

        ?>

        <br>
        
      </div>

      <div class="box box-tools">

        <?php

        $ultimo_login = $_SESSION["ultimo_login"]; 

        $extracion_anoLogin =  substr($ultimo_login, 0, 4);

        $extracion_mesLogin =  substr($ultimo_login, 4, 4);

        $extracion_diaLogin = substr($ultimo_login, 8, 2);

        $extracion_horaLogin = substr($ultimo_login, 11,14);

        echo '<h3>Último login: </h3>';

        echo '<h4>' . "&nbsp&nbsp Fecha: " . $extracion_diaLogin . $extracion_mesLogin .  $extracion_anoLogin . "<br>&nbsp&nbsp Hora: " . $extracion_horaLogin . '</h4>'; 

        ?>
        <br>

      </div>

      <div class="box box-tools">

        <?php
          if ($_SESSION["estado"] == 1){

            echo "<h3>Estado: </h3>";

            echo '<h4> &nbsp&nbsp Usuario activo actualmente </h4>';

          }else{
            
            echo "<h3>Estado: </h3>";

            echo "<h4>&nbsp&nbsp Usuario inactivo actualmente.</h4>";
          }
        ?>
        <br>
      
      </div>
    
    
  
  </section>

 
  
</div>
