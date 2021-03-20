<?php

class ControladorHistoriales{


   

    /* -------------------------------------------------------------------------- */
    /*                              MOSTRAR HISTORIALES                              */
    /* -------------------------------------------------------------------------- */

    static public function ctr_mostrarHistoriales($item, $valor){

       
        $tabla = "historiales";


        $respuesta = ModeloHistoriales::mdl_mostrarHistoriales($tabla, $item, $valor);

        return $respuesta;


    }

    /* -------------------------------------------------------------------------- */
    /*                               CREAR HISTORIAL                              */
    /* -------------------------------------------------------------------------- */
    static public function ctr_crearHistorial(){

        if(isset($_POST["crear_historial"])){


            $nombre_paciente = $_POST["nuevoHistorial"];
            $cirugias = $_POST["nuevoCirugias"];
            $resonancias = $_POST["nuevoResonancias"];

            $tabla = "historiales";


            $datos =[

                
                "id_paciente" => $nombre_paciente,
                "cirugias" => $cirugias,
                "resonancias" => $resonancias
                

            ];

            

            $respuesta2 = ModeloHistoriales::mdl_comprobarHistorial($nombre_paciente);

            if($respuesta2 == null){

                $respuesta = ModeloHistoriales::mdl_crearHistorial($tabla, $datos);
                echo '<script>

                swal({
                    
                    type: "success",
                    title: "El historial ha sido guardado correctamente.",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false

                }).then((result)=>{

                    if(result.value){

                        window.location = "pacientes_medico";
                    }

                });

            </script>';
            }else{

                echo '<script>

                swal({
                    
                    type: "error",
                    title: "El paciente ya tiene un historial. Puede verse en el botón historial",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false

                }).then((result)=>{

                    if(result.value){

                        window.location = "pacientes_medico";
                    }

                });

            </script>';
                
            }

           
                

           
               
           


        }
    }
    /* -------------------------------------------------------------------------- */
    /*                               EDITAR PACIENTE MEDICO                              */
    /* -------------------------------------------------------------------------- */
    
    static public function ctr_editarPaciente_medico(){

        if(isset($_POST["modificar_paciente_medico"])){

            
            $id = $_POST["editarId"];
            $paciente = $_POST["editarPaciente"];
            $demencia = $_POST["editarDemencia"];
            $cronica = $_POST["editarCronica"];
            $alergias = $_POST["editarAlergias"];
            $suplementos = $_POST["editarSuplementos"];

            $situacion = $_POST["editarSituacion"];
            
           
            //pendiente de agregar restricciones a las clumnas del medico
            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $paciente)){


                
                
                $tabla = "pacientes";


                $datos =[

                    "id" => $id,
                    "paciente" => $paciente,
                    "demencia" => $demencia,
                    "cronica" => $cronica,
                    "alergias" => $alergias,
                    "suplementos" => $suplementos,
                    "situacion" => $situacion
                   

                ];


                $respuesta = ModeloPacientes::mdl_editarPaciente_medico($tabla, $datos);
                

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

                                window.location = "pacientes_medico";
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

                                window.location = "pacientes_medico";
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

                        window.location = "pacientes_medico";
                    }

                });

            </script>';

            }
        }else if(isset($_POST["modificar_paciente_psicologo"])){

            $id = $_POST["editarId"];
            $paciente = $_POST["editarPaciente"];
            $situacion = $_POST["editarSituacion"];

            $tabla = "pacientes";


            $datos =[

                "id" => $id,
                "paciente" => $paciente,
                "situacion" => $situacion
               

            ];


            $respuesta = ModeloPacientes::mdl_editarPaciente_medico($tabla, $datos);

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

                            window.location = "pacientes_psicologo";
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

                            window.location = "pacientes_psicologo";
                        }

                    });

                </script>';
            }
        }


    }


    /* -------------------------------------------------------------------------- */
    /*                               EDITAR  HISTORIAL                              */
    /* -------------------------------------------------------------------------- */
    static public function ctr_editarHistorial(){

        if(isset($_POST["modificar_historial"])){


            $id = $_POST["editarId_historial"];
            
            $id_paciente = $_POST["editarId_paciente"];
            $cirugias = $_POST["editarCirugias"];
            $resonancias = $_POST["editarResonancias"];

            $tabla = "historiales";


            $datos =[

                "id" => $id,
              
                "cirugias" => $cirugias,
                "resonancias" => $resonancias,
                "id_paciente" => $id_paciente
                

            ];

     
            $respuesta = ModeloHistoriales::mdl_editarHistorial($tabla, $datos);

            if($respuesta == "ok"){

                echo '<script>

                    swal({
                        
                        type: "success",
                        title: "!El historial ha sido editado correctamente.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                    }).then((result)=>{

                        if(result.value){

                            window.location = "pacientes_medico";
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

                            window.location = "pacientes_medico";
                        }

                    });

                </script>';
            }

            

            

            
        }
    }


   







}



