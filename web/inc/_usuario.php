<?php 

function getTiposUsuario(){
	$sql = "SELECT DISTINCT tipoUsuario FROM usuario";
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
		$tiposUsuario[$i] = array( "tipoUsuario" => $row["tipoUsuario"]
							);	
		$i++;
	}
	return($tiposUsuario);
}

function getRutNombre($idUsuario){
    $sql ="SELECT P.rutProfesor,P.nombreProfesor,P.apellidoPaternoProfesor,P.apellidoMaternoProfesor FROM usuario as U
    	   inner join profesor as P on P.rutProfesor = U.rutProfesor
    	   where idUsuario = ".$idUsuario."";
    $res = mysql_query($sql);
    $i=0;
    while($row = mysql_fetch_array($res)){
            $profesor[] = array(
            "rutProfesor"=> $row["rutProfesor"],
            "nombreProfesor" => $row["nombreProfesor"],
            "apellidoPaternoProfesor" => $row["apellidoPaternoProfesor"],
            "apellidoMaternoProfesor" => $row["apellidoMaternoProfesor"]);    
    }
    
    return $profesor;

}
function getColegiosDeProfesor($idUsuario){
    $sql ="SELECT uc.rbdColegio,
				c.nombreColegio
	FROM  `usuarioColegio` uc
	JOIN   `colegio` c
	ON uc.rbdColegio=c.rbdColegio
	
	WHERE  `idUsuario` = ".$idUsuario." ";

    $res = mysql_query($sql);
    $i=0;
    while($row = mysql_fetch_array($res)){
            $colegio[] = array(
            "rbdColegio"=> $row["rbdColegio"],
			"nombreColegio"=> $row["nombreColegio"]   );
    }
   
    return $colegio;

}

function getNombreColegioProfesor($idUsuario){
    $sql ="SELECT c.nombreColegio
	FROM  `usuario` us join `profesor` pr on us.rutProfesor = pr.rutProfesor 
	JOIN   `colegio` c on pr.rbdColegio= c.rbdColegio
	WHERE  `idUsuario` = $idUsuario";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    return $row["nombreColegio"];

}


