<?php

    require_once("../controlador/pacientes.controlador.php");
    require_once("../modelo/pacientes.modelo.php");
    
   

    class AjaxIngreso{

    





    /* -------------------------------------------------------------------------- */
    /*                               ACTIVAR INGRESO HOSPITAL                              */
    /* -------------------------------------------------------------------------- */

    public $activarIngreso;
    public $activarId;

    public function ajax_activarIngreso(){

        $tabla = "pacientes";

        $item1 = "ingreso_hospital";

        $valor1 = $this -> activarIngreso;

        $item2 = "id";

        $valor2 = $this -> activarId;

        $respuesta = ModeloPacientes::mdl_actualizarPaciente($tabla, $item1, $valor1, $item2, $valor2);

    }


   


}




/* -------------------------------------------------------------------------- */
/*                               ACTIVAR PACIENTE                               */
/* -------------------------------------------------------------------------- */

if(isset($_POST["activarIngreso"])){

    $activarIngreso = new AjaxIngreso();

    $activarIngreso -> activarIngreso = $_POST["activarIngreso"];

    $activarIngreso -> activarId = $_POST["activarId"];

    $activarIngreso -> ajax_activarIngreso();

    
}



