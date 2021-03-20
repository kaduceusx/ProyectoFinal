<?php

class ControladorUsuarios{


    /* -------------------------------------------------------------------------- */
    /*                              INGRESO USUARIOS                              */
    /* -------------------------------------------------------------------------- */

    public function ctr_ingresoUsuario(){

        //error_reporting(E_ALL ^ E_NOTICE);

        if(isset($_POST["Ingresar"])){

            $usuario = $_POST["ingUsuario"];
            $password = $_POST["ingPassword"];

            if(preg_match('/^[a-zñA-ZÑ0-9]+$/', $usuario) && preg_match('/^[a-zA-Z0-9]+$/' , $password)){

                $encriptar = crypt($password, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                $tabla = "usuarios";

                $item = "usuario";
                $valor = $usuario;

                $respuesta = ModeloUsuarios::mdl_mostrarUsuarios($tabla, $item, $valor);

                

                if($respuesta["usuario"] == $usuario && $respuesta["password"] == $encriptar){

                    if($respuesta["estado"] == 1){
                    
                        //if($respuesta["perfil"] == "Administrador"){

                            //echo inicia sesion
                            //echo '<div class="alert alert-success">Bienvenido al sistema.</div>';

                            /*informacion si se quiere recuperar en las vistas*/
                            $_SESSION["iniciarSesion"] = "ok";
                            $_SESSION["id"] = $respuesta["id"];
                            $_SESSION["nombre"] = $respuesta["nombre"];
                            $_SESSION["apellidos"] = $respuesta["apellidos"];
                            $_SESSION["usuario"] = $respuesta["usuario"];
                            $_SESSION["perfil"] = $respuesta["perfil"];
                            $_SESSION["email"] = $respuesta["email"];
                            $_SESSION["ultimo_login"] = $respuesta["ultimo_login"];
                            $_SESSION["estado"] = $respuesta["estado"];
                            $_SESSION["foto"] = $respuesta["foto"];
                            $_SESSION["timeout"] = time(); //tiempo de inactividad.


                       
                            /* REGISTRAR FECHA PARA ULTIMO LOGIN */
                        
                            date_default_timezone_set("Europe/Madrid");
                            
                            $fecha = date("Y-m-d");
    
                            $hora = date("H:i:s");
    
                            $fechaActual = $fecha . ' ' . $hora;


                            /* -------Fecha y hora de entrada-------*/
                            $entradaFecha = date("d-m-Y");

                            $entradaHora = date("H:i:s");
                            
                            $_SESSION["entradaFecha"] = $entradaFecha;

                            $_SESSION["entradaHora"] = $entradaHora;
                            /*-------fecha y hora de entrada-------*/
    
                            $item1 = "ultimo_login";
    
                            $valor1 = $fechaActual;
    
                            $item2 = "id";
    
                            $valor2 = $respuesta["id"];
    
                            $ulimoLogin = ModeloUsuarios::mdl_actualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
        
                            if($ulimoLogin == "ok"){
    
                                echo '<script>
                                        window.location = "inicio";
                                    </script>';
    
                            }
        
                         
                          
                            
                    }else{
        
                        echo '<div class="alert alert-danger">Error al ingresar, usuario de baja temporalmente.</div>';
        
                    }

                        

                    
                    


                }else{

                    echo '<div class="alert alert-danger">Error al ingresar, vuelve a intentarlo.</div>';
                }

            }
            
        }
    }


    /* -------------------------------------------------------------------------- */
    /*                                CREAR USUARIO                               */
    /* -------------------------------------------------------------------------- */

    public function ctr_crearUsuario(){

        if(isset($_POST["guardar_usuario"])){   

            $nombre = $_POST["nuevoNombre"];
            $apellidos = $_POST["nuevoApellidos"];
            $usuario = $_POST["nuevoUsuario"];
            $contrasena = $_POST["nuevoPassword"];
            $encriptar = crypt($contrasena, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
            $dni = $_POST["nuevoDni"];
            $email = $_POST["nuevoEmail"];
            $perfil = $_POST["nuevoPerfil"];
            $nacimiento = $_POST["nuevoNacimiento"];
            $provincia = $_POST["nuevoProvincia"];
            $localidad = $_POST["nuevoLocalidad"];
            $domicilio = $_POST["nuevoDomicilio"];
            $civil = $_POST["nuevoCivil"];
            $ruta = "";
            $foto = $_FILES["nuevaFoto"]["tmp_name"];
            $fotoType = $_FILES["nuevaFoto"]["type"];

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $nombre ) 
            && preg_match('/^[a-zA-Z0-9ñÑ]+$/', $dni)
            && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $domicilio)){

                    
                //para que todas las fotos tengan el mismo ancho y alto.
                list($ancho, $alto) = getimagesize($foto);

                $nuevoAncho = 500;
                $nuevoAlto = 500;



                //Directorio donde se va a guardar la foto del usuario
                $directorio = "vista/img/usuarios/".$usuario;

                mkdir($directorio, 0755);//0755 son los permiso de lectura y escritura.


                //Depende del tipo de imagen se usará un metodo u otro de php.
                if ($fotoType == "image/jpeg"){

                    //guardar imagen en el directorio
                    $aleatorio = mt_rand(100,900);

                    $ruta = "vista/img/usuarios/".$usuario."/" . $aleatorio.".jpeg";

                    $origen  = imagecreatefromjpeg($foto);

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagejpeg($destino, $ruta);
                }


                if ($fotoType == "image/png"){

                    //guardar imagen en el directorio
                    $aleatorio = mt_rand(1,100);

                    $ruta = "vista/img/usuarios/".$usuario."/" . $aleatorio.".png";

                    $origen  = imagecreatefrompng($foto);

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagepng($destino, $ruta);
                }


                $tabla = "usuarios";

                $datos =[

                    "nombre" => $nombre,
                    "apellidos" => $apellidos,
                    "usuario" => $usuario,
                    "contrasena" => $encriptar,
                    "dni" => $dni,
                    "email" => $email,
                    "perfil" => $perfil,
                    "nacimiento" => $nacimiento,
                    "provincia" => $provincia,
                    "localidad" => $localidad,
                    "domicilio" => $domicilio,
                    "civil" => $civil,
                    "foto" => $ruta

                ];


                $respuesta = ModeloUsuarios::mdl_ingresarUsuario($tabla, $datos);

                if($respuesta == "ok"){

                    echo '<script>

                        swal({
                            
                            type: "success",
                            title: "!El usuario ha sido guardado correctamente.",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        }).then((result)=>{

                            if(result.value){

                                window.location = "usuarios";
                            }

                        });

                    </script>';

                }else if ($respuesta == "error"){

                    echo '<script>

                        swal({
                            
                            type: "error",
                            title: "Error de tipo sql",
                            text: "Revisa la funcion del modelo",
                            confirmButtonText: "Cerrar",

                        }).then((result)=>{

                            if(result.value){

                                window.location = "usuarios";
                            }

                        });

                    </script>';
                }


            }else {

                echo '<script>

                        swal({
                            
                            type: "error",
                            title: "!El usuario no puede ir vacío o llevar carácteres especiales",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        }).then((result)=>{

                            if(result.value){

                                window.location = "usuarios";
                            }

                        });

                    </script>';

            }

        }

    }


    /* -------------------------------------------------------------------------- */
    /*                              MOSTRAR USUARIOS                              */
    /* -------------------------------------------------------------------------- */

    static public function ctr_mostrarUsuarios($item, $valor){

        $tabla = "usuarios";


        $respuesta = ModeloUsuarios::mdl_mostrarUsuarios($tabla, $item, $valor);

        return $respuesta;


    }

   
    public function ctr_editarUsuario(){

        if(isset($_POST["modificar_usuario"])){

            $nombre = $_POST["editarNombre"];
            $apellidos = $_POST["editarApellidos"];
            $usuario = $_POST["editarUsuario"];
            $contrasena = $_POST["editarPassword"];
            $contrasenaActual = $_POST["passwordActual"];
            $dni = $_POST["editarDni"];
            $email = $_POST["editarEmail"];
            $perfil = $_POST["editarPerfil"];
            $nacimiento = $_POST["editarNacimiento"];
            $provincia = $_POST["editarProvincia"];
            $localidad = $_POST["editarLocalidad"];
            $domicilio = $_POST["editarDomicilio"];
            $civil = $_POST["editarCivil"];
            
            $fotoActual = $_POST["fotoActual"];

            $fotoEditar = $_FILES["editarFoto"]["tmp_name"];
            $fotoType = $_FILES["editarFoto"]["type"];


            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $nombre ) 
            && preg_match('/^[a-zA-Z0-9ñÑ]+$/', $dni)
            && preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $domicilio)){


                //validar imagen

                $ruta = "";

                $ruta = $fotoActual;

                if(isset($fotoEditar) && !empty($fotoEditar)){

					list($ancho, $alto) = getimagesize($fotoEditar);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;



                    //Directorio donde se va a guardar la foto del usuario
                    $directorio = "vista/img/usuarios/".$usuario;


                    //se comprueba si existe en la base de datos.btn
                    if(!empty($fotoActual)){

                        unlink($fotoActual);

                    }else{

                        mkdir($directorio, 0755);//0755 son los permiso de lectura y escritura. Crea la carpeta para que la foto se agrega ahi

                    }

                    


                    //Depende del tipo de imagen se usará un metodo u otro de php.
                    if ($fotoType == "image/jpeg"){

                        //guardar imagen en el directorio
                        $aleatorio = mt_rand(100,900);

                        $ruta = "vista/img/usuarios/".$usuario."/" . $aleatorio.".jpeg";

                        $origen  = imagecreatefromjpeg($fotoEditar);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }


                    if ($fotoType == "image/png"){

                        //guardar imagen en el directorio
                        $aleatorio = mt_rand(1,100);

                        $ruta = "vista/img/usuarios/".$usuario."/" . $aleatorio.".png";

                        $origen  = imagecreatefrompng($fotoEditar);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }

                }
                
                $tabla = "usuarios";

                if($contrasena != ""){


                    if(preg_match('/^[a-zA-Z0-9]+$/', $contrasena)){

                        $encriptar = crypt($contrasena, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                    }else{

                        echo '<script>

                                swal({
                                    
                                    type: "error",
                                    title: "La contraseña no puede ir vacía o llevar carácteres especiales",
                                    showConfirmButton: true,
                                    confirmButtonText: "Cerrar",
                                    closeOnConfirm: false

                                }).then((result)=>{

                                    if(result.value){

                                        window.location = "usuarios";

                                    }

                                });

                            </script>';

                    }


                }else{

                    $encriptar = $contrasenaActual;

                }


                $datos =[

                    "nombre" => $nombre,
                    "apellidos" => $apellidos,
                    "usuario" => $usuario,
                    "password" => $encriptar,
                    "dni" => $dni,
                    "email" => $email,
                    "perfil" => $perfil,
                    "nacimiento" => $nacimiento,
                    "provincia" => $provincia,
                    "localidad" => $localidad,
                    "domicilio" => $domicilio,
                    "civil" => $civil,
                    "foto" => $ruta

                ];


                $respuesta = ModeloUsuarios::mdl_editarUsuario($tabla, $datos);


                if($respuesta == "ok"){

                    echo '<script>

                        swal({
                            
                            type: "success",
                            title: "!El usuario ha sido editado correctamente.",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        }).then((result)=>{

                            if(result.value){

                                window.location = "usuarios";
                            }

                        });

                    </script>';

                }else if ($respuesta == "error"){

                    echo '<script>

                        swal({
                            
                            type: "error",
                            title: "Error de tipo sql",
                            text: "Revisa la funcion del modelo",
                            confirmButtonText: "Cerrar",

                        }).then((result)=>{

                            if(result.value){

                                window.location = "usuarios";
                            }

                        });

                    </script>';
                }

            }else{
                
                echo '<script>

                swal({
                    
                    type: "error",
                    title: "!El nombre no puede ir vacío o llevar carácteres especiales",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false

                }).then((result)=>{

                    if(result.value){

                        window.location = "usuarios";
                    }

                });

            </script>';

            }



        }

    }



    /* -------------------------------------------------------------------------- */
    /*                               BORRAR USUARIO                               */
    /* -------------------------------------------------------------------------- */

    public function ctr_borrarUsuario(){

        if(isset($_GET["idUsuario"])){

            $tabla = "usuarios";

            $datos = $_GET["idUsuario"];

            if($_GET["fotoUsuario"] != ""){

                unlink($_GET["fotoUsuario"]);
                rmdir("vista/img/usuarios/".$_GET["nombreUsuario"]);

            }

                $respuesta = ModeloUsuarios::mdl_borrarUsuario($tabla, $datos);

                if($respuesta == "ok"){

                    echo '<script>

                        swal({
                            
                            type: "success",
                            title: "!El usuario ha sido editado correctamente.",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        }).then((result)=>{

                            if(result.value){

                                window.location = "usuarios";
                            }

                        });

                    </script>';


                }

        }


    }



    public function ctr_incidencias(){

        if(isset($_POST["Incidencias"])){

            $titulo = $_POST["Titulo"];
            $email = $_POST["Email"];
            $telefono = $_POST["Telefono"];
            $descripcion = $_POST["Descripcion"];

            $usuarioEmail = ModeloUsuarios::mdl_cargarUsuario_porEmail($email); 

            $existeUsuario = ModeloUsuarios::mdl_existeUsuario($usuarioEmail);
            
            if($existeUsuario != null){

                if($existeUsuario == $usuarioEmail){

                //Mensaje para el usuario.
				$to1 = $email;
				$subject1 = "Solución de incidencias externas.";
				$message1 = "Hola ". $usuarioEmail . ". \n\n\n" . "En breve nos pondremos en contacto contigo para solucionar el problema, ya sea por este correo que nos has facilitado o llamando directamente por teléfono, muchas gracias.";

				$headers1 = "From: admin_fernando_serna@geriatrysalut.com";
				//contra = h>g7^&9ib02N
	
				mail($to1, $subject1, $message1, $headers1);


				//Mensaje para el administrador, para que tenga el usuario, el telefono y la descripcion.

				$to2 = "admin_fernando_serna@geriatrysalut.com";
				$subject2 = $titulo;
				$message2 = "Hay una nueva incidencia." . "\n\n\n" . 
				"El usuario de la incidencia es: " . $usuarioEmail . ". \n\n" . 
				"Su correo es: " . $email . " \n\n" . 
				"Su telefono de contacto es: " . $telefono . "\n\n" .
				"La descripcion del problema es la siguiente: " . $descripcion;

				$headers2 = "From: kaduceusxx@gmail.com"; //uso mi propio correo para enviar el correo a admin_fernando_serna@geriatrysalut.com en vez del CGI-mailer
	
				mail($to2, $subject2, $message2, $headers2);

                    echo '<script>

                        swal({
                            
                            type: "success",
                            title: "Se ha enviado un mensaje a tu correo electronico.",
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
            }else {

                    echo '<script>
    
                        swal({
                            
                            type: "error",
                            title: "No existe ningun usuario relacionado con ese email",
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
            
      
    }


    public function ctr_recuperarContrasena(){

        if(isset($_POST["Recuperar"])){

            $email = $_POST["recuperarEmail"];
            $nuevaContrasena = $_POST["nuevaContrasena"];
            $confirmarContrasena = $_POST["confirmarContrasena"];

            $usuarioEmail = ModeloUsuarios::mdl_cargarUsuario_porEmail($email); 

            $existeUsuario = ModeloUsuarios::mdl_existeUsuario($usuarioEmail);


            
            if($existeUsuario != null){

                //uso de expresiones para filtrar lo que se mete en las contraseñas.
                if(preg_match('/^[a-zñA-ZÑ0-9]+$/', $nuevaContrasena) 
                    && preg_match('/^[a-zA-Z0-9]+$/' , $confirmarContrasena)){

                    if ($nuevaContrasena == $confirmarContrasena && $existeUsuario == $usuarioEmail){
			
			
                        $encriptar = crypt($nuevaContrasena, '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');
                        
                        $editarContrasena = ModeloUsuarios::mdl_editarContrasena($usuarioEmail, $encriptar);
    
                        session_destroy();
                        $_SESSION=array();
                        
                        $to = $email;
                        $subject = "Recuperación de la contraseña";
                        $message = "Su usuario es: ". $usuarioEmail. "\n\n\n" . "y su contraseña es :" . $confirmarContrasena;
                        $headers = "From: admin_fernando_serna@geriatrysalut.com";
            
                        mail($to, $subject, $message, $headers);
    
                        echo '<script>
    
                            swal({
                                
                                type: "success",
                                title: "Se ha enviado un mensaje a tu correo electronico." ,
                                showConfirmButton: true,
                                confirmButtonText: "Cerrar",
                                closeOnConfirm: false
    
                            }).then((result)=>{
    
                                if(result.value){
    
                                    window.location = "login";
                                }
    
                            });
    
                        </script>';
    
                    
    
                    
                    }else {
                        echo '<script>
    
                        swal({
                            
                            type: "error",
                            title: "Las contraseñas no coinciden",
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

                }else{
                    
                    echo '<script>

                        swal({
                            
                            type: "error",
                            title: "Los campos de contraseñas no puede ir vacíos o llevar carácteres especiales",
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

        

            }else {

                echo '<script>

                    swal({
                        
                        type: "error",
                        title: "No existe ningun usuario relacionado con ese email",
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
        


    

    }









}



