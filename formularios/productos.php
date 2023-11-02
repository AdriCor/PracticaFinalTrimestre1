<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
</head>

<body>
    <?php
    if (
        $_SERVER["REQUEST_METHOD"] == "POST" &&
        $_POST["formulario"] == "insertar"
    ) {

        //  Valido el nombre del producto
        if (empty($_POST["nameProduct"])) {
            $err_name = "*El nombre es obligatorio";
        } else {
            $temp_name = $_POST["nameProduct"];

            if (strlen($temp_name) > 40) {
                $err_name = "*El nombre debe tener máximo 40 caracteres";
            }else if(!preg_match("/^[a-zA-ZñÑáÁéÉíÍóÓúÚ 0-9]{0,40}$/", $temp_name )){
                $err_name="*EL nombre solo puede contener u mayusculas, minúsculas, ñ, acentosy números";
            } 
            else {
                $name = $temp_name;
            }
        }
        // Valido el precio del producto
        if (empty($_POST["price"])) {
            $err_price = "*El precio es obligatorio";
        } else {
            $temp_price = $_POST["price"];
            $temp_price = filter_var($temp_price, FILTER_VALIDATE_INT);

            if (!$temp_price) {
                $err_price = "*El precio debe ser un número";
            } else {
                if ($temp_price < 0) {
                    $err_price = "*El precio debe ser mayor o igual a cero";
                }else if(!preg_match('/^[1-9]$/', $temp_price )){
                    $err_name="*EL precio solo admite cantidades numéricas";
                } else {
                    $price = $_POST["price"];
                }
            }
        }

        //Valido la descripción del producto
        if (empty($_POST["description"])) {
            $err_descrip = "*la descripción es obligatoria";
        } else {
            $temp_descrip = $_POST["description"];

            if (strlen($temp_descrip) > 255) {
                $err_descrip = "*La descripción puede contener como máximo 255 caracteres";
            }else if(!preg_match("/^[a-zA-ZñÑáÁéÉíÍóÓúÚ 0-9]{0,255}$/", $temp_descrip )){
                $err_descrip="*La descripción solo puede contener u mayusculas, minúsculas, ñ, acentosy números";
            }else {
                $descrip = $temp_descrip;
            }
        }
        // Valido la cantidad de stock del producto
        if (empty($_POST["quantity"])) {
            $err_quantity = "*La cantidad es obligatoria";
        } else {
            $temp_quantity = $_POST["quantity"];
            $temp_quantity = filter_var($temp_quantity, FILTER_VALIDATE_INT);
            if (!$temp_quantity) {
                $err_quantity = "*La cantidad debe ser un numérica";
            } else {
                if ($temp_quantity < 0) {
                    $err_quantityt = "*La cantidad debe ser mayor o igual a cero";
                } else if(!preg_match('/^[0-9]$/', $temp_quantity )){
                    $err_quantity="*Ela cantidad solo admite cifras numéricas";
                }else {
                    $quantity = $_POST["quantity"];
                }
            }
        }
    }
    ?>
    <h2>Formulario de los productos</h2>
    <form action="" method="post">
        <!-- maximo 40 char,acepta de a-z en min y mayusc, ñ y acentos -->
        <label for="nameProduct">Nombre del Producto: </label>
        <input type="text" id="name" ></input>
        <?php if (isset($err_name)) echo $err_name; ?>
        <br><br>
        <!-- entre 1 y 9 -->
        <label for="price">Precio del Producto: </label>
        <input type="text" id="Price"></input>
        <?php if (isset($err_price)) echo $err_price; ?>
        <br><br>
        <!-- maximo 255 char -->
        <label id="description"> Descripción del producto:</label>
        <input type="text" id="price"></input><br><br>
        <!-- entre 0 y 9 -->
        <label id="Quantity"> Cantidades del Producto:</label>
        <input type="text" id="Quantity"></input>
        <?php if (isset($err_quantity)) echo $err_quantity; ?>
        <br><br>
        <input type="hidden" name="formulario" value="insertar">
        <input type="submit" value="Insertar producto">
    </form>


</body>

</html>