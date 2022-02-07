<?php
/*
en esta hoja se incluye la conexion con la base de datos y tambien se modela la base de datos
ya sea inicio de cesion u otras actividades que tenga que ver con la base de datos
*/

$user = "JhostinDelaC";
$pass = "Jhostin2004@";
$server = "localhost";
$db = "Ventas";
$con = new mysqli($server, $user, $pass, $db);

	


#Es para obtener la contrase del usuario y desincriptarla
function Desincriptar($ConexionD, $UsuarioD)
{
    $BuscarUsuario = "SELECT Pass as Contra from Tbl_Usuario where Usuario='$UsuarioD'";
    $EnviarConsulta = mysqli_query($ConexionD, $BuscarUsuario);
    $PassObtenida = mysqli_fetch_array($EnviarConsulta);

    $PassDesincriptar = $PassObtenida['Contra'];

    return $PassDesincriptar;
}





#Es para obtener la contrase del usuario(Tel) y desincriptarla
function DesincriptarTel($ConexionT, $UsuarioT)
{
    $BuscarUsuarioTelefono = "SELECT Pass as Contra from Tbl_Usuario where NumeroCel='$UsuarioT'";
    $EnviarConsultaExiteTel = mysqli_query($ConexionT, $BuscarUsuarioTelefono);
    $PassObtenidaDeTel = mysqli_fetch_array($EnviarConsultaExiteTel);

    $PassDesincriptarTel = $PassObtenidaDeTel['Contra'];

    return $PassDesincriptarTel;
}

#reconocer si el usuario ingresado existe 
function ReconocerUsuario($Conexion, $Usuario, $password)
{

    $Existe = "SELECT COUNT(*) as buscar from Tbl_Usuario where Usuario='$Usuario' ";
    $consulta = mysqli_query($Conexion, $Existe);
    $arrays = mysqli_fetch_array($consulta);

    if ($arrays['buscar'] > 0) {
        return true;
    } else {
        return false;
    }
}

#reconocer si el usuario(Telefono) ingresado existe 

function ReconocerElTelefono($Conexion, $tel, $password)
{

    $ExisteTel = "SELECT COUNT(*) as buscar from Tbl_Usuario where NumeroCel='$tel'";
    $consultaTel = mysqli_query($Conexion, $ExisteTel);
    $arraysTel = mysqli_fetch_array($consultaTel);

    if ($arraysTel['buscar'] > 0) {
        return true;
    } else {
        return false;
    }
}
