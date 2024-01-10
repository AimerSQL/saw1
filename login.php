<?php

session_start();
// TODO 5. Configurar autenticación con certificado de persona

if (isset($_SERVER['SSL_CLIENT_VERIFY']) && $_SERVER['SSL_CLIENT_VERIFY'] == "SUCCESS") {

    include("includes/abrirbd.php");

    $usuario = $_SERVER['SSL_CLIENT_S_DN_CN'];


    $sql = "SELECT * FROM usuarios WHERE user = '$usuario'";
    $resultado = mysqli_query($link, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        $_SESSION['autenticado'] = 'correcto';
        $_SESSION['user'] = $usuario['user'];
        session_regenerate_id();
        header("Location:MasterWeb.php");
    } else {
        header("Location: NoAuth.php");
        exit;
    }
    
    mysqli_close($link);
    exit;
} 

if (isset($_GET['registro'])) {
    header("Location: registro.php");
    exit;
}

if (isset($_GET['login'])) {
    include ("includes/abrirbd.php");
    $sql = "SELECT * FROM usuarios WHERE user ='{$_GET['user']}'";
    $resultado = mysqli_query($link, $sql);

    if (mysqli_num_rows($resultado) == 1) {
        $usuario = mysqli_fetch_assoc($resultado);
        if (password_verify($_GET['passwd'], $usuario['password'])) {
            $_SESSION['autenticado'] = 'correcto';
            $_SESSION['user'] = $usuario['user'];
            session_regenerate_id();
            header("Location:MasterWeb.php");
        } else {
            echo "<BR><BR><BR><CENTER>";
            echo "<h3>Autenticación incorrecta de " . $_GET['user'] . "</h3> <BR>";
            echo "<A href= 'login.php'> Volver a login </A>";
            echo "</CENTER>";
        }
    } else {
        echo "<BR><BR><BR><CENTER>";
        echo "<h3>Autenticación incorrecta de " . $_GET['user'] . "</h3> <BR>";
        echo "<A href= 'login.php'> Volver a login </A>";
        echo "</CENTER>";
    }
    mysqli_close($link);
    exit;
}
?>

<html>
    <head>
        <title> Login </title>
        <meta charset="UTF-8">
    </head>
    <body>
        <br><br><br>
    <center>
        <img src="logo.png" width= 120 height= 60>
        <br><br><br>
        <form action= '<?php "{$_SERVER['PHP_SELF']}" ?>' method = get>
            <table bgcolor = 'lightgrey'> 
                <tr>
                    <td width= 100> Usuario: </td> 
                    <td> <input type = text name ='user'></td>
                </tr>
                <tr>
                    <td width= 100> Password: </td> 
                    <td> <input type = password name ='passwd'></td>
                </tr>
            </table><br>
            <input type=submit name = 'login' value = "LOGIN"><br><br><br>
            <input type=submit name = 'registro' value = "REGISTRAR USUARIO">
        </form>
    </center>
</body>
</html>