function getDatosUsuarioPorId($idUsuario){ 
		$sql = "SELECT * FROM `usuario` WHERE idUsuario ="."'$idUsuario'";
		//echo $sql;
		$res = mysql_query($sql); 
		$row = mysql_fetch_array($res);
		
		$usuario=array();
		
		if ($row["tipoUsuario"] == "Profesor" || $row["tipoUsuario"] == "Encuesta" || $row["tipoUsuario"] == "UTP" || $row["tipoUsuario"] == "Directivo" || $row["tipoUsuario"] == "Visitante"  ){
			$datos = getDatosProfesor($idUsuario);
			$datos["nombre"] = $datos["nombreProfesor"];
			$datos["rbdColegio"] = $datos["rbdColegio"];
			$datos["apellidoPaterno"] = $datos["apellidoPaternoProfesor"];
			$datos["apellidoMaterno"] = $datos["apellidoMaternoProfesor"];
			$datos["rut"] = $datos["rutProfesor"];
			$datos["sexo"] = $datos["sexoProfesor"];
			$datos["fechaNacimiento"] = $datos["fechaNacimientoProfesor"];
			$datos["telefono"] = $datos["telefonoProfesor"];
			$datos["email"] = $datos["emailProfesor"];
			$datos["anosExperienciaProfesor"] = $datos["anosExperienciaProfesor"];
			$datos["asignaturaACargoProfesor"] = $datos["asignaturaACargoProfesor"];
		}
		/*
		if ($row["tipoUsuario"] == "Directivo"){
			$datos = getDatosDirectivo($idUsuario);
			$datos["nombre"] = $datos["nombreDirectivo"];
			$datos["apellidoPaterno"] = $datos["apellidoPaternoDirectivo"];
			$datos["apellidoMaterno"] = $datos["apellidoMaternoDirectivo"];
			$datos["rut"] = $datos["rutDirectivo"];
			$datos["sexo"] = $datos["sexoDirectivo"];
			$datos["fechaNacimiento"] = $datos["fechaNacimientoDirectivo"];
			$datos["telefono"] = $datos["telefonoDirectivo"];
			$datos["email"] = $datos["emailDirectivo"];
		}
		*/
		
		/*
		if ($row["tipoUsuario"] == "Sostenedor"){
			$datos = getDatosDirectivo($idUsuario);
			$datos["nombre"] = $datos["nombreDirectivo"];
			$datos["apellidoPaterno"] = $datos["apellidoPaternoDirectivo"];
			$datos["apellidoMaterno"] = $datos["apellidoMaternoDirectivo"];
			$datos["rut"] = $datos["rutDirectivo"];
			$datos["sexo"] = $datos["sexoDirectivo"];
			$datos["telefono"] = $datos["telefonoDirectivo"];
			$datos["email"] = $datos["emailDirectivo"];
			
		}*/
		
		
		if ($row["tipoUsuario"] == "Alumno"){
			
		}
		if ($row["tipoUsuario"] == "Empleado Klein"|| $row["tipoUsuario"] == "Coordinador General" || $row["tipoUsuario"] == "Relator/Tutor" || $row["tipoUsuario"] == "Asesor"){
			$datos = getDatosEmpleadoKlein($idUsuario);
			$datos["nombre"] = $datos["nombreEmpleadoKlein"];
			$datos["apellidoPaterno"] = $datos["apellidoPaternoEmpleadoKlein"];
			$datos["apellidoMaterno"] = $datos["apellidoMaternoEmpleadoKlein"];
			$datos["rut"] = $datos["rutEmpleadoKlein"];
			$datos["sexo"] = @$datos["sexoEmpleadoKlein"];
			$datos["fechaNacimiento"] = @$datos["fechaNacimientoEmpleadoKlein"];
			$datos["telefono"] = $datos["telefonoEmpleadoKlein"];
			$datos["email"] = $datos["emailEmpleadoKlein"];
			$datos["rolEmpleadoKlein"] = $datos["rolEmpleadoKlein"];
			$datos["idComuna"] = $datos["idComuna"];
		}
		if($row["tipoUsuario"] == "Profesor")
		{
			$usuario=array(
				"idUsuario"=> $row["idUsuario"],
				"tipoUsuario" => $row["tipoUsuario"],
				"emailUsuario" => $row["emailUsuario"],
				"loginUsuario" => $row["loginUsuario"],
				"passwordUsuario" => $row["passwordUsuario"],
				"estadoUsuario" => $row["estadoUsuario"],
				"ultimoAccesoUsuario" => $row["ultimoAccesoUsuario"],
				"imagenUsuario" => $row["imagenUsuario"],
				"rbdColegio" => @$datos["rbdColegio"],
				"nombre" => $datos["nombre"],
				"apellidoPaterno" => $datos["apellidoPaterno"],
				"apellidoMaterno" => $datos["apellidoMaterno"],
				"rut" => $datos["rut"],
				"sexo" => $datos["sexo"],
				"fechaNacimiento" => $datos["fechaNacimiento"],
				"telefono" => $datos["telefono"],
				"email" => $datos["email"],
				"acercaDeUsuario" => $datos["acercaDeUsuario"],
				"interesesUsuario" => $datos["interesesUsuario"],
				"anosExperienciaProfesor" => $datos["anosExperienciaProfesor"],
				"asignaturaACargoProfesor" => $datos["asignaturaACargoProfesor"]
				);
		}
		else if($row["tipoUsuario"] == "Empleado Klein" || $row["tipoUsuario"] == "Coordinador General" || $row["tipoUsuario"] == "Relator/Tutor" || $row["tipoUsuario"] == "Asesor")
		{
			$usuario=array(
				"idUsuario"=> $row["idUsuario"],
				"tipoUsuario" => $row["tipoUsuario"],
				"emailUsuario" => $row["emailUsuario"],
				"loginUsuario" => $row["loginUsuario"],
				"passwordUsuario" => $row["passwordUsuario"],
				"estadoUsuario" => $row["estadoUsuario"],
				"ultimoAccesoUsuario" => $row["ultimoAccesoUsuario"],
				"imagenUsuario" => $row["imagenUsuario"],
				"rbdColegio" => @$datos["rbdColegio"],
				"nombre" => $datos["nombre"],
				"apellidoPaterno" => $datos["apellidoPaterno"],
				"apellidoMaterno" => $datos["apellidoMaterno"],
				"rut" => $datos["rut"],
				"email" => $datos["email"],
				"acercaDeUsuario" => $datos["acercaDeUsuario"],
				"sexo" => @$datos["sexo"],
				"fechaNacimiento" => @$datos["fechaNacimiento"],
				"telefono" => $datos["telefono"],
				"interesesUsuario" => $datos["interesesUsuario"],
				"rolEmpleadoKlein" => $datos["rolEmpleadoKlein"],
				"idComuna" => $datos["idComuna"]
				);
		}
		/*
		else if($row["tipoUsuario"] == "Directivo")
		{
			$usuario=array(
				"idUsuario"=> $row["idUsuario"],
				"tipoUsuario" => $row["tipoUsuario"],
				"emailUsuario" => $row["emailUsuario"],
				"loginUsuario" => $row["loginUsuario"],
				"passwordUsuario" => $row["passwordUsuario"],
				"estadoUsuario" => $row["estadoUsuario"],
				"ultimoAccesoUsuario" => $row["ultimoAccesoUsuario"],
				"imagenUsuario" => $row["imagenUsuario"],
				"rbdColegio" => @$datos["rbdColegio"],
				"nombre" => $datos["nombre"],
				"apellidoPaterno" => $datos["apellidoPaterno"],
				"apellidoMaterno" => $datos["apellidoMaterno"],
				"rut" => $datos["rut"],
				"sexo" => $datos["sexo"],
				"fechaNacimiento" => $datos["fechaNacimiento"],
				"telefono" => $datos["telefono"],
				"email" => $datos["email"],
				"acercaDeUsuario" => $datos["acercaDeUsuario"],
				"interesesUsuario" => $datos["interesesUsuario"]
				);
		}*/
		else
		{
			$usuario=array(
				"idUsuario"=> $row["idUsuario"],
				"tipoUsuario" => $row["tipoUsuario"],
				"emailUsuario" => $row["emailUsuario"],
				"loginUsuario" => $row["loginUsuario"],
				"passwordUsuario" => $row["passwordUsuario"],
				"estadoUsuario" => $row["estadoUsuario"],
				"ultimoAccesoUsuario" => $row["ultimoAccesoUsuario"],
				"imagenUsuario" => $row["imagenUsuario"],
				"rbdColegio" => @$datos["rbdColegio"],
				"nombre" => $datos["nombre"],
				"apellidoPaterno" => $datos["apellidoPaterno"],
				"apellidoMaterno" => $datos["apellidoMaterno"],
				"rut" => $datos["rut"]
				);
		
		}
		return ($usuario);
}	



