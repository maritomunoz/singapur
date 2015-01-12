<?php
require("inc/incluidos.php");
require("inc/_asistenciaSesion.php");
$datos = getDatosSesion($_POST["idCurso"], $_POST["numeroSesion"]);


if(!$datos){
	newInformeSesion($_POST);
}else{
	updateInformeSesion($_POST);
}
$datos = getDatosSesion($_POST["idCurso"], $_POST["numeroSesion"]);

$programados="";
$trabajados ="";
$destacados ="";
$debiles ="";
foreach ($_POST as $key => $val) {
	if(substr($key, 0,14)=="numeroCapitulo"){
		$programados.=$val.",";
	}
	if(substr($key, 0,7)=="taller-"){
		$trabajados.=$_POST["tallerN-".substr($key, 7)].":".$val.",";
	}
	if(substr($key, 0,9)=="destacado"){
		if($val!=""){
			$destacados.=$val.",";
		}
	}
	if(substr($key, 0,5)=="debil"){
		if($val!=""){
			$debiles.=$val.",";
		}
	}
}
$programados=substr($programados,0,strlen($programados)-1);
$trabajados=substr($trabajados,0,strlen($trabajados)-1);
$destacados=substr($destacados,0,strlen($destacados)-1);
$debiles=substr($debiles,0,strlen($debiles)-1);
$_POST["programados"] = "[".$programados."]";
$_POST["trabajados"] = "[".$trabajados."]";
$_POST["destacados"] = "[".$destacados."]";
$_POST["debiles"] = "[".$debiles."]";
$_POST["idInformeSesion"]=$datos["idInformeSesion"];
$detalle = getDetalleSesion($_POST["idInformeSesion"]);
if(!$detalle){
	newDetalleSesion($_POST);
}else{
	updateDetalleSesion($_POST);
}

$detalle = getDetalleSesion($_POST["idInformeSesion"]);

header('Location: ./ingresoInformeSesion.php');

?>

