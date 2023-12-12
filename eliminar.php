<?php
  session_start();
  include_once("./include/dbconn.php");
  if(isset($_GET["id"])) {
    $database = new Connection();
    $db =$database->open();
    try{
        $sql = "Delete  From comentarios Where id_comentario = '".$_GET["id"]."'";
        $_SESSION['message']=( $db -> exec($sql)) ? 'Comentario Eliminado correctamente' :'No se a eliminado, revisa los datos';
    }catch(Exception $e){
        $_SESSION['message']= $e->getMessage();
  }
  $database->close();
}else{
    $_SERVER['message'] = 'Completa el formulario';
}
header("Location: index.php");
?>