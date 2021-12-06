<?php

require_once('src/empleados.php');
require_once('src/puestos.php');

$empleado = new Empleado();

if ($_REQUEST) {
    if (isset($_POST['enviar'])) {
        $empleado->nombre = $_POST['nombre'];
        $empleado->tel = $_POST['tel'];
        $empleado->puesto = $_POST['puesto'];
        $empleado->provincia = $_POST['provincia'];
        $empleado->calle = strtoupper($_POST['calle']);
        $empleado->altura = $_POST['altura'];

        if ($_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
            $nombre = $_FILES['archivo']['tmp_name'];
            $archivo = uniqid() . '.' . pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
            move_uploaded_file($nombre, 'assets/' . $archivo);
            $empleado->archivo = $archivo;
            unlink('assets/' . $_GET['archivo']);
        }

        $id = $_GET['id'];
        $empleado->editar($id);
        header('location: empleados.php');
    }

    if (isset($_GET['id'])) {
        $obj = new Empleado();
        $id = $_GET['id'];
        $obj->obtenerPorId($id);

        $p = new Puesto();
        $p->obtenerPorId($obj->puesto);

    }
}

$puesto = new Puesto();
$puestos = $puesto->obtenerTodo();

$json = file_get_contents('provincias.json');
$provincias = json_decode($json, true);

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
            <div class="col-12 col-lg-6 offset-lg-3">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input type="text" class="form-control" name="nombre" required
                                
                                value="<?php echo $obj->nombre; ?>"

                                >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Tel</label>
                                <input type="text" class="form-control" name="tel" required
                                
                                value="<?php echo $obj->tel; ?>"

                                >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Puestos</label>
                                <select class="form-select" name="puesto">

                                    <option value="<?php echo $p->id; ?>" selected><?php echo $p->nombre; ?></option>

                                    <?php foreach($puestos as $e): ?>

                                    <option value="<?php echo $e->id; ?>"><?php echo $e->nombre; ?></option>

                                    <?php endforeach; ?>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Provincia</label>
                                <select class="form-select" name="provincia">

                                    <option selected><?php echo $obj->provincia; ?></option>

                                    <?php for($r = 0; $r < 24; $r++): ?>

                                    <option><?php echo $provincias['provincias'][$r]['iso_nombre']; ?></option>

                                    <?php endfor; ?>

                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Calle</label>
                                <input type="text" class="form-control" name="calle" required
                                
                                value="<?php echo $obj->calle; ?>"

                                >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Altura</label>
                                <input type="number" class="form-control" name="altura" required
                                
                                value="<?php echo $obj->altura; ?>"
                                
                                >
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Archivo</label>
                                <input type="file" class="form-control" name="archivo">
                            </div>
                            <div class="text-end">
                                <a href="empleados.php" class="btn btn-link">Volver</a>
                                <button type="submit" class="btn btn-primary" name="enviar">Editar</button>
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