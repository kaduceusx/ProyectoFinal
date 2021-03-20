<?php

class ControladorSeguimientos{


   

    /* -------------------------------------------------------------------------- */
    /*                              MOSTRAR SEGUIMIENTO                              */
    /* -------------------------------------------------------------------------- */

    static public function ctr_mostrarSeguimientos($item, $valor){

       
        $tabla = "seguimientos";

        


        $respuesta = ModeloSeguimientos::mdl_mostrarSeguimientos($tabla, $item, $valor);

        return $respuesta;


    }

    /* -------------------------------------------------------------------------- */
    /*                               CREAR SEGUIMIENTO                              */
    /* -------------------------------------------------------------------------- */
    static public function ctr_crearSeguimiento(){

        if(isset($_POST["crear_seguimiento"])){

            $fechaSeguimiento = $_POST["nuevoFechaSeguimiento"];
            $nombre_paciente = $_POST["nuevoSeguimiento"];
            $ingesta = $_POST["nuevoIngesta"];
            $miccion = $_POST["nuevoMiccion"];
            $defecacion = $_POST["nuevoDefecacion"];

            $tabla = "seguimientos";


            $datos =[

                
                "id_paciente" => $nombre_paciente,
                "fechaSeguimiento" => $fechaSeguimiento,
                "ingesta" => $ingesta,
                "miccion" => $miccion,
                "defecacion" => $defecacion
                

            ];

            
            $respuesta = ModeloSeguimientos::mdl_crearSeguimiento($tabla, $datos);
           // $respuesta2 = ModeloSeguimientos::mdl_comprobarSeguimiento($nombre_paciente);

            if($respuesta == "ok"){

                
                echo '<script>

                swal({
                    
                    type: "success",
                    title: "El seguimiento ha sido guardado correctamente.",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar",
                    closeOnConfirm: false

                }).then((result)=>{

                    if(result.value){

                        window.location = "pacientes_auxiliar";
                    }

                });

            </script>';
            }else if($respuesta == "error"){

                echo '<script>

                swal({
                    
                    type: "error",
                    title: "Error en el seguimiento",
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

           
                

           
               
           


        }
    }
    


    /* -------------------------------------------------------------------------- */
    /*                               EDITAR  SEGUIMIENTO                              */
    /* -------------------------------------------------------------------------- */
    static public function ctr_editarSeguimiento(){

        if(isset($_POST["modificar_seguimiento"])){


            $id = $_POST["editarId_Seguimiento"];
            $id_paciente = $_POST["editarId_paciente"];
            $fechaSeguimiento = $_POST["editarFechaSeguimiento"];
            $ingesta = $_POST["editarIngesta"];
            $miccion = $_POST["editarMiccion"];
            $defecacion = $_POST["editarDefecacion"];

            $tabla = "seguimientos";


            $datos =[

                "id" => $id,
                "fechaSeguimiento" => $fechaSeguimiento,
                "ingesta" => $ingesta,
                "miccion" => $miccion,
                "defecacion" => $defecacion,
                "id_paciente" => $id_paciente
                

            ];

     
            $respuesta = ModeloSeguimientos::mdl_editarSeguimiento($tabla, $datos);

            if($respuesta == "ok"){

                echo '<script>

                    swal({
                        
                        type: "success",
                        title: "El seguimiento ha sido editado correctamente.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                    }).then((result)=>{

                        if(result.value){

                            window.location = "pacientes_auxiliar";
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

                            window.location = "pacientes_auxiliar";
                        }

                    });

                </script>';
            }

            

            

            
        }
    }


   







}



