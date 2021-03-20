<?php

    require_once("../controlador/pacientes.controlador.php");
    require_once("../modelo/pacientes.modelo.php");
    
   

    class AjaxPacientes{

    /* -------------------------------------------------------------------------- */
    /*                               EDITAR PACIENTE                               */
    /* -------------------------------------------------------------------------- */

    public $idPaciente;

    public function ajax_editarPaciente(){

        $item = "id";

        $valor = $this -> idPaciente;


        $respuesta = ControladorPacientes::ctr_mostrarPacientes($item, $valor);

        echo json_encode($respuesta);

    }





    /* -------------------------------------------------------------------------- */
    /*                               ACTIVAR PACIENTE                              */
    /* -------------------------------------------------------------------------- */

    public $activarPaciente;
    public $activarId;

    public function ajax_activarPaciente(){

        $tabla = "pacientes";

        $item1 = "estado";

        $valor1 = $this -> activarPaciente;

        $item2 = "id";

        $valor2 = $this -> activarId;

        $respuesta = ModeloPacientes::mdl_actualizarPaciente($tabla, $item1, $valor1, $item2, $valor2);

    }


    /* -------------------------------------------------------------------------- */
    /*                         VALIDAR NO REPETIR NOMBRE PACIENTE                         */
    /* -------------------------------------------------------------------------- */

    public $validarPaciente;

    public function ajax_validarPaciente(){

        $item = "paciente";

        $valor = $this -> validarPaciente;

        $respuesta = ControladorPacientes::ctr_mostrarPacientes($item, $valor);

        echo json_encode($respuesta);

    }



}


/* -------------------------------------------------------------------------- */
/*                               EDITAR PACIENTE                               */
/* -------------------------------------------------------------------------- */

if(isset($_POST["idPaciente"])){

    $editar = new AjaxPacientes();

    $editar -> idPaciente = $_POST["idPaciente"];

    $editar -> ajax_editarPaciente();

}





/* -------------------------------------------------------------------------- */
/*                               ACTIVAR PACIENTE                               */
/* -------------------------------------------------------------------------- */

if(isset($_POST["activarPaciente"])){

    $activarPaciente = new AjaxPacientes();

    $activarPaciente -> activarPaciente = $_POST["activarPaciente"];

    $activarPaciente -> activarId = $_POST["activarId"];

    $activarPaciente -> ajax_activarPaciente();

    
}



/* -------------------------------------------------------------------------- */
/*                         VALIDAR NO REPETIR PACIENTE                         */
/* -------------------------------------------------------------------------- */

if(isset($_POST["validarPaciente"])){

    $valPaciente = new AjaxPacientes();

    $valPaciente -> validarPaciente = $_POST["validarPaciente"];

    $valPaciente -> ajax_validarPaciente();

}

