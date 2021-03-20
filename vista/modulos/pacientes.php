<div class="content-wrapper">
    
  <section class="content-header">

    <h1>
      Administrar Pacientes
    </h1>

    

  </section>

  
  <section class="content">

    
    <div class="box">

      <div class="box-header with-border">
        
        <button class="btn btn-primary" data-toggle="modal" data-target="#modal_agregarPaciente">Agregar Paciente</button>

      </div>


      <!--=====================================
        MOSTRAR PACIENTES
      ======================================-->

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tabla ">

          <thead>
          
            <tr>
            
              <th style="width:5px" >Id</th>
              <th>Foto</th>
              <th>Nombre</th>
              <th style="width:5px">DNI</th>
              <th style="width:5px">SIP</th>
              <th style="width:5px">NUSS</th>
              <th style="width:10px">Fecha Nacimiento</th>
              <th>Lugar De Residencia</th>
              <th  style="width:5px">Estado civil</th>
              <th  style="width:5px">Estado</th>
              <th style="width:10px">Tipo Ingreso</th>
              <th  style="width:100%">Acciones</th>

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

                echo '<td>' . $value["sip"] .'</td>';

                echo '<td>' . $value["nuss"] .'</td>';
    


                //el date format me falla, cambio el formato desde aqui.

                $fecha = $value["nacimiento"]; //2020-09-08

                $extracion_ano =  substr($fecha, 0, 4);//2020

                $extracion_mes =  substr($fecha, 4, 4);//-09-

                $extracion_dia = substr($fecha, 8, 2); //08

                echo '<td>' .$extracion_dia . $extracion_mes  . $extracion_ano .  '</td>'; 


                echo '<td>' . "<b>Provincia: </b>" . $value["provincia"]. "<br>" .
                "<b>Localidad: </b>" . $value["localidad"] . "<br><br>" .
                "<b>Domicilio: </b>" . $value["domicilio"] .
                '</td>';

                echo '<td>' .$value["civil"]. '</td>';

                if($value["estado"] !=0){

                  echo '<td>Alta</td>';

                }else{

                  echo '<td>Baja</td>';

                }

                echo '<td>' .$value["ingreso"]. '</td>';

               
                

                echo '<td>
                  
                      <div class="btn-group">

                        <button  class="btn btn-warning btn_editarPaciente" idPaciente="'.$value["id"].'" data-toggle="modal" data-target="#modal_editarPaciente"><i class="fa fa-pencil"></i>Editar</button>

                        <button style="margin-left:10px;" class="btn btn-danger btn_eliminarPaciente" idPaciente="'.$value["id"].'" fotoPaciente="'.$value["foto"].'" nombrePaciente="'.$value["paciente"].'"><i class="fa fa-times"></i>Eliminar</button>

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
MODAL AGREGAR PACIENTE
======================================-->

