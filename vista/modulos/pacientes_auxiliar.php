<div class="content-wrapper">
    
  <section class="content-header">

    <h1>
      Administrar Pacientes Del Auxiliar
    </h1>

    

  </section>

  
  <section class="content">

    
    <div class="box">

      <div class="box-header with-border">
        
        <button class="btn btn-primary" data-toggle="modal" data-target="#modal_agregarSeguimiento">Agregar Seguimiento</button>

        <button class="btn btn-primary" data-toggle="modal" data-target="#modal_verSeguimiento">Seguimientos</button>



      </div>

      
        




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
              <th style="width:5px">DNI</th>
              <th>NUSS</th>
              <th>SIP</th>
              <th style="width:5px">Edad</th>
              <th>Situación</th>
              <th>Género</th>
              <th>Estado</th>
              <th>Ingreso Hospital</th>
              

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


               



                if($value["estado"] !=0){

                  echo '<td> Alta </td>';

                }else{

                  echo '<td> Baja </td>';


                }

                if($value["ingreso_hospital"] !=0){

                  echo '<td> Ingresado </td>';


                }else{

                  echo '<td> No Ingresado </td>';


                }

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
MODAL CREAR SEGUIMIENTO
======================================-->

<div id="modal_agregarSeguimiento" class="modal fade" role="dialog" >
  
  <div class="modal-dialog modal-lg" >

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Crear Seguimiento</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" >

          <!-- Inputs de la parte izquierda  -->
          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR AL PACIENTE -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                  <select class="form-control input-lg" name="nuevoSeguimiento" required>
                  
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




            <!-- EDITAR PARA FECHA  -->

            <div class="form-group col-lg-10" >

              <label for="nuevoFechaSeguimiento"> Fecha De La Seguimiento: </label>

              <input type="date" class="form-control input-lg" name="nuevoFechaSeguimiento" readonly value="<?php echo date("Y-m-d");?>">
              
            </div>


            <!-- EDITAR PARA INGESTA  -->

            <div class="form-group col-lg-4" >

              <label for="nuevoIngesta"> Ingesta: </label>
              
              <textarea  name="nuevoIngesta" style="resize: none" class="form-control input-lg sin_negrita" rows="10" cols="10" maxlength="200"placeholder="INGRESE INGESTA"></textarea>
   
            </div>

           

            <!-- EDITAR PARA MICCION  -->

            <div class="form-group col-lg-4" >

              <label for="nuevoMiccion"> Micción: </label>

                <textarea  name="nuevoMiccion" style="resize: none" class="form-control input-lg sin_negrita" rows="10" cols="10" maxlength="200"placeholder="INGRESE MICCIÓN"></textarea>
   
            </div>



            <!-- EDITAR PARA DEFECACCIÓN  -->

            <div class="form-group col-lg-4" >

              <label for="nuevoDefecacion"> Defecación: </label>

                <textarea  name="nuevoDefecacion" style="resize: none" class="form-control input-lg sin_negrita" rows="10" cols="10" maxlength="200"placeholder="INGRESE DEFECACIÓN"></textarea>
   
            </div>




           
   

          </div>



        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="crear_seguimiento">Crear Seguimiento</button>

        </div>

        <?php

          $crearSeguimiento = new ControladorSeguimientos();
          $crearSeguimiento -> ctr_crearSeguimiento();

        ?>

      </form>

    </div>

  </div>

</div>



<!--=====================================
MODAL VER SEGUIMIENTO
======================================-->

