<?php

class ControladorPacientes{


    /* -------------------------------------------------------------------------- */
    /*                                CREAR PACIENTE                               */
    /* -------------------------------------------------------------------------- */

    public function ctr_crearPaciente(){

        if(isset($_POST["guardar_paciente"])){   

            $paciente = $_POST["nuevoPaciente"];
            $sip = $_POST["nuevoSip"];
            $dni = $_POST["nuevoDni"];
            $nuss = $_POST["nuevoNuss"];
            $familiar = $_POST["nuevoFamiliar"];
            $nacimiento = $_POST["nuevoNacimiento"];
            $provincia = $_POST["nuevoProvincia"];
            $localidad = $_POST["nuevoLocalidad"];
            $domicilio = $_POST["nuevoDomicilio"];
            $civil = $_POST["nuevoCivil"];
            $genero = $_POST["nuevoGenero"];
            $ingreso = $_POST["nuevoIngreso"];
            $ruta = "";
            $foto = $_FILES["nuevaFoto"]["tmp_name"];
            $fotoType = $_FILES["nuevaFoto"]["type"];

            if(preg_match('/^[a-zA-Z0-9ñÑ]+$/', $dni)){

                    
                //para que todas las fotos tengan el mismo ancho y alto.
                list($ancho, $alto) = getimagesize($foto);

                $nuevoAncho = 500;
                $nuevoAlto = 500;



                //Directorio donde se va a guardar la foto del paciente
                $directorio = "vista/img/pacientes/".$paciente;

                mkdir($directorio, 0755);//0755 son los permiso de lectura y escritura.


                //Depende del tipo de imagen se usará un metodo u otro de php.
                if ($fotoType == "image/jpeg"){

                    //guardar imagen en el directorio
                    $aleatorio = mt_rand(100,900);

                    $ruta = "vista/img/pacientes/".$paciente."/" . $aleatorio.".jpeg";

                    $origen  = imagecreatefromjpeg($foto);

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagejpeg($destino, $ruta);
                }


                if ($fotoType == "image/png"){

                    //guardar imagen en el directorio
                    $aleatorio = mt_rand(1,100);

                    $ruta = "vista/img/pacientes/".$paciente."/" . $aleatorio.".png";

                    $origen  = imagecreatefrompng($foto);

                    $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                    imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                    imagepng($destino, $ruta);
                }


                $tabla = "pacientes";

                $datos =[

                    "paciente" => $paciente,
                    "sip" => $sip,
                    "dni" => $dni,
                    "nuss" => $nuss,
                    "familiar" => $familiar,
                    "nacimiento" => $nacimiento,
                    "provincia" => $provincia,
                    "localidad" => $localidad,
                    "domicilio" => $domicilio,
                    "civil" => $civil,
                    "genero" => $genero,
                    "ingreso" => $ingreso,
                    "foto" => $ruta

                ];


                $respuesta = ModeloPacientes::mdl_ingresarPaciente($tabla, $datos);

                if($respuesta == "ok"){

                    echo '<script>

                        swal({
                            
                            type: "success",
                            title: "!El paciente ha sido guardado correctamente.",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        }).then((result)=>{

                            if(result.value){

                                window.location = "pacientes";
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

                                window.location = "pacientes";
                            }

                        });

                    </script>';
                }


            }else {

                echo '<script>

                        swal({
                            
                            type: "error",
                            title: "!Algunos campos no pueden ir vacíos o llevar carácteres especiales",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        }).then((result)=>{

                            if(result.value){

                                window.location = "pacientes";
                            }

                        });

                    </script>';

            }

        }

    }


    /* -------------------------------------------------------------------------- */
    /*                              MOSTRAR PACIENTES                              */
    /* -------------------------------------------------------------------------- */

    static public function ctr_mostrarPacientes($item, $valor){

        $tabla = "pacientes";


        $respuesta = ModeloPacientes::mdl_mostrarPacientes($tabla, $item, $valor);

        return $respuesta;


    }



   


    /* -------------------------------------------------------------------------- */
    /*                               EDITAR PACIENTE                              */
    /* -------------------------------------------------------------------------- */
    
