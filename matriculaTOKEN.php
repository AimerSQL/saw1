<?php
session_start();
include ("includes/autenticado.php");
?>
<HTML>
    <HEAD>
        <title>Matrícula de asignaturas</title>
        <meta charset="UTF-8">
    </HEAD>
    <body>
    <center>
        <?php
        if (isset($_GET['Envio'])) {
            include ("includes/abrirbd.php");
            $_SESSION['token'] = bin2hex(random_bytes(32));
            if (isset($_GET['IWVG'])) {
                $matricula[0] = 'S';
            } else {
                $matricula[0] = 'N';
            }
            if (isset($_GET['APAW'])) {
                $matricula[1] = 'S';
            } else {
                $matricula[1] = 'N';
            }
            if (isset($_GET['FEM'])) {
                $matricula[2] = 'S';
            } else {
                $matricula[2] = 'N';
            }
            if (isset($_GET['FENW'])) {
                $matricula[3] = 'S';
            } else {
                $matricula[3] = 'N';
            }
            if (isset($_GET['PHP'])) {
                $matricula[4] = 'S';
            } else {
                $matricula[4] = 'N';
            }
            if (isset($_GET['SAW'])) {
                $matricula[5] = 'S';
            } else {
                $matricula[5] = 'N';
            }

            if (isset($_GET['token']) || $_GET['token'] === $_SESSION['token']) {
                $permisos = implode($matricula);
                $sql = "UPDATE usuarios SET permisos = '{$permisos}' WHERE user ='{$_SESSION['user']}'";
                if (mysqli_query($link, $sql)) {
                    echo "<center>";
                    echo ("<h3><b>Matrícula realizada correctamente.</h3></b>");
                } else {
                    echo "<center>";
                    echo "Error en la matrícula.";
                }
                echo ("<br><br><A href= 'MasterWeb.php'> Volver a inicio </A>");
                exit;
            } else {
                echo "<center>";
                echo ("<h3><b>Matrícula incorrecta. Token no válido.</h3></b>");
                echo ("<br><br><A href= 'MasterWeb.php'> Volver a inicio </A>");
                exit;
            }
        }
        ?>
        <img src="logo.png" width= 120 height= 60>
        <br><br><br>
        <H2> Selecciona las asignaturas en las que quieres matricularte </H2><BR><BR>
        <FORM name="matricula" method=get action= '<?php "{$_SERVER['PHP_SELF']}" ?>'>
            <TABLE>
                <TR>
                    <TD align=right><INPUT type="checkbox" name="IWVG" value="Si"></TD>
                    <TD align=left> Ingeniería Web: Visión General (IWVG)</TD>
                </TR>
                <TR>
                    <TD align=right><INPUT type="checkbox" name="APAW" value="Si"></TD>
                    <TD align=left> Arquitectura y Patrones para Aplicaciones Web (APAW)</TD>
                </TR>
                <TR>
                    <TD align=right><INPUT type="checkbox" name="FEM" value="Si"></TD>
                    <TD align=left> Front-end para Móviles (FEM)</TD>
                </TR>
                <TR>
                    <TD align=right><INPUT type="checkbox" name="FENW" value="Si"></TD>
                    <TD align=left> Front-end para Navegadores Web (FENW)</TD>
                </TR><TR>
                    <TD align=right><INPUT type="checkbox" name="PHP" value="Si"></TD>
                    <TD align=left> Back-end con Tecnologías de Libre Distribución (PHP)</TD>
                </TR><TR>
                    <TD align=right><INPUT type="checkbox" name="SAW" value="Si"></TD>
                    <TD align=left> Seguridad en Aplicaciones Web (SAW)</TD>
                </TR>
            </TABLE><BR>
            <INPUT type="submit" name="Envio" value="Enviar">
            <INPUT type="hidden" name="token" value="<?php echo $_SESSION['token']; ?>">
        </FORM>  
    </CENTER>
</BODY>
</HTML>

