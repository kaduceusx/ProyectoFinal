<div class="content-wrapper">
    
  <section class="content-header">

    <h1>
      Administrar Pacientes Del Médico
    </h1>

    

  </section>

  
  <section class="content">

    
    <div class="box">

      <div class="box-header with-border">
        
        <button class="btn btn-primary" data-toggle="modal" data-target="#modal_agregarHistorial">Agregar Historial</button>

        <button class="btn btn-primary" data-toggle="modal" data-target="#modal_agregarMedicamento">Recetar Medicamento</button>

      </div>


      <!--=====================================
        MOSTRAR PACIENTES
      ======================================-->

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tabla ">

          <thead>
          
            <tr>
            
              <!-- <th style="width:5px" >Id</th> -->
              <th>Foto</th>
              <th>Nombre</th>
              <th style="width:5px">DNI</th>
              <th>NUSS</th>
              <th>SIP</th>
              <th style="width:5px">Edad</th>
              <th>Situación</th>
              <th>Género</th>
              <th>Demencias</th>
              <th>Enfermedades Crónicas</th>
              <th>Alergías</th>
              <th>Suplementos</th>
              <th>Estado</th>
              <th style="width:5px">Ingreso Hospital</th>
              <th >Acciones</th>

            </tr>

          </thead>


          <tbody>


          <?php

            $item = null;

            $valor = null;
            

            $pacientes = ControladorPacientes::ctr_mostrarPacientes($item, $valor);

            //$historiales = ControladorHistoriales::ctr_mostrarHistoriales($item, $valor);

            foreach ($pacientes as $key => $value) {

              
             
              echo '<tr>';

                //echo '<td>' . $value["id"] .'</td>';
                

                if($value["foto"] != ""){

                  echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="60px"></td>';

                }else{

                  echo '<td><img src="vista/img/pacientes/default/anonymous.png" class="img-thumbnail" width="60px"></td>';
                    
                }

                  

                echo '<td>' . $value["paciente"] .'</td>';

                

                echo '<td>' . $value["dni"] .'</td>';


                echo '<td>' . $value["nuss"] .'</td>';

      
                echo '<td>' . $value["sip"] .'</td>';

                $fecha = $value["nacimiento"]; //2020-09-08

                
                $tiempo = strtotime($fecha); //Recupera la edad.
                $ahora = time(); 
                $edad = ($ahora-$tiempo)/(60*60*24*365.25); 
                $edad = floor($edad); 
                
            

                echo '<td>' . $edad.  '</td>'; 




                echo '<td>' .$value["situacion"]. '</td>';

                echo '<td>' .$value["genero"]. '</td>';

                echo '<td>' .$value["demencia"]. '</td>';

                echo '<td>' .$value["cronica"]. '</td>';

                echo '<td>' .$value["alergias"]. '</td>';

                echo '<td>' .$value["suplementos"]. '</td>';



                if($value["estado"] !=0){

                  echo '<td><button class="btn btn-success btn-xs btnActivar" idPaciente="'.$value["id"].'" estadoPaciente="0">Alta</button></td>';

                }else{

                  echo '<td><button class="btn btn-danger btn-xs btnActivar" idPaciente="'.$value["id"].'" estadoPaciente="1">Baja</button></td>';

                }

                if($value["ingreso_hospital"] !=0){

                  echo '<td><button class="btn btn-success btn-xs btnActivar_ingreso" idIngreso="'.$value["id"].'" estadoIngreso="0">Ingresado</button></td>';

                }else{

                  echo '<td><button class="btn btn-danger btn-xs btnActivar_ingreso" idIngreso="'.$value["id"].'" estadoIngreso="1">No Ingresado</button></td>';

                }

                echo '<td>
                  
                      <div class="btn-group">
           
                        <button style="margin-right:10px; margin-left:0px" class="btn btn-info btn_editarHistorial" idHistorial="'.$value["id"].'" data-toggle="modal" data-target="#modal_editarHistorial"><i class="fa fa-align-center"></i>Historial</button>


                        <button style="margin-right:0px; margin-left:0px" class="btn btn-info btn_editarMedicamento" idMedicamento="'.$value["id"].'" data-toggle="modal" data-target="#modal_editarMedicamento"><i class="fa fa-align-center"></i>Medicamentos</button>


                        <button style="margin-left:10px;" class="btn btn-warning btn_editarPaciente" idPaciente="'.$value["id"].'" data-toggle="modal" data-target="#modal_editarPaciente"><i class="fa fa-pencil"></i>Editar</button>

                      </div>

                    </td>
    
              </tr>';

            
              
              

            }
            


        

          ?>
          
          
          </tbody>
        
        </table>

      </div>
      
    </div>
    

  </section>
 