    public function ctr_editarPaciente(){

        if(isset($_POST["modificar_paciente"])){

            $id = $_POST["editarId"];
            $paciente = $_POST["editarPaciente"];
            $sip = $_POST["editarSip"];
            $dni = $_POST["editarDni"];
            $nuss = $_POST["editarNuss"];
            $familiar = $_POST["editarFamiliar"];
            $nacimiento = $_POST["editarNacimiento"];
            $provincia = $_POST["editarProvincia"];
            $localidad = $_POST["editarLocalidad"];
            $domicilio = $_POST["editarDomicilio"];
            $civil = $_POST["editarCivil"];
            $genero = $_POST["editarGenero"];
            $ingreso = $_POST["editarIngreso"];
          
            $fotoActual = $_POST["fotoActual"];

            $fotoEditar = $_FILES["editarFoto"]["tmp_name"];
            $fotoType = $_FILES["editarFoto"]["type"];

           
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $paciente)
            && preg_match('/^[a-zA-Z0-9ñÑ]+$/', $dni)){


                //validar imagen

                $ruta = "";

                $ruta = $fotoActual;

                if(isset($fotoEditar) && !empty($fotoEditar)){

					list($ancho, $alto) = getimagesize($fotoEditar);

                    $nuevoAncho = 500;
                    $nuevoAlto = 500;



                    //Directorio donde se va a guardar la foto del paciente
                    $directorio = "vista/img/pacientes/".$paciente;


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

                        $ruta = "vista/img/pacientes/".$paciente."/" . $aleatorio.".jpeg";

                        $origen  = imagecreatefromjpeg($fotoEditar);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagejpeg($destino, $ruta);
                    }


                    if ($fotoType == "image/png"){

                        //guardar imagen en el directorio
                        $aleatorio = mt_rand(1,100);

                        $ruta = "vista/img/pacientes/".$paciente."/" . $aleatorio.".png";

                        $origen  = imagecreatefrompng($fotoEditar);

                        $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                        imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);

                        imagepng($destino, $ruta);
                    }

                }
                
                $tabla = "pacientes";

              


                $datos =[

                    "id" => $id,
                    "paciente" => $paciente,
                    "sip" => $sip,
                    "dni" => $dni,
                    "nuss" => $nuss,
                    "familiar" => $familiar,
                    "nacimiento" => $nacimiento,
                    "provincia" => $provincia,
                    "localidad" => $localidad,
                    "domicilio" => $domicilio,
                    "civil" => $civil,
                    "genero" => $genero,
                    "ingreso" => $ingreso,
                   
                    "foto" => $ruta

                ];


                $respuesta = ModeloPacientes::mdl_editarPaciente($tabla, $datos);


                if($respuesta == "ok"){

                    echo '<script>

                        swal({
                            
                            type: "success",
                            title: "!El paciente ha sido editado correctamente.",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        }).then((result)=>{

                            if(result.value){

                                window.location = "pacientes";
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

                                window.location = "pacientes";
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

                        window.location = "pacientes";
                    }

                });

            </script>';

            }



        }

    }



    /* -------------------------------------------------------------------------- */
    /*                               BORRAR PACIENTE                               */
    /* -------------------------------------------------------------------------- */

    public function ctr_borrarPaciente(){

        if(isset($_GET["idPaciente"])){

            $tabla = "pacientes";

            $datos = $_GET["idPaciente"];

         

                $respuesta = ModeloPacientes::mdl_borrarPaciente($tabla, $datos);

                if($respuesta == "ok"){

                    if($_GET["fotoPaciente"] != ""){

                        unlink($_GET["fotoPaciente"]);
                        rmdir("vista/img/pacientes/".$_GET["nombrePaciente"]);
        
                    }

                    echo '<script>

                        swal({
                            
                            type: "success",
                            title: "El paciente ha sido borrado correctamente",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        }).then((result)=>{

                            if(result.value){

                                window.location = "pacientes";
                            }

                        });

                    </script>';


                }else if ($respuesta == "fallo"){
                    echo '<script>

                    swal({
                        
                        type: "warning",
                        title: "Error al borrar al paciente.",
                        text: "Para poder borrar a el paciente y su historial, primero tiene que estar dado de baja por el médico",
                        confirmButtonText: "Cerrar",

                    }).then((result)=>{

                        if(result.value){

                            window.location = "pacientes";
                        }

                    });

                </script>';
                }else{

                    echo '<script>

                    swal({
                        
                        type: "error",
                        title: "Error tipo sql",
                        text: "Error al borrar, intentelo más tarde.",
                        confirmButtonText: "Cerrar",

                    }).then((result)=>{

                        if(result.value){

                            window.location = "pacientes";
                        }

                    });

                </script>';
                }

        }


    }


    








}



