<?php
session_start();
include("include/dbconn.php");

if(isset($_POST["editar"])) {
    $database = new Connection();
    $db = $database->open();
    try {
        $id = $_GET["id"];  // Corrected typo here
        $nombres = $_POST["nombres"];

        $sql = "UPDATE comentarios SET comentario = '$nombres' WHERE id_comentario = '$id'";

        $_SESSION["message"] = ($db->exec($sql)) ? 'Comentario actualizado correctamente ' : 'No se puede actualizar el comentario';

    } catch (PDOException $e) {
        $_SESSION['message'] = $e->getMessage();  // Corrected here
    }
    $database->close();
} else {
    $_SESSION['message'] = 'Completa correctamente el formulario';  // Corrected here
}

header("Location: index.php");
?>
