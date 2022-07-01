<?php
require("app/database/Config.php");

use App\database\Config;

// CONNECT DB
$pdo = new Config();

// EXAMPLE GET
$edit = "?id=1&color=success&descripcion=Este es un color verde";


if (!$_GET == null) {
    $id = $_GET["id"];
    $color = $_GET["color"];
    $descripcion = $_GET["descripcion"];

    $sqlEditar = "UPDATE colores SET color=?,descripcion=? WHERE  id=?";
    $query_editar = $pdo->prepare($sqlEditar);
    $query_editar->execute(array($color, $descripcion, $id));

    header("location:index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <nav class="nav">
            <li class="nav-item">
                <a class="nav-link " href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="editar.php">Editar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="delete.php">Delete</a>
            </li>
        </nav>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</body>

</html>