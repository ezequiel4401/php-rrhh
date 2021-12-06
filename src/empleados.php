<?php

class Empleado {
    private $id;
    private $nombre;
    private $tel;
    private $puesto;
    private $salario;
    private $provincia;
    private $calle;
    private $altura;
    private $archivo;

    public function __get($propiedad) {
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor) {
        return $this->$propiedad = $valor;
    }

    public function obtenerTodo() {
        require('config.php');
        $query = 'SELECT *,
        empleados.id AS id,
        empleados.nombre AS nombre,
        puestos.nombre AS puesto
        FROM empleados
        INNER JOIN puestos ON empleados.puesto = puestos.id ORDER BY empleados.id ASC';
        $resultado = $mysqli->query($query);
        if ($resultado) {
            $lista = array();
            while($fila = $resultado->fetch_assoc()) {
                $obj = new Empleado();
                $obj->id = $fila['id'];
                $obj->nombre = $fila['nombre'];
                $obj->tel = $fila['tel'];
                $obj->puesto = $fila['puesto'];
                $obj->salario = $fila['salario'];
                $obj->provincia = $fila['provincia'];
                $obj->calle = $fila['calle'];
                $obj->altura = $fila['altura'];
                $obj->archivo = $fila['archivo'];
                $lista[] = $obj;
            }
            return $lista;
        }
        $mysqli->close();
    }

    public function obtenerPorId($id) {
        require('config.php');
        $query = 'SELECT * FROM empleados WHERE id =' . $id;
        $resultado = $mysqli->query($query);
        if ($fila = $resultado->fetch_assoc()) {
            $this->id = $fila['id'];
            $this->nombre = $fila['nombre'];
            $this->tel = $fila['tel'];
            $this->puesto = $fila['puesto'];
            $this->provincia = $fila['provincia'];
            $this->calle = $fila['calle'];
            $this->altura = $fila['altura'];
            $this->archivo = $fila['archivo'];
        }
        $mysqli->close();
    }

    public function guardar() {
        require('config.php');
        $query = 'INSERT INTO empleados(nombre, tel, puesto, provincia, calle, altura, archivo)
        VALUES (
            "' . $this->nombre . '",
            "' . $this->tel . '",
            "' . $this->puesto . '",
            "' . $this->provincia . '",
            "' . $this->calle . '",
            "' . $this->altura . '",
            "' . $this->archivo . '"
        )';
        $mysqli->query($query);
        $this->id = $mysqli->insert_id;
        $mysqli->close();
    }

    public function editar($id) {
        require('config.php');
        $query = 'UPDATE empleados SET
        nombre = "' . $this->nombre . '",
        tel = "' . $this->tel . '",
        puesto = "' . $this->puesto . '",
        provincia = "' . $this->provincia . '",
        calle = "' . $this->calle . '",
        altura = "' . $this->altura . '",
        archivo = "' . $this->archivo . '"
        WHERE id =' . $id;
        $mysqli->query($query);
        $mysqli->close();
    }

    public function borrar($id) {
        require('config.php');
        $query = 'DELETE FROM empleados WHERE id =' . $id;
        $mysqli->query($query);
        $mysqli->close();
    }
}

?>
