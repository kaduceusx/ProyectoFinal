<?php

class ControladorIncidenciasAdmin{


    /* -------------------------------------------------------------------------- */
    /*                              MOSTRAR INCIDENCIAS                              */
    /* -------------------------------------------------------------------------- */

    static public function ctr_mostrarIncidenciasAdmin($item, $valor){

        $tabla = "incidencias";


        $respuesta = ModeloIncidenciasAdmin::mdl_mostrarIncidenciasAdmin($tabla, $item, $valor);

        return $respuesta;


    }



    

    /* -------------------------------------------------------------------------- */
    /*                    ENVIAR INFORME A USUARIOS DE INCIDENCIAS                 */
    /* -------------------------------------------------------------------------- */

    public function ctr_enviarCorreo(){

        if(isset($_POST["enviarCorreo"])){

            $nombre = $_POST["enviarNombre"];
            $apellidos = $_POST["enviarApellidos"];
            $incidencia = $_POST["enviarIncidencia"];
            $email = $_POST["enviarEmail"];

         
       

            //Mensaje para el usuario.
            $to1 = $email;
            $subject1 = "Solución de incidencias internas.";
            $message1 = "Hola ". $nombre . " " . $apellidos . ". \n\n\n" . "En breve nos disponemos a solucionar esta incidencia: " . "\n\n" . $incidencia . ". \n\n\n" . "Muchas gracias por informarnos de este problema.";

            $headers1 = "From: admin_fernando_serna@geriatrysalut.com";
          

           


            if (mail($to1, $subject1, $message1, $headers1)){

                echo '<script>

                    swal({
                        
                        type: "success",
                        title: "Se ha enviado un mensaje a tu correo electronico.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                    }).then((result)=>{

                        if(result.value){

                            window.location = "incidencias_admin";
                        }

                    });

                </script>';

            }else {

                echo '<script>
        
                        swal({
                            
                            type: "error",
                            title: "No se ha podido enviar el email",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
    
                        }).then((result)=>{
    
                            if(result.value){
    
                                window.location = "incidencias_admin";
    
                            }
    
                        });
        
                    </script>';
            }
           

           
        }
            
      
    }


    /* -------------------------------------------------------------------------- */
    /*                      BORRAR INCIDENCIAS REALIZADAS                         */
    /* -------------------------------------------------------------------------  */

    public function ctr_borrarIncidenciasAdmin(){

        if(isset($_POST["borrarIncidencias"])){

            $respuesta = ModeloIncidenciasAdmin::mdl_borrarIncidenciaAdmin();
            
            if($respuesta == "ok"){
                
                echo '<script>

                    swal({
                        
                        type: "success",
                        title: "Las incidencias realizadas han sido eliminadas.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                    }).then((result)=>{

                        if(result.value){

                            window.location = "incidencias_admin";
                        }

                    });

                </script>';

            }else if ($respuesta == "error"){

                echo '<script>
            
                    swal({
                        
                        type: "error",
                        title: "No se ha podido borrar las incidencias realizadas.",
                        showConfirmButton: true,
                        confirmButtonText: "Cerrar",
                        closeOnConfirm: false

                    }).then((result)=>{

                        if(result.value){

                            window.location = "incidencias_admin";

                        }

                    });

                </script>';

            }
           

           
        }
            
      
    }


    




}



