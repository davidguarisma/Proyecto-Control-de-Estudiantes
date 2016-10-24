<?php
class reporte{
	private $consulta;
	private $fetch;

	function __construct($codigo){
		$this->consulta = mysql_query("SELECT COUNT(*) AS result FROM usuarios WHERE pnf_user = $codigo");
		$this->fetch = mysql_fetch_array($this->consulta);
	}

	function consultar($campo){
		return $this->fetch[$campo];
	}
}
?>
SELECT id_materias, materia, nombre_semestre, trayecto, pnf, id_semestre  FROM materias INNER JOIN semestre on semestre_id = id_semestre AND id_materias ="'.$id.
