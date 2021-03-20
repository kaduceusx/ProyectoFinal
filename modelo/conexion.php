<?php




//Si se hubiese hecho conexion orientada a objetos por el tema de la clase me hubiese hecho falta hacer una conexion por cada modelo. Asi que conexion directa.


//hostinguer
// $hostna = "localhost";
// $dns = "mysql:host=localhost;dbname=u610787214_geriatry_salut";
// $usu = "u610787214_administrador";
// $pass = "8a]]U]&8!J";

$hostna = "localhost";
$dns = "mysql:host=localhost;dbname=geriatry_salut";
$usu = "admin_fesergry";
$pass = "admin_Fesergry";




try{
	$conexion = new PDO ($dns, $usu, $pass);
	
	$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	$conexion->exec("SET CHARACTER SET UTF8");
	
}catch(Exception $e){
	echo "El error es: " . $e->getMessage();
}
?>