</div>


<!--=====================================
MODAL CREAR HISTORIAL
======================================-->

<div id="modal_agregarHistorial" class="modal fade" role="dialog" >
  
  <div class="modal-dialog modal-lg" >

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Crear Historial</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" >

          <!-- Inputs de la parte izquierda  -->
          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR AL PACIENTE -->

            <div class="form-group ">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                  <select class="form-control input-lg" name="nuevoHistorial" required>
                  
                    <option value="">Selecionar Paciente</option>

                    <?php

                      $item = null;

                      $valor = null;

                      $pacientes= ControladorPacientes::ctr_mostrarPacientes($item, $valor);

                      
                      foreach ($pacientes as $key => $value) {

                        echo '<option value="'.$value["paciente"].'"> '.$value["paciente"].'</option>';  
                      
                      }
                    ?>

                  </select>

              </div>

            </div>


            <!-- EDITAR PARA CIRUGIAS  -->

            <div class="form-group col-lg-4" >

              <label for="nuevoCirugias"> Cirugías: </label>
              
              <textarea  name="nuevoCirugias" style="resize: none" class="form-control input-lg sin_negrita" rows="10" cols="10" maxlength="200"placeholder="INGRESE CIRUGÍAS"></textarea>
   
            </div>

           

            <!-- EDITAR PARA RESONANCIAS  -->

            <div class="form-group col-lg-4" >

              <label for="nuevoResonancias"> Resonancias: </label>

                <textarea  name="nuevoResonancias" style="resize: none" class="form-control input-lg sin_negrita" rows="10" cols="10" maxlength="200"placeholder="INGRESE RESONANCIAS"></textarea>
   
            </div>




           
   

          </div>



        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="crear_historial">Crear Historial</button>

        </div>

        <?php

          $crearHistorial = new ControladorHistoriales();
          $crearHistorial -> ctr_crearHistorial();

        ?>

      </form>

    </div>

  </div>

</div>



<!--=====================================
MODAL CREAR MEDICAMENTO
======================================-->

