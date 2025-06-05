

<?php
class Conexion {
    public $conexion;

    public function __construct() {
        try {
            $this->conexion = new PDO('mysql:host=localhost;dbname=bdagenciatours', 'root', '1111');
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
?>
