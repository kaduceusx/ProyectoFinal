<?php

class ControladorIncidencias{



    /* -------------------------------------------------------------------------- */
    /*                                CREAR INCIDENCIA                               */
    /* -------------------------------------------------------------------------- */

    public function ctr_crearIncidencia(){

        if(isset($_POST["enviar_incidencia"])){   

            $id_usuario = $_POST["nuevoId"];
            $perfil = $_POST["nuevoPerfil"];
            $fechaIncidencia = $_POST["nuevoFechaIncidencia"];
            $nombreIncidencia = $_POST["nuevoIncidencia"];
           

            $tabla = "incidencias";

            $datos =[

                
                "id_usuario" => $id_usuario,
                "nombreIncidencia" => $nombreIncidencia,
                "fechaIncidencia" => $fechaIncidencia
               
            ];


            $respuesta = ModeloIncidencias::mdl_enviarIncidencia($tabla, $datos);

            if($respuesta == "ok"){

                if ($perfil == "Administrativo"){

                    echo '<script>

                        swal({
                            
                            type: "success",
                            title: "La incidencia ha sido enviada correctamente.",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        }).then((result)=>{

                            if(result.value){

                                window.location = "pacientes";
                            }

                        });

                    </script>';

                }else if ($perfil == "Medico"){

                    echo '<script>

                        swal({
                            
                            type: "success",
                            title: "La incidencia ha sido enviada correctamente.",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        }).then((result)=>{

                            if(result.value){

                                window.location = "pacientes_medico";
                            }

                        });

                    </script>';
                }else if ($perfil == "Enfermero"){

                    echo '<script>

                        swal({
                            
                            type: "success",
                            title: "La incidencia ha sido enviada correctamente.",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        }).then((result)=>{

                            if(result.value){

                                window.location = "pacientes_enfermero";
                            }

                        });

                    </script>';
                }else if ($perfil == "Psicologo"){

                    echo '<script>

                        swal({
                            
                            type: "success",
                            title: "La incidencia ha sido enviada correctamente.",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        }).then((result)=>{

                            if(result.value){

                                window.location = "pacientes_psicologo";
                            }

                        });

                    </script>';
                }else if ($perfil == "Auxiliar"){

                    echo '<script>

                        swal({
                            
                            type: "success",
                            title: "La incidencia ha sido enviada correctamente.",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false

                        }).then((result)=>{

                            if(result.value){

                                window.location = "pacientes_auxiliar";
                            }

                        });

                    </script>';
                }

               

            }else if ($respuesta == "error"){

                echo '<script>

                    swal({
                        
                        type: "error",
                        title: "Error de tipo sql",
                        text: "Revisa la funcion del modelo",
                        confirmButtonText: "Cerrar",

                    });

                </script>';
            }


            

        }

    }



 


    
   




}



