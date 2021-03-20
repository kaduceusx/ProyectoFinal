<div class="content-wrapper">
    
  <section class="content-header">

    <h1>
      Administrar Pacientes Del Psicólogo
    </h1>

    

  </section>

  
  <section class="content">

    
    <div class="box">



      <!--=====================================
        MOSTRAR PACIENTES
      ======================================-->

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tabla ">

          <thead>
          
            <tr>
            
              <th style="width:10px" >Id</th>
              <th>Foto</th>
              <th>Nombre</th>
              <th style="width:5px">Edad</th>
              <th>Situación</th>
              <th>Estado</th>
              <th>Ingreso Hospital</th>
              <th >Escala De Barthel</th>
              <th >Indice De Lawton Y Brody</th>
              <th >Test Dibujo Del Reloj De Shulman</th>
              <th >Escala Depresion Geriatrica De Yesavage</th>
              <th>Acciones</th>

            </tr>

          </thead>


          <tbody>


          <?php

            $item = null;

            $valor = null;
            

            $pacientes = ControladorPacientes::ctr_mostrarPacientes($item, $valor);

            foreach ($pacientes as $key => $value) {

              
             
              echo '<tr>

                <td>' . ($key+1) .'</td>';
                

                if($value["foto"] != ""){

                  echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="60px"></td>';

                }else{

                  echo '<td><img src="vista/img/pacientes/default/anonymous.png" class="img-thumbnail" width="60px"></td>';
                    
                }

                  

                echo '<td>' . $value["paciente"] .'</td>';

                $fecha = $value["nacimiento"]; //2020-09-08

                
                $tiempo = strtotime($fecha); //Recupera la edad.
                $ahora = time(); 
                $edad = ($ahora-$tiempo)/(60*60*24*365.25); 
                $edad = floor($edad); 
                
            

                echo '<td>' . $edad.  '</td>'; 

                echo '<td>' .$value["situacion"]. '</td>';

                //echo '<td>' .$value["genero"]. '</td>';


                if($value["estado"] !=0){

                  echo '<td>Alta</td>';


                }else{

                  echo '<td>Baja</td>';

                }


                if($value["ingreso_hospital"] !=0){

                  echo '<td>Ingresado</td>';


                }else{

                  echo '<td>No Ingresado</td>';

                }


                if($value["escala_barthel"] !=0){

                  echo '<td><button class="btn btn-success btn-xs btnActivarEscala_barthel" idEscala_barthel="'.$value["id"].'" estadoEscala_barthel="0">Hecho</button></td>';
                  


                }else{

                  echo '<td><button class="btn btn-danger btn-xs btnActivarEscala_barthel" idEscala_barthel="'.$value["id"].'" estadoEscala_barthel="1">No Hecho</button></td>';
                

                }


                if($value["indice_lawton_brody"] !=0){

                  echo '<td><button class="btn btn-success btn-xs btnActivarIndice_lawton_brody" idIndice_lawton_brody="'.$value["id"].'" estadoIndice_lawton_brody="0">Hecho</button></td>';
                  

                }else{

                  echo '<td><button class="btn btn-danger btn-xs btnActivarIndice_lawton_brody" idIndice_lawton_brody="'.$value["id"].'" estadoIndice_lawton_brody="1">No Hecho</button></td>';
                

                }


                if($value["test_reloj_shulman"] !=0){

                  echo '<td><button class="btn btn-success btn-xs btnActivarTest_reloj_shulman" idTest_reloj_shulman="'.$value["id"].'" estadoTest_reloj_shulman="0">Hecho</button></td>';


                }else{

                  echo '<td><button class="btn btn-danger btn-xs btnActivarTest_reloj_shulman" idTest_reloj_shulman="'.$value["id"].'" estadoTest_reloj_shulman="1">No Hecho</button></td>';

                }


                if($value["escala_depresion_yesavage"] !=0){

                  echo '<td><button class="btn btn-success btn-xs btnActivarEscala_depresion_yesavage" idEscala_depresion_yesavage="'.$value["id"].'" estadoEscala_depresion_yesavage="0">Hecho</button></td>';


                }else{

                  echo '<td><button class="btn btn-danger btn-xs btnActivarEscala_depresion_yesavage" idEscala_depresion_yesavage="'.$value["id"].'" estadoEscala_depresion_yesavage="1">No Hecho</button></td>';

                }

                echo '<td>
                  
                      <div class="btn-group">


                       <button class="btn btn-warning btn_editarPaciente" idPaciente="'.$value["id"].'" data-toggle="modal" data-target="#modal_editarPaciente"><i class="fa fa-pencil"></i>Editar Situación</button>

                      </div>

                    </td>';
    
              echo '</tr>';

 
            }
            


          ?>
          
          
          </tbody>
        
        </table>

      </div>
      
    </div>
    

  </section>
 
</div>




<!--=====================================
MODAL EDITAR PACIENTE
======================================-->

<div id="modal_editarPaciente" class="modal fade" role="dialog" >
  
  <div class="modal-lg modal-dialog" >

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Paciente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" >

          <!-- Inputs de la parte izquierda  -->
          <div class="box-body">

            <!-- EDITAR EL ID  -->

            <input type="hidden" name="editarId" id="editarId" value="">


           
            <!-- EDITAR PARA EL PACIENTE  -->

            <div class="form-group col-lg-3" >

              <label for="editarPaciente" > Nombre: </label>
              
              <input type="text" class="form-control input-lg sin_negrita" name="editarPaciente"  id="editarPaciente" maxlength="30" value="" readonly>
  
            </div>



            <!-- ENTRADA PARA EDITAR LA SITUACIÓN -->

        
            <div class="form-group col-lg-3">
            
              <label for="editarSituacion" > Situación: </label>

              <select class="form-control input-lg sin_negrita" name="editarSituacion">
                    
                <option value="" id="editarSituacion"></option>

                <option value="Dependiente">Dependiente</option>

                <option value="Independiente">Independiente</option>

              </select>
            </div>

    
          </div>
                  

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="modificar_paciente_psicologo">Modificar Paciente</button>

        </div>

        <?php

          $editarPaciente = new ControladorHistoriales();
          $editarPaciente -> ctr_editarPaciente_medico();

        ?>

      </form>

    </div>

  </div>

</div>