function getTipoUsuario($idUsuario){
	$sql = "SELECT * FROM usuario WHERE idUsuario = ".$idUsuario;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["tipoUsuario"]);
	
	}

function getNombreFotoUsuarioDirectivo($idUsuario){
	$sql = "SELECT * FROM usuario a left join directivo b on a.rutDirectivo = b.rutDirectivo  WHERE idUsuario = "."'$idUsuario'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$nombreFotoUsuario=array(
		"imagenUsuario"=> $row["imagenUsuario"],
		"nombreProfesor" => $row["nombreDirectivo"],
		"apellidoPaternoDirectivo" => $row["apellidoPaternoDirectivo"],
		"apellidoMaternoDirectivo" => $row["apellidoMaternoDirectivo"]
		);
	return($nombreFotoUsuario);
}

function getNombreFotoUsuarioEmpleadoKlein($idUsuario){
	$sql = "SELECT * FROM usuario a left join empleadoKlein b on a.rutEmpleadoKlein = b.rutEmpleadoKlein  WHERE idUsuario = "."'$idUsuario'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$nombreFotoUsuario=array(
		"imagenUsuario"=> $row["imagenUsuario"],
		"nombre" => $row["nombreEmpleadoKlein"],
		"apellidoPaterno" => $row["apellidoPaternoEmpleadoKlein"],
		"apellidoMaterno" => $row["apellidoMaternoEmpleadoKlein"],
		"nombreCompleto" => $row["apellidoPaternoEmpleadoKlein"]." ".$row["apellidoMaternoEmpleadoKlein"]." ".$row["nombreEmpleadoKlein"]
		);

	return($nombreFotoUsuario);
}

