<?php


include 'BasedeDatos.php';

if (empty($_POST)) {
    $LascontrasNoSonInguales = "";
    $llenarContrasenas = "";
}

if (!empty($_POST)) {

    $NombreUsuario = $_POST['UsuarioIngresar'];
    $PrimerContrasena = $_POST["PassWordIngresar"];
    $SegundaContasena = $_POST["ConfirmarPassword"];
    $NumeroTel = $_POST["NumeroTelefono"];
    $Correo = $_POST["CorreoIngresar"];
    $TipoIngre=$_POST['Tipo'];
    $NombreDelUsuario=$_POST['NombreCom'];




    #$EdadInsertar = intval($_POST["EdadIngresar"]);

    $Existeusuario = "SELECT COUNT(*) as buscar from Tbl_Usuario where Usuario='$NombreUsuario'";
    $EnviarConsultaExistencia = mysqli_query($con, $Existeusuario);
    $ConfirmarsiExistencia = mysqli_fetch_array($EnviarConsultaExistencia);

    if ($ConfirmarsiExistencia['buscar'] > 0) {
        $Nombrevalidation = '<label class="text-danger">El usuario ya existe intente con otro usuario</label><br>';
    } else {
        $usuarioNoexiste = true;
    }

    if (strlen($NombreUsuario) < 4) {
        $Usuariovalidar = '<label class="text-danger">Deve rellenar este campo con almenos tres caracteres</label><br>';
    } else {
        $nombrecompleto = true;
    }


    if (strlen($NombreDelUsuario) < 4) {
        $NombreUValidar = '<label class="text-danger">Deve rellenar este campo con almenos tres caracteres</label><br>';
    } else {
        $NC = true;
    }



    if (strlen($PrimerContrasena) < 3) {
        $Primercontravalidar = '<label class="text-danger">Deve rellenar este campo con almenos tres caracteres</label><br>';
    } else {
        $PirimeraContraCompleta = true;
    }

    if (strlen($SegundaContasena) < 3) {
        $Segundacontravalidar = '<label class="text-danger">Deve rellenar este campo con almenos tres caracteres</label><br>';
    } else {
        $SegundaContraCompleta = true;
    }


    if (strlen($NumeroTel) < 3) {
        $TelefonoValidar = '<label class="text-danger">Deve rellenar este campo con almenos tres caracteres</label><br>';
    } else {
        $TelefonoCompleto = true;
    }


    if (strlen($Correo) < 3) {
        $CorreoValidar = '<label class="text-danger">Deve rellenar este campo con almenos tres caracteres</label><br>';
    } else {
        $CorreoCompleto = true;
    }



    if ($PirimeraContraCompleta == true && $SegundaContraCompleta == true) {
        if ($PrimerContrasena == $SegundaContasena) {
        } else {
            $Primercontravalidar = '<label class="text-danger">Las contraseñas no son iguales</label><br>';
            $Segundacontravalidar = '<label class="text-danger">Las contraseñas no son iguales</label><br>';
        }
    }
    if ($usuarioNoexiste == true && $nombrecompleto == true && $PirimeraContraCompleta == true && $SegundaContraCompleta == true && $TelefonoCompleto == true && $CorreoCompleto == true && $NC==true) {
        $pass_cifrada = password_hash($PrimerContrasena, PASSWORD_DEFAULT, array("cost" => 10));
        $contrasi = $pass_cifrada;
        $consultaInsert = "INSERT INTO `Tbl_Usuario`(`Usuario`, `Pass`, `Correo`, `NumeroCel`,`Nombre`,`ID_Tipo`) VALUES ('$NombreUsuario','$contrasi','$Correo','$NumeroTel','$NombreDelUsuario','$TipoIngre')";
        $EnviarConsultainsert = mysqli_query($con, $consultaInsert);

        if ($EnviarConsultainsert) {
            header("location: index.php");
        } else {
            echo "Error: " . $EnviarConsultainsert . mysqli_error($con);
            die;
        }
    } else {
        echo "hola";
    }
}

$ConsultaTipoUsuario = "SELECT * FROM `Tbl_T/U`";

$ListaTipo = mysqli_query($con, $ConsultaTipoUsuario);




