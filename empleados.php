<?php

require_once('src/empleados.php');

$empleado = new Empleado();
$empleados = $empleado->obtenerTodo();

if (isset($_GET['borrar']) && isset($_GET['id']) && isset($_GET['archivo'])) {
    $id = $_GET['id'];
    $empleado->borrar($id);
    unlink('assets/' . $_GET['archivo']);
    header('location: empleados.php');
}

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
            <div class="col-12">
                <div class="text-end">
                    <a href="crear.php" class="btn btn-primary">Crear</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td>Id</td>
                            <td>Nombre</td>
                            <td>Tel</td>
                            <td>Puesto</td>
                            <td>Salario</td>
                            <td>Provincia</td>
                            <td>Calle</td>
                            <td>Altura</td>
                            <td>Archivo</td>
                            <td></td>
                        </tr>

                        <?php foreach($empleados as $i): ?>

                        <tr>
                            <td><?php echo $i->id; ?></td>
                            <td><?php echo $i->nombre; ?></td>
                            <td><?php echo $i->tel; ?></td>
                            <td><?php echo $i->puesto; ?></td>
                            <td><?php echo $i->salario; ?></td>
                            <td><?php echo $i->provincia; ?></td>
                            <td><?php echo $i->calle; ?></td>
                            <td><?php echo $i->altura; ?></td>
                            <td>
                                <a href="assets/<?php echo $i->archivo; ?>" class="btn btn-link">Archivo</a>
                            </td>
                            <td>
                                <a href="editar.php?id=<?php echo $i->id; ?>&archivo=<?php echo $i->archivo; ?>" class="btn btn-link">Editar</a>
                                <a href="empleados.php?borrar&id=<?php echo $i->id; ?>&archivo=<?php echo $i->archivo; ?>" class="btn btn-danger">Borrar</a>
                            </td>
                        </tr>

                        <?php endforeach; ?>

                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>