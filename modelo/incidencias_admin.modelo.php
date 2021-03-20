<?php


class ModeloIncidenciasAdmin{

    /* -------------------------------------------------------------------------- */
    /*                              MOSTRAR INCIDENCIAS                              */
    /* -------------------------------------------------------------------------- */
    static public function mdl_mostrarIncidenciasAdmin($tabla, $item, $valor){

        require("conexion.php");

        if($item != null){

            $sql="SELECT * FROM $tabla where $item= :$item";

            $stmt = $conexion -> prepare($sql);

            $stmt -> bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        }else{

            $sql = "SELECT pa.id, pa.fechaIncidencia, pa.nombreIncidencia, p.nombre as id_nombre, p.apellidos as id_apellidos, p.usuario as id_usuario, p.perfil as id_perfil, p.email as id_email, pa.estadoIncidencia
            FROM  $tabla pa
            LEFT JOIN usuarios p ON p.id = pa.id_usuario";

            $stmt = $conexion -> prepare($sql);

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

        

        $stmt -> close(); //deberia bastar con el return...

        $stmt = null;

    }





    /* -------------------------------------------------------------------------- */
    /*                             ACTUALIZAR INCIDENCCIA                             */
    /* -------------------------------------------------------------------------- */

    static public function mdl_actualizarIncidenciaAdmin($tabla, $item1, $valor1, $item2, $valor2){

        require("conexion.php");

        $stmt = $conexion->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

        $stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
        $stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

        
        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";
        }


        $stmt -> close(); 

        $stmt = null;


    }


    /* -------------------------------------------------------------------------- */
    /*                               BORRAR INCIDENCIA                              */
    /* -------------------------------------------------------------------------- */

    static public function mdl_borrarIncidenciaAdmin(){

        require("conexion.php");

        $sql = "DELETE FROM incidencias WHERE estadoIncidencia= 1";

        $stmt = $conexion -> prepare($sql);



        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";
        }


        $stmt -> close(); 

        $stmt = null;

    }



 


}
