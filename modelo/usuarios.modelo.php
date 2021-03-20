<?php


class ModeloUsuarios{

    /* -------------------------------------------------------------------------- */
    /*                              MOSTRAR USUARIOS                              */
    /* -------------------------------------------------------------------------- */
    static public function mdl_mostrarUsuarios($tabla, $item, $valor){

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
    /*                              CREAR USUARIOS                                */
    /* -------------------------------------------------------------------------- */
    static public function mdl_ingresarUsuario($tabla, $datos){

        require("conexion.php");

        $sql = "INSERT INTO $tabla (nombre, apellidos, usuario, password, dni, email,  perfil, nacimiento, provincia, localidad, domicilio, civil, foto)  VALUES (:Nombre, :Apellidos, :Usuario, :Password, :Dni, :Email, :Perfil, :Nacimiento, :Provincia, :Localidad, :Domicilio, :Civil, :Foto)";

        $stmt = $conexion -> prepare($sql);

        $stmt -> bindParam(":Nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":Apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt -> bindParam(":Usuario", $datos["usuario"], PDO::PARAM_STR);
        $stmt -> bindParam(":Password", $datos["contrasena"], PDO::PARAM_STR);
        $stmt -> bindParam(":Dni", $datos["dni"], PDO::PARAM_STR);
        $stmt -> bindParam(":Email", $datos["email"], PDO::PARAM_STR);
        $stmt -> bindParam(":Perfil", $datos["perfil"], PDO::PARAM_STR);
        $stmt -> bindParam(":Nacimiento", $datos["nacimiento"], PDO::PARAM_STR);
        $stmt -> bindParam(":Provincia", $datos["provincia"], PDO::PARAM_STR);
        $stmt -> bindParam(":Localidad", $datos["localidad"], PDO::PARAM_STR);
        $stmt -> bindParam(":Domicilio", $datos["domicilio"], PDO::PARAM_STR);
        $stmt -> bindParam(":Civil", $datos["civil"], PDO::PARAM_STR);
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
    /*                               EDITAR USUARIOS                              */
    /* -------------------------------------------------------------------------- */

    static public function mdl_editarUsuario($tabla, $datos){

        require("conexion.php");

        $stmt = $conexion->prepare("UPDATE $tabla SET nombre = :nombre, apellidos = :apellidos, password = :password, dni = :dni, email = :email, perfil = :perfil, nacimiento = :nacimiento, provincia = :provincia, localidad = :localidad, domicilio = :domicilio, civil = :civil, foto = :foto WHERE usuario = :usuario");

        $stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt -> bindParam(":apellidos", $datos["apellidos"], PDO::PARAM_STR);
        $stmt -> bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt -> bindParam(":dni", $datos["dni"], PDO::PARAM_STR);
        $stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt -> bindParam(":perfil", $datos["perfil"], PDO::PARAM_STR);
        $stmt -> bindParam(":nacimiento", $datos["nacimiento"], PDO::PARAM_STR);
        $stmt -> bindParam(":provincia", $datos["provincia"], PDO::PARAM_STR);
        $stmt -> bindParam(":localidad", $datos["localidad"], PDO::PARAM_STR);
        $stmt -> bindParam(":domicilio", $datos["domicilio"], PDO::PARAM_STR);
        $stmt -> bindParam(":civil", $datos["civil"], PDO::PARAM_STR);
		$stmt -> bindParam(":foto", $datos["foto"], PDO::PARAM_STR);
		$stmt -> bindParam(":usuario", $datos["usuario"], PDO::PARAM_STR);


        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";
        }


        $stmt -> close(); 

        $stmt = null;

    }



    /* -------------------------------------------------------------------------- */
    /*                             ACTUALIZAR USUARIO                             */
    /* -------------------------------------------------------------------------- */

    static public function mdl_actualizarUsuario($tabla, $item1, $valor1, $item2, $valor2){

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
    /*                               BORRAR USUARIOS                              */
    /* -------------------------------------------------------------------------- */

    static public function mdl_borrarUsuario($tabla, $datos){

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



    static function mdl_cargarUsuario_porEmail($email){

        require("conexion.php");
    
        //$sql = "SELECT usuario from usuarios where email = :email";
        
        $stmt = $conexion -> prepare("SELECT usuario from usuarios where email = :email");

        $stmt -> bindParam(":email", $email, PDO::PARAM_STR);

        if ($stmt -> execute()){

            $fila = $stmt -> fetch();

            return $fila["usuario"];

        }else {
            return "error";
        }


        $stmt -> close(); 

        $stmt = null;
		
    }
    


    static function mdl_existeUsuario($login_usuario){

        require("conexion.php");

        $sql = "SELECT usuario from usuarios where usuario = :usuario";
        
        $stmt = $conexion -> prepare($sql);

        $stmt -> bindParam(":usuario", $login_usuario, PDO::PARAM_STR);

        if ($stmt -> execute()){

            $fila = $stmt -> fetch();

            return $fila["usuario"];

        }else {
            return "error";
        }


        $stmt -> close(); 

        $stmt = null;
		 
		
 	
    }
    

    static function mdl_editarContrasena($usuario, $contrasena){  //cambiar contraseña
	
        require("conexion.php");
        
		$sql = "UPDATE usuarios SET password= :contrasena where usuario= :usuario";
        
        $stmt = $conexion -> prepare($sql);

        $stmt -> bindParam(":contrasena", $contrasena, PDO::PARAM_STR);

        $stmt -> bindParam(":usuario", $usuario, PDO::PARAM_STR);

        if($stmt -> execute()){

            return "ok";

        }else{

            return "error";
        }


        $stmt -> close(); 

        $stmt = null;
		
		
	
	}


}
