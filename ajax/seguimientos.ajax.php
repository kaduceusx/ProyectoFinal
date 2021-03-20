<?php

    require_once("../controlador/seguimientos.controlador.php");
    require_once("../modelo/seguimientos.modelo.php");
    
   

    class AjaxSeguimientos{

    /* -------------------------------------------------------------------------- */
    /*                               EDITAR HISTORIAL                               */
    /* -------------------------------------------------------------------------- */

    public $idSeguimiento;

    public function ajax_editarSeguimiento(){

        $item = "id";

        $valor = $this -> idSeguimiento;


        $respuesta = ControladorSeguimientos::ctr_mostrarSeguimientos($item, $valor);

        echo json_encode($respuesta);

    }


 

}


/* -------------------------------------------------------------------------- */
/*                               EDITAR HISTORIAL                               */
/* -------------------------------------------------------------------------- */

if(isset($_POST["idSeguimiento"])){

    $editar = new AjaxSeguimientos();

    $editar -> idSeguimiento = $_POST["idSeguimiento"];

    $editar -> ajax_editarSeguimiento();

}

















