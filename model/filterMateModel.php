<?php
include('../config/config.php');

  function filterSelect($opt,$pnf,$trayecto,$semestre){
	$mysqli = crearConexion();
    $consulta = '
			SELECT id_materias, materia, nombre_semestre, trayecto, id_semestre,
			case pnf WHEN 1 THEN  "PNF en Electricidad"
				  WHEN 2 THEN  "PNF en Ingeniería de Mantenimiento"
		          WHEN 3 THEN  "PNF en Mecánica"
		          WHEN 4 THEN  "PNF en Informática"
		          WHEN 5 THEN  "PNF en Geociencia"
		          WHEN 6 THEN  "PNF en Sistemas de Calidad y Ambiente"
      		END AS pnfs,
			case apertura WHEN 0 THEN  "Cerrada"
	 		  	  WHEN 1 THEN  "Activa"
      		END AS apert,
      		case trayecto
      			  WHEN 1 THEN  "I"
				  WHEN 2 THEN  "II"
		          WHEN 3 THEN  "III"
		          WHEN 4 THEN  "IV"
      		END AS tray,
      		case nombre_semestre
      			  WHEN 1 THEN  "I"
				  WHEN 2 THEN  "II"
		          WHEN 3 THEN  "III"
		          WHEN 4 THEN  "IV"
		          WHEN 5 THEN  "V"
		          WHEN 6 THEN  "VI"
		          WHEN 7 THEN  "VII"
		          WHEN 8 THEN  "VIII"
      		END AS semestre
  		FROM materias INNER JOIN semestre on semestre_id = id_semestre AND pnf = "'.$pnf.'" AND trayecto = "'.$trayecto.'" AND nombre_semestre = "'.$semestre.'" ORDER BY id_semestre DESC ';
	$resultado = $mysqli->query($consulta);
$datos = array();
	while ($row = $resultado->fetch_array()){
    		$datos[] = $row;
		}

		$data = '<thead><tr><th>Nº </th><th>Materia</th><th>PNF</th><th>Trayecto</th><th>Semestre</th><th>Status</th><th>Opciones</th></tr></thead><tbody>';

      $number =0;
   if (is_array($datos) || is_object($datos)){
     foreach ($datos as $item) {
      $number++;

     $data = $data.'<tr><td>'.$number.'</td>
             <td>'.$item["materia"].'</td>
             <td>'.string_ucfirst($item["pnfs"]).'</td>
             <td>'.$item["tray"].'</td>
             <td>'.string_ucfirst($item["semestre"]).'</td>
             <td>'.$item["apert"].'</td>
             <td>
              <a href="#" data-toggle="modal" data-target="#myModal" class="btn_edit optTable" onclick="edit('.$item["id_materias"].')" id="'.$item["id_materias"].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                 <a href="#"  class="btn_trash optTable" onclick="trash('.$item["id_materias"].')" id="'.$item["id_semestre"].'"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                 <a href="#"  class="btn_power optTable" onclick="power('.$item["id_materias"].')" id="'.$item["id_materias"].'"><i class="fa fa-power-off" aria-hidden="true"></i></a></td></tr>';
     }
   }
      if($number == 0){
      	$data = $data.'<tr><td colspan="7" class="text-center"> No hay Registros </td></tr>';
      }
  $data = $data.'</tbody>';

    	echo json_encode(array('opt' => $opt, 'dat'=> $data));
}

function listar(){
	$mysqli = crearConexion();
    $consulta = '
			SELECT id_materias, materia, nombre_semestre, trayecto, id_semestre,
			case pnf WHEN 1 THEN  "PNF en Electricidad"
				  WHEN 2 THEN  "PNF en Ingeniería de Mantenimiento"
		          WHEN 3 THEN  "PNF en Mecánica"
		          WHEN 4 THEN  "PNF en Informática"
		          WHEN 5 THEN  "PNF en Geociencia"
		          WHEN 6 THEN  "PNF en Sistemas de Calidad y Ambiente"
      		END AS pnfs,
			case apertura WHEN 0 THEN  "Cerrada"
	 		  	  WHEN 1 THEN  "Activa"
      		END AS apert,
      		case trayecto
      			  WHEN 1 THEN  "I"
				  WHEN 2 THEN  "II"
		          WHEN 3 THEN  "III"
		          WHEN 4 THEN  "IV"
      		END AS tray,
      		case nombre_semestre
      			  WHEN 1 THEN  "I"
				  WHEN 2 THEN  "II"
		          WHEN 3 THEN  "III"
		          WHEN 4 THEN  "IV"
		          WHEN 5 THEN  "V"
		          WHEN 6 THEN  "VI"
		          WHEN 7 THEN  "VII"
		          WHEN 8 THEN  "VIII"
      		END AS semestre
  		FROM materias INNER JOIN semestre on semestre_id = id_semestre  ORDER BY id_semestre DESC ';

	$resultado = $mysqli->query($consulta);

	while ($row = $resultado->fetch_array()){
    		$datos[] = $row;
		}

		$data = '<thead><tr><th>Nº </th><th>Materia</th><th>PNF</th><th>Trayecto</th><th>Semestre</th><th>Status</th><th>Opciones</th></tr></thead><tbody>';

      $number =0;
      foreach ($datos as $item) {
      	$number++;

      $data = $data.'<tr><td>'.$number.'</td>
              <td>'.string_ucfirst($item["materia"]).'</td>
              <td>'.string_ucfirst($item["pnfs"]).'</td>
              <td>'.$item["tray"].'</td>
              <td>'.string_ucfirst($item["semestre"]).'</td>
              <td>'.$item["apert"].'</td>
              <td>
                 	<a href="#" data-toggle="modal" data-target="#myModal" class="btn_edit optTable" onclick="edit('.$item["id_materias"].')" id="'.$item["id_materias"].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                  <a href="#"  class="btn_trash optTable" onclick="trash('.$item["id_materias"].')" id="'.$item["id_semestre"].'"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                  <a href="#"  class="btn_power optTable" onclick="power('.$item["id_materias"].')" id="'.$item["id_materias"].'"><i class="fa fa-power-off" aria-hidden="true"></i></a></td></tr>';
      }
      if($number == 0){
      	$data = $data.'<tr>
			<td colspan="7" class="text-center"> No hay Registros </td>
      	</tr>';
      }
  $data = $data.'</tbody>';
  echo json_encode(array('dat'=> $data));
}

?>
