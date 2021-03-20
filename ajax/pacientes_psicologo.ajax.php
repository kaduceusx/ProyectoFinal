<?php

    require_once("../controlador/pacientes.controlador.php");
    require_once("../modelo/pacientes.modelo.php");
    
   

    class AjaxPsicologo{

  
    /* -------------------------------------------------------------------------- */
    /*                          ACTIVAR  ESCALA BARTHEL                           */
    /* -------------------------------------------------------------------------- */

    public $activarEscala_barthel;
    public $activarIdEscala_barthel;

    public function ajax_activarEscala_barthel(){

        $tabla = "pacientes";

        $item1 = "escala_barthel";

        $valor1 = $this -> activarEscala_barthel;

        $item2 = "id";

        $valor2 = $this -> activarIdEscala_barthel;

        $respuesta = ModeloPacientes::mdl_actualizarPaciente($tabla, $item1, $valor1, $item2, $valor2);

    }



    /* -------------------------------------------------------------------------- */
    /*                         ACTIVAR INDICEN LAWTON BRODY                       */
    /* -------------------------------------------------------------------------- */

    public $activarIndice_lawton_brody;
    public $activarIdIndice_lawton_brody;

    public function ajax_activarIndice_lawton_brody(){

        $tabla = "pacientes";

        $item1 = "indice_lawton_brody";

        $valor1 = $this -> activarIndice_lawton_brody;

        $item2 = "id";

        $valor2 = $this -> activarIdIndice_lawton_brody;

        $respuesta = ModeloPacientes::mdl_actualizarPaciente($tabla, $item1, $valor1, $item2, $valor2);

    }


    
    /* -------------------------------------------------------------------------- */
    /*                      ACTIVAR TEST RELOJ SHULMAN                            */
    /* -------------------------------------------------------------------------- */

    public $activarTest_reloj_shulman;
    public $activarIdTest_reloj_shulman;

    public function ajax_activarTest_reloj_shulman(){

        $tabla = "pacientes";

        $item1 = "test_reloj_shulman";

        $valor1 = $this -> activarTest_reloj_shulman;

        $item2 = "id";

        $valor2 = $this -> activarIdTest_reloj_shulman;

        $respuesta = ModeloPacientes::mdl_actualizarPaciente($tabla, $item1, $valor1, $item2, $valor2);

    }



    /* -------------------------------------------------------------------------- */
    /*                      ACTIVAR ESCALA DEPRESION YESAVAGE                     */
    /* -------------------------------------------------------------------------- */

    public $activarEscala_depresion_yesavage;
    public $activarIdEscala_depresion_yesavage;

    public function ajax_activarEscala_depresion_yesavage(){

        $tabla = "pacientes";

        $item1 = "escala_depresion_yesavage";

        $valor1 = $this -> activarEscala_depresion_yesavage;

        $item2 = "id";

        $valor2 = $this -> activarIdEscala_depresion_yesavage;

        $respuesta = ModeloPacientes::mdl_actualizarPaciente($tabla, $item1, $valor1, $item2, $valor2);

    }




   


}




/* -------------------------------------------------------------------------- */
/*                               ACTIVAR ESCALA BARTEL                         */
/* -------------------------------------------------------------------------- */

if(isset($_POST["activarEscala_barthel"])){

    $activarEscala_barthel = new AjaxPsicologo();

    $activarEscala_barthel -> activarEscala_barthel = $_POST["activarEscala_barthel"];

    $activarEscala_barthel -> activarIdEscala_barthel = $_POST["activarIdEscala_barthel"];

    $activarEscala_barthel -> ajax_activarEscala_barthel();

    
}


/* -------------------------------------------------------------------------- */
/*                      ACTIVAR INDICE LAWTON Y BRODY                         */
/* -------------------------------------------------------------------------- */

if(isset($_POST["activarIndice_lawton_brody"])){

    $activarIndice_lawton_brody = new AjaxPsicologo();

    $activarIndice_lawton_brody -> activarIndice_lawton_brody = $_POST["activarIndice_lawton_brody"];

    $activarIndice_lawton_brody -> activarIdIndice_lawton_brody = $_POST["activarIdIndice_lawton_brody"];

    $activarIndice_lawton_brody -> ajax_activarIndice_lawton_brody();

    
}



/* -------------------------------------------------------------------------- */
/*                      ACTIVAR TEST RELOJ SHULMAN                           */
/* -------------------------------------------------------------------------- */

if(isset($_POST["activarTest_reloj_shulman"])){

    $activarTest_reloj_shulman = new AjaxPsicologo();

    $activarTest_reloj_shulman -> activarTest_reloj_shulman = $_POST["activarTest_reloj_shulman"];

    $activarTest_reloj_shulman -> activarIdTest_reloj_shulman = $_POST["activarIdTest_reloj_shulman"];

    $activarTest_reloj_shulman -> ajax_activarTest_reloj_shulman();

    
}


/* -------------------------------------------------------------------------- */
/*                      ACTIVAR ESCALA DEPRESION YESAVAGE                     */
/* -------------------------------------------------------------------------- */

if(isset($_POST["activarEscala_depresion_yesavage"])){

    $activarEscala_depresion_yesavage = new AjaxPsicologo();

    $activarEscala_depresion_yesavage -> activarEscala_depresion_yesavage = $_POST["activarEscala_depresion_yesavage"];

    $activarEscala_depresion_yesavage -> activarIdEscala_depresion_yesavage = $_POST["activarIdEscala_depresion_yesavage"];

    $activarEscala_depresion_yesavage -> ajax_activarEscala_depresion_yesavage();

    
}









