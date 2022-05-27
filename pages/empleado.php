<?php
 session_start();

 if (isset($_GET['mensaje'])){
    echo '<script>alert('.$_GET["mensaje"].')</script>';
 }

date_default_timezone_set("America/Guayaquil");

 ?>

<!DOCTYPE html>


<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>PROYECTO 9NO</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="../css/dataTables/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="../css/dataTables/dataTables.responsive.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->



        <script>
            function validarLetras(e) { // 1
                tecla = (document.all) ? e.keyCode : e.which; // 2
                if (tecla==8) return true; // 3
                patron =/[A-Za-z\s]/; // 4
                te = String.fromCharCode(tecla); // 5
                return patron.test(te); // 6
            }



            function validarNumero(evt){

                // code is the decimal ASCII representation of the pressed key.
                var code = (evt.which) ? evt.which : evt.keyCode;

                if(code==8) { // backspace.
                    return true;
                } else if(code>=48 && code<=57) { // is a number.
                    return true;
                } else{ // other keys.
                    return false;
                }
            }

            function validarIdentificacion() {
                var parametros = $("#form2").serialize();
                $.ajax({
                    data: parametros,
                    url: 'validar_cedula.php',
                    type: 'post',
                    success: function(resp) {
                        console.log("La variable resp es:" + resp);
                        if (resp == "invalida") {
                            alert("La cédula es inválida por favor ingresar un valor correcto");
                            $("#cedula").val("");
                        }else{
                            alert("La cédula es válida");
                        }
                    }
                });
            }


        </script>


    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <?php include("topbar.php");    ?>
                <!-- /.navbar-top-links -->

                <?php include("menu.php"); ?>
            </nav>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Empleado</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row TABLA PRINCIPAL -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Registro de empleados
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Nombre</th>
                                                    <th>Cédula</th>
                                                    <th>Usuario</th>
                                                    <th>Dirección</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $selects = "select * from empleado where estado=1";
                                                $consulta = $con->consulta($selects);
                                                while($filas = $con->fetch_array($consulta)){
                                            ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $filas['nombre'].' '.$filas['apellido'] ?></td>
                                                    <td><?php echo $filas['cedula']; ?></td>
                                                    <td><?php echo $filas['usuario']; ?></td>
                                                    <td class="center"><?php echo $filas['direccion']; ?></td>
                                                    <td class="center">
                                                        <button type="button" class="btn btn-primary" onclick="Bolon('<?php echo $filas['emp_id']; ?>','<?php echo $filas['nombre']; ?>','<?php echo $filas['apellido']; ?>','<?php echo $filas['cedula']; ?>','<?php echo $filas['direccion']; ?>','<?php echo $filas['telefono']; ?>','<?php echo $filas['correo']; ?>','<?php echo $filas['genero']; ?>','<?php echo $filas['fecha_nacimiento']; ?>','<?php echo $filas['fecha_ingreso']; ?>','<?php echo $filas['interes01']; ?>','<?php echo $filas['interes02']; ?>','<?php echo $filas['interes03']; ?>','<?php echo $filas['interes04']; ?>','<?php echo $filas['usuario']; ?>','<?php echo $filas['clave']; ?>','<?php echo $filas['dep_id']; ?>','<?php echo $filas['car_id']; ?>')">Ver Datos</button>
                                                        <button type="button" class="btn btn-danger" onclick="Eliminar_dato('<?php echo $filas['emp_id']; ?>')">Eliminar</button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->

                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row FORMULARIO-->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3><b>Formulario de Empleado</b></h3>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form">
<!--                                                NOmbre-->



                                                <button type="submit" class="btn btn-default">Guardar Registro</button>
                                                <button type="reset" class="btn btn-default">Limpiar Registros</button>
                                                <button type="button" class="btn btn-primary" onclick="mostrarModal()">Llamar modal</button>
                                            </form>
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->

                                        <!-- /.col-lg-6 (nested) -->
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- DataTables JavaScript -->
        <script src="../js/dataTables/jquery.dataTables.min.js"></script>
        <script src="../js/dataTables/dataTables.bootstrap.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });


            $(document).ready(function() {
                $('#dataTables-example2').DataTable({
                    responsive: true
                });
            });






        </script>

        <div class="modal fade" id="modalnuevo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">

            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4>Registro de empleado </h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="post" id="form2" name="form2" action="empleado_insertar.php" >

                            <div class="form-group">
                                <label>Nombre</label>
                                <input class="form-control" onkeypress="return validarLetras(event)" placeholder="Ingrese el nombre" id="nombre" name="nombre" type="text" required>
                            </div>
                            <!--                                                Apellido-->
                            <div class="form-group">
                                <label>Apellidos</label>
                                <input class="form-control" placeholder="Ingrese los apellidos" id="apellido" name="apellido" type="text" required>
                            </div>
                            <!--                                                    Cedula-->
                            <div class="form-group">
                                <label>Cédula</label>
                                <input class="form-control" onkeypress="return validarNumero(event)" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"  placeholder="Ingrese la cédula" id="cedula" name="cedula" type="number" maxlength="10" onchange="validarIdentificacion();" required>
                            </div>


                            <!--                                                Dirección-->
                            <div class="form-group">
                                <label>Dirección</label>
                                <textarea class="form-control" rows="3" placeholder="Ingrese la dirección" name="direccion" id="direccion"></textarea>
                            </div>

                            <!--                                                Telefono-->
                            <div class="form-group">
                                <label>Teléfono/celular</label>
                                <input class="form-control" placeholder="Ingrese su teléfono o celular" id="telefono" name="telefono" type="text" required>
                            </div>
                            <!--                                                    Correo-->
                            <div class="form-group">
                                <label>Correo</label>
                                <input class="form-control" placeholder="Ingrese su correo" id="correo" name="correo" type="email" required>
                            </div>


                                <div class="form-group col-md-6">
                                    <label>Usuario</label>
                                    <input class="form-control" placeholder="Ingrese su usuario" id="usuario" name="usuario" type="text" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Contraseña</label>
                                    <input class="form-control" placeholder="Ingrese su contraseña" id="clave" name="clave" type="text" required>
                                </div>



                            <!--                                                Departamento-->
                            <div class="form-group">
                                <label>Departamento</label>
                                <select class="form-control" id="departamento" name="departamento">
                                    <option value="1">DEPARTAMENTO DE SISTEMAS</option>
                                    <option value="2">DEPARTAMENTO DE VENTAS</option>
                                    <option value="3">DEPARTAMENTO DE GERENCIA</option>
                                </select>
                            </div>
                            <!--                                                Cargo-->
                            <div class="form-group">
                                <label>Cargo</label>
                                <select class="form-control" id="cargo" name="cargo">
                                    <option value="1">ADMINISTRADOR</option>
                                    <option value="2">SUPERVISOR</option>
                                    <option value="3">OPERADOR</option>

                                </select>
                            </div>
                            <!--                                                Fecha Nacimiento-->
                            <div class="form-group">
                                <label>Fecha de Nacimiento</label>
                                <input class="form-control" name="fnacimiento" id="fnacimiento" type="date" required>
                            </div>
                            <!--                                                    Fecha de Ingreso-->
                            <div class="form-group">
                                <label>Fecha de Ingreso</label>
                                <input class="form-control" name="fingreso" id="fingreso" type="date" value="<?php echo date('Y-m-d') ?>" required>
                            </div>

                            <!--                                                Sexo-->
                            <div class="form-group">
                                <label>Género</label>
                                <label class="radio-inline">
                                    <input type="radio" name="genero" id="genero1" value="1" checked>MASCULINO
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="genero" id="genero2" value="2" >FEMENINO
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="genero" id="genero3" value="3">NO ESPECIFICADO
                                </label>
                            </div>

                            <!--                                                Intereses-->
                            <div class="form-group">
                                <label>Intereses</label>
                                <div class="row">

                                    <div class="checkbox col-md-4">
                                        <label>
                                            <input type="checkbox" value="1" name="ch[]" id="ch01" >MUSICA
                                        </label>
                                    </div>
                                    <div class="checkbox col-md-4">
                                        <label>
                                            <input type="checkbox" value="2" name="ch[]" id="ch02" >CINE
                                        </label>
                                    </div>
                                    <div class="checkbox col-md-4">
                                        <label>
                                            <input type="checkbox" value="3" name="ch[]" id="ch03" >DEPORTES
                                        </label>
                                    </div>
                                    <div class="checkbox col-md-4">
                                        <label>
                                            <input type="checkbox" value="4" name="ch[]" id="ch04" >VIDEOJUEGOS
                                        </label>
                                    </div>
                                </div>
                            </div>




                            <td class="center">
                                <a class="btn btn-info" onclick="guardar_datos();">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Guardar Datos
                                </a>
                            </td>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                    </div>
                </div>
            </div>
        </div>

    <script>

        function mostrarModal(){
            $("#modalnuevo").modal('show');
        }




    </script>

        <div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">

            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4>Datos para editar empleado </h4>
                    </div>
                    <div class="modal-body">
                        <form role="form" method="post" id="form3" name="form3" action="#" >

                            <input type="hidden" name="codigo" id="codigo">

                            <div class="form-group">
                                <label>Nombre</label>
                                <input class="form-control" placeholder="Ingrese el nombre" id="enombre" name="enombre" type="text" required>
                            </div>
                            <!--    Apellido-->
                            <div class="form-group">
                                <label>Apellidos</label>
                                <input class="form-control" placeholder="Ingrese los apellidos" id="eapellido" name="eapellido" type="text" required>
                            </div>
                            <!--         Cedula-->
                            <div class="form-group">
                                <label>Cédula</label>
                                <input class="form-control"  placeholder="Ingrese la cédula" id="ecedula" name="ecedula" type="number" maxlength="10" required>
                            </div>


                            <!--          Dirección-->
                            <div class="form-group">
                                <label>Dirección</label>
                                <textarea class="form-control" rows="3" placeholder="Ingrese la dirección" name="edireccion" id="edireccion"></textarea>
                            </div>

                            <!--       Telefono-->
                            <div class="form-group">
                                <label>Teléfono/celular</label>
                                <input class="form-control" placeholder="Ingrese su teléfono o celular" id="etelefono" name="etelefono" type="text" required>
                            </div>
                            <!--       Correo-->
                            <div class="form-group">
                                <label>Correo</label>
                                <input class="form-control" placeholder="Ingrese su correo" id="ecorreo" name="ecorreo" type="email" required>
                            </div>


                                <div class="form-group col-md-6">
                                    <label>Usuario</label>
                                    <input class="form-control" placeholder="Ingrese su usuario" id="eusuario" name="eusuario" type="text" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Contraseña</label>
                                    <input class="form-control" placeholder="Ingrese su contraseña" id="eclave" name="eclave" type="text" required>
                                </div>



                            <!--       Departamento-->
                            <div class="form-group">
                                <label>Departamento</label>
                                <select class="form-control" id="edepartamento" name="edepartamento">
                                    <option value="1">DEPARTAMENTO DE SISTEMAS</option>
                                    <option value="2">DEPARTAMENTO DE VENTAS</option>
                                    <option value="3">DEPARTAMENTO DE GERENCIA</option>
                                </select>
                            </div>
                            <!--                                                Cargo-->
                            <div class="form-group">
                                <label>Cargo</label>
                                <select class="form-control" id="ecargo" name="ecargo">
                                    <option value="1">ADMINISTRADOR</option>
                                    <option value="2">SUPERVISOR</option>
                                    <option value="3">OPERADOR</option>

                                </select>
                            </div>
                            <!--                                                Fecha Nacimiento-->
                            <div class="form-group">
                                <label>Fecha de Nacimiento</label>
                                <input class="form-control" name="efnacimiento" id="efnacimiento" type="date" required>
                            </div>
                            <!--                                                    Fecha de Ingreso-->
                            <div class="form-group">
                                <label>Fecha de Ingreso</label>
                                <input class="form-control" name="efingreso" id="efingreso" type="date" required>
                            </div>

                            <!--                                                Sexo-->
                            <div class="form-group">
                                <label>Género</label>
                                <label class="radio-inline">
                                    <input type="radio" name="egenero" id="egenero1" value="M" checked>MASCULINO
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="egenero" id="egenero2" value="F" >FEMENINO
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="egenero" id="egenero3" value="NE">NO ESPECIFICADO
                                </label>
                            </div>

                            <!--                                                Intereses-->
                            <div class="form-group">
                                <label>Intereses</label>
                                <div class="row">

                                    <div class="checkbox col-md-4">
                                        <label>
                                            <input type="checkbox" value="1" name="ech[]" id="ech01" >MUSICA
                                        </label>
                                    </div>
                                    <div class="checkbox col-md-4">
                                        <label>
                                            <input type="checkbox" value="2" name="ech[]" id="ech02" >CINE
                                        </label>
                                    </div>
                                    <div class="checkbox col-md-4">
                                        <label>
                                            <input type="checkbox" value="3" name="ech[]" id="ech03" >DEPORTES
                                        </label>
                                    </div>
                                    <div class="checkbox col-md-4">
                                        <label>
                                            <input type="checkbox" value="4" name="ech[]" id="ech04" >VIDEOJUEGOS
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <td class="center">
                                <a class="btn btn-info" onclick="modificar_datos();">
                                    <i class="glyphicon glyphicon-edit icon-white"></i>
                                    Modificar Datos
                                </a>


                            </td>

                        </form>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-default" data-dismiss="modal">Cerrar</a>
                    </div>
                </div>
            </div>
        </div>

        <script>

            function Bolon(emid,nom,ape,ced,dir,telf,cor,gen,fnac,fing,int1,int2,int3,in4,usu,cla,dep,car){
                $("#modal2").modal('show');
                $("#codigo").val(emid);
                $("#enombre").val(nom);
                $("#eapellido").val(ape);

                $("#ecedula").val(ced);
                $("#edireccion").val(dir);
                $("#etelefono").val(telf);
                $("#ecorreo").val(cor);
                $("#eusuario").val(usu);
                $("#eclave").val(cla);
                $("#efnacimiento").val(fnac);

                $("#efingreso").val(fing);



                if (gen=='1'){
                    $("#egenero1").prop("checked", true);
                }else if(gen=='2'){
                    $("#egenero2").prop("checked", true);
                }else{
                    $("#egenero3").prop("checked", true);
                }

                if(int1=='1'){
                    $("#ech01").prop("checked", true);
                }else{
                    $("#ech01").prop("checked", false);
                }
                if(int2=='1'){
                    $("#ech02").prop("checked", true);
                }else{
                    $("#ech02").prop("checked", false);
                }
                if(int3=='1'){
                    $("#ech03").prop("checked", true);
                }else{
                    $("#ech03").prop("checked", false);
                }
                if(int4=='1'){
                    $("#ech04").prop("checked", true);
                }else{
                    $("#ech04").prop("checked", false);
                }

                $("#edepartamento").val(dep);
                $("#ecargo").val(car);

            }

            function sumar(){
                var a = $("#apellido").val();
                var b = $("#cedula").val();
                var c;

                <?php $saludo="Tendremos lección en 2 semanas y media";?>

                c = parseInt(a) +parseInt(b);
                var mensaje = "<?php echo $saludo ?>";

                $("#direccion").val(c);
                alert(mensaje);
            }

            function Eliminar_dato(empid){
                window.location.href = "empleado_eliminar.php?jugo="+empid;
            }

            function guardar_datos(){
                $("#form2").submit();
            }


            function modificar_datos(){
                var parametros = $("#form3").serialize();
                $.ajax({
                    data: parametros,
                    url: 'empleado_editar.php',
                    type: 'post',
                    success: function(resp) {
                        if (resp == "si") {
                            alert("El empleado fue modificado con éxito");
                            $("#modal2").modal('hide');
                        }else{
                            alert("El empleado no fue modificado, intentelo mas tarde");
                        }
                    }
                });
            }



        </script>


    </body>
</html>
