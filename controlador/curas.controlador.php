<?php

class ControladorCuras{


   

    /* -------------------------------------------------------------------------- */
    /*                              MOSTRAR CURAS                              */
    /* -------------------------------------------------------------------------- */

    static public function ctr_mostrarCuras($item, $valor){

       
        $tabla = "curas";


        $respuesta = ModeloCuras::mdl_mostrarCuras($tabla, $item, $valor);

        return $respuesta;


    }

    /* -------------------------------------------------------------------------- */
    /*                               CREAR CURA                              */
    /* -------------------------------------------------------------------------- */
    static public function ctr_crearCura(){

        if(isset($_POST["crear_cura"])){


            $nombre_paciente = $_POST["nuevoPacienteCura"];
            $cura = $_POST["nuevoCura"];
            $fechaCura = $_POST["nuevoFechaCura"];

            $tabla = "curas";


            $datos =[

                
                "id_paciente" => $nombre_paciente,
                "cura" => $cura,
                "fechaCura" => $fechaCura
                

            ];

            

            //$respuesta2 = ModeloCuras::mdl_comprobarCura($nombre_paciente);

            $respuesta = ModeloCuras::mdl_crearCura($tabla, $datos);


            //if($respuesta2 == null){

            if($respuesta == "ok"){

                echo '<script>

                swal({
                    
                    type: "success",
                    title: "Cura agregada.",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false

                }).then((result)=>{

                    if(result.value){

                        window.location = "pacientes_enfermero";
                    }

                });

            </script>';
            }else{

                echo '<script>

                swal({
                    
                    type: "error",
                    title: "El paciente ya tiene una cura lista. Puede verse en el botón seguimiento de curas",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false

                }).then((result)=>{

                    if(result.value){

                        window.location = "pacientes_enfermero";
                    }

                });

            </script>';
                
            }

           
                

           
               
           


        }
    }
  


    /* -------------------------------------------------------------------------- */
    /*                               EDITAR  CURA                              */
    /* -------------------------------------------------------------------------- */
    static public function ctr_editarCura(){

        if(isset($_POST["modificar_cura"])){


            $id = $_POST["editarId_Seguimiento_cura"];
            $id_paciente = $_POST["editarId_pacienteCura"];
            $fechaCura = $_POST["editarFechaCura"];
            $cura = $_POST["editarCura"];
           
            $tabla = "curas";


            $datos =[

                "id" => $id,
                "id_paciente" => $id_paciente,
                "fechaCura" => $fechaCura,
                "cura" => $cura
               
               
                

            ];

     
            $respuesta = ModeloCuras::mdl_editarCura($tabla, $datos);

            if($respuesta == "ok"){

                echo '<script>

                    swal({
                        
                        type: "success",
                        title: "!La cura ha sido editada correctamente.",
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





    /* -------------------------------------------------------------------------- */
    /*                               BORRAR CURA                               */
    /* -------------------------------------------------------------------------- */

    public function ctr_borrarCura(){

        if(isset($_GET["idCura"])){

            $tabla = "curas";

            $datos = $_GET["idCura"];

            $respuesta = ModeloCuras::mdl_borrarCura($tabla, $datos);

            if($respuesta == "ok"){

                echo '<script>

                    swal({
                        
                        type: "success",
                        title: "!La cura ha sido realizada correctamente.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

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



