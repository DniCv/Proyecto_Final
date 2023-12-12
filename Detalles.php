<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    session_destroy();
    exit();
}
?>

<?php
require('include/dbconfi.php');
require('include/dbconn.php');

$database = new Connection();
$db = $database->open();
$id = isset($_GET['id']) ? $_GET['id'] : '';

if ($id == '') {
    echo 'Error al procesar la información.';
    exit;
}

$token = isset($_GET['token']) ? $_GET['token'] : '';
$token_tmp = hash_hmac('sha1', $id, KEY_TOKEN);

if (!hash_equals($token, $token_tmp)) {
    echo 'Error al procesar la información.';
    exit;
}

$sql = $db->prepare("SELECT
    animal.Id_Animal,
    animal.Nombre AS Nombre_Animal,
    animal.Tipo,
    animal.Raza,
    animal.Sexo,
    animal.Edad,
    animal.Tamaño,
    animal.Descripcion,
    albergue.Id_Albergue,
    albergue.Nombre AS Nombre_Albergue,
    albergue.Num_Tel,
    albergue.Direccion,
    albergue.Correo,
    albergue.Ciudad
FROM
    animal
JOIN
    albergue ON animal.Id_Albergue = albergue.Id_Albergue
WHERE
    animal.Id_Animal = ? LIMIT 1");

$sql->execute([$id]);
$row = $sql->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./Style.css">
    <title>Detalles</title>
</head>

<body>
<nav class="navbar navbar-expand-lg bg-white titulo ">
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
            <!-- Detalles -->

            <div class="container py-5" style="background-image: url('./public/img/Fondo_D.png'); background-size: cover;">
                <div class="row">
                    <div class="col-md-6 order-md-1">
                        <?php
                        $id = $row['Id_Animal'];
                        $imagen = "./public/img/Animales/" . $id . ".jpg";

                        if (!file_exists($imagen)) {
                            $imagen = "./public/img/PerroIcon.png";
                        }
                        ?>
                        <img src="<?php echo $imagen; ?> " width="640px" class="img-fluid" alt="">
                    </div>

                    <div class="col-md-6 order-md-2">
                        <h1>
                            <?php echo $row['Nombre_Animal']; ?>
                        </h1>
                        <p>Raza:
                            <?php echo $row['Raza']; ?>
                        </p>
                        <p>Sexo:
                            <?php echo $row['Sexo']; ?>
                        </p>
                        <p>Edad:
                            <?php echo $row['Edad']; ?>
                        </p>
                        <p>Tamaño:
                            <?php echo $row['Tamaño']; ?>
                        </p>
                        <p>Descripción:
                            <?php echo $row['Descripcion']; ?>
                        </p>
                        <h6>Datos del albergue</h6>
                        <p>
                            Nombre:
                            <?php echo $row['Nombre_Albergue']; ?>
                        </p>
                        <p>Numero de telefono:
                            <?php echo $row['Num_Tel']; ?>
                        </p>
                        <p>Direccion:
                            <?php echo $row['Direccion']; ?>
                        </p>
                        <p>Correo:
                            <?php echo $row['Correo']; ?>
                        </p>
                        <p>Ciudad:
                            <?php echo $row['Ciudad']; ?>
                        </p>


                    </div>
                </div>
            </div>

            <footer class="text-center">
                <a href=""><img src="./public/img/Logo.png" width="140px" alt=""></a>
                <p>
                    Derechos Reservados. Hogar Peludo 2023. | Desarrollado por DaniCv_Isela
                </p>
            </footer>
        </header>
    </main>
    <script src="./public/js/bootstrap.min.js"></script>
</body>

</html>