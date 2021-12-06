<?php

require_once('src/puestos.php');

$puesto = new Puesto();

if ($_REQUEST) {
    if (isset($_POST['enviar'])) {
        $puesto->nombre = $_POST['nombre'];
        $puesto->salario = $_POST['salario'];
        $puesto->guardar();
        header('location: puestos.php');
    }
    if (isset($_GET['borrar']) && isset($_GET['id'])) {
        $id = $_GET['id'];
        $puesto->borrar($id);
        header('location: puestos.php');
    }
}

$puestos = $puesto->obtenerTodo();

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RRHH</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        * {
            border-radius: 0 !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <h5 class="display-5">RRHH</h5>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <img src="list.svg" class="img-fluid">
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a href="empleados.php" class="nav-link">Empleados</a>
                    </li>
                    <li class="nav-item">
                        <a href="puestos.php" class="nav-link">Puestos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <br>
        <div class="row">
            <div class="col-12 col-lg-8">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>Id</td>
                            <td>Nombre</td>
                            <td>Salario</td>
                            <td></td>
                        </tr>

                        <?php foreach($puestos as $p): ?>

                        <tr>
                            <td><?php echo $p->id; ?></td>
                            <td><?php echo $p->nombre; ?></td>
                            <td><?php echo $p->salario; ?></td>
                            <td>
                                <a href="puestos.php?borrar&id=<?php echo $p->id; ?>" class="btn btn-danger">Borrar</a>
                            </td>
                        </tr>

                        <?php endforeach; ?>

                    </table>
                </div>
            </div>
            <div class="col-12 col-lg-4">
                <div class="card">
                    <div class="card-body">
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Salario</label>
                                <input type="number" step="any" class="form-control" name="salario" required>
                            </div>
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary" name="enviar">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>