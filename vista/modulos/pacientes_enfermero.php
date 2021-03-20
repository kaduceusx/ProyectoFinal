<div class="content-wrapper">
    
  <section class="content-header">

    <h1>
      Administrar Pacientes Del Enfermero
    </h1>

    

  </section>

  
  <section class="content">

    
    <div class="box">

      <div class="box-header with-border">
        
        <button class="btn btn-primary" data-toggle="modal" data-target="#modal_agregarCura">Agregar Cura</button>

        <button class="btn btn-primary" data-toggle="modal" data-target="#modal_verCura">Seguimientos Curas</button>


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



                echo '<td>
                  
                      <div class="btn-group">

                        <button style="margin-right:0px; margin-left:0px" class="btn btn-info btn_editarMedicamento" idMedicamento="'.$value["id"].'" data-toggle="modal" data-target="#modal_editarMedicamento"><i class="fa fa-align-center"></i>Medicamentos Recetados</button>

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
MODAL CREAR CURA
======================================-->

<div id="modal_agregarCura" class="modal fade" role="dialog" >
  
  <div class="modal-dialog modal-lg" >

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Crear Cura</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" >

          <div class="box-body">


            <!-- ENTRADA PARA SELECCIONAR AL PACIENTE -->

            <div class="form-group ">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                  <select class="form-control input-lg" name="nuevoPacienteCura" required>
                  
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

            <div class="form-group col-lg-4" >

              <label for="nuevoFechaCura"> Fecha De La Cura: </label>

              <input type="date" class="form-control input-lg" name="nuevoFechaCura" readonly value="<?php echo date("Y-m-d");?>">
              
            </div>




            <!-- EDITAR PARA CURA  -->

            <div class="form-group col-lg-7" >

              <label for="nuevoCura"> Cura: </label>
              
              <textarea  name="nuevoCura" style="resize: none" class="form-control input-lg sin_negrita" rows="10" cols="10" maxlength="200"placeholder="INGRESE CURAS"></textarea>
   
            </div>


          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="crear_cura">Crear Cura</button>

        </div>

        <?php

          $crearCura = new ControladorCuras();
          $crearCura -> ctr_crearCura();

        ?>

      </form>

    </div>

  </div>

</div>



<!--=====================================
MODAL VER CURA
======================================-->

