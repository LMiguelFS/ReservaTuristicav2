<?php
require_once __DIR__ . '/../MODELO/CPaquete.php';
require_once __DIR__ . '/../CONTROLADOR/SConexion.php';

class PaqueteController {
   private $db;
    private $modelo; // propiedad para el modelo

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->conexion;
        $this->modelo = new CPaquete($this->db); // inicializas el modelo aquí
    }

    public function obtenerTodos() {
        return $this->modelo->obtenerTodos();  // ahora sí usas $this->modelo
    }
    public function guardar($datos, $archivos) {
        $titulo = $datos['titulo'];
        $destino = $datos['destino'];
        $fechas = $datos['fechas'];
        $cupos = $datos['cupos'];
        $precio = $datos['precio'];
        $incluye = $datos['incluye'];
        $actividades = $datos['actividades'];
        $atracciones = $datos['atracciones'];
        $duracion = $datos['duracion'];
        $frase = $datos['frase'];

        // Armar arreglo itinerario, eliminando vacíos
        $itinerarioArr = [];
        foreach ($datos['itinerario'] as $dia => $actividad) {
            if (!empty(trim($actividad))) {
                $itinerarioArr[$dia + 1] = trim($actividad);
            }
        }
        $itinerario = json_encode($itinerarioArr, JSON_UNESCAPED_UNICODE);

        $imagen = "";
        if (isset($archivos['imagen']) && $archivos['imagen']['error'] == 0) {
            $nombreImagen = time() . "_" . basename($archivos['imagen']['name']);
            move_uploaded_file($archivos['imagen']['tmp_name'], "vista/imagenes/" . $nombreImagen);
            $imagen = "vista/imagenes/" . $nombreImagen;
        }

        // Crear objeto paquete (incluye precio)
        $paquete = new CPaquete($this->db, $titulo, $destino, $fechas, $cupos, $precio, $incluye, $actividades, $atracciones, $duracion, $frase, $itinerario, $imagen);

        // Insertar en base de datos (incluye precio)
        $sql = "INSERT INTO paquetes (titulo, destino, fechas, cupos, precio, incluye, actividades, atracciones, duracion, frase, itinerario, imagen)
                VALUES (:titulo, :destino, :fechas, :cupos, :precio, :incluye, :actividades, :atracciones, :duracion, :frase, :itinerario, :imagen)";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':titulo', $paquete->getTitulo());
        $stmt->bindParam(':destino', $paquete->getDestino());
        $stmt->bindParam(':fechas', $paquete->getFechas());
        $stmt->bindParam(':cupos', $paquete->getCupos());
        $stmt->bindParam(':precio', $paquete->getPrecio()); 
        $stmt->bindParam(':incluye', $paquete->getIncluye());
        $stmt->bindParam(':actividades', $paquete->getActividades());
        $stmt->bindParam(':atracciones', $paquete->getAtracciones());
        $stmt->bindParam(':duracion', $paquete->getDuracion());
        $stmt->bindParam(':frase', $paquete->getFrase());
        $stmt->bindParam(':itinerario', $paquete->getItinerario());
        $stmt->bindParam(':imagen', $paquete->getImagen());

        return $stmt->execute();
    }

    public function mostrarPaquetes() {
        $paquete = new CPaquete($this->db);
        $paquetes = $paquete->obtenerTodos();
        require_once __DIR__ . '/../VISTA/ver_paquetes.php';
    }
}

?>
