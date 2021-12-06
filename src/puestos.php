<?php

class Puesto {
    private $id;
    private $nombre;
    private $salario;

    public function __get($propiedad) {
        return $this->$propiedad;
    }

    public function __set($propiedad, $valor) {
        return $this->$propiedad = $valor;
    }

    public function obtenerTodo() {
        require('config.php');
        $query = 'SELECT * FROM puestos ORDER BY id ASC';
        $resultado = $mysqli->query($query);
        if ($resultado) {
            $lista = array();
            while($fila = $resultado->fetch_assoc()) {
                $obj = new Puesto();
                $obj->id = $fila['id'];
                $obj->nombre = $fila['nombre'];
                $obj->salario = $fila['salario'];
                $lista[] = $obj;
            }
            return $lista;
        }
        $mysqli->close();
    }

    public function obtenerPorId($id) {
        require('config.php');
        $query = 'SELECT * FROM puestos WHERE id =' . $id;
        $resultado = $mysqli->query($query);
        if ($fila = $resultado->fetch_assoc()) {
            $this->id = $fila['id'];
            $this->nombre = $fila['nombre'];
            $this->salario = $fila['salario'];
        }
        $mysqli->close();
    }

    public function guardar() {
        require('config.php');
        $query = 'INSERT INTO puestos(nombre, salario)
        VALUES (
            "' . $this->nombre . '",
            "' . $this->salario . '"
        )';
        $mysqli->query($query);
        $this->id = $mysqli->insert_id;
        $mysqli->close();
    }

    public function borrar($id) {
        require('config.php');
        $query = 'DELETE FROM puestos WHERE id =' . $id;
        $mysqli->query($query);
        $mysqli->close();
    }
}

?>
