<?php
include 'conn.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>App web PHP</title>
</head>
<body>
    <div class="title__container"><h1>Inventario de productos</h1></div>
    <div class="container">
        <form action="#" method="post" class="form" name="productos_php">
            <div class="input__container">
                <label for="name" class="regist-label">Nombre</label>
                <input type="text" name="name" class="regist-input">
            </div>

            <div class="input__container">
                <label for="descripcion" class="regist-label">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" class="regist-input">
            </div>

            <div class="input__container">
                <label for="precio" class="regist-label">Precio</label>
                <input type="number" name="precio" id="precio" step="any" class="regist-input">
            </div>

            <div class="input__container">
                <label for="stock" class="regist-label">Stock</label>
                <input type="number" name="stock" id="stock" class="regist-input">
            </div>

            <div class="input__container btn__container">
                <label for="enviar" class="regist-label">Registro</label>
                <button type="submit" name="registro" class="btn btn-primary regist-input">Enviar</button>
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
                        <button class="btn btn-danger" onclick="confirmarEliminacion(<?php echo $mostrar['id']; ?>)">Eliminar</button>
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

    <script>
        function confirmarEliminacion(id) {
            if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
                window.location.href = `delete.php?id=${id}`;
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

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