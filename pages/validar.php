<?php
session_start();

$usuario = $_POST['var_nom'];

//EL USUARIO Y CONTRASEÑA EXISTE?
$_SESSION['us_ses'] = $usuario;
header("location:dashboard.php");
?>