<div id="modal_agregarMedicamento" class="modal fade" role="dialog" >
  
  <div class="modal-dialog" style="width:100%; margin:auto; margin-left:-10px" >

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Recetar Medicamento</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" >

          
          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR AL MEDICAMENTO -->

            <div class="form-group ">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                  <select class="form-control input-lg" name="nuevoMedicamento" required>
                  
                    <option value="">Selecionar Paciente</option>

                    <?php

                      $item = null;

                      $valor = null;

                      $pacientes= ControladorPacientes::ctr_mostrarPacientes($item, $valor);

                      
                      foreach ($pacientes as $key => $value) {

                        echo '<option value="'.$value["paciente"].'"> '.$value["paciente"].'</option>';  
                      
                      }
                    ?>

                  </select>

              </div>

            </div>


            <!-- EDITAR PARA DESAYUNO  -->

            <div class="form-group col-lg-4" >

              <label for="nuevoDesayuno"> Para El Desayuno: </label>
              
              <textarea  name="nuevoDesayuno" style="resize: none" class="form-control input-lg sin_negrita" rows="10" cols="10" maxlength="200"placeholder="INGRESE MEDICAMENTOS PARA EL DESAYUNO"></textarea>
   
            </div>

           

            <!-- EDITAR PARA COMIDA  -->

            <div class="form-group col-lg-4" >

              <label for="nuevoComida"> Para La Comida: </label>

                <textarea  name="nuevoComida" style="resize: none" class="form-control input-lg sin_negrita" rows="10" cols="10" maxlength="200"placeholder="INGRESE MEDICAMENTOS PARA LA COMIDA"></textarea>
   
            </div>



            <!-- EDITAR PARA MERIENDA  -->

            <div class="form-group col-lg-4" >

              <label for="nuevoMerienda"> Para La Merienda: </label>

                <textarea  name="nuevoMerienda" style="resize: none" class="form-control input-lg sin_negrita" rows="10" cols="10" maxlength="200"placeholder="INGRESE MEDICAMENTOS PARA LA MERIENDA"></textarea>
   
            </div>


            <!-- EDITAR PARA CENA  -->

            <div class="form-group col-lg-4" >

              <label for="nuevoCena"> Para La Cena: </label>

                <textarea  name="nuevoCena" style="resize: none" class="form-control input-lg sin_negrita" rows="10" cols="10" maxlength="200"placeholder="INGRESE MEDICAMENTOS PARA LA CENA"></textarea>
   
            </div>



            <!-- EDITAR PARA NOCHE  -->

            <div class="form-group col-lg-4" >

              <label for="nuevoNoche"> Para La Noche: </label>

                <textarea  name="nuevoNoche" style="resize: none" class="form-control input-lg sin_negrita" rows="10" cols="10" maxlength="200"placeholder="INGRESE MEDICAMENTOS PARA LA NOCHE"></textarea>
   
            </div>



          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="crear_medicamento">Recetar  Medicamento</button>

        </div>

        <?php

          $crearMedicamento = new ControladorMedicamentos();
          $crearMedicamento -> ctr_crearMedicamento();

        ?>

      </form>

    </div>

  </div>

</div>



<!--=====================================
MODAL EDITAR HISTORIAL
======================================-->

<div id="modal_editarHistorial" class="modal fade" role="dialog" >
  
  <div class="modal-lg" style="width:100%">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Historial</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" >

          <!-- Inputs de la parte izquierda  -->
          <div class="box-body">

            <!-- EDITAR EL ID  -->

            <input type="hidden" name="editarId_historial" id="editarId_historial" value="" />


            <!-- EDITAR PARA EL NOMBRE HISTORIAL  -->

            <div class="form-group col-lg-3" >

              <label for="editarId_paciente" > Historial Del Paciente: </label>
              
              <input type="text" class="form-control input-lg sin_negrita" name="editarId_paciente"  id="editarId_paciente" maxlength="30" value="" readonly>
  
            </div>
            
           
            <!-- EDITAR PARA CIRUGIAS  -->

            <div class="form-group col-lg-4" >

              <label for="editarCirugias"> Cirugias: </label>
              
              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarCirugias" id="editarCirugias" rows="10" cols="10" maxlength="200" value="">
              </textarea>
   
            </div>

           

            <!-- EDITAR PARA RESONANCIAS  -->

            <div class="form-group col-lg-4" >

              <label for="editarResonancias"> Resonancias: </label>
              
              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarResonancias" id="editarResonancias" rows="10" cols="10" maxlength="200" value="">
                </textarea>
   
            </div>



          </div>



        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="modificar_historial">Modificar Historial</button>

        </div>

        <?php

          $editarHistorial = new ControladorHistoriales();
          $editarHistorial -> ctr_editarHistorial();

        ?>

      </form>

    </div>

  </div>

</div>




<!--=====================================
MODAL EDITAR MEDICAMENTO
======================================-->

