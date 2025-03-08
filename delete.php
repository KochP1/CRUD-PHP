<?php
include 'conn.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM `producto` WHERE id=$id";
    $result = mysqli_query($enlace, $sql);

    if ($result) {
        header('Location: index.php');
    } else {
        echo "Error al eliminar producto";
    }
}
?>
