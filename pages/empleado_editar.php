<?php
session_start();
include ("../configuracion/conectar.php");
$con = new base();

$nom = $_POST['enombre'];
$ape = $_POST['eapellido'];
$ced = $_POST['ecedula'];
$dir = $_POST['edireccion'];
$tel = $_POST['etelefono'];
$cor = $_POST['ecorreo'];
$usu = $_POST['eusuario'];
$cla = $_POST['eclave'];
$dep = $_POST['edepartamento'];
$car = $_POST['ecargo'];
$fnac = $_POST['efnacimiento'];
$fing = $_POST['efingreso'];
$gen = $_POST['egenero'];

$idemp = $_POST['codigo'];

$inter = 0;
$inter1=0;
$inter2=0;
$inter3=0;
$inter4=0;

if(isset($_POST['ech'])){
    $inter = $_POST['ech'];
    foreach ($inter as $opcion){
        if($opcion==1) $inter1 =1;
        if($opcion==2) $inter2 =1;
        if($opcion==3) $inter3 =1;
        if($opcion==4) $inter4 =1;
    }

}

$oracion = "update empleado set nombre='$nom',apellido='$ape',cedula='$ced',direccion='$dir',telefono='$tel',correo='$cor',usuario='$usu',clave='$cla',dep_id='$dep',car_id='$car',fecha_nacimiento='$fnac',fecha_ingreso='$fing',genero='$gen',interes01='$inter1',interes02='$inter2',interes03='$inter3',interes04='$inter4'
            where emp_id=".$idemp;
$var1 = $con->consulta($oracion);

if ($var1==true){
    echo 'si';
}else{
    echo 'no';
}
?>