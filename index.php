<?php
require("vendor/autoload.php");

use App\database\Config;


// CONNECT DB
$pdo = new Config();

// LEER ALL
$query = "SELECT * FROM colores";
$prepare_query = $pdo->prepare($query);
$prepare_query->execute();
$resultado = $prepare_query->fetchAll();

// ADD ALL
if ($_POST) {
    $color = $_POST["color"];
    $descripcion = $_POST["descripcion"];

    try {
        $slq_add = "INSERT INTO colores (color,descripcion) values (?, ?)";
        $sentence = $pdo->prepare($slq_add);
        $sentence->execute(array($color, $descripcion));

        // close conexion
        $pdo = null;
        $sentence = null;

        header("location:index.php");
    } catch (\Throwable $th) {
        var_dump($th);
    }
}

// DELETE BY ID
if (isset($_GET["delete"])) {
    $id = $_GET["id"];
    $query_unique = "DELETE FROM colores WHERE id=?";
    $prepare_unique = $pdo->prepare($query_unique);
    $prepare_unique->execute(array($id));

    // close conexion
    $pdo = null;
    $query_unique = null;
}

// PINTAR EDIT FORM
if (isset($_GET["edit"])) {
    $id = $_GET["id"];
    $sql_unique = "SELECT * FROM colores WHERE id=?";
    $prepare_sql_unique = $pdo->prepare($sql_unique);
    $resultado_edit = $prepare_sql_unique->fetchAll();

    // close conexion
    $pdo = null;
    $sql_unique = null;
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="./node_modules/bootstrap/dist/css/bootstrap.css" rel="stylesheet" media="screen">

    <title>Hello, world!</title>
</head>

<body>

    <!-- CONTAINER PRINCIPAL -->
    <div class="container mt-5">
        <div class="container">
            <nav class="nav">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="editar.php">Editar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="delete.php">Delete</a>
                </li>
            </nav>
        </div>

        <h1>LISTADO DESDE BASE DE DATOS</h1>

        <!-- GRID START -->
        <div class="row">

            <!-- COLUMNA LISTA MYSLQ -->
            <div class="col-md-6 d-flex flex-column">

                <?php
                foreach ($resultado as $key) {
                ?>
                <div class="d-flex justify-content-between alert alert-<?php echo $key["color"]; ?>" role="alert">
                    <?php echo $key[2]; ?>

                    <div class="d-inline" style="width: 1em;">
                        <a href="index.php?id=<?php echo $key['id']; ?>&edit=true" class="">
                            <img src="./app/img/edit_icon.svg" alt="" class="d-inline ">
                        </a>
                        <a href="index.php?id=<?php echo $key['id']; ?>&delete=true" class="">
                            <img src="./app/img/delete_icon.svg" alt="" class="d-inline">
                        </a>
                    </div>

                </div>
                <?php
                }
                ?>
            </div>

            <!-- 
            <div class="col-md-6">
                <div class="alert alert-dark d-flex justify-content-between">
                    <span class="align-self-center">text</span>
                    <span class="">
                        <a href="">
                            <img src="./app/img/edit_icon.svg" alt="">
                        </a>
                        <a href="">
                            <img src="./app/img/delete_icon.svg" alt="">
                        </a>
                    </span>
                </div>


            </div> -->


            <!-- COLUMNA AGREGAR -->
            <div class=" col-md-6">
                <?php
                if (!$_GET) {
                ?>
                <h2>Agregar elementos</h2>

                <!-- FORMULARIO -->
                <form method="POST">
                    <input class="form-control " type="text" name="color" id="" placeholder="Color">
                    <input class="form-control mt-3" type="text" name="descripcion" id="" placeholder="Descripcion">
                    <button type="submit" class="btn btn-primary mt-3">Agregar</button>
                </form>
                <?php
                }
                ?>
            </div>

            <!-- COLUMNA EDITAR ELEMENTOS -->
            <?php
            if (isset($_GET["edit"])) {

            ?>
            <div class="col-md-6">
                <h2>Editar elementos</h2>

                <!-- FORMULARIO -->
                <form method="GET" action="editar.php">
                    <input class="form-control " type="text" placeholder="Color" name="color" id="" value="<?php // echo $editResult["color"]; 
                                                                                                                ?>">
                    <input class="form-control mt-3" type="text" placeholder="Descripcion" name="descripcion" id=""
                        value="<?php // echo $editResult["descripcion"]; 
                                                                                                                                ?>">
                    <input class="d-none" type="text" name="id" value="<?php echo $_GET["id"];
                                                                            ?>">
                    <button type="submit" class="btn btn-primary mt-3">Editar</button>
                </form>
            </div>
            <?php
            }
            ?>
            <?php

            if (isset($_GET["delete"])) {
                header("location:index.php");

            ?>
            <div class="col-md-6">
                <h2>Elemento eliminado</h2>
            </div>
            <?php
            }

            $pdo = null;
            $prepare_query = null;
            ?>

        </div>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->
    <script src="./node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>