/*
//Contrasena funciona hace falta validar que no existan usuaerio con el mismo nombre
$PrimerContrasena = $_POST["PassWordIngresar"];
$SegundaContasena = $_POST["ConfirmarPassword"];
if (!empty($_POST)) {



    if ($PrimerContrasena == $SegundaContasena) {
        $Funcion = '<h2>Funciona</h2>';
    } else {
        $Funcion = '<h2>No funciona</h2>';
    }
}*/



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrarse</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Herramientas/estilos/bootstrap5/css/bootstrap.css">
    <script src="jqueri/jquery.js"></script>
</head>

<body class="todo">


    <div class="container">
        <form method="POST" enctype="multipart/form-data">
            <section class=" mx-auto">

                <div class="container-fluid h-custom">
                    <div class="row d-flex  ">
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <div id='fotoPorDefecto'>
                            </div>




                            <div class="row">
                                <div class="divider d-flex align-items-center my-4">
                                    <p class="text-center fw-bold mx-3 mb-0">Registrarse</p>
                                </div>


                                <div class="form-outline mb-3">
                                    <input type="text" name="UsuarioIngresar" autocomplete="off" id="Usuario" class="form-control form-control-lg" placeholder="Usuario" value="<?php echo $NombreUsuario ?>" />
                                    <?php echo $Nombrevalidation; ?>


                                    <?php echo $Usuariovalidar; ?>

                                    <label class="form-label" for="Usuario">Inserte su Usuario</label>


                                </div>
                                <div class="form-outline mb-3">
                                    <input type="password" name="PassWordIngresar" autocomplete="off" id="pass" class="form-control form-control-lg" placeholder="Contraseña" value="<?php echo $PrimerContrasena; ?>" />
                                    <?php echo $Primercontravalidar; ?>
                                    <label class="form-label" for="pass">Inserte su contraseña</label>

                                </div>
                                <div class="form-outline mb-3">
                                    <input type="password" name="ConfirmarPassword" autocomplete="off" id="ConfirmarPass" class="form-control form-control-lg" placeholder="Confirme Contraseña" value="<?php echo $SegundaContasena;  ?>" />
                                    <?php echo $Segundacontravalidar; ?>
                                    <label class="form-label" for="ConfirmarPassword">Confirme su contraseña</label>



                                </div>


                                <div class="form-outline mb-3">
                                    <input type="text" name="NombreCom" autocomplete="off"  class="form-control form-control-lg" placeholder="Nombre" value="<?php echo $NumeroTel; ?>" />
                                    <?php echo $NombreUValidar; ?>
                                    <label class="form-label" for="NombreCom">Ingrese su Nombre</label>
                                </div>

                                <div class="form-outline mb-3">
                                    <input type="text" name="NumeroTelefono" autocomplete="off" id="Nombre" class="form-control form-control-lg" placeholder="NumeroTelefono" value="<?php echo $NumeroTel; ?>" />
                                    <?php echo $TelefonoValidar; ?>
                                    <label class="form-label" for="NumeroTelefono">Ingrese su numero de Telefono</label>
                                </div>
                                <div class="form-outline mb-3">
                                    <input type="text" name="CorreoIngresar" autocomplete="off" id="Apellido" class="form-control form-control-lg" placeholder="Correo" value="<?php echo $Correo; ?>" />
                                    <?php echo $CorreoValidar; ?>
                                    <label class="form-label" for="CorreoIngresar">Ingrese CorreoElectronico</label>
                                </div>
                                <div class="form-outline mb-3">

                                   
                                        <select name="Tipo" class="form-select form-select-lg mb-3" id="TipoU">
                                        <?php
                                   while ($datos = $ListaTipo->fetch_array()) {
                                    ?>
                                            <option value="<?php echo $datos["ID_Tipo"] ?>"><?php echo $datos["Nombre/TipoUsuario"] ?></option>
                                            <?php } ?>
                                        </select>
                                    
                                    <?php echo $CorreoValidar; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 ">


                            <div class="divider d-flex align-items-center my-4">
                            </div>



                            <div class="text-center text-lg-start mt-4 pt-2">
                                <p class="small fw-bold mt-2 pt-1 mb-0">ya tienes una cuenta? <a href="inicio_Sesion.php" class="link-danger">Regresar</a></p>
                                <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Enviar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
    </div>
    <script src="Herramientas/estilos/bootstrap5/js/bootstrap.js"></script>

</body>

</html>