function getIdUsuarios(){

	$sql = "SELECT * FROM usuario where tipoUsuario != 'Alumno' ORDER BY tipoUsuario DESC, idUsuario DESC ";
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	
	$usuarios[$i] = array( "idUsuario" => $row["idUsuario"]);	
	$i++;
		}
	if ($i==0){
		return(NULL);
	}
	
	return($usuarios);

}	

function estaUsuario($loginUsuario){
	$sql = "SELECT loginUsuario FROM usuario WHERE loginUsuario = "."'$loginUsuario' AND estadoUsuario = 1";
	$res = mysql_query($sql);
	//echo $sql;
	if (mysql_num_rows($res) > 0 ){
		return (true);
	}else{
		return(false);
	}
}


function claveCorrectaUsuario($loginUsuario,$claveUsuario){
	$sql = "SELECT idUsuario FROM usuario WHERE loginUsuario = "."'$loginUsuario'"." AND passwordUsuario = "."'$claveUsuario'";
	//echo $sql;
	$res = mysql_query($sql);
	if (mysql_num_rows($res) > 0 ){
		return (true);
	}else{
		return(false);
	}
}



function getNombreUsuario($idUsuario){
		$sql = "SELECT * FROM `usuario` WHERE idUsuario =".$idUsuario;
		//echo $sql;
		$nombre="";
		$res = mysql_query($sql); 
		$row = mysql_fetch_array($res);
		if ($row["tipoUsuario"] == "Profesor"||$row["tipoUsuario"]=="UTP"){
			$rut = $row["rutProfesor"];
			$nombre = getNombreProfesorPorRut($rut);
		}
		if ($row["tipoUsuario"] == "Directivo"){
			$rut = $row["rutDirectivo"];
		}
		if ($row["tipoUsuario"] == "Alumno"){
			$rut = $row["rutAlumno"];
		}
		if ($row["tipoUsuario"] == "Empleado Klein" || $row["tipoUsuario"] == "Coordinador General" || $row["tipoUsuario"] == "Relator/Tutor" || $row["tipoUsuario"] == "Asesor"){
			$rut = $row["rutEmpleadoKlein"];
			$nombre = getNombreEmpleadoKleinPorRut($rut);
		}
		return ($nombre);
}

function getApellidosNombre($idUsuario){
	
		$sql = "SELECT * FROM `usuario` WHERE idUsuario =".$idUsuario;
		$nombre="";
		$res = mysql_query($sql); 
		$row = mysql_fetch_array($res);
		if ($row["tipoUsuario"] == "Profesor"){
			$rut = $row["rutProfesor"];
			$nombre = getApellidosNombrePorRutProfe($rut);
		}
		if ($row["tipoUsuario"] == "Directivo"){
			$rut = $row["rutDirectivo"];
		}
		if ($row["tipoUsuario"] == "Alumno"){
			$rut = $row["rutAlumno"];
		}
		if ($row["tipoUsuario"] == "Empleado Klein"){
			$rut = $row["rutEmpleadoKlein"];
			$nombre = getApellidosNombrePorRutEmpleadoKlein($rut);
		}

		return ($nombre);
}

function getDatosGenerico($idUsuario){
	$tipo = getTipoUsuario($idUsuario);
	switch ($tipo){
		case "Profesor":
		case "UTP":
		$datos = getDatosProfesor($idUsuario);
		return $datos;
		break;
		
		case "Empleado Klein":
		case "Relator/Tutor":
		$datos = getDatosEmpleadoKlein($idUsuario);
		return $datos;
		break;
	}
}


