<?php
include 'index.php';

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Obtener el ID del producto desde la URL
    parse_str(file_get_contents("php://input"), $params);
    $id = $params['id'];

    // Eliminar el producto
    $sql = "DELETE FROM producto WHERE id = $id";
    $result = mysqli_query($enlace, $sql);

    if ($result) {
        http_response_code(200); // Respuesta exitosa
        echo "Producto eliminado correctamente.";
    } else {
        http_response_code(500); // Error del servidor
        echo "Error al eliminar el producto: " . mysqli_error($enlace);
    }
} else {
    http_response_code(405); // Método no permitido
    echo "Método no permitido.";
}
?>
