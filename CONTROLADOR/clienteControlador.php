<?php
include('../CONTROLADOR/CConexion.php');
include('../MODELO/CCliente.php');


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
            // Operación para crear un nuevo cliente
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                // Verificar si los campos necesarios están presentes en el formulario
                if (isset($_POST["dIdentidad"], $_POST["aPaterno"], $_POST["aMaterno"], $_POST["nombreC"], $_POST["sexoC"], $_POST["paisC"], $_POST["fechaN"])) {
                    $CCliente1 = new CCliente(
                        $_POST["dIdentidad"],
                        $_POST["aPaterno"],
                        $_POST["aMaterno"],
                        $_POST["nombreC"],
                        $_POST["sexoC"],
                        $_POST["paisC"],
                        $_POST["fechaN"]
                    );

                    // Preparar y vincular los parámetros para la inserción
                    $consulta = $conn->prepare("INSERT INTO ccliente VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $consulta->bind_param(
                        "sssssss",
                        $CCliente1->docIdentidadC,
                        $CCliente1->aPaterno,
                        $CCliente1->aMaterno,
                        $CCliente1->NombreC,
                        $CCliente1->sexo,
                        $CCliente1->Pais,
                        $CCliente1->fNacimiento
                    );

                    // Ejecutar la consulta preparada
                    if ($consulta->execute()) {
                        echo "<script>alert('Datos registrados correctamente.'); window.close();</script>";
                    } else {
                        echo ("<script>alert('Error al registrar los datos: " . $conn->error . "');</script>");
                    }

                    $consulta->close();
                    $conn->close();
                } else {
                    echo "<script>alert('Por favor, complete todos los campos requeridos.');</script>";
                }
            }
            break;
        case 'update':
            // Operación para actualizar un cliente existente
            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                // Verificar si los campos necesarios están presentes en el formulario
                if (isset($_POST["dIdentidad"], $_POST["aPaterno"], $_POST["aMaterno"], $_POST["nombreC"], $_POST["sexoC"], $_POST["paisC"], $_POST["fechaN"])) {
                    $CCliente1 = new CCliente(
                        $_POST["dIdentidad"],
                        $_POST["aPaterno"],
                        $_POST["aMaterno"],
                        $_POST["nombreC"],
                        $_POST["sexoC"],
                        $_POST["paisC"],
                        $_POST["fechaN"]
                    );

                    // Preparar y vincular los parámetros para la actualización
                    $consulta = $conn->prepare("UPDATE ccliente SET aPaterno=?, aMaterno=?, Nombre=?, sexo=?, pais=?, fNacimiento=? WHERE docIdentidadC=?");
                    $consulta->bind_param(
                        "sssssss",
                        $CCliente1->aPaterno,
                        $CCliente1->aMaterno,
                        $CCliente1->NombreC,
                        $CCliente1->sexo,
                        $CCliente1->Pais,
                        $CCliente1->fNacimiento,
                        $CCliente1->docIdentidadC
                    );

                    // Ejecutar la consulta preparada
                    if ($consulta->execute()) {
                        echo "<script>alert('Datos actualizados correctamente.');</script>";
                    } else {
                        echo ("<script>alert('Error al actualizar los datos: " . $conn->error . "');</script>");
                    }

                    $consulta->close();
                    $conn->close();
                } else {
                    echo "<script>alert('Por favor, complete todos los campos requeridos.');</script>";
                }
            }
            break;
        case 'listar':
            // Operación para listar todos los clientes
            header('Content-Type: application/json');
            $consulta = $conn->prepare("SELECT docIdentidadC, aPaterno, aMaterno, Nombre, sexo, pais, fNacimiento FROM ccliente");
            if ($consulta->execute()) {
                $resultado = $consulta->get_result();
                $clientes = [];
                while ($fila = $resultado->fetch_assoc()) {
                    $clientes[] = $fila;
                }
                echo json_encode($clientes);
            } else {
                echo json_encode([]);
            }
            $consulta->close();
            $conn->close();
            break;

        case 'buscar':
            if (isset($_POST["nombreUsuario"], $_POST["contrasena"])) {
                // Recuperar los valores del nombre de usuario y la contraseña del formulario
                $nombreUsuario = $_POST["nombreUsuario"];
                $contrasena = $_POST["contrasena"];

                // Consulta SQL para buscar un usuario por su nombre de usuario y contraseña
                $consulta = $conn->prepare("SELECT * FROM ccliente WHERE Nombre = ? AND docIdentidadC = ?");
                $consulta->bind_param("ss", $nombreUsuario, $contrasena);

                // Ejecutar la consulta preparada
                if ($consulta->execute()) {
                    // Obtener el resultado de la consulta
                    $resultado = $consulta->get_result();
                    // Verificar si se encontraron resultados
                    if ($resultado->num_rows > 0) {
                        echo "<script>window.open('../VISTA/reservar.html', '_blank');</script>";
                    } else {
                        echo "<script>alert('No se encuentra registrado');</script>";
                    }
                }

                $consulta->close();
                $conn->close();
            } else {
                echo "<script>alert('Por favor, complete todos los campos requeridos.');</script>";
            }

            break;
        case 'delete':
            if (isset($_POST["docIdentidadC"])) {
                $docIdentidadC = $_POST["docIdentidadC"];
                $consulta = $conn->prepare("DELETE FROM ccliente WHERE docIdentidadC = ?");
                $consulta->bind_param("s", $docIdentidadC);
                if ($consulta->execute()) {
                    echo "Cliente eliminado correctamente.";
                } else {
                    echo "Error al eliminar el cliente.";
                }
                $consulta->close();
                $conn->close();
            } else {
                echo "ID de cliente no proporcionado.";
            }
            break;

        default:
            echo "<script>alert('Operación no válida.');</script>";
            break;
    }
}
