<html>
<head>
    <title>XSS</title>
    <meta charset="UTF-8">
</head>
<body>
    <br><br><br>
    <center>
        <img src="logo.png" width=120 height=60>
        <br><br><br>
        <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>' method="get">
            <table bgcolor='lightgrey'>
                <tr>
                    <td><input type="text" name='dato1'></td>
                    <td><input type="submit" name='submit1' value='DATO1'></td>
                </tr>
            </table><BR>
        </form>
        <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>' method="get">
            <table bgcolor='lightgrey'>
                <tr>
                    <td><input type="text" name='dato2'></td>
                    <td><input type="submit" name='submit2' value='DATO2'></td>
                </tr>
            </table><BR>
        </form>
        <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>' method="get">
            <table bgcolor='lightgrey'>
                <tr>
                    <td>
                        <input type="radio" name='dato3' value="Rojo"> Rojo
                        <input type="radio" name='dato3' value="Verde"> Verde
                    </td>
                    <td><input type="submit" name='submit3' value='DATO3'></td>
                </tr>
            </table><BR>
        </form>
        <form action='<?php echo htmlspecialchars($_SERVER['PHP_SELF'], ENT_QUOTES, 'UTF-8'); ?>' method="get">
            <table bgcolor='lightgrey'>
                <tr>
                    <td>
                        <input type="radio" name='dato4' value="blue"> Azul
                        <input type="radio" name='dato4' value="yellow"> Amarillo
                    </td>
                    <td><input type="submit" name='submit4' value='DATO4'></td>
                </tr>
            </table>
        </form>
        <br><br><br><br>

        <?php

        function validarDato1($dato) {
            return is_numeric($dato);
        }

        function validarDato2($dato) {
            return ctype_alnum($dato);
        }

        function validarDato3($dato) {
            return $dato === "Rojo" || $dato === "Verde";
        }

        function validarDato4($dato) {
            return $dato === "blue" || $dato === "yellow";
        }

        if (isset($_GET['submit1'])) {
            $dato1 = $_GET['dato1'];
            if (validarDato1($dato1)) {
                echo "Dato 1 válido: " . htmlspecialchars($dato1, ENT_QUOTES, 'UTF-8');
            }
            exit;
        }

        if (isset($_GET['submit2'])) {
            $dato2 = $_GET['dato2'];
            if (validarDato2($dato2)) {
                echo "Dato 2 válido: " . htmlspecialchars($dato2, ENT_QUOTES, 'UTF-8');
            }
            exit;
        }

        if (isset($_GET['submit3'])) {
            $dato3 = $_GET['dato3'];
            if (validarDato3($dato3)) {
                echo "Dato 3 válido: " . htmlspecialchars($dato3, ENT_QUOTES, 'UTF-8');
            }
            exit;
        }

        if (isset($_GET['submit4'])) {
            $dato4 = $_GET['dato4'];
            if (validarDato4($dato4)) {
                echo "<p style=color:" . htmlspecialchars($dato4, ENT_QUOTES, 'UTF-8') . "> MI COLOR FAVORITO </p>";
            }
            exit;
        }
        ?> 
    </center>
</body>
</html>
