<?php

    require_once("../controlador/curas.controlador.php");
    require_once("../modelo/curas.modelo.php");
    
   

    class AjaxCuras{

    /* -------------------------------------------------------------------------- */
    /*                               EDITAR CURAS                               */
    /* -------------------------------------------------------------------------- */

    public $idCura;

    public function ajax_editarCura(){

        $item = "id";

        $valor = $this -> idCura;


        $respuesta = ControladorCuras::ctr_mostrarCuras($item, $valor);

        echo json_encode($respuesta);

    }


 

}


/* -------------------------------------------------------------------------- */
/*                               EDITAR CURAS                               */
/* -------------------------------------------------------------------------- */

if(isset($_POST["idCura"])){

    $editar = new AjaxCuras();

    $editar -> idCura = $_POST["idCura"];

    $editar -> ajax_editarCura();

}

















