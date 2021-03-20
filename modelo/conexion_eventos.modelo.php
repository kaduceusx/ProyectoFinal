
<?php
session_start();
header("Content-Type: application/json");

//hostinguer
// $hostna = "localhost";
// $dns = "mysql:host=localhost;dbname=u610787214_geriatry_salut";
// $usu = "u610787214_administrador";
// $pass = "8a]]U]&8!J";

$hostna = "localhost";
$dns = "mysql:host=localhost;dbname=geriatry_salut";
$usu = "admin_fesergry";
$pass = "admin_Fesergry";

$pdo = new PDO($dns, $usu, $pass);



//condicional ternaria. if reducido.
$accion = (isset($_GET["accion"]))?$_GET["accion"]:"leer";

switch($accion){

    case "agregar":
        //instruccion de agregar

        $sentencia = $pdo -> prepare("INSERT INTO eventos (title, descripcion, color, textColor, start, end, nombre_usuario, perfil_usuario) VALUES (:title, :descripcion, :color, :textColor, :start, :end, :nombre_usuario, :perfil_usuario)");

        $respuesta = $sentencia -> execute(array(

            "title" => $_POST["title"],
            "descripcion" => $_POST["descripcion"],
            "color" => $_POST["color"],
            "textColor" => $_POST["textColor"],
            "start" => $_POST["start"],
            "end" => $_POST["end"],
            "nombre_usuario" => $_POST["nombre_usuario"],
            "perfil_usuario" => $_POST["perfil_usuario"]
        ));
        echo json_encode($respuesta);
        break;


    case "eliminar":
        //intruccion eliminar

        $respuesta = false;

        if (isset($_POST["id"])){

            $sentencia = $pdo -> prepare("DELETE FROM eventos WHERE id= :id AND nombre_usuario = :nombre_usuario");

            $respuesta = $sentencia -> execute(array(

                "id" => $_POST["id"],
                "nombre_usuario" => $_SESSION["nombre"]
            ));

            echo json_encode($respuesta);
                
            break;
    
            
            

            

        }
        


    case "modificar":
        //instrucciones modificar



        $sentencia = $pdo -> prepare("UPDATE eventos SET title = :title, descripcion = :descripcion, color = :color, textColor = :textColor, start = :start, end = :end WHERE id = :id AND nombre_usuario = :nombre_usuario");

        $respuesta = $sentencia -> execute(array(

            "id" => $_POST["id"],
            "title" => $_POST["title"],
            "descripcion" => $_POST["descripcion"],
            "color" => $_POST["color"],
            "textColor" => $_POST["textColor"],
            "start" => $_POST["start"],
            "end" => $_POST["end"],
            "nombre_usuario" => $_SESSION["nombre"]
        ));

       

        echo json_encode($respuesta);

        

        break;

         

       
        


    default:

        //Leer eventos
        
        $sentencia = $pdo -> prepare("SELECT * FROM eventos");
        
        $sentencia -> execute();

        $respuesta = $sentencia -> fetchAll(PDO::FETCH_ASSOC);

        echo json_encode($respuesta);

        break;

}








?>