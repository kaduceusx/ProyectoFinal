<div class="content-wrapper">
    
  <section class="content-header">

    <h1>
      Incidencias
    </h1>

    

  </section>

  
  <section class="content">

    
    <div class="box">

    
      <!--=====================================
        MOSTRAR INCIDENCIAS
      ======================================-->

      <div class="box-body">

        

        <table class="table table-bordered table-striped dt-responsive tabla ">

          <thead>
          
            <tr>
            
              <th style="width:10px" >Id</th>
              <th>Fecha Incidencia</th>
              <th>Incidencia</th>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>Usuario</th>
              <th>Perfil</th>
              <th>Email</th>
              <th>Estado Incidencia</th>
              <th>Acciones</th>

            </tr>

          </thead>


          <tbody>


          <?php

            $item = null;

            $valor = null;
            

            $incidencia = ControladorIncidenciasAdmin::ctr_mostrarIncidenciasAdmin($item, $valor);

            foreach ($incidencia as $key => $value) {

              
             
              echo '<tr>

                <td>' . $value["id"] .'</td>';

                $fecha = $value["fechaIncidencia"]; //2020-09-08
                $fechaEU = date("d-m-Y", strtotime($fecha));

                echo '<td>' . $fechaEU . '</td>';

                echo '<td>' . $value["nombreIncidencia"] . '</td>';

                echo '<td>' . $value["id_nombre"] . '</td>';

                echo '<td>' . $value["id_apellidos"] . '</td>';

                echo '<td>' . $value["id_usuario"] . '</td>';

                echo '<td>' . $value["id_perfil"] . '</td>';
                
                echo '<td>' . $value["id_email"] . '</td>';
            


                if($value["estadoIncidencia"] !=0){

                  echo '<td><button class="btn btn-success btn-xs btnActivarIncidencia" idEstadoIncidencia="'.$value["id"].'" estadoIncidencia="0">Relizada</button></td>';


                }else{

                   echo '<td><button class="btn btn-danger btn-xs btnActivarIncidencia" idEstadoIncidencia="'.$value["id"].'" estadoIncidencia="1">Pendiente</button></td>';

                }


    

                echo '<td>
                  
                      <div class="btn-group">

                        <form action="" method="post">

                          <input type="hidden" name="enviarNombre" value="'.$value["id_nombre"].'" >

                          <input type="hidden" name="enviarApellidos" value="'.$value["id_apellidos"].'" >

                          <input type="hidden" name="enviarEmail" value="'.$value["id_email"].'" >

                          <input type="hidden" name="enviarIncidencia" value="'.$value["nombreIncidencia"].'" >

                          <button type="submit" name="enviarCorreo" class="btn btn-info btn_enviarCorreo"><i class="fa fa-pencil"></i>Enviar Correo Informativo</button>

                        </form>
                      </div>

                    </td>';
    
              echo '</tr>';

              $enviarCorreo = new ControladorIncidenciasAdmin();
              $enviarCorreo -> ctr_enviarCorreo();



         
              
            
            }
            


          ?>


          
          
          </tbody>
         
        </table>

        
      </div>

      <form method="post" id="form1"></form>
    

      <button type="submit" form="form1" name="borrarIncidencias" class="btn btn-danger" style="margin:10px">Borrar Incidencias Realizadas</button>
    
    </div>
    

  </section>
 

</div>




<?php

  $borrarIncidencia = new ControladorIncidenciasAdmin();
  $borrarIncidencia -> ctr_borrarIncidenciasAdmin();


?>