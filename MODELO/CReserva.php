<?php
class CReserva {
    private $idReserva;
    private $docidentidadC;
    private $idPaquete;
    private $codEmpleado;
    private $fecha;
    private $tipoPago;
    private $cantidad;
    private $totalVenta;

    // Constructor
    public function __construct($newdocidentidadC, $newidPaquete, $newcodEmpleado, $newfecha, $newtipoPago, $newcantidad, $newtotalVenta) {
        $this->docidentidadC = $newdocidentidadC;
        $this->idPaquete = $newidPaquete;
        $this->codEmpleado = $newcodEmpleado;
        $this->fecha = $newfecha;
        $this->tipoPago = $newtipoPago;
        $this->cantidad = $newcantidad;
        $this->totalVenta = $newtotalVenta;
    }

    // Getters
    public function getDocIdentidadC() {
        return $this->docidentidadC;
    }

    public function getIdPaquete() {
        return $this->idPaquete;
    }

    public function getCodEmpleado() {
        return $this->codEmpleado;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function getTipoPago() {
        return $this->tipoPago;
    }

    public function getCantidad() {
        return $this->cantidad;
    }

    public function getTotalVenta() {
        return $this->totalVenta;
    }
}
?>