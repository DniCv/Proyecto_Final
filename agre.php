<?php
    session_start();
    include_once('./include/dbconn.php');
    if(isset($_POST['agregar'])){
        $database = new Connection();
        $db = $database->open();
        try{
            $stmt = $db->prepare("INSERT INTO comentarios (comentario	) Values (:nombre)");
            $_SESSION["message"]=($stmt->execute(array(":nombre"=> $_POST['nombre']))) ? "comentario guardado correctamente"
            :"Algo salio mal, No se guardo correctamente el comentario";  
        }
        catch
        (PDOException $e){
            $_SESSION["message"] = $e->getMessage();
        }
        $database->close();
    }
    else{
        $_SESSION["message"] = "LLene completamente el Formulario";
    }
    header("Location: index.php");
?>