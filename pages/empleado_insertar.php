<?php
session_start();
include ("../configuracion/conectar.php");
$con = new base();

$nom = $_POST['nombre'];
$ape = $_POST['apellido'];
$ced = $_POST['cedula'];
$dir = $_POST['direccion'];
$tel = $_POST['telefono'];
$cor = $_POST['correo'];
$usu = $_POST['usuario'];
$cla = $_POST['clave'];
$dep = $_POST['departamento'];
$car = $_POST['cargo'];
$fnac = $_POST['fnacimiento'];
$fing = $_POST['fingreso'];
$gen = $_POST['genero'];
$inter = 0;
$inter1=0;
$inter2=0;
$inter3=0;
$inter4=0;

if(isset($_POST['ch'])){
    $inter = $_POST['ch'];
    foreach ($inter as $opcion){
        if($opcion==1) $inter1 =1;
        if($opcion==2) $inter2 =1;
        if($opcion==3) $inter3 =1;
        if($opcion==4) $inter4 =1;
    }

}



$oracion = "insert into empleado(nombre,apellido,cedula,direccion,telefono,correo,usuario,clave,dep_id,car_id,fecha_nacimiento,fecha_ingreso,genero,interes01,interes02,interes03,interes04)
            values ('$nom','$ape','$ced','$dir','$tel','$cor','$usu','$cla','$dep','$car','$fnac','$fing','$gen','$inter1','$inter2','$inter3','$inter4') ";
$var1 = $con->consulta($oracion);

if ($var1==true){
    header("location:empleado.php?mensaje='El empleado fue ingresado correctamente'");
}else{
    header("location:empleado.php?mensaje='No se ingresó el empleado, intentelo mas tarde'");
}
?>