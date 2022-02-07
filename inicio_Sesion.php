<?php

require "BasedeDatos.php";
session_start();


#==========================


#Este if se asegura que la vareable post este vacia con Empty
if (!empty($_POST)) {


    #Se Obtienen los datos que se necesitan como lo es usuario y contrasena
    $User = $_POST['Usuario'];
    $pass = $_POST['Clave'];
    #===========================================

    #Se identifica que es lo que esta utilizando ya sea el usuario de lo contrario se intentara con el numero de tel
    $Verificar = ReconocerUsuario($con, $User, $pass);

    $Passverificar = Desincriptar($con, $User);

    if ($Verificar == true) {
        if (password_verify($pass, $Passverificar)) {
            header("location: Pantallas/Home.php");
        } else {
            $contraValidar = '<label class="text-danger">Su contraseña es incorrecta</label><br>';
        }
    } else {

        $VerificarNumeroDeTelefono = ReconocerElTelefono($con, $User, $pass);
        if ($VerificarNumeroDeTelefono == true) {

            $Passverificar = DesincriptarTel($con, $User);

            if (password_verify($pass, $Passverificar)) {
                header("location: Pantallas/Home.php");
            } else {

                $contraValidar = '<label class="text-danger">Su contraseña es incorrecta</label><br>';
            }
        } else {
            $UsuarioValidar = '<label class="text-danger">El usuario no existe</label><br>';
            $contraValidar = '<label class="text-danger">El usuario no existe</label><br>';
        }
    }
}


?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="Herramientas/estilos/bootstrap5/css/bootstrap.css">
    <script src="jqueri/jquery.js"></script>

</head>

<body class="todo">

<div class="container">

<section class=" mx-auto" style="margin-top:10%;">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="Recursos/Fotos/Logo.jpeg" class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="POST">

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Iniciar Sesion</p>
          </div>
          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="text" name="Usuario" id="form3Example3" class="form-control form-control-lg " placeholder="Usuario o numero telefonico" value="<?php echo $User ?>" autocomplete="Nombre de usuario" />
            <?php echo $UsuarioValidar ?>
            <label class="form-label" for="form3Example3">Inserte su Usuario</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input type="password" name="Clave" autocomplete="current-password" id="form3Example4" class="form-control form-control-lg"  placeholder="Contraseña" />
            <?php echo $contraValidar ?>
            <label class="form-label" for="form3Example4">Inserte su Contraseña</label>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Enviar</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Aun no tenes una cuenta? <a href="Crear_Cuenta.php" class="link-danger">Register</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>
</section>
</div>


    <script src="Herramientas/estilos/bootstrap5/js/bootstrap.js"></script>
</body>

</html>