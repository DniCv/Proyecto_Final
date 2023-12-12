<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    session_destroy();
    exit();
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/bootstrap.min.css">
    <link rel="stylesheet" href="./Style.css">
    <title>Hogar_Peludo</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-white titulo fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><img src="./public/img/Logo.png" width="140px" alt=""></a>
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
                        <a class="nav-link" href="#Adoptar">Adoptar</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#Acerca">Acerca de</a>
                    </li>
                </ul>
                <button type="button" class="btn btn-danger"><a class="nav-link" href="cerrar.php">Cerrar
                        sesion</a></button>
            </div>
        </div>
    </nav>
    <main>

        <header>
            <div class="col-md-12">
                <div class='img'>
                    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="./public/img/1.png" class="d-block w-100 img-fluid" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="./public/img/2.png" class="d-block w-100 img-fluid" alt="...">
                            </div>
                            <div class="carousel-item">
                                <img src="./public/img/3.png" class="d-block w-100 img-fluid" alt="...">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container py-5">

                <div id="Acerca" class="row">
                    <div class="col-md-8">
                        <h6>ACERCA DE</h6>
                        <H1 class="titulo">Nosotros</H1>
                        <p class="lead text-justify">
                            Somos más que una organización; somos una comunidad apasionada unida por el amor a los
                            animales. Juntos, dedicamos nuestros esfuerzos a construir un mundo donde cada ser vivo, de
                            patas, tenga la oportunidad de experimentar una vida plena y feliz.
                        </p>
                        <p class="lead text-justify">
                            Nos esforzamos por trascender los límites, construir puentes entre corazones compasivos y
                            ser el cambio positivo que deseamos ver en la vida de cada criatura.
                        </p>
                    </div>
                    <div class="col-md-4 text-center">
                        <img src="./public/img/PerroGato.png" width="340px" alt class="img-fluid ">
                    </div>

                </div>
            </div>


            <div id="Adoptar" class="container py-5 ">
                <div class="col-md-12 text-center titulo">
                    <h1>¿Que amigo peludo buscas?</h1>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <a href="./Gatos.php"><img src="./public/img/Gato.png" width="460px" , lang="500" alt
                                class="img-fluid "></a>

                    </div>
                    <div class="col-md-5">
                        <a href="./Perros.php"><img src="./public/img/Perro.png" width="460px" , lang="500" alt
                                class="img-fluid "></a>

                    </div>
                </div>
            </div>

            <div class="container py-5 " style="background: #FFDBA3;">
                <div class="row">
                    <div class="col-md-5 text-center">
                        <img src="public\img\Requisitos.png" width="300px" alt class="img-fluid ">
                    </div>
                    <div class="col-md-7">
                        <h2 class="titulo">Requisitos</h2>
                        <ul class="lead text-justify">
                            <li>Copia de identificación oficial (INE)</li>
                            <li>Copia de comprobante de domicilio</li>
                            <li>Llenar una responsiva de adopción</li>
                            <li>Cumplir con la recepción de visita al lugar donde vivirá el animalito (con la finalidad
                                de que sea un lugar adecuado para su nuevo hogar)</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="container py-5">
                
                    <div class="row mx-auto">
                        <div id="Tabla" class="row mx-auto">
                            <form action="agre.php" method="POST">
                                <div class="col-md-4">
                                    <label for="form-label">Comentario</label>
                                    <input type="text" id="nombre" name="nombre" class="form-control" required
                                        autofocus>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary" name="agregar">Ingresar</button>

                                </div>
                            </form>
                            <br>
                        </div>
                        <table class="table table-hover">
                            <thead>
                                <th>Comentario</th>
                                <th></th>
                            </thead>
                            <tbody>
                                <?php
                                include_once('include/dbconn.php');
                                $database = new Connection();
                                $db = $database->open();

                                try {
                                    $sql = 'SELECT * FROM comentarios';
                                    foreach ($db->query($sql) as $row) { ?>
                                        <tr>

                                            <td>
                                                <?php echo $row['comentario'] ?>
                                            </td>
                                            <td>
                                                <a class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#editModal_<?php echo $row['id_comentario']; ?>">
                                                    <img src="./public/img/editar.png" width="20px">
                                                </a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="editModal_<?php echo $row['id_comentario']; ?>"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Editar comentario
                                                                </h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST"
                                                                    action="edit.php? id=<?php echo $row['id_comentario']; ?>">

                                                                    <div class="row form-group">
                                                                        <div class="col-sm-2">
                                                                            <label class="control-label"
                                                                                style="position:relative; top:7px;">Comentario:</label>
                                                                        </div>
                                                                        <div class="col-sm-10">
                                                                            <input type="text" class="form-control"
                                                                                name="nombres"
                                                                                value="<?php echo $row['comentario']; ?>">
                                                                        </div>

                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Cerrar</button>
                                                                        <button type="submit" name="editar"
                                                                            class="btn btn-primary">Guardar</button>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                <a class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#borrarModal_<?php echo $row["id_comentario"]; ?>">
                                                    <img src="./public/img/eliminar.png" width="20px">
                                                </a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="borrarModal_<?php echo $row['id_comentario']; ?>"
                                                    tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Eliminar
                                                                    comentario</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                    aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form method="POST"
                                                                    action="eliminar.php?id=<?php echo $row['id_comentario']; ?>">

                                                                    <div class="row form-group">
                                                                        <h2 class="text-center">
                                                                            <?php echo $row['comentario']; ?>
                                                                        </h2>

                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Cerrar</button>
                                                                        <button type="submit" name="eliminar"
                                                                            class="btn btn-primary">Eliminar</button>
                                                                    </div>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                            </div>
                        </div>
                        <?php
                                    }
                                } catch (PDOException $e) {
                                    echo "Error en la conexion" .
                                        $e->getMessage();
                                }
                                $database->close();
                                ?>
                </tbody>
                </table>

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