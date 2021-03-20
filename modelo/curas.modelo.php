<?php


class ModeloCuras{


    /* -------------------------------------------------------------------------- */
    /*                              MOSTRAR CURAS                              */
    /* -------------------------------------------------------------------------- */
    static public function mdl_mostrarCuras($tabla, $item, $valor){

        require("conexion.php");

        if($item != null){


            $sql = "SELECT pa.id, pa.fechaCura as fechaCura,  p.paciente as id_paciente, pa.cura as cura
            FROM  $tabla pa
            LEFT JOIN pacientes p ON p.id = pa.id_paciente
            
            WHERE pa.$item= :$item";

            //$sql = "select * from $tabla where $item = :$item";
      
           

            $stmt = $conexion -> prepare($sql);

            $stmt -> bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        }else{

            $sql = "SELECT pa.id, pa.fechaCura as fechaCura,  p.paciente as id_paciente, pa.cura as cura
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
    /*                              CREAR CURA                                */
    /* -------------------------------------------------------------------------- */
    static public function mdl_crearCura($tabla, $datos){

        require("conexion.php");

      
         $stmt = $conexion -> prepare("INSERT INTO $tabla (cura, fechaCura, id_paciente) 
        VALUES ( :cura, :fechaCura,
            (SELECT id FROM pacientes WHERE paciente = :nombre_paciente))");


        $stmt -> bindParam(":nombre_paciente", $datos["id_paciente"], PDO::PARAM_STR);
        $stmt -> bindParam(":cura", $datos["cura"], PDO::PARAM_STR);
        $stmt -> bindParam(":fechaCura", $datos["fechaCura"], PDO::PARAM_STR);
       

         
        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";
        }
     


        $stmt -> close(); 

        $stmt = null;

       


    }


    /* -------------------------------------------------------------------------- */
    /*                COMPROBAR PACIENTE REPETIDO EN CURAS                    */
    /* -------------------------------------------------------------------------- */
    static public function mdl_comprobarCura($paciente){

        require("conexion.php");

      
        $sql = "SELECT * FROM curas WHERE id_paciente =(SELECT id FROM pacientes WHERE paciente = :nombre_paciente) ";
        

            $stmt = $conexion -> prepare($sql);

         
            $stmt -> bindParam(":nombre_paciente", $paciente, PDO::PARAM_STR);
           

            if ($stmt -> execute()){

                $fila = $stmt -> fetch();
    
                return $fila["id_paciente"];
    
            }else {
                return "error";
            }

            //return $stmt -> fetchAll();



         
        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";
        }
     


        $stmt -> close(); 

        $stmt = null;

       


    }


  


   


    /* -------------------------------------------------------------------------- */
    /*                           EDITAR CURAS                                     */
    /* -------------------------------------------------------------------------- */
    static public function mdl_editarCura($tabla, $datos){

        require("conexion.php");


       
        
            $stmt = $conexion -> prepare("UPDATE $tabla SET  fechaCura = :fechaCura, cura = :cura, id_paciente = (SELECT id FROM pacientes WHERE paciente=:nombre_paciente)
            WHERE id = :id");

            $stmt -> bindParam(":cura", $datos["cura"], PDO::PARAM_STR);
            $stmt -> bindParam(":fechaCura", $datos["fechaCura"], PDO::PARAM_STR);
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





    /* -------------------------------------------------------------------------- */
    /*                               BORRAR CURA                              */
    /* -------------------------------------------------------------------------- */

    static public function mdl_borrarCura($tabla, $datos){

        require("conexion.php");

        $sql = "DELETE FROM $tabla where id= :id";

        $stmt = $conexion -> prepare($sql);

        $stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";
        }


        $stmt -> close(); 

        $stmt = null;

    }

   


   





}