<div id="modal_agregarPaciente" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Paciente</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" >

          <div class="box-body" style ="width:50%; float:left; border-right:double 1px grey;">

            <!-- ENTRADA PARA EL PACIENTE -->

            <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoPaciente" placeholder="*Ingrese Nombre" id="nuevoPaciente" maxlength="40" required>

              </div>

            </div>


           
            
             <!-- ENTRADA PARA EL SIP -->

             <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-id-card-o"></i></span> 

                <input type="number" class="form-control input-lg" id="nuevoSip" name="nuevoSip" placeholder="*Ingrese Sip" maxlength="9" required>

              </div>

            </div>


            <!-- ENTRADA PARA EL DNI -->

            <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-id-card"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoDni" name="nuevoDni" placeholder="*Ingrese Dni" maxlength="9" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL N. SOCIAL -->

            <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-id-card"></i></span> 

                <input type="number" class="form-control input-lg" id="nuevoNuss" name="nuevoNuss" placeholder="*Ingrese Nº seguridad social" maxlength="9" required>

              </div>

            </div>


            <!-- ENTRADA PARA LA NUMERO DEL FAMILIAR -->

            <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-phone"></i></span> 

                <input type="number" class="form-control input-lg" id="nuevoFamiliar" name="nuevoFamiliar" placeholder="*Ingrese Número Familiar Más Cercano" maxlength="9" required>

              </div>

            </div>




          </div>


        
          <div class="box-body pull-right" style="width:50%;">


            


            <!-- ENTRADA PARA EL FECHA NACIMINETO -->

            <div class="form-group" style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevoNacimiento" id="nuevoNacimiento" required>

              </div>

            </div>


            <!-- ENTRADA PARA LA PROVINCIA -->

            <div class="form-group" style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-home"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoProvincia" id="nuevoProvincia" placeholder="Ingrese Provicia" maxlength="40">

              </div>

            </div>



            <!-- ENTRADA PARA LA LOCALIDAD -->

            <div class="form-group" style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-home"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoLocalidad" id="nuevoLocalidad" placeholder="Ingrese Localidad" maxlength="40">

              </div>

            </div>

            <!-- ENTRADA PARA EL DOMICILIO -->

            <div class="form-group" style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-home"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoDomicilio" id="nuevoDomicilio" placeholder="Ingrese Domicilio" maxlength="40">


              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU ESTADO CIVIL -->

            <div class="form-group " style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span> 

                <select class="form-control input-lg" name="nuevoCivil">
                  
                  <option value="">Selecionar Estado Civil</option>

                  <option value="Soltero">Soltero/a</option>

                  <option value="Casado">Casado/a</option>

                  <option value="Divorciado">Divorciado/a</option>

                  <option value="Viudo">Viudo/a</option>

                </select>

              </div>

            </div>


            <!-- ENTRADA PARA SELECCIONAR SU GÉNERO -->

            <div class="form-group " style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-intersex"></i></span> 

                <select class="form-control input-lg" name="nuevoGenero">
                  
                  <option value="">Seleciona Género</option>

                  <option value="Masculino">Masculino</option>

                  <option value="Femenino">Femenino</option>

                </select>

              </div>

            </div>


            
            <!-- ENTRADA PARA SELECCIONAR SU INGRESO -->

            <div class="form-group " style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-hospital-o"></i></span> 

                <select class="form-control input-lg" name="nuevoIngreso">
                  
                  <option value="">Seleciona Tipo De Ingreso</option>

                  <option value="Voluntario">Voluntario</option>

                  <option value="Involuntario">Involuntario</option>

                </select>

              </div>

            </div>








          </div>


          <!-- ENTRADA PARA SUBIR FOTO -->

          <div class="form-group">
                
            <div class="panel">SUBIR FOTO</div>

            <input type="file" class="nuevaFoto" name="nuevaFoto">

            <p class="help-block">Peso máximo de la foto 2MB</p>

            <img src="vista/img/pacientes/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="guardar_paciente">Guardar Paciente</button>

        </div>

        <?php

          $crearPaciente = new ControladorPacientes();
          $crearPaciente -> ctr_crearPaciente();

        ?>

      </form>

    </div>

  </div>

</div>





<!--=====================================
MODAL EDITAR PACIENTE
======================================-->