<div id="modal_editarMedicamento" class="modal fade" role="dialog" >
  
  <div class="modal-lg" style="width:100%">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Medicamentos</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" >

         
          <div class="box-body">

            <!-- EDITAR EL ID  -->

            <input type="hidden" name="editarId_medicamento" id="editarId_medicamento" value="" />


            <!-- EDITAR PARA EL NOMBRE PACIENTE  -->

            <div class="form-group col-lg-4" >

              <label for="editarId_paciente_medicamento" > Medicamentos Del Paciente: </label>
              
              <input type="text" class="form-control input-lg sin_negrita" name="editarId_paciente_medicamento"  id="editarId_paciente_medicamento" maxlength="30" value="" readonly>
  
            </div>
            
           
            <!-- EDITAR PARA DESAYUNO  -->

            <div class="form-group col-lg-4" >

              <label for="editarDesayuno"> Desayuno: </label>
              
              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarDesayuno" id="editarDesayuno" rows="10" cols="10" maxlength="200" value="">
              </textarea>
   
            </div>

           

            <!-- EDITAR PARA COMIDAS  -->

            <div class="form-group col-lg-4" >

              <label for="editarComida"> Comida: </label>
              
              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarComida" id="editarComida" rows="10" cols="10" maxlength="200" value="">
              </textarea>
   
            </div>


            <!-- EDITAR PARA MERIENDA  -->

            <div class="form-group col-lg-4" >

              <label for="editarMerienda"> Merienda: </label>
              
              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarMerienda" id="editarMerienda" rows="10" cols="10" maxlength="200" value="">
              </textarea>
   
            </div>



            <!-- EDITAR PARA CENA  -->

            <div class="form-group col-lg-4" >

              <label for="editarCena"> Cena: </label>
              
              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarCena" id="editarCena" rows="10" cols="10" maxlength="200" value="">
              </textarea>
   
            </div>



             <!-- EDITAR PARA NOCHE  -->

            <div class="form-group col-lg-4" >

              <label for="editarNoche"> Noche: </label>
              
              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarNoche" id="editarNoche" rows="10" cols="10" maxlength="200" value="">
              </textarea>
   
            </div>



          </div>



        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="modificar_medicamento">Modificar Medicamentos</button>

        </div>

        <?php

          $editarMedicamento = new ControladorMedicamentos();
          $editarMedicamento -> ctr_editarMedicamento();

        ?>

      </form>

    </div>

  </div>

</div>





<!--=====================================
MODAL EDITAR PACIENTE
======================================-->

<div id="modal_editarPaciente" class="modal fade" role="dialog" >
  
  <div class="modal-lg" style="width:100%">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar paciente</h4>

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


           

         


            <!-- EDITAR PARA EL TIPO DE DEMENCIA  -->

            <div class="form-group col-lg-4" >

              <label for="editarDemencia"> Demencias: </label>
              
              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarDemencia" id="editarDemencia" rows="10" cols="10" maxlength="200" value="">
                </textarea>
   
            </div>


            <!-- ENTRADA PARA AGREGAR ENFERMEDAD CRÓNICA -->

            <div class="form-group col-lg-4">
              
            
              <label for="editarDemencia"> Enfermedades crónicas: </label> 
                
              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarCronica" id="editarCronica" rows="10" cols="10" maxlength="200" value="">
              </textarea>

            

            </div>

            
            
            <div class="form-group col-lg-3">
            
              <label for="editarSituacion" > Situación: </label>

              <select class="form-control input-lg sin_negrita" name="editarSituacion">
                    
                <option value="" id="editarSituacion"></option>

                <option value="Dependiente">Dependiente</option>

                <option value="Independiente">Independiente</option>

              </select>
            </div>


            <!-- EDITAR PARA EL TIPO DE ALERGIAS  -->

            <div class="form-group col-lg-4" >

              <label for="editarAlergias"> Alergias: </label>

              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarAlergias" id="editarAlergias" rows="10" cols="10" maxlength="200" value="">
              </textarea>

            </div>


            <!-- EDITAR PARA EL TIPO DE SUPLEMENTOS  -->

            <div class="form-group col-lg-4" >

              <label for="editarSuplementos"> Suplementos adicionales: </label>

              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarSuplementos" id="editarSuplementos" rows="10" cols="10" maxlength="200" value="">
              </textarea>

            </div>



            

         
           


          </div>


          <!-- ENTRADA PARA SUBIR FOTO -->

          

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="modificar_paciente_medico">Modificar paciente</button>

        </div>

        <?php

          $editarPaciente = new ControladorHistoriales();
          $editarPaciente -> ctr_editarPaciente_medico();

        ?>

      </form>

    </div>

  </div>

</div>



<?php

  $borrarPaciente = new ControladorPacientes();
  $borrarPaciente -> ctr_borrarPaciente();


?>


