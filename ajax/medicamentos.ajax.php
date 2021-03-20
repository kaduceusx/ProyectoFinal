<?php

    require_once("../controlador/medicamentos.controlador.php");
    require_once("../modelo/medicamentos.modelo.php");
    
   

    class AjaxMedicamentos{

    /* -------------------------------------------------------------------------- */
    /*                               EDITAR MEDICAMENTO                               */
    /* -------------------------------------------------------------------------- */

    public $idMedicamento;

    public function ajax_editarMedicamento(){

        $item = "id_paciente";

        $valor = $this -> idMedicamento;


        $respuesta = ControladorMedicamentos::ctr_mostrarMedicamentos($item, $valor);

        echo json_encode($respuesta);

    }



    
}


/* -------------------------------------------------------------------------- */
/*                               EDITAR MEDICAMENTO                               */
/* -------------------------------------------------------------------------- */

if(isset($_POST["idMedicamento"])){

    $editar = new AjaxMedicamentos();

    $editar -> idMedicamento = $_POST["idMedicamento"];

    $editar -> ajax_editarMedicamento();

}


