<div id="modal_verSeguimiento" class="modal fade" role="dialog" >
  
  <div class="modal-lg" style="width:100%">

    <div class="modal-content">

      
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ver Seguimiento</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" >

         
          <div class="box-body">

            <!--=====================================
              MOSTRAR SEGUIMIENTOS
            ======================================-->

            <div class="box-body">

              <table class="table table-bordered table-striped dt-responsive tabla">

                <thead>
                
                  <tr>
                  
                    <th style="width:10px" >Id</th>
                    <th>Fecha Seguimiento</th>
                    <th>Paciente</th>
                    <th>Ingesta</th>
                    <th>Micción</th>
                    <th>Defecación</th>
                    <th >Acciones</th>

                  </tr>

                </thead>


                <tbody>


                  <?php

                    $item = null;

                    $valor = null;
                    
                    

                    
                    $seguimientos = ControladorSeguimientos::ctr_mostrarSeguimientos($item, $valor);




                    foreach ($seguimientos as $key2 => $value2) {

                      
                    
                      echo '<tr>

                        <td>' . ($key2+1)  .'</td>';

                        $fechaSeguimiento = $value2["fechaSeguimiento"]; //2020-09-08

                        $extracion_ano =  substr($fechaSeguimiento, 0, 4);//2020

                        $extracion_mes =  substr($fechaSeguimiento, 4, 4);//-09-

                        $extracion_dia = substr($fechaSeguimiento, 8, 2); //08


                        echo '<td>' . $extracion_dia . $extracion_mes . $extracion_ano . '</td>';

                        echo '<td>' . $value2["id_paciente"] . '</td>';

                        echo '<td>' . $value2["ingesta"] .'</td>';

                        echo '<td>' . $value2["miccion"] . '</td>';
                        
                        echo '<td>' . $value2["defecacion"] . '</td>';

                        

                      

                        echo '<td>
                          
                              <div class="btn-group">


                              <button class="btn btn-info btn_editarSeguimiento" idSeguimiento="'.$value2["id"].'" data-toggle="modal" data-target="#modal_editarSeguimiento"><i class="fa fa-pencil"></i>Editar Seguimiento</button>

                  
                              </div>

                            </td>

                      </tr>';

                    
                      
                      

                    }
                    




                  ?>
                
                
                </tbody>

              </table>

       
        </div>


        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        </div>

      

  </div>

</div>






<!--=====================================
MODAL EDITAR SEGUIMIENTO
======================================-->

<div id="modal_editarSeguimiento" class="modal fade" role="dialog" >
  
  <div class="modal-lg" style="width:100%">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Seguimiento</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" >

       
          <div class="box-body">

            <!-- EDITAR EL ID  -->

            <input type="hidden" name="editarId_Seguimiento" id="editarId_Seguimiento" value="" />


            <!-- EDITAR PARA EL NOMBRE SEGUIMIENTO  -->

            <div class="form-group col-lg-12" >

              <label for="editarId_paciente" >Nombre Paciente: </label>
              
              <input type="text" class="form-control input-lg sin_negrita" name="editarId_paciente"  id="editarId_paciente" maxlength="30" value="" readonly>
  
            </div>


            <!-- EDITAR PARA FECHA  -->

            <div class="form-group col-lg-10" >

              <label for="editarFechaSeguimiento"> Fecha Del Seguimiento: </label>

              <input type="date" class="form-control input-lg" name="editarFechaSeguimiento" id="editarFechaSeguimiento"readonly value="<?php echo date("Y-m-d");?>">
              
            </div>
        

           
            
           
            <!-- EDITAR PARA INGESTA  -->

            <div class="form-group col-lg-4" >

              <label for="editarIngesta"> Ingesta: </label>
              
              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarIngesta" id="editarIngesta" rows="10" cols="10" maxlength="200" value="">
              </textarea>
   
            </div>

           

            <!-- EDITAR PARA MICCION  -->

            <div class="form-group col-lg-4" >

              <label for="editarMiccion"> Micción: </label>
              
              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarMiccion" id="editarMiccion" rows="10" cols="10" maxlength="200" value="">
              </textarea>
   
            </div>


            <!-- EDITAR PARA DEFECACION  -->

            <div class="form-group col-lg-4" >

              <label for="editarDefecacion"> Defecación: </label>
              
              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarDefecacion" id="editarDefecacion" rows="10" cols="10" maxlength="200" value="">
              </textarea>
   
            </div>



          </div>



        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="modificar_seguimiento">Modificar Seguimiento</button>

        </div>

        <?php

          $editarSeguimiento = new ControladorSeguimientos();
          $editarSeguimiento -> ctr_editarSeguimiento();

        ?>

      </form>

    </div>

  </div>

</div>
