<div class="content-wrapper" >
    
  <section class="content-header">

    <h1>
      Crear Incidencia
    </h1>

    

  </section>

  
  <section class="content" >

    
    <div class="box" >

    
      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title" >Crear Incidencia</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body" style ="width:50%; float:left; border-right:double 1px grey;">



            <!-- ENTRADA OCULTA PARA EL ID -->

            <input type="hidden" class="form-control input-lg" name="nuevoId"  value="<?php echo $_SESSION["id"];?>"  readonly>


            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <label for="nuevoNombre">Nombre:</label>

                <input type="text" class="form-control input-lg" name="nuevoNombre" id="nuevoNombre"  value="<?php echo $_SESSION["nombre"];?>" onkeydown="return false" readonly>

              </div>

            </div>


           <!-- ENTRADA PARA LOS APELLIDOS -->
            
           <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user-circle"></i></span> 

                <label for="nuevoApellidos">Apellidos:</label>

                <input type="text" class="form-control input-lg" name="nuevoApellidos" id="nuevoApellidos"value="<?php echo $_SESSION["apellidos"];?>" readonly>

              </div>

            </div>



            <!-- ENTRADA PARA EL USUARIO -->

            <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <label for="nuevoUsuario">Usuario:</label>

                <input type="text" class="form-control input-lg" name="nuevoUsuario" id="nuevoUsuario" value="<?php echo $_SESSION["usuario"];?>" readonly>

              </div>

            </div>

           

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group" style="width:80%;">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <label for="nuevoPerfil">Perfil:</label>

                <input type="text" class="form-control input-lg" name="nuevoPerfil" id="nuevoPerfil" value="<?php echo $_SESSION["perfil"];?>" readonly>

              </div>

            </div>

          </div>



          <div class="box-body pull-right" style="width:50%;">


            <!-- ENTRADA PARA LOS EMAIL -->

            <div class="form-group" style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-envelope-square"></i></span> 

                <label for="nuevoEmail">Email:</label>

                <input type="email" class="form-control input-lg" id="nuevoEmail" name="nuevoEmail" value="<?php echo $_SESSION["email"];?>" readonly >

              </div>

            </div>


            <!-- ENTRADA PARA EL FECHA INCIDENCIA -->

            <div class="form-group" style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span> 

                <label for="nuevoFechaIncidencia">Fecha Incidencia:</label>

                <input type="date" class="form-control input-lg" name="nuevoFechaIncidencia" id="nuevoFechaIncidencia" value="<?php echo date("Y-m-d");?>" readonly>

              </div>

            </div>


            <!-- ENTRADA PARA LA INCIDENCIA -->

            <div class="form-group" style="width:80%; margin-left:20%">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-warning"></i></span> 


                <textarea name="nuevoIncidencia" id="nuevoIncidencia" cols=58 rows="8" placeholder="INGRESE SU INCIDENCIA"></textarea>

              </div>

            </div>



          

         

          </div>


   

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer" >

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="enviar_incidencia" style="margin-left:80%">Enviar Incidencia</button>

        </div>

        <?php

          $crearIncidencia = new ControladorIncidencias();
          $crearIncidencia -> ctr_crearIncidencia();

        ?>

      </form>


      
    </div>
    

  </section>
 
</div>











