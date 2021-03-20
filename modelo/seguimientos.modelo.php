<?php


class ModeloSeguimientos{


    /* -------------------------------------------------------------------------- */
    /*                              MOSTRAR SEGUIMIENTO                              */
    /* -------------------------------------------------------------------------- */
    static public function mdl_mostrarSeguimientos($tabla, $item, $valor){

        require("conexion.php");

        if($item != null){


            $sql = "SELECT pa.id, pa.fechaSeguimiento as fechaSeguimiento, p.paciente as id_paciente, pa.ingesta as ingesta, pa.miccion as miccion, pa.defecacion as defecacion
            FROM  $tabla pa
            LEFT JOIN pacientes p ON p.id = pa.id_paciente
            
            WHERE pa.$item= :$item";

            //$sql = "select * from $tabla where $item = :$item";
      
           

            $stmt = $conexion -> prepare($sql);

            $stmt -> bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            $fila = $stmt -> fetch();
    
            return $fila;

            //return $stmt -> fetch();

        }else{

            $sql = "SELECT pa.id, pa.fechaSeguimiento as fechaSeguimiento,  p.paciente as id_paciente, pa.ingesta as ingesta, pa.miccion as miccion, pa.defecacion as defecacion
            FROM  $tabla pa
            LEFT JOIN pacientes p ON p.id = pa.id_paciente";

            $stmt = $conexion -> prepare($sql);

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

        

        $stmt -> close(); //deberia bastar con el return...

        $stmt = null;

    }


    /* -------------------------------------------------------------------------- */
    /*                              CREAR SEGUIMIENTO                                */
    /* -------------------------------------------------------------------------- */
    static public function mdl_crearSeguimiento($tabla, $datos){

        require("conexion.php");

      
         $stmt = $conexion -> prepare("INSERT INTO $tabla (fechaSeguimiento, ingesta, miccion, defecacion, id_paciente) 
        VALUES (:fechaSeguimiento, :ingesta, :miccion, :defecacion,
            (SELECT id FROM pacientes WHERE paciente = :nombre_paciente))");


        $stmt -> bindParam(":nombre_paciente", $datos["id_paciente"], PDO::PARAM_STR);
        $stmt -> bindParam(":fechaSeguimiento", $datos["fechaSeguimiento"], PDO::PARAM_STR);
        $stmt -> bindParam(":ingesta", $datos["ingesta"], PDO::PARAM_STR);
        $stmt -> bindParam(":miccion", $datos["miccion"], PDO::PARAM_STR);
        $stmt -> bindParam(":defecacion", $datos["defecacion"], PDO::PARAM_STR);
       

         
        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";
        }
     


        $stmt -> close(); 

        $stmt = null;

       


    }


  




    /* -------------------------------------------------------------------------- */
    /*                           EDICCION DEL SEGUIMIENTO                           */
    /* -------------------------------------------------------------------------- */
    static public function mdl_editarSeguimiento($tabla, $datos){

        require("conexion.php");


        $stmt = $conexion -> prepare("UPDATE $tabla SET fechaSeguimiento = :fechaSeguimiento,  ingesta = :ingesta, miccion = :miccion, defecacion = :defecacion, id_paciente = (SELECT id FROM pacientes WHERE paciente=:nombre_paciente)
        WHERE id = :id");

        $stmt -> bindParam(":fechaSeguimiento", $datos["fechaSeguimiento"], PDO::PARAM_STR);
        $stmt -> bindParam(":ingesta", $datos["ingesta"], PDO::PARAM_STR);
        $stmt -> bindParam(":miccion", $datos["miccion"], PDO::PARAM_STR);
        $stmt -> bindParam(":defecacion", $datos["defecacion"], PDO::PARAM_STR);
        $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);
        $stmt -> bindParam(":nombre_paciente", $datos["id_paciente"], PDO::PARAM_STR);

        
        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";
        }

       
        $stmt -> close(); 

        $stmt = null;
    }

   


   





}