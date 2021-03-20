<div class="content-wrapper">
    
  <section class="content-header">

    <h1>
      Administrar usuarios
    </h1>

    

  </section>

  
  <section class="content">

    
    <div class="box">

      <div class="box-header with-border">
        
        <button class="btn btn-primary" data-toggle="modal" data-target="#modal_agregarUsuario">Agregar usuario</button>

      </div>


      <!--=====================================
        MOSTRAR USUARIOS
      ======================================-->

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tabla ">

          <thead>
          
            <tr >
            
             
              <th>Foto</th>
              <th>Nombre</th>
              <th>Apellidos</th>
              <th>Usuario</th>
              <th style="width:5px">DNI</th>
              <th style="width:5px">Email</th>
              <th style="width:5px">Perfil</th>
              <!-- <th>Último login</th> -->
              <th style="width:5px">Fecha nacimiento</th>
              <th>Lugar de residencia</th>
              <th>Estado civil</th>
              <th>Estado</th>
              <th style="width:5px">Acciones</th>

            </tr>

          </thead>


          <tbody>


          <?php

            $item = null;

            $valor = null;

            $usuarios = ControladorUsuarios::ctr_mostrarUsuarios($item, $valor);

            foreach ($usuarios as $key => $value) {

              if ($value["perfil"] == "Administrador"){

                //usuario administrador, no se deberían ver sus datos.
              }else{

                echo '<tr>

                  <!--<td>' . $value["id"] .'</td>-->';
                  
                  

                  if($value["foto"] != ""){

                    echo '<td><img src="'.$value["foto"].'" class="img-thumbnail" width="60px"></td>';

                  }else{

                    echo '<td><img src="vista/img/usuarios/default/anonymous.png" class="img-thumbnail" width="60px"></td>';
                      
                  }
                  
                  

                  echo '<td>' . $value["nombre"] .'</td>

                  <td>' . $value["apellidos"] .'</td>

                  <td>' . $value["usuario"] .'</td>

                  <td>' . $value["dni"] .'</td>

                  <td>' . $value["email"] .'</td>

                  <td>' . $value["perfil"] .'</td>';
      


                  $ultimo_login = $value["ultimo_login"]; 

                  $extracion_anoLogin =  substr($ultimo_login, 0, 4);

                  $extracion_mesLogin =  substr($ultimo_login, 4, 4);

                  $extracion_diaLogin =  substr($ultimo_login, 8, 2);

                  $extracion_horaLogin = substr($ultimo_login, 11 ,18);

                  //echo '<td>' . $extracion_diaLogin . $extracion_mesLogin .  $extracion_anoLogin . "<br>" . $extracion_horaLogin . '</td>'; 



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

                    echo '<td><button class="btn btn-success btn-xs btnActivarUsuario" idUsuario="'.$value["id"].'" estadoUsuario="0">Alta</button></td>';

                  }else{

                    echo '<td><button class="btn btn-danger btn-xs btnActivarUsuario" idUsuario="'.$value["id"].'" estadoUsuario="1">Baja</button></td>';

                  }
                  

                  echo '<td>
                    
                        <div class="btn-group">

                          <button class="btn btn-warning btn_editarUsuario" idUsuario="'.$value["id"].'" data-toggle="modal" data-target="#modal_editarUsuario"><i class="fa fa-pencil"></i></button>

                          <button class="btn btn-danger btn_eliminarUsuario" idUsuario="'.$value["id"].'" fotoUsuario="'.$value["foto"].'" nombreUsuario="'.$value["usuario"].'"><i class="fa fa-times"></i></button>

                        </div>

                      </td>
      
                </tr>';

              }
              
              

            }

          ?>
          
          
          </tbody>
        
        </table>

      </div>
      
    </div>
    

  </section>
 
</div>



<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modal_agregarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" >

          <div class="box-body" style ="width:50%; float:left; border-right:double 1px grey;">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id ="nuevoNombre" name="nuevoNombre" placeholder="Ingrese nombre" maxlength="40" required>

              </div>

            </div>


             <!-- ENTRADA PARA LOS APELLIDOS -->
            
             <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoApellidos" name="nuevoApellidos" placeholder="Ingrese apellidos" maxlength="20" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingrese usuario" id="nuevoUsuario" maxlength="40" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingrese contraseña" maxlength="20" required>

              </div>

            </div>



             <!-- ENTRADA PARA EL DNI -->

             <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-id-card"></i></span> 

                <input type="text" class="form-control input-lg" id="nuevoDni" name="nuevoDni" placeholder="Ingrese dni" maxlength="9" required>

              </div>

            </div>


            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoPerfil">
                  
                  <option value="">Selecionar un perfil</option>

                  <option hidden value="Administrador">Administrador</option>

                  <option value="Administrativo">Administrativo</option>

                  <option value="Medico">Médico</option>

                  <option value="Enfermero">Enfermero</option>

                  <option value="Auxiliar">Auxiliar</option>

                  <option value="Psicologo">Psicólogo</option>

                </select>

              </div>

            </div>

          </div>


        
          <div class="box-body pull-right" style="width:50%;">


            <!-- ENTRADA PARA LOS EMAIL -->

            <div class="form-group" style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope-square"></i></span> 

                <input type="email" class="form-control input-lg" id="nuevoEmail" name="nuevoEmail" placeholder="Ingrese email" maxlength="40" required>

              </div>

            </div>


            <!-- ENTRADA PARA EL FECHA NACIMINETO -->

            <div class="form-group" style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span> 

                <input type="date" class="form-control input-lg" name="nuevoNacimiento" id="nuevoNacimiento">

              </div>

            </div>


            <!-- ENTRADA PARA LA PROVINCIA -->

            <div class="form-group" style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-home"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoProvincia" id="nuevoProvincia" placeholder="Ingrese provicia" maxlength="40" required>

              </div>

            </div>



            <!-- ENTRADA PARA LA LOCALIDAD -->

            <div class="form-group" style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-home"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoLocalidad" id="nuevoLocalidad" placeholder="Ingrese localidad" maxlength="40" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOMICILIO -->

            <div class="form-group" style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-home"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoDomicilio" id="nuevoDomicilio" placeholder="Ingrese domicilio" maxlength="40">

                <!-- <input type="hidden" name="passwordActual" id="passwordActual"> -->

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU ESTADO CIVIL -->

            <div class="form-group " style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span> 

                <select class="form-control input-lg" name="nuevoCivil">
                  
                  <option value="">Selecionar un estado civil</option>

                  <option value="Soltero">Soltero/a</option>

                  <option value="Casado">Casado/a</option>

                  <option value="Divorciado">Divorciado/a</option>

                  <option value="Viudo">Viudo/a</option>


                </select>

              </div>

            </div>

          </div>


          <!-- ENTRADA PARA SUBIR FOTO -->

          <div class="form-group">
                
            <div class="panel">SUBIR FOTO</div>

            <input type="file" class="nuevaFoto" name="nuevaFoto">

            <p class="help-block">Peso máximo de la foto 2MB</p>

            <img src="vista/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="guardar_usuario">Guardar usuario</button>

        </div>

        <?php

          $crearUsuario = new ControladorUsuarios();
          $crearUsuario -> ctr_crearUsuario();

        ?>

      </form>

    </div>

  </div>

</div>





<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modal_editarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body" >

          <div class="box-body" style ="width:50%; float:left; border-right:double 1px grey;">
          
            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

              </div>

            </div>


            <!-- ENTRADA PARA LOS APELLIDOS -->
            
            <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span> 

                <input type="text" class="form-control input-lg" id="editarApellidos" name="editarApellidos" value="" required>

              </div>

            </div>
            

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="editarUsuario" value="" id="editarUsuario" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">

                <input type="hidden" name="passwordActual" id="passwordActual">

              </div>

            </div>


            <!-- ENTRADA PARA EL DNI -->
            
            <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-id-card"></i></span> 

                <input type="text" class="form-control input-lg" id="editarDni" name="editarDni" value="" required>

              </div>

            </div>


            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group " style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="editarPerfil">
                  
                  <option value="" id="editarPerfil"></option>

                  <option hidden value="Administrador">Administrador</option>

                  <option value="Administrativo">Administrativo</option>

                  <option value="Medico">Médico</option>

                  <option value="Enfermero">Enfermero</option>

                  <option value="Auxiliar">Auxiliar</option>

                  <option value="Psicologo">Psicólogo</option>

                </select>

              </div>

            </div>

            

          </div>


          <div class="box-body pull-right" style="width:50%;">

            


            <!-- ENTRADA PARA LOS EMAIL -->
            
            <div class="form-group" style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope-square"></i></span> 

                <input type="email" class="form-control input-lg" id="editarEmail" name="editarEmail" value="" required>

              </div>

            </div>
            

            <!-- ENTRADA PARA EL FECHA NACIMINETO -->

             <div class="form-group" style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span> 

                <input type="date" class="form-control input-lg" name="editarNacimiento" value="" id="editarNacimiento" >
                

              </div>

            </div>



            <!-- ENTRADA PARA LA PROVINCIA -->

            <div class="form-group" style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-home"></i></span> 

                <input type="text" class="form-control input-lg" name="editarProvincia" id="editarProvincia" maxlength="40" required>

              </div>

            </div>



            <!-- ENTRADA PARA LA LOCALIDAD -->

            <div class="form-group" style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-home"></i></span> 

                <input type="text" class="form-control input-lg" name="editarLocalidad" id="editarLocalidad"  maxlength="40" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOMICILIO -->

             <div class="form-group" style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-home"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDomicilio" id="editarDomicilio">

                <!-- <input type="hidden" name="passwordActual" id="passwordActual"> -->

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU ESTADO CIVIL -->

            <div class="form-group " style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-venus-mars"></i></span> 

                <select class="form-control input-lg" name="editarCivil">
                  
                  <option value="" id="editarCivil"></option>

                  <option value="Soltero">Soltero/a</option>

                  <option value="Casado">Casado/a</option>

                  <option value="Divorciado">Divorciado/a</option>

                  <option value="Viudo">Viudo/a</option>

                </select>

              </div>

            </div>
            

            

          </div>

          <!-- ENTRADA PARA SUBIR FOTO -->

          <div class="form-group">
              
            <div class="panel">SUBIR FOTO</div>

            <input type="file" class="nuevaFoto" name="editarFoto">

            <p class="help-block">Peso máximo de la foto 2MB</p>

            <img src="vista/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="150px">

            <input type="hidden" name="fotoActual" id="fotoActual">

          </div>

          

        </div>

        
        <!--=====================================
        PIE DEL MODAL
        ======================================-->
        
        <div class="modal-footer" >

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="modificar_usuario">Modificar usuario</button>

        </div>

        <?php

          $editarUsuario = new ControladorUsuarios();
          $editarUsuario -> ctr_editarUsuario();
          

        ?>

      </form>

    </div>

  </div>

</div>



<?php

  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctr_borrarUsuario();


?>


