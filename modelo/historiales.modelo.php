<?php


class ModeloHistoriales{


    /* -------------------------------------------------------------------------- */
    /*                              MOSTRAR HISTORIALES                              */
    /* -------------------------------------------------------------------------- */
    static public function mdl_mostrarHistoriales($tabla, $item, $valor){

        require("conexion.php");

        if($item != null){


            $sql = "SELECT pa.id,  p.paciente as id_paciente, pa.cirugias as cirugias, pa.resonancias as resonancias
            FROM  $tabla pa
            LEFT JOIN pacientes p ON p.id = pa.id_paciente
            
            WHERE pa.$item= :$item";

            //$sql = "select * from $tabla where $item = :$item";
      
           

            $stmt = $conexion -> prepare($sql);

            $stmt -> bindParam(":" . $item, $valor, PDO::PARAM_STR);

            $stmt -> execute();

            return $stmt -> fetch();

        }else{

            $sql = "SELECT * FROM $tabla";

            $stmt = $conexion -> prepare($sql);

            $stmt -> execute();

            return $stmt -> fetchAll();

        }

        

        $stmt -> close(); //deberia bastar con el return...

        $stmt = null;

    }


    /* -------------------------------------------------------------------------- */
    /*                              CREAR HISTORIAL                                */
    /* -------------------------------------------------------------------------- */
    static public function mdl_crearHistorial($tabla, $datos){

        require("conexion.php");

      
         $stmt = $conexion -> prepare("INSERT INTO $tabla (cirugias, resonancias, id_paciente) 
        VALUES ( :cirugias, :resonancias,
            (SELECT id FROM pacientes WHERE paciente = :nombre_paciente))");


        $stmt -> bindParam(":nombre_paciente", $datos["id_paciente"], PDO::PARAM_STR);
        $stmt -> bindParam(":cirugias", $datos["cirugias"], PDO::PARAM_STR);
        $stmt -> bindParam(":resonancias", $datos["resonancias"], PDO::PARAM_STR);
       

         
        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";
        }
     


        $stmt -> close(); 

        $stmt = null;

       


    }


    /* -------------------------------------------------------------------------- */
    /*                COMPROBAR PACIENTE REPETIDO EN HISTORIAL                    */
    /* -------------------------------------------------------------------------- */
    static public function mdl_comprobarHistorial($paciente){

        require("conexion.php");

      
        $sql = "SELECT * FROM historiales WHERE id_paciente =(SELECT id FROM pacientes WHERE paciente = :nombre_paciente) ";
        

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
    /*                               EDITAR PACIENTE MEDICO                              */
    /* -------------------------------------------------------------------------- */

    static public function mdl_editarPaciente_medico($tabla, $datos){

        require("conexion.php");

        $stmt = $conexion -> prepare("UPDATE $tabla SET demencia = :demencia, cronica = :cronica, alergias = :alergias, suplementos = :suplementos, situacion = :situacion WHERE id = :id");

        $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);
      
       
       
        $stmt -> bindParam(":demencia", $datos["demencia"], PDO::PARAM_STR);
        $stmt -> bindParam(":cronica", $datos["cronica"], PDO::PARAM_STR);
        $stmt -> bindParam(":alergias", $datos["alergias"], PDO::PARAM_STR);
        $stmt -> bindParam(":suplementos", $datos["suplementos"], PDO::PARAM_STR);

        $stmt -> bindParam(":situacion", $datos["situacion"], PDO::PARAM_STR);
		
		


        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";
        }


        $stmt -> close(); 

        $stmt = null;

    }


    /* -------------------------------------------------------------------------- */
    /*                           EDICCION DEL HISTORIAL                           */
    /* -------------------------------------------------------------------------- */
    static public function mdl_editarHistorial($tabla, $datos){

        require("conexion.php");


       
        
            $stmt = $conexion -> prepare("UPDATE $tabla SET  cirugias = :cirugias, resonancias = :resonancias, id_paciente = (SELECT id FROM pacientes WHERE paciente=:nombre_paciente)
            WHERE id = :id");

            $stmt -> bindParam(":cirugias", $datos["cirugias"], PDO::PARAM_STR);
            $stmt -> bindParam(":resonancias", $datos["resonancias"], PDO::PARAM_STR);
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