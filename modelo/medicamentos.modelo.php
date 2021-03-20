<?php


class ModeloMedicamentos{


    /* -------------------------------------------------------------------------- */
    /*                              MOSTRAR MEDICAMENTOS                              */
    /* -------------------------------------------------------------------------- */
    static public function mdl_mostrarMedicamentos($tabla, $item, $valor){

        require("conexion.php");

        if($item != null){


            $sql = "SELECT pa.id,  p.paciente as id_paciente, pa.desayuno as desayuno, pa.comida as comida, pa.merienda as merienda, pa.cena as cena, pa.noche as noche
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
    /*                              CREAR MEDICAMENTO                                */
    /* -------------------------------------------------------------------------- */
    static public function mdl_crearMedicamento($tabla, $datos){

        require("conexion.php");

      
         $stmt = $conexion -> prepare("INSERT INTO $tabla (desayuno, comida, merienda, cena, noche, id_paciente) 
        VALUES ( :desayuno, :comida, :merienda, :cena, :noche,
            (SELECT id FROM pacientes WHERE paciente = :nombre_paciente))");


        $stmt -> bindParam(":nombre_paciente", $datos["id_paciente"], PDO::PARAM_STR);
        $stmt -> bindParam(":desayuno", $datos["desayuno"], PDO::PARAM_STR);
        $stmt -> bindParam(":comida", $datos["comida"], PDO::PARAM_STR);
        $stmt -> bindParam(":merienda", $datos["merienda"], PDO::PARAM_STR);
        $stmt -> bindParam(":noche", $datos["noche"], PDO::PARAM_STR);
        $stmt -> bindParam(":cena", $datos["cena"], PDO::PARAM_STR);
       

         
        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";
        }
     


        $stmt -> close(); 

        $stmt = null;

       


    }


    /* -------------------------------------------------------------------------- */
    /*                COMPROBAR PACIENTE REPETIDO CON MEDICAMENTO                    */
    /* -------------------------------------------------------------------------- */
    static public function mdl_comprobarMedicamento($paciente){

        require("conexion.php");

      
        $sql = "SELECT * FROM medicamentos WHERE id_paciente =(SELECT id FROM pacientes WHERE paciente = :nombre_paciente) ";
        

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
    /*                           EDITAR MEDICAMENTO                           */
    /* -------------------------------------------------------------------------- */
    static public function mdl_editarMedicamento($tabla, $datos){

        require("conexion.php");


       
        
            $stmt = $conexion -> prepare("UPDATE $tabla SET  desayuno = :desayuno, comida = :comida, merienda = :merienda, cena = :cena, noche = :noche, id_paciente = (SELECT id FROM pacientes WHERE paciente=:nombre_paciente)
            WHERE id = :id");

            $stmt -> bindParam(":desayuno", $datos["desayuno"], PDO::PARAM_STR);
            $stmt -> bindParam(":comida", $datos["comida"], PDO::PARAM_STR);
            $stmt -> bindParam(":merienda", $datos["merienda"], PDO::PARAM_STR);
            $stmt -> bindParam(":cena", $datos["cena"], PDO::PARAM_STR);
            $stmt -> bindParam(":noche", $datos["noche"], PDO::PARAM_STR);
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
    /*                           COMPROBAR MEDICAMENTO                           */
    /* -------------------------------------------------------------------------- */
    static public function mdl_comprobarMedicamento_enfermero($tabla, $datos){

        require("conexion.php");


       
        
            $stmt = $conexion -> prepare("UPDATE $tabla SET  comp_desayuno = :comp_desayuno, comp_comida = :comp_comida, comp_merienda = :comp_merienda, comp_cena = :comp_cena, comp_noche = :comp_noche, id_paciente = (SELECT id FROM pacientes WHERE paciente=:nombre_paciente)
            WHERE id = :id");

            $stmt -> bindParam(":comp_desayuno", $datos["comp_desayuno"], PDO::PARAM_STR);
            $stmt -> bindParam(":comp_comida", $datos["comp_comida"], PDO::PARAM_STR);
            $stmt -> bindParam(":comp_merienda", $datos["comp_merienda"], PDO::PARAM_STR);
            $stmt -> bindParam(":comp_cena", $datos["comp_cena"], PDO::PARAM_STR);
            $stmt -> bindParam(":comp_noche", $datos["comp_noche"], PDO::PARAM_STR);
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