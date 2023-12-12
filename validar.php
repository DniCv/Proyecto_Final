<?php
session_start();
include 'include/dbconn.php';
$database = new Connection();
$db = $database->open();

if(isset($_POST['I_Sesion'])) {
    $correo = $_POST["Correo"];
    $contraseña = $_POST["Contraseña"];
    $contraseña = hash('sha512', $contraseña); // Aplicas hash a la contraseña

    try {
        $stmt = $db->prepare("SELECT * FROM usuario WHERE Correo = :correo AND Contraseña = :contrasena");
        $stmt->bindParam(':correo', $correo, PDO::PARAM_STR);
        $stmt->bindParam(':contrasena', $contraseña, PDO::PARAM_STR);
        $stmt->execute();
        
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if($resultado) {
            $_SESSION['usuario'] = $resultado; 
            header("Location: index.php"); // Corregir esta línea
            exit;
        } else {
            echo '
            <script>
            alert("Usuario no existe, por favor verifique los datos introducidos");
            window.location = "login.php";
            </script>
            ';
            exit;
        }
        
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $database->close();
}
?>
