<?php

    require_once("../controlador/incidencias_admin.controlador.php");
    require_once("../modelo/incidencias_admin.modelo.php");
    
   

    class AjaxIncidenciasAdmin{

  
    /* -------------------------------------------------------------------------- */
    /*                          ACTIVAR INCIDENCIA ADMIN                           */
    /* -------------------------------------------------------------------------- */

    public $activarEstadoIncidencia;
    public $activarIdEstadoIncidencia;

    public function ajax_activarEstadoIncidencia(){

        $tabla = "incidencias";

        $item1 = "estadoIncidencia";

        $valor1 = $this -> activarEstadoIncidencia;

        $item2 = "id";

        $valor2 = $this -> activarIdEstadoIncidencia;

        $respuesta = ModeloIncidenciasAdmin::mdl_actualizarIncidenciaAdmin($tabla, $item1, $valor1, $item2, $valor2);

    }



}




/* -------------------------------------------------------------------------- */
/*                               ACTIVAR INCIDENCIA ADMIN                     */
/* -------------------------------------------------------------------------- */

if(isset($_POST["activarEstadoIncidencia"])){

    $activarEstadoIncidencia = new AjaxIncidenciasAdmin();

    $activarEstadoIncidencia -> activarEstadoIncidencia = $_POST["activarEstadoIncidencia"];

    $activarEstadoIncidencia -> activarIdEstadoIncidencia = $_POST["activarIdEstadoIncidencia"];

    $activarEstadoIncidencia -> ajax_activarEstadoIncidencia();

    
}