<div id="modal_editarPaciente" class="modal fade" role="dialog" >
  
  <div class="modal-lg" style="width:100%; margin-left:-0.8%">

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
          <div class="box-body" style ="width:50%; float:left;">

            <!-- EDITAR EL ID  -->

            <input type="hidden" name="editarId" id="editarId" value="">

            

            <!-- EDITAR PARA EL PACIENTE -->

            <div class="form-group">
              
              <label for="editarPaciente" style="width:80%;">
              
                <span style="margin-right:5px" ><i class="fa fa-user-o"></i></span>

                Nombre: 

                <input type="text" class="form-control input-lg sin_negrita" name="editarPaciente"  id="editarPaciente" maxlength="30" value="">
                  
              </label>

            </div>


         

          

            <!-- ENTRADA PARA EL SIP -->

            <div class="form-group" >

              <label for="editarSip" style="width:80%;">

                <span style="margin-right:5px"><i class="fa fa-id-card-o"></i></span>
            
                SIP:

                <input type="number" class="form-control input-lg sin_negrita" id="editarSip" name="editarSip" maxlength="9" value="">

              </label>
         
            </div>


            <!-- ENTRADA PARA EL DNI -->

            <div class="form-group" >
              
              <label for="editarDni" style="width:80%;">

                <span style="margin-right:5px"><i class="fa fa-id-card"></i></span> 

                DNI:

                <input type="text" class="form-control input-lg sin_negrita" id="editarDni" name="editarDni" maxlength="9" value="">

              </label>
              
            </div>


            <!-- ENTRADA PARA EL N. SOCIAL -->

            <div class="form-group" >
              
              <label for="editarNuss" style="width:80%;">
            
                <span style="margin-right:5px"><i class="fa fa-id-card"></i></span> 

                Nº Seguridad Social (NUSS):

                <input type="number" class="form-control input-lg sin_negrita" id="editarNuss" name="editarNuss" maxlength="9" value="">

              </label>
        
            </div>


            <!-- ENTRADA PARA LA NUMERO DEL FAMILIAR -->

            <div class="form-group">
              
              <label for="editarFamiliar" style="width:80%;">
            
                <span style="margin-right:5px"><i class="fa fa-phone"></i></span>
                
                Teléfono Del Familiar:

                <input type="number" class="form-control input-lg sin_negrita" id="editarFamiliar" name="editarFamiliar" maxlength="9" value="">

              </label>
              
            </div>



            <!-- ENTRADA PARA EL FECHA NACIMINETO -->

            <div class="form-group">
              
              <label for="editarNacimiento" style="width:80%;">
            
                <span style="margin-right:5px"><i class="fa fa-birthday-cake"></i></span>
                
                Fecha De Nacimiento:

                <input type="date" class="form-control input-lg sin_negrita" name="editarNacimiento"  id="editarNacimiento" value="" >

              </label>
       
            </div>




          </div>


          <!-- Inputs de la parte derecha  -->
          <div class="box-body pull-right" style="width:50%;">



            <!-- ENTRADA PARA LA PROVINCIA -->

            <div class="form-group">
              
              <label for="editarProvincia" style="width:80%;">
            
                <span style="margin-right:5px"><i class="fa fa-home"></i></span> 

                Provincia:

                <input type="text" class="form-control input-lg sin_negrita" name="editarProvincia" id="editarProvincia" maxlength="40" value="">

              </label>
       
            </div>


            <!-- ENTRADA PARA LA LOCALIDAD -->

            <div class="form-group" >
              
              <label for="editarLocalidad" style="width:80%;">

                <span style="margin-right:5px"><i class="fa fa-home"></i></span> 

                Localidad:

                <input type="text" class="form-control input-lg sin_negrita" name="editarLocalidad" id="editarLocalidad" maxlength="40" value="">
            
              </label>
          
            </div>


            <!-- ENTRADA PARA EL DOMICILIO -->

            <div class="form-group" >
              
              <label for="editarDomicilio" style="width:80%">

                <span style="margin-right:5px"><i class="fa fa-home"></i></span> 

                Domicilio:

                <input type="text" class="form-control input-lg sin_negrita" name="editarDomicilio" id="editarDomicilio" maxlength="40" value="">
            
              </label>
       
            </div>


            <!-- ENTRADA PARA SELECCIONAR SU ESTADO CIVIL -->

            <div class="form-group">
              
              <label for="editarCivil" style="width:80%;">

                <span style="margin-right:5px"><i class="fa fa-venus-mars"></i></span> 

                Estado Civil:

                <select class="form-control input-lg sin_negrita" name="editarCivil">
                  
                  <option value="" id="editarCivil"></option>

                  <option value="Soltero">Soltero/a</option>

                  <option value="Casado">Casado/a</option>

                  <option value="Divorciado">Divorciado/a</option>

                  <option value="Viudo">Viudo/a</option>

                </select>
            
              </label>
              
            </div>


            <!-- ENTRADA PARA SELECCIONAR SU GÉNERO -->

            <div class="form-group">
              
              <label for="editarGenero" style="width:80%;">

                <span style="margin-right:5px"><i class="fa fa-male"></i></span> 

                Género:

                <select class="form-control input-lg sin_negrita" name="editarGenero">
                  
                <option value="" id="editarGenero"></option>

                  <option value="Masculino">Masculino</option>

                  <option value="Femenino">Femenino</option>

                </select>
                              
              </label>
              
            </div>


            
            <!-- ENTRADA PARA SELECCIONAR SU INGRESO -->

            <div class="form-group">
              
              <label for="editarIngreso" style="width:80%;">
            
                <span style="margin-right:5px"><i class="fa fa-hospital-o"></i></span> 

                Tipo De Ingreso:

                <select class="form-control input-lg sin_negrita" name="editarIngreso">
                  
                <option value="" id="editarIngreso"></option>

                  <option value="Voluntario">Voluntario</option>

                  <option value="Involuntario">Involuntario</option>

                </select>

              </label>
       
            </div>


          </div>


          <!-- ENTRADA PARA SUBIR FOTO -->

          <div class="form-group">
               
          
            <label for="editarFoto" style="width:90%; border-top:2px solid #3c8dbc; border-bottom:2px solid #3c8dbc;  padding:10px">
 
              Subir Foto:
              <p class="help-block">Peso máximo de la foto 2MB</p>

              <input type="file" class="editarFoto sin_negrita" name="editarFoto" id="editarFoto"> 

              <img src="vista/img/pacientes/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="fotoActual" id="fotoActual">

            </label>

          

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="modificar_paciente">Modificar paciente</button>

        </div>

        <?php

          $editarPaciente = new ControladorPacientes();
          $editarPaciente -> ctr_editarPaciente();

        ?>

      </form>

    </div>

  </div>

</div>



<?php

  $borrarPaciente = new ControladorPacientes();
  $borrarPaciente -> ctr_borrarPaciente();


?>


