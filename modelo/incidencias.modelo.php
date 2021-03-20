<?php


class ModeloIncidencias{

   




    /* -------------------------------------------------------------------------- */
    /*                              ENVIAR INCIDENCIAS                                */
    /* -------------------------------------------------------------------------- */
    static public function mdl_enviarIncidencia($tabla, $datos){

        require("conexion.php");

        $sql = "INSERT INTO $tabla (fechaIncidencia, nombreIncidencia, id_usuario)  VALUES (:fechaIncidencia, :nombreIncidencia, :id_usuario)";

        $stmt = $conexion -> prepare($sql);

        $stmt -> bindParam(":nombreIncidencia", $datos["nombreIncidencia"], PDO::PARAM_STR);
       
        $stmt -> bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
       
        $stmt -> bindParam(":fechaIncidencia", $datos["fechaIncidencia"], PDO::PARAM_STR);
       

        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";
        }


        $stmt -> close(); 

        $stmt = null;

       


    }




}
