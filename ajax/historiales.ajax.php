<?php

    require_once("../controlador/historiales.controlador.php");
    require_once("../modelo/historiales.modelo.php");
    
   

    class AjaxHistoriales{

    /* -------------------------------------------------------------------------- */
    /*                               EDITAR HISTORIAL                               */
    /* -------------------------------------------------------------------------- */

    public $idHistorial;

    public function ajax_editarHistorial(){

        $item = "id_paciente";

        $valor = $this -> idHistorial;


        $respuesta = ControladorHistoriales::ctr_mostrarHistoriales($item, $valor);

        echo json_encode($respuesta);

    }


 

}


/* -------------------------------------------------------------------------- */
/*                               EDITAR HISTORIAL                               */
/* -------------------------------------------------------------------------- */

if(isset($_POST["idHistorial"])){

    $editar = new AjaxHistoriales();

    $editar -> idHistorial = $_POST["idHistorial"];

    $editar -> ajax_editarHistorial();

}

















