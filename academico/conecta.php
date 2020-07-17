<?php
require_once('conexion.php');

$consulta='';
if($conection->connect_errno){
	echo "Error en la conexion";
	exit;
}
funcion laConsulta(){
	global $conexion, $consulta;
	$sql ='SELECT COUNT(i.lugar_residencia) as cantidad,i.lugar_residencia 
from identificacion i ,notas n , usuario u 
where i.ci=u.ci_identificacion1 AND n.cod_usuario1=u.cod_usuario
group by i.lugar_residencia
having (avg(n.nota)>101 AND COUNT(n.materia)=1 ) OR (avg(n.nota)>50 AND COUNT(n.materia)>1)';
return $conexion->query($sql);
}



 