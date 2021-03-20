<?php


class ModeloPacientes{


    /* -------------------------------------------------------------------------- */
    /*                              MOSTRAR PACIENTES                              */
    /* -------------------------------------------------------------------------- */
    static public function mdl_mostrarPacientes($tabla, $item, $valor){

        require("conexion.php");

        if($item != null){


            $sql="SELECT * FROM $tabla where $item= :$item";

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
    /*                              CREAR PACIENTES                                */
    /* -------------------------------------------------------------------------- */
    static public function mdl_ingresarPaciente($tabla, $datos){

        require("conexion.php");

        $sql = "INSERT INTO $tabla (paciente, sip, dni, nuss, familiar, nacimiento, provincia, localidad, domicilio, civil, genero, ingreso, foto)  
        VALUES ( :Paciente, :Sip, :Dni, :Nuss, :Familiar, :Nacimiento, :Provincia, :Localidad, :Domicilio, :Civil, :Genero, :Ingreso, :Foto)";

        $stmt = $conexion -> prepare($sql);

        $stmt -> bindParam(":Paciente", $datos["paciente"], PDO::PARAM_STR); 
        $stmt -> bindParam(":Sip", $datos["sip"], PDO::PARAM_STR);
        $stmt -> bindParam(":Dni", $datos["dni"], PDO::PARAM_STR);
        $stmt -> bindParam(":Nuss", $datos["nuss"], PDO::PARAM_STR);
        $stmt -> bindParam(":Familiar", $datos["familiar"], PDO::PARAM_STR);
        $stmt -> bindParam(":Nacimiento", $datos["nacimiento"], PDO::PARAM_STR);
        $stmt -> bindParam(":Provincia", $datos["provincia"], PDO::PARAM_STR);
        $stmt -> bindParam(":Localidad", $datos["localidad"], PDO::PARAM_STR);
        $stmt -> bindParam(":Domicilio", $datos["domicilio"], PDO::PARAM_STR);
        $stmt -> bindParam(":Civil", $datos["civil"], PDO::PARAM_STR);
        $stmt -> bindParam(":Genero", $datos["genero"], PDO::PARAM_STR);
        $stmt -> bindParam(":Ingreso", $datos["ingreso"], PDO::PARAM_STR);
        $stmt -> bindParam(":Foto", $datos["foto"], PDO::PARAM_STR);

        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";
        }


        $stmt -> close(); 

        $stmt = null;

       


    }


    /* -------------------------------------------------------------------------- */
    /*                               EDITAR PACIENTES                              */
    /* -------------------------------------------------------------------------- */

    static public function mdl_editarPaciente($tabla, $datos){

        require("conexion.php");

        $stmt = $conexion -> prepare("UPDATE $tabla SET paciente = :paciente, sip = :sip, dni = :dni, nuss = :nuss, familiar = :familiar, nacimiento = :nacimiento, provincia = :provincia, localidad = :localidad, domicilio = :domicilio, civil = :civil, genero = :genero, ingreso = :ingreso, foto = :foto WHERE id = :id");

        $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);
        $stmt -> bindParam(":paciente", $datos["paciente"], PDO::PARAM_STR);
        $stmt -> bindParam(":sip", $datos["sip"], PDO::PARAM_STR);
        $stmt -> bindParam(":dni", $datos["dni"], PDO::PARAM_STR);
        $stmt -> bindParam(":nuss", $datos["nuss"], PDO::PARAM_STR);
        $stmt -> bindParam(":familiar", $datos["familiar"], PDO::PARAM_STR);
        $stmt -> bindParam(":nacimiento", $datos["nacimiento"], PDO::PARAM_STR);
        $stmt -> bindParam(":provincia", $datos["provincia"], PDO::PARAM_STR);
        $stmt -> bindParam(":localidad", $datos["localidad"], PDO::PARAM_STR);
        $stmt -> bindParam(":domicilio", $datos["domicilio"], PDO::PARAM_STR);
        $stmt -> bindParam(":civil", $datos["civil"], PDO::PARAM_STR);
        $stmt -> bindParam(":genero", $datos["genero"], PDO::PARAM_STR);
        $stmt -> bindParam(":ingreso", $datos["ingreso"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		


        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";
        }


        $stmt -> close(); 

        $stmt = null;

    }


    /* -------------------------------------------------------------------------- */
    /*                           EDITAR PACIENTE MEDICO                           */
    /* -------------------------------------------------------------------------- */
    static public function mdl_editarPaciente_medico($tabla, $datos){

        require("conexion.php");

        $stmt = $conexion -> prepare("UPDATE $tabla SET paciente = :paciente, demencia = :demencia, cronica = :cronica, alergias = :alergias, suplementos = :suplementos, situacion = :situacion WHERE id = :id");

        $stmt -> bindParam(":id", $datos["id"], PDO::PARAM_STR);
        $stmt -> bindParam(":paciente", $datos["paciente"], PDO::PARAM_STR);
       
       
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
    /*                             ACTUALIZAR PACIENTE                             */
    /* -------------------------------------------------------------------------- */

    static public function mdl_actualizarPaciente($tabla, $item1, $valor1, $item2, $valor2){

        require("conexion.php");

        $stmt = $conexion -> prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

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
    /*                               BORRAR PACIENTES                              */
    /* -------------------------------------------------------------------------- */

    static public function mdl_borrarPaciente($tabla, $datos){

        require("conexion.php");

        $sql = "DELETE FROM $tabla where id= :id AND estado=0";//estado 0 de baja.

        $stmt = $conexion -> prepare($sql);

        $stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

        

        $stmt -> execute();

        //$filas=$stmt->columnCount();

        $filas=$stmt->rowCount();

        //$filas = $resultado->rowCount();

        if($filas == 0){
            
           return "fallo";
           
        }else if($filas != 0){
            return "ok";
        }else{
            return "error";
        }


        $stmt -> close(); 

        $stmt = null;

    }





}