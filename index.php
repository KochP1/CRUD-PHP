<?php
include 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>App web PHP</title>
</head>
<body>
    <div class="container">
        <form action="#" method="post" class="form" name="productos_php">
            <div class="input__container">
                <label for="name">Nombre</label>
                <input type="text" name="name">
            </div>

            <div class="input__container">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" id="descripcion">
            </div>

            <div class="input__container">
                <label for="precio">Precio</label>
                <input type="number" name="precio" id="precio" step="any">
            </div>

            <div class="input__container">
                <label for="stock">Stock</label>
                <input type="number" name="stock" id="stock">
            </div>

            <div class="input__container">
                <label for="enviar">Registro</label>
                <button type="submit" name="registro" class="btn btn-primary">Enviar</button>
            </div>
        </form>
    </div>

    <div class="table__container">
        <table class="table table-dark">
            <tr">
                <th class="th">#</th>
                <th class="th">Nombre</th>
                <th class="th">Descripción</th>
                <th class="th">Precio</th>
                <th class="th">Stock</th>
                <th></th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            <?php
            $sql = 'SELECT * FROM producto';
            $resultado = mysqli_query($enlace, $sql);

            while($mostrar = mysqli_fetch_array($resultado)){
            ?>
                <tr class="table-active">
                    <td><?php echo $mostrar["id"]?></td>
                    <td><?php echo $mostrar["nombre"]?></td>
                    <td><?php echo $mostrar["descripcion"]?></td>
                    <td><?php echo $mostrar["precio"]?></td>
                    <td><?php echo $mostrar["stock"]?></td>
                    <td>
                        <button class="btn btn-danger" onclick="eliminarProducto(<?php echo $mostrar['id']; ?>)">Eliminar</button>
                    </td>
                    <td>
                        <button class="btn btn-warning"><a class="link" href="edit.php?id=<?php echo $mostrar['id']; ?>">Editar</a></button>
                    </td>
                </tr>
            <?php
            };
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<script>
    function eliminarProducto(id) {
        if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
            fetch(`delete.php?id=${id}`, {
                method: 'DELETE', // Usar el método DELETE
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `id=${id}` // Enviar el ID en el cuerpo de la solicitud
            })
            .then(response => {
                if (response.ok) {
                    window.location.href = 'index.php'; // Recargar la página después de eliminar
                } else {
                    alert("Error al eliminar el producto.");
                }
            })
            .catch(error => {
                console.error("Error:", error);
            });
        }
    }
</script>

<?php
if (isset($_POST['registro'])) {
    $nombre = mysqli_real_escape_string($enlace, $_POST['name']);
    $descripcion = mysqli_real_escape_string($enlace, $_POST['descripcion']);
    $precio = mysqli_real_escape_string($enlace, $_POST['precio']);
    $stock = mysqli_real_escape_string($enlace, $_POST['stock']);

    $insertDatos = "INSERT INTO producto (nombre, descripcion, precio, stock) VALUES ('$nombre', '$descripcion', '$precio', '$stock')";
    $ejecutarInsert = mysqli_query($enlace, $insertDatos);

    if ($ejecutarInsert) {
        echo 'Caraota';
    } else {
        echo "Error al insertar los datos: " . mysqli_error($enlace);
    }
}
?>