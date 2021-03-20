<?php

class ControladorMedicamentos{


   

    /* -------------------------------------------------------------------------- */
    /*                              MOSTRAR MEDICAMENTOS                              */
    /* -------------------------------------------------------------------------- */

    static public function ctr_mostrarMedicamentos($item, $valor){

       
        $tabla = "medicamentos";


        $respuesta = ModeloMedicamentos::mdl_mostrarMedicamentos($tabla, $item, $valor);

        return $respuesta;


    }


   

    /* -------------------------------------------------------------------------- */
    /*                               CREAR MEDICAMENTO                              */
    /* -------------------------------------------------------------------------- */
    static public function ctr_crearMedicamento(){

        if(isset($_POST["crear_medicamento"])){


            $nombre_paciente = $_POST["nuevoMedicamento"];
            $desayuno = $_POST["nuevoDesayuno"];
            $comida = $_POST["nuevoComida"];
            $merienda = $_POST["nuevoMerienda"];
            $cena = $_POST["nuevoCena"];
            $noche = $_POST["nuevoNoche"];

            $tabla = "medicamentos";


            $datos =[

                
                "id_paciente" => $nombre_paciente,
                "desayuno" => $desayuno,
                "comida" => $comida,
                "merienda" => $merienda,
                "cena" => $cena,
                "noche" => $noche
                
                

            ];

            

            $respuesta2 = ModeloMedicamentos::mdl_comprobarMedicamento($nombre_paciente);

            if($respuesta2 == null){

                $respuesta = ModeloMedicamentos::mdl_crearMedicamento($tabla, $datos);
                echo '<script>

                swal({
                    
                    type: "success",
                    title: "El medicamento ha sido agregado correctamente.",
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
                    title: "El paciente ya tiene medicamentos recetados. Puede verse en el botón medicamentos.",
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
    /*                               EDITAR  MEDICAMENTO                              */
    /* -------------------------------------------------------------------------- */
    static public function ctr_editarMedicamento(){

        if(isset($_POST["modificar_medicamento"])){


            $id = $_POST["editarId_medicamento"];
            
            $id_paciente = $_POST["editarId_paciente_medicamento"];
            $desayuno = $_POST["editarDesayuno"];
            $comida = $_POST["editarComida"];
            $merienda = $_POST["editarMerienda"];
            $cena = $_POST["editarCena"];
            $noche = $_POST["editarNoche"];

            $tabla = "medicamentos";


            $datos =[

                "id" => $id,
                "desayuno" => $desayuno,
                "comida" => $comida,
                "merienda" => $merienda,
                "cena" => $cena,
                "noche" => $noche,
                "id_paciente" => $id_paciente
                

            ];

     
            $respuesta = ModeloMedicamentos::mdl_editarMedicamento($tabla, $datos);

            if($respuesta == "ok"){

                echo '<script>

                    swal({
                        
                        type: "success",
                        title: "!El medicamento ha sido editado correctamente.",
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




    /* -------------------------------------------------------------------------- */
    /*                               CONFIRMAR  MEDICAMENTO                              */
    /* -------------------------------------------------------------------------- */
    static public function ctr_confirmarMedicamento(){

        if(isset($_POST["modificar_medicamento_enfermero"])){


            $id = $_POST["editarId_medicamento"];
            
            $id_paciente = $_POST["editarId_paciente_medicamento"];
            $desayuno = $_POST["desayuno"];
            $comida = $_POST["comida"];
            $merienda = $_POST["merienda"];
            $cena = $_POST["cena"];
            $noche = $_POST["noche"];

            $tabla = "medicamentos";


            $datos =[

                "id" => $id,
                "comp_desayuno" => $desayuno,
                "comp_comida" => $comida,
                "comp_merienda" => $merienda,
                "comp_cena" => $cena,
                "comp_noche" => $noche,
                "comp_id_paciente" => $id_paciente
                

            ];

     
            $respuesta = ModeloMedicamentos::mdl_comprobarMedicamento_enfermero($tabla, $datos);

            if($respuesta == "ok"){

                echo '<script>

                    swal({
                        
                        type: "success",
                        title: "!Se ha comprobrado que el medicamento sido suministrado correctamente.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                    }).then((result)=>{

                        if(result.value){

                            window.location = "pacientes_enfermero";
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

                            window.location = "pacientes_enfermero";
                        }

                    });

                </script>';
            }

            

            

            
        }
    }



   







}



