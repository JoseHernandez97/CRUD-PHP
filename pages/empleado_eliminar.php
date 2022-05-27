<?php
session_start();
include ("../configuracion/conectar.php");
$con = new base();

$id_emp = $_GET['jugo'];

$oracion = "update empleado set estado=0 where emp_id=".$id_emp;
$var1 = $con->consulta($oracion);

if ($var1==true){
    header("location:empleado.php?mensaje='El empleado fue eliminado correctamente'");
}else{
    header("location:empleado.php?mensaje='No se eliminó el empleado, intentelo mas tarde'");
}
?>