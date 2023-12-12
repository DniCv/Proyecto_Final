<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    session_destroy();
    exit();
}
?>



<?php
require ('include/dbconfi.php');
require('include/dbconn.php');
$database = new Connection();
$db = $database->open();

$sql = $db->prepare("SELECT Id_Animal,Nombre, Raza, Sexo, Edad, Tamaño FROM animal WHERE Tipo = 'Gato' ");

if (!$sql->execute()) {
    var_dump($sql->errorInfo());
}

$resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./Style.css">
    <title>Gatos</title>
</head>

<body>
<nav class="navbar navbar-expand-lg bg-white titulo fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php"><img src="./public/img/Logo.png" width="140px" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="./index.php #Adoptar">Adoptar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php#Acerca">Acerca de</a>
                    </li>
                </ul>
                <button type="button" class="btn btn-danger"><a class="nav-link" href="cerrar.php">Cerrar
                        sesion</a></button>
            </div>
        </div>
    </nav>

    <main>
        <header>
            <!-- Tabla de gatos-->
            
            <div class="container py-5">
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <?php foreach ($resultado as $row) { ?>
                        <div class="col">
                            <div class="card shadow-sm">
                                <?php 
                                $id = $row['Id_Animal'];
                                $imagen = "./public/img/Animales/" . $id . ".jpg";

                                if (!file_exists($imagen)) {
                                    $imagen = "./public/img/PerroIcon.png";
                                }
                                ?>
                                <img src="<?php echo $imagen; ?>" alt="">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $row['Nombre']; ?></h5>
                                    <p class="card-title">Raza: <?php echo $row['Raza']; ?></p>
                                    <p class="card-title">Sexo: <?php echo $row['Sexo']; ?></p>
                                    <p class="card-title">Tamaño: <?php echo $row['Tamaño']; ?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <a href="./Detalles.php?id=<?php echo urlencode($row['Id_Animal']); ?>&token=<?php echo urlencode(hash_hmac('sha1', $row['Id_Animal'], KEY_TOKEN)); ?>" class="btn btn-warning">Detalles</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>

            <tr>
                <td colspan="2">
                    <footer class="text-center">
                        <a href=""><img src="./public/img/Logo.png" width="140px" alt=""></a>

                        <p>
                            Derechos Reservados. Hogar Peludo 2023. | Desarrollado por DaniCv_Isela
                        </p>

                    </footer>
                </td>
            </tr>

        </header>

    </main>
    <script src="./public/js/bootstrap.min.js"></script>

</body>

</html>