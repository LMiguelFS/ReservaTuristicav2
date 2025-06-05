<?php
require_once 'PaqueteController.php';

$controller = new PaqueteController();
if ($controller->guardar($_POST, $_FILES)) {
    echo "<script>alert('Paquete guardado exitosamente'); window.location.href='registrar_paquete.php';</script>";
} else {
    echo "<script>alert('Error al guardar'); history.back();</script>";
}
?>
