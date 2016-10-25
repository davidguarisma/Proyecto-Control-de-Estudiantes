<?php
	session_start();
	$id_curso=$_GET['curso'];
	$tr=$_GET['tra'];
	$se=$_GET['sem'];
	$pnfs=$_GET['pnf'];


	switch ($pnfs) {
		case 1:
			$pnf= 'PNF en Electricidad';
			break;
		case 2:
			$pnf= 'PNF en Ingeniería de Mantenimiento';
			break;
		case 3:
			$pnf= 'PNF en Mecánica';
			break;
		case 4:
			$pnf= 'PNF en Informática';
			break;
		case 5:
			$pnf= 'PNF en Geociencia';
			break;
		case 6:
			$pnf= 'PNF en Sistemas de Calidad y Ambiente';
			break;
		default:
			# code...
			break;
	}

switch ($se) {
	case 1:
		$sem = 'Semestre I';
		break;
	case 2:
		$sem = 'Semestre II';
		break;
	case 3:
		$sem = 'Semestre III';
		break;
	case 4:
		$sem = 'Semestre IV';
		break;
	case 5:
		$sem = 'Semestre V';
		break;
	case 6:
		$sem = 'Semestre VI';
		break;
	case 7:
		$sem = 'Semestre VII';
		break;
	case 8:
		$sem = 'Semestre VIII';
		break;
	default:

		break;
}

switch ($tr) {
	case 1:
		$tra = 'trayecto I';
		break;
	case 2:
		$tra = 'trayecto II';
		break;
	case 3:
		$tra = 'trayecto III';
		break;
	case 4:
		$tra = 'trayecto IV';
		break;
	default:

		break;
}


	date_default_timezone_set("America/Caracas");


	include('../config/config.php');

	$mysqli = crearConexion();

$consultaM = '
		SELECT materia, semestre_id FROM materias WHERE id_materias = "'.$id_curso.'" ';

	$resultadoM = $mysqli->query($consultaM);

	$datosM = array();

	while ($rowM = $resultadoM->fetch_array()){
    		$nombreMateria = $rowM['materia'];
    		$idSemestre = $rowM['semestre_id'];
	}


    $consulta = '
		SELECT nombres, apellidos, cedula FROM usuarios INNER JOIN inscripcion on id_semestre = "'.$idSemestre.'"
			GROUP BY id_user';

	$resultado = $mysqli->query($consulta);

	$datos = array();

	while ($row = $resultado->fetch_array()){
    		$datos[] = $row;
	}


		$nombre_curso= $nombreMateria;
	// 	$descri_curso='otro';

	 header("Content-Disposition: attachment; filename=Report_".$nombre_curso.".xls");
	 header("Pragma: no-cache");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Reporte Alumnos</title>
</head>

<body>
<table width="100%" border="1">
  <tr>
		<td colspan="3"><center><strong><?php echo  strtoupper($pnf); ?></strong></center></td>
    <td colspan="3">
    	<center><strong>Nombre de  Materia:<?php echo strtoupper($nombre_curso); ?></strong></center>
    </td>
  </tr>
  <tr>
    <td width="5%"><center><strong>No.</strong></center></td>
    <td width="20%"><center><strong>Trayecto</strong></center></td>
    <td width="20%"><center><strong>Semestre</strong></center></td>
		<td width="15%"><center><strong>Cedula</strong></center></td>
    <td width="20%"><strong>Apellidos</strong></td>
		<td width="20%"><strong>Nombres</strong></td>

  </tr>

<?php
      $number =0;
   if (is_array($datos) || is_object($datos)){
     foreach ($datos as $item) {
      $number++;

     echo '
  <tr>
    <td><center><strong>'.$number.'</strong></center></td>
    <td><center>'.$tra.'</center></td>
    <td><center>'.$sem.'</center></td>
		<td><center>'.$item["cedula"].'</center></td>
    <td>'.$item["apellidos"].'</td>
	  <td>'.$item["nombres"].'</td>
  </tr>';

  }
   }
if($number == 0){
   echo '
  <tr>
    <td colspan="6"><center>No hay regitros </center></td>
  </tr>';
}

 ?>
</table>
</body>
</html>