function getDatosUsuario($usuario){
		
		$sql = "SELECT * FROM `usuario` a left join detalleUsuarioProyectoPerfil b on a.idUsuario = b.idUsuario WHERE loginUsuario ="."'$usuario'";
		//echo $sql;
		$res = mysql_query($sql); 
		$row = mysql_fetch_array($res);
		if ($row["tipoUsuario"] == "Profesor" || $row["tipoUsuario"] == "UTP" || $row["tipoUsuario"] == "Directivo" ){
			$rut = $row["rutProfesor"];
		}
		//if ($row["tipoUsuario"] == "Directivo"){
		//	$rut = $row["rutProfesor"];
		//}
		if ($row["tipoUsuario"] == "Alumno"){
			$rut = $row["rutAlumno"];
		}
		if ($row["tipoUsuario"] == "Empleado Klein" || $row["tipoUsuario"] == "Relator/Tutor" || $row["tipoUsuario"] == "Asesor" || $row["tipoUsuario"] == "Coordinador General"){
			$rut = $row["rutEmpleadoKlein"];
		}
		$usuario=array(
			"idUsuario"=> $row["idUsuario"],
			"tipoUsuario" => $row["tipoUsuario"],
			"emailUsuario" => $row["emailUsuario"],
			"loginUsuario" => $row["loginUsuario"],
			"passwordUsuario" => $row["passwordUsuario"],
			"estadoUsuario" => $row["estadoUsuario"],
			"ultimoAccesoUsuario" => $row["ultimoAccesoUsuario"],
			"imagenUsuario" => $row["imagenUsuario"],
			"idPerfilUsuario" => $row["idPerfil"],
			"rut" => $rut
			);
		return ($usuario);
}	

function getNombreFotoUsuario($idUsuario){
	$tipo = getTipoUsuario($idUsuario);
	switch ($tipo){
		case "Profesor":
		$datos = getNombreFotoUsuarioProfesor($idUsuario);
		return $datos;
		break;
		
		case "Empleado Klein":
		$datos = getNombreFotoUsuarioEmpleadoKlein($idUsuario);
		return $datos;
		break;
	
		case "Empleado Klein":
		$datos = getNombreFotoUsuarioDirectivo($idUsuario);
		return $datos;
		break;
	
		
	}
}


function getNombreFotoUsuarioProfesor($idUsuario){
	$sql = "SELECT * FROM usuario a left join profesor b on a.rutProfesor = b.rutProfesor WHERE idUsuario = '$idUsuario'";
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$nombreFotoUsuario=array(
		"imagenUsuario"=> $row["imagenUsuario"],
		"nombre" => $row["nombreProfesor"],
		"apellidoPaterno" => $row["apellidoPaternoProfesor"],
		"apellidoMaterno" => $row["apellidoMaternoProfesor"],
		"nombreCompleto" => $row["apellidoPaternoProfesor"]." ".$row["apellidoMaternoProfesor"]." ".$row["nombreProfesor"]
		);
	//echo $row["nombreProfesor"]." ".$row["apellidoPaternoProfesor"]." ".$row["apellidoMaternoProfesor"];
	return($nombreFotoUsuario);
}




function actualizaDatosUsuario($idUsuario, $emailUsuario,$passwordUsuario,$acercaDeUsuario,$interesesUsuario){
	if ($passwordUsuario != ""){
		$sql_udateUsuario="UPDATE usuario SET 
		emailUsuario = '$emailUsuario', 
		passwordUsuario = '$passwordUsuario',
		acercaDeUsuario = '$acercaDeUsuario',
		interesesUsuario = '$interesesUsuario'
		WHERE idusuario  = '$idUsuario';";
	}else{
		$sql_udateUsuario="UPDATE usuario SET 
		emailUsuario = '$emailUsuario',
		acercaDeUsuario = '$acercaDeUsuario',
		interesesUsuario = '$interesesUsuario'
		WHERE idusuario  = '$idUsuario';";
	}
	
	//echo $sql_udateUsuario;
	$result = mysql_query($sql_udateUsuario);
	return $result;
}	
	
	
function acualizaUltimoAcceso($idUsuario){
	$sql = "UPDATE `usuario` SET `ultimoAccesoUsuario` = NOW( ) WHERE `idUsuario` = ".$idUsuario;
	mysql_query($sql);
}

function activaUsuario($idUsuario){
	$sql = "UPDATE usuario SET estadoUsuario = '1', visibleUsuario = '1' WHERE idUsuario = ".$idUsuario;
	mysql_query($sql);
}

function desactivaUsuario($idUsuario){
	$sql = "UPDATE usuario SET estadoUsuario = '0', visibleUsuario = '0' WHERE idUsuario = ".$idUsuario;
	mysql_query($sql);
}


?>