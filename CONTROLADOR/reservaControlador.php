<?php
include('../CONTROLADOR/CConexion.php');
include('../MODELO/CReserva.php');

// Verificar si se ha enviado una solicitud de operación CRUD
if (isset($_POST["crud_operation"])) {
    
    // Realizar la operación CRUD correspondiente
    realizarCRUD($_POST["crud_operation"], $conn);
}

// Función para realizar la operación CRUD deseada
function realizarCRUD($operacion, $conn)
{
    switch ($operacion) {
        case 'create':
            // Verificar si los campos necesarios están presentes en el formulario
            if (isset($_POST["docidentidadC"], $_POST["idPaquete"], $_POST["codEmpleado"], $_POST["fecha"], $_POST["tipoPago"], $_POST["cantidad"], $_POST["totalVenta"])) {
                // Sanitizar los datos del formulario
                $docidentidadC = $conn->real_escape_string($_POST["docidentidadC"]);
                $idPaquete = $conn->real_escape_string($_POST["idPaquete"]);
                $codEmpleado = $conn->real_escape_string($_POST["codEmpleado"]);
                $fecha = $conn->real_escape_string($_POST["fecha"]);
                $tipoPago = $conn->real_escape_string($_POST["tipoPago"]);
                $cantidad = $conn->real_escape_string($_POST["cantidad"]);
                $totalVenta = $conn->real_escape_string($_POST["totalVenta"]);

                $CReserva1 = new CReserva(
                    $docidentidadC,
                    $idPaquete,
                    $codEmpleado,
                    $fecha,
                    $tipoPago,
                    $cantidad,
                    $totalVenta
                );

                // Preparar y vincular los parámetros para la inserción
                $consulta = $conn->prepare("INSERT INTO reserva (docidentidadC, idPaquete, codEmpleado, fecha, tipoPago, cantidad, totalVenta) VALUES (?, ?, ?, ?, ?, ?, ?)");
                $consulta->bind_param("sssssid",
                    $CReserva1->getDocIdentidadC(),
                    $CReserva1->getIdPaquete(),
                    $CReserva1->getCodEmpleado(),
                    $CReserva1->getFecha(),
                    $CReserva1->getTipoPago(),
                    $CReserva1->getCantidad(),
                    $CReserva1->getTotalVenta()
                );

                // Ejecutar la consulta preparada
                if ($consulta->execute()) {
                    echo "<script>alert('Reserva registrada correctamente.');</script>";
                } else {
                    echo ("<script>alert('Error al registrar la reserva: " . $conn->error . "');</script>");
                }

                $consulta->close();
            } else {
                echo "<script>alert('Por favor, complete todos los campos requeridos.');</script>";
            }
            break;
        // Aquí podrías agregar otros casos para 'read', 'update' y 'delete'
    }

    // Cerrar la conexión al final
    $conn->close();
}
?>