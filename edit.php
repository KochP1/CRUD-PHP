<?php
include 'conn.php';
$id = $_GET['id'];
$sql = "SELECT * FROM producto WHERE id=$id";
$result = mysqli_query($enlace, $sql);
$mostrar = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <title>Editar registro</title>

    <style>
        .edit-form{
            display: flex;
            flex-direction: column;
            margin: auto;
            margin-top: 30px;
            width: 30vw;
            border-radius: 10px;
            box-shadow: 0px 0px 6px 0px #fff;
        }

        .edit-form div{
            width: 100% !important;
            display: flex !important;
            flex-direction: column !important;
            align-items: center;
        }

        .form-control, .form-label{
            width: 90%;
        }
    </style>
</head>
<body>
<form method="post" class="edit-form">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nombre</label>
    <input type="text" class="form-control" name="name" value="<?php echo $mostrar["nombre"]?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Descripcion</label>
    <input type="text" class="form-control" name="descripcion" value="<?php echo $mostrar["descripcion"]?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Precio</label>
    <input type="number" class="form-control" step="any" name="precio" value="<?php echo $mostrar["precio"]?>">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Stock</label>
    <input type="number" class="form-control" name="stock" value="<?php echo $mostrar["stock"]?>">
  </div>
  <button type="submit" class="btn btn-primary" name="registro">Editar</button>
</form>
</body>
</html>

<?php
if (isset($_POST['registro'])) {
    $nombre = mysqli_real_escape_string($enlace, $_POST['name']);
    $descripcion = mysqli_real_escape_string($enlace, $_POST['descripcion']);
    $precio = mysqli_real_escape_string($enlace, $_POST['precio']);
    $stock = mysqli_real_escape_string($enlace, $_POST['stock']);

    $insertDatos = "UPDATE `producto` SET nombre='$nombre', descripcion='$descripcion', precio='$precio', stock='$stock' WHERE id=$id";
    $ejecutarInsert = mysqli_query($enlace, $insertDatos);

    if ($ejecutarInsert) {
        header('Location: index.php');
    } else {
        echo "Error al editar los datos: " . mysqli_error($enlace);
    }
}
?>