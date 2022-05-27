<?php
session_start();
include("ValidarIdentificacion.php");
$vced = new ValidarIdentificacion();
$cedula = $_POST['cedula'];
$val = $vced->validarCedula($cedula);
if($val == false){
    echo 'invalida';
}
else {
    echo 'valida';
}
?>