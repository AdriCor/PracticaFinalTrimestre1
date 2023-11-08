<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <?php require 'BaseDatosTienda.php' ?>
    <?php require 'depurar.php' ?>
</head>

<body>
    <?php
    if (
        $_SERVER["REQUEST_METHOD"] == "POST" &&
        $_POST["formulario"] == "insertar"
    ) 
    $temp_usu = $_POST["nameUsu"];
    $temp_pass = $_POST["contraseña"];
    $temp_edad = $_POST["edad"];

    {

        //  Valido el usuario
        if (empty($_POST["nameUsu"])) {
            $err_usu = "*El usuario es obligatorio";
        } else {
            

            if (strlen($temp_usu) > 12 || strlen($temp_usu) > 4) {
                $err_name = "*El usuario debe tener entre 4 y 12 caracteres";
            } else if (!preg_match("/^[a-zA-ZñÑáÁéÉíÍóÓúÚ]{4,12}$/", $temp_usu)) {
                $err_usu = "*EL usuario solo puede contener mayusculas, minúsculas, ñ y acentos";
            } else {
                $usuario = $temp_usu;
            }
        }

        //Valido la contraseña
        if (empty($temp_usu)) { //he probado por aqui pero nada
            $err_pass = "*la contraseña es obligatoria";
        } else {
            

            if (strlen($temp_pass) > 255) {
                $err_pass = "*La contraseña puede contener como máximo 255 caracteres";
            } else if (!preg_match("/^[a-zA-ZñÑáÁéÉíÍóÓúÚ 0-9]{0,255}$/", $temp_pass)) {
                $err_pass = "*La contraseña solo puede contener mayusculas, minúsculas, ñ, acentosy números";
            } else {
                $contraseña = $temp_pass;
            }
        }
        // Valido la edad
        if (empty($_POST["edad"])) {
            $err_edad = "*La fecha de nacimiento es obligatoria";
        } else {
            
            function obtener_edad_segun_fecha($temp_edad)
            {
                $nacimiento = new DateTime($temp_edad);
                $ahora = new DateTime(date("Y-m-d"));
                $diferencia = $ahora->diff($nacimiento);
                return $diferencia->format("%y");
            }
            if ($diferencia < 4 || $diferencia > 120) {
                $err_edad = "*Debes ser mayor de 12 años y menor de 120";
            } else {
                $edad = $temp_edad;
            }
        }
    }
    ?>
    <h2>Formulario de los usuarios</h2>
    <form action="" method="post">
        <!-- 4-12 char,acepta de a-z en min y mayusc, ñ, acentos y _ -->
        <label for="nameUsu">Nombre de Ususario: </label>
        <input type="text" id="nameUsu"></input>
        <?php if (isset($err_usu)) echo $err_usu; ?>
        <br><br>
        <!-- maximo 255 char -->
        <label id="contraseña"> Contraseña:</label>
        <input type="text" id="contraseña"></input>
        <?php if (isset($err_pass)) echo $err_pass; ?>
        <br><br>
        <label id="edad"> Fecha de nacimiento:</label>
        <input type="date" id="edad"></input>
        <?php if (isset($err_edad)) echo $err_edad; ?>
        <br><br>
        <input type="hidden" name="formulario" value="insertar">
        <input type="submit" value="Insertar usuario">
    </form>


</body>

</html>