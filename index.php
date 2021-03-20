<?php


require_once("controlador/plantilla.controlador.php");
require_once("controlador/usuarios.controlador.php");
require_once("controlador/pacientes.controlador.php");
require_once("controlador/historiales.controlador.php");
require_once("controlador/seguimientos.controlador.php");
require_once("controlador/curas.controlador.php");
require_once("controlador/medicamentos.controlador.php");
require_once("controlador/incidencias_admin.controlador.php");
require_once("controlador/incidencias.controlador.php");


require_once("modelo/usuarios.modelo.php");
require_once("modelo/pacientes.modelo.php");
require_once("modelo/historiales.modelo.php");
require_once("modelo/seguimientos.modelo.php");
require_once("modelo/curas.modelo.php");
require_once("modelo/medicamentos.modelo.php");
require_once("modelo/incidencias_admin.modelo.php");
require_once("modelo/incidencias.modelo.php");




$plantilla = new ControladorPlantilla();
$plantilla -> ctr_plantilla();