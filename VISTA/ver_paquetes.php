<?php
require_once '../CONTROLADOR/paqueteControlador.php';

$controlador = new PaqueteController();
$paquetes = $controlador->obtenerTodos();

if (!is_array($paquetes)) {
    $paquetes = [];
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Tours Disponibles</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <style>
    .tour-card { transition: transform 0.3s ease; }
    .tour-card:hover { transform: translateY(-10px); }
    .badge { font-size: 1.1rem; padding: 8px 15px; }
  </style>
</head>
<body>
  <main>
    <section class="container py-5">
      <h2 class="text-center mb-4">Tours Disponibles</h2>
      <div class="row gx-4 gy-4">
        <?php foreach ($paquetes as $paquete): ?>
          <div class="col-md-4">
            <div class="card tour-card h-100 shadow-sm">
              <img src="../<?= htmlspecialchars($paquete['imagen']) ?>" 
     class="card-img-top" 
     alt="<?= htmlspecialchars($paquete['titulo'] ?? 'Sin título') ?>" 
     style="height: 220px; object-fit: cover;">

                

              <div class="card-body d-flex flex-column">
                <h5 class="card-title"><?= htmlspecialchars($paquete['titulo'] ?? 'Sin título') ?></h5>
                <p class="card-text text-muted mb-1">
                  <i class="bi bi-geo-alt-fill"></i> <?= htmlspecialchars($paquete['destino'] ?? 'No especificado') ?>
                </p>
                <p class="card-text mb-1">
                  <i class="bi bi-calendar-event"></i> <?= htmlspecialchars($paquete['fechas'] ?? 'No especificadas') ?>
                </p>
                <p class="card-text mb-1">
                  <i class="bi bi-people-fill"></i> Cupos: <?= htmlspecialchars($paquete['cupos'] ?? 'No especificado') ?>
                </p>
                <p class="card-text fw-bold text-primary">
                  S/. <?= number_format($paquete['precio'] ?? 0, 2) ?> <span class="text-muted fs-6">por persona</span>
                </p>

                <a href="detalle-paquete.php?id=<?= $paquete['idPaquete'] ?>" class="btn btn-outline-primary mt-auto">
  Conocer más
</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </section>
  </main>
</body>
</html>
