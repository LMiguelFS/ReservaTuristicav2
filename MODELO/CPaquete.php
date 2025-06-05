<?php
class CPaquete {
    private $conexion;

    private $titulo, $destino, $fechas, $cupos, $precio, $incluye, $actividades, $atracciones, $duracion, $frase, $itinerario, $imagen;

    public function __construct($conexion, $titulo = null, $destino = null, $fechas = null, $cupos = null, $precio = null, $incluye = null, $actividades = null, $atracciones = null, $duracion = null, $frase = null, $itinerario = null, $imagen = null) {
        $this->conexion = $conexion;

        $this->titulo = $titulo;
        $this->destino = $destino;
        $this->fechas = $fechas;
        $this->cupos = $cupos;
        $this->precio = $precio;
        $this->incluye = $incluye;
        $this->actividades = $actividades;
        $this->atracciones = $atracciones;
        $this->duracion = $duracion;
        $this->frase = $frase;
        $this->itinerario = $itinerario;
        $this->imagen = $imagen;
    }

    public function getTitulo() { return $this->titulo; }
    public function getDestino() { return $this->destino; }
    public function getFechas() { return $this->fechas; }
    public function getCupos() { return $this->cupos; }
    public function getPrecio() { return $this->precio; }
    public function getIncluye() { return $this->incluye; }
    public function getActividades() { return $this->actividades; }
    public function getAtracciones() { return $this->atracciones; }
    public function getDuracion() { return $this->duracion; }
    public function getFrase() { return $this->frase; }
    public function getItinerario() { return $this->itinerario; }
    public function getImagen() { return $this->imagen; }

    // Método para obtener todos los paquetes desde la BD
    public function obtenerTodos() {
    $sql = "SELECT idPaquete, titulo, destino, fechas, cupos, precio, imagen FROM paquetes";
    $stmt = $this->conexion->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    

    public function obtenerPorId($idPaquete) {
        $sql = "SELECT * FROM paquetes WHERE idPaquete = :idPaquete";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':idPaquete', $idPaquete, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