<div id="modal_verCura" class="modal fade" role="dialog" >
  
  <div class="modal-lg" style="width:100%">

    <div class="modal-content">

      
        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Ver Cura</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" >

         
          <div class="box-body">

            <!--=====================================
              MOSTRAR CURAS
            ======================================-->

           
              <table class="table table-bordered table-striped dt-responsive tabla">

                <thead>
                
                  <tr>
                  
                    <th style="width:10px" >Id</th>
                    <th>Fecha De Cura</th>
                    <th>Paciente</th>
                    <th>Cura</th>
                    <th>Acciones</th>

                  </tr>

                </thead>


                <tbody>


                  <?php

                    $item = null;

                    $valor = null;
                    
                    

                    
                    $curas = ControladorCuras::ctr_mostrarCuras($item, $valor);




                    foreach ($curas as $key2 => $value2) {

                      
                    
                      echo '<tr>

                        <td>' . ($key2+1) .'</td>';


                        $fechaCura = $value2["fechaCura"]; //2020-09-08

                        $extracion_ano =  substr($fechaCura, 0, 4);//2020

                        $extracion_mes =  substr($fechaCura, 4, 4);//-09-

                        $extracion_dia = substr($fechaCura, 8, 2); //08


                        echo '<td>' . $extracion_dia . $extracion_mes . $extracion_ano . '</td>';

                        echo '<td>' . $value2["id_paciente"] . '</td>';

                        echo '<td>' . $value2["cura"] .'</td>';

                      

                        

                      

                        echo '<td>
                          
                              <div class="btn-group">


                              <button class="btn btn-info btn_editarCura" idCura="'.$value2["id"].'" data-toggle="modal" data-target="#modal_editarCura" ><i class="fa fa-pencil"></i>Editar Cura</button>

                              <button  style="margin-left:10px" class="btn btn-success btn_eliminarCura" idCura="'.$value2["id"].'" nombreCura="'.$value2["id_paciente"].'"><i class="fa fa-check"></i>Cura Realizada</button>

                  
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
 </div>

</div>






<!--=====================================
MODAL EDITAR CURA
======================================-->

<div id="modal_editarCura" class="modal fade" role="dialog" >
  
  <div class="modal-lg" style="width:100%">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Seguimiento De Curas</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" >

       
          <div class="box-body">

            <!-- EDITAR EL ID  -->

            <input type="hidden" name="editarId_Seguimiento_cura" id="editarId_Seguimiento_cura" value="" />


            <!-- EDITAR PARA EL NOMBRE SEGUIMIENTO CURA  -->

            <div class="form-group col-lg-6" >

              <label for="editarId_pacienteCura" >Nombre Paciente: </label>
              
              <input type="text" class="form-control input-lg sin_negrita" name="editarId_pacienteCura"  id="editarId_pacienteCura" maxlength="30" value="" readonly>
  
            </div>


            
            <!-- EDITAR PARA FECHA  -->

            <div class="form-group col-lg-6" >

              <label for="editarFechaCura"> Fecha De La Cura: </label>

              <input type="date" class="form-control input-lg" name="editarFechaCura" id="editarFechaCura"readonly value="<?php echo date("Y-m-d");?>">
              
            </div>

           
            <!-- EDITAR PARA CURA  -->

            <div class="form-group col-lg-12" >

              <label for="editarCura"> Cura: </label>
              
              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarCura" id="editarCura" rows="09" cols="10" maxlength="200" value="">
              </textarea>
   
            </div>

           

           

            </div>



          </div>

  
                    
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="modificar_cura">Modificar Seguimiento De Curas</button>

        </div>
        </div>
       
     

        <?php

          $editarCura = new ControladorCuras();
          $editarCura -> ctr_editarCura();

        ?>

      </form>

    </div>

 </div>



</div>



<!--=====================================
MODAL EDITAR MEDICAMENTO
======================================-->

<div id="modal_editarMedicamento" class="modal" role="dialog" >
  
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

              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarDesayuno" id="editarDesayuno" rows="10" cols="10" maxlength="200" value="" readonly>
              </textarea>

            </div>

            
            
            <!-- <div class="form-group col-lg-4" style="position:absolute; top:18%; width:30%;margin-left:1%">

             <p style="font-size:14px; font-weight: bold;">Ha tomado medicamento</p>

            
              <input type="checkbox" id="vehicle1" name="vehicle1" value="Bike">
              <label class="sin_negrita" style="font-size:18px" for="vehicle1">Desayuno</label><br>
              <input class="sin_negrita" type="checkbox" id="vehicle2" name="vehicle2" value="Car">
              <label class="sin_negrita" style="font-size:18px" for="vehicle2">Comida</label><br>
              <input type="checkbox" id="vehicle3" name="vehicle3" value="Boat">
              <label class="sin_negrita" style="font-size:18px" for="vehicle3">Merienda</label><br>
              <input type="checkbox" id="vehicle4" name="vehicle4" value="Boat">
              <label class="sin_negrita" style="font-size:18px" for="vehicle3">Cena</label><br>
              <input type="checkbox" id="vehicle5" name="vehicle5" value="Boat">
              <label class="sin_negrita" style="font-size:18px" for="vehicle3">Noche</label><br>
            
             
  
            </div> -->
     

            <!-- EDITAR PARA COMIDAS  -->

            <div class="form-group col-lg-4" >

              <label for="editarComida"> Comida: </label>
              
              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarComida" id="editarComida" rows="10" cols="10" maxlength="200" value="" readonly>
              </textarea>
   
            </div>



            

           


            <!-- EDITAR PARA MERIENDA  -->

            <div class="form-group col-lg-4" >

              <label for="editarMerienda"> Merienda: </label>
              
              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarMerienda" id="editarMerienda" rows="10" cols="10" maxlength="200" value="" readonly>
              </textarea>
   
            </div>



            <!-- EDITAR PARA CENA  -->

            <div class="form-group col-lg-4" >

              <label for="editarCena"> Cena: </label>
              
              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarCena" id="editarCena" rows="10" cols="10" maxlength="200" value="" readonly>
              </textarea>
   
            </div>



             <!-- EDITAR PARA NOCHE  -->

            <div class="form-group col-lg-4" >

              <label for="editarNoche"> Noche: </label>
              
              <textarea style="resize: none" class="form-control input-lg sin_negrita" name="editarNoche" id="editarNoche" rows="10" cols="10" maxlength="200" value="" readonly>
              </textarea>
   
            </div>



          </div>



        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <!-- <button type="submit" class="btn btn-primary" name="modificar_medicamento_enfermero">Confirmar Medicamentos</button> -->

        </div>

        <?php

          $editarMedicamento = new ControladorMedicamentos();
          $editarMedicamento -> ctr_editarMedicamento();

        ?>

      </form>

    </div>

  </div>

</div>



</div>
    

 

<?php

  $borrarCura = new ControladorCuras();
  $borrarCura -> ctr_borrarCura();


?>