<?php  
    class CPaquete {
        private $idPaquete;
        private $nombreP ;
        private $precio ;
        private $Costo ;
        private $Ciudad ;
        private $fechaInicio ;
        private $fechaTermina ;
        private $Categoria ;
        private $Cupos ;
        private $Vigencia ;

        // Constructor
    public function __construct($idPaquete, $nombreP, $precio, $Costo, $Ciudad, $fechaInicio, $fechaTermina, $Categoria, $Cupos, $Vigencia) {
        $this->idPaquete = $idPaquete;
        $this->nombreP = $nombreP;
        $this->precio = $precio;
        $this->Costo = $Costo;
        $this->Ciudad = $Ciudad;
        $this->fechaInicio = $fechaInicio;
        $this->fechaTermina = $fechaTermina;
        $this->Categoria = $Categoria;
        $this->Cupos = $Cupos;
        $this->Vigencia = $Vigencia;
    }

    // Getters

    public function getNombreP() {
        return $this->nombreP;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getCosto() {
        return $this->Costo;
    }

    public function getCiudad() {
        return $this->Ciudad;
    }

    public function getFechaInicio() {
        return $this->fechaInicio;
    }

    public function getFechaTermina() {
        return $this->fechaTermina;
    }

    public function getCategoria() {
        return $this->Categoria;
    }

    public function getCupos() {
        return $this->Cupos;
    }

    public function getVigencia() {
        return $this->Vigencia;
    }

    // Setters
    public function setIdPaquete($idPaquete) {
        $this->idPaquete = $idPaquete;
    }

    public function setNombreP($nombreP) {
        $this->nombreP = $nombreP;
    }

    public function setPrecio($precio) {
        $this->precio = $precio;
    }

    public function setCosto($Costo) {
        $this->Costo = $Costo;
    }

    public function setCiudad($Ciudad) {
        $this->Ciudad = $Ciudad;
    }

    public function setFechaInicio($fechaInicio) {
        $this->fechaInicio = $fechaInicio;
    }

    public function setFechaTermina($fechaTermina) {
        $this->fechaTermina = $fechaTermina;
    }

    public function setCategoria($Categoria) {
        $this->Categoria = $Categoria;
    }

    public function setCupos($Cupos) {
        $this->Cupos = $Cupos;
    }

    public function setVigencia($Vigencia) {
        $this->Vigencia = $Vigencia;
    }

    }
       




?>