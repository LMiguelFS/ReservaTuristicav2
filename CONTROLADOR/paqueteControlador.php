<?php
include('../CONTROLADOR/CConexion.php');

if (isset($_POST["crud_operation"]) && $_POST["crud_operation"] === "listar") {
    header('Content-Type: application/json');
    $consulta = $conn->prepare("SELECT idPaquete, nombreP, precio, Costo, Ciudad, fechalnicio, fechaTermina, Categoria, Cupos, Vigencia FROM cpaquete");
    if ($consulta->execute()) {
        $resultado = $consulta->get_result();
        $paquetes = [];
        while ($fila = $resultado->fetch_assoc()) {
            $paquetes[] = $fila;
        }
        echo json_encode($paquetes);
    } else {
        echo json_encode([]);
    }
    $consulta->close();
    $conn->close();
}

if (isset($_POST["crud_operation"]) && $_POST["crud_operation"] === "reporte") {
    header('Content-Type: application/json');
    $sql = "SELECT CASE WHEN Vigencia=1 THEN 'Vigente' ELSE 'No Vigente' END as estado, COUNT(*) as cantidad FROM cpaquete GROUP BY Vigencia";
    $result = $conn->query($sql);
    $labels = [];
    $values = [];
    while ($row = $result->fetch_assoc()) {
        $labels[] = $row['estado'];
        $values[] = $row['cantidad'];
    }
    echo json_encode(['labels' => $labels, 'values' => $values]);
    $conn->close();
    exit;
}
