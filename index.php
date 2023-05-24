<?php 

include 'Bd/Bd.php';

header('Access-Control-Allow-Origin: *');

if($_SERVER['REQUEST_METHOD']=='GET') {
	if (isset($_GET['Id'])){
		$query="SELECT * FROM frameworks WHERE Id=".$_GET['Id'];
		$resultado=metodoGet($query);
		echo json_encode($resultado->fetch(PDO::FETCH_ASSOC));
	}else{
		$query="SELECT * FROM frameworks";
		$resultado=metodoGet($query);
		echo json_encode($resultado->fetchAll());
	}
	header("HTTP/1.1 200 OK");
	exit();
}

if ($_POST['METHOD']=='POST') {
	unset($_POST['METHOD']);
	$Nombre=$_POST['Nombre'];
	$Lanzamiento=$_POST['Lanzamiento'];
	$Desarrollador=$_POST['Desarrollador'];
	$query="INSERT INTO frameworks (Nombre, Lanzamiento, Desarrollador) VALUES ('$Nombre', '$Lanzamiento', '$Desarrollador')";
	$queryAutoIncrement="SELECT MAX(Id) as Id from frameworks";
	$resultado=metodoPost($query, $queryAutoIncrement);
	echo json_encode($resultado);
	header("HTTP/1.1 200 OK");
	exit();
}

if ($_POST['METHOD']=='PUT'){
	unset($_POST['METHOD']);
	$Id=$_GET['Id'];
	$Nombre=$_POST['Nombre'];
	$Lanzamiento=$_POST['Lanzamiento'];
	$Desarrollador=$_POST['Desarrollador'];
	$query="UPDATE frameworks SET Nombre='$Nombre', Lanzamiento='$Lanzamiento', Desarrollador='$Desarrollador' WHERE Id='$Id'";
	$resultado=metodoPut($query);
	echo json_encode($resultado);
	header("http/1.1 200 OK");
	exit();
}

if ($_POST['METHOD']=='DELETE'){
	unset($_POST['METHOD']);
	$Id=$_GET['Id'];
	$query="DELETE FROM frameworks WHERE Id='$Id'";
	$resultado=metodoDelete($query);
	echo json_encode($resultado);
	header("HTTP/1.1 200 OK");
	exit();
}

header("HTTP/1.1 400 Bad Request");


 ?>