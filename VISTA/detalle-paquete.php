<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../CONTROLADOR/SConexion.php';
require_once '../MODELO/CPaquete.php';

$objConexion = new Conexion();
$conexion = $objConexion->conexion;

$id_paquete = $_GET['id'] ?? null;

if ($id_paquete) {
    $paquete = new CPaquete($conexion);
    $detalle = $paquete->obtenerPorId($id_paquete);
    if (!$detalle) {
        die("Paquete no encontrado");
    }
} else {
    die("ID de paquete no especificado");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title><?= htmlspecialchars($detalle['titulo']) ?> - Paquete Turístico</title>

  <!-- Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="css/estilos.css" />
</head>
<body class="bg-gradient-to-b from-blue-50 to-white font-sans text-gray-800 overflow-x-hidden">

  <!-- CABECERA -->
  <header class="menu-principal bg-gradient-to-r from-blue-800 to-blue-600 p-5 text-white shadow-lg sticky top-0 z-50">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
      <h1 class="text-3xl font-bold mb-3 md:mb-0 hover:scale-105 transition-transform">🌎 TRAVEL AGENCY CUSCO</h1>
      <nav>
        <ul class="flex gap-6 text-lg"> 
          <li><a href="/reservaTuristica/VISTA/index.html" class="hover:text-yellow-300 transition-colors">Inicio</a></li>
          <li><a href="/reservaTuristica/VISTA/ver_paquetes.php" class="hover:text-yellow-300 transition-colors">Destinos</a></li>

          <li><a href="registrar_paquete.php" class="hover:text-yellow-300 transition-colors">Registrar</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <!-- CONTENIDO PRINCIPAL -->
  <main class="container mx-auto my-10 px-4">
    <!-- INFO PAQUETE -->
    <section class="info-paquete bg-white rounded-xl shadow-xl p-8 grid gap-8 md:grid-cols-2 animate-fade-in">
      <!-- Imagen del paquete -->
      <div class="overflow-hidden rounded-lg shadow-md hover:scale-105 transition-transform">
<img src="/reservaTuristica/<?= htmlspecialchars($detalle['imagen']) ?>" alt="<?= htmlspecialchars($detalle['titulo']) ?>" class="w-full h-96 object-cover rounded-md">
      </div>

      <!-- Información del paquete -->
      <!-- Dentro del div de información del paquete -->
<div class="space-y-4 text-lg leading-relaxed">
  <h2 class="text-3xl font-bold text-blue-700 mb-4">✨ <?= htmlspecialchars($detalle['titulo']) ?></h2>
  <p><strong>Destino:</strong> <?= htmlspecialchars($detalle['destino']) ?></p>
  <p><strong>Fechas disponibles:</strong> <?= htmlspecialchars($detalle['fechas']) ?></p>
  <p><strong>Cupos:</strong> <?= htmlspecialchars($detalle['cupos']) ?></p>
  <p><strong>Precio:</strong> S/ <?= number_format($detalle['precio'], 2) ?></p>
  <p><strong>Incluye:</strong> <?= htmlspecialchars($detalle['incluye']) ?></p>
  <p><strong>Actividades:</strong> <?= htmlspecialchars($detalle['actividades']) ?></p>
  <p><strong>Atracciones:</strong> <?= htmlspecialchars($detalle['atracciones']) ?></p>
  <p><strong>Duración:</strong> <?= htmlspecialchars($detalle['duracion']) ?></p>
  <div class="bg-blue-100 p-4 rounded border-l-4 border-blue-500 text-gray-700 italic animate-pulse">
    "<?= htmlspecialchars($detalle['frase']) ?>"
  </div>
</div>

    </section>

    <!-- ITINERARIO INTERACTIVO -->
    
        <?php
// Decodificar el itinerario JSON
$itinerarioArray = json_decode($detalle['itinerario'], true);

// Si está vacío o no es array, intentar con stripslashes por si el JSON está escapado
if ($itinerarioArray === null) {
    $itinerarioArray = json_decode(stripslashes($detalle['itinerario']), true);
}
?>
<section class="mt-12 bg-white rounded-xl shadow-md p-6 animate-slide-up itinerario-detallado">
  <h3 class="text-2xl font-semibold text-blue-700 mb-4">🗓️ Itinerario Detallado</h3>
  <?php if (!empty($itinerarioArray) && is_array($itinerarioArray)) : ?>
    <ul class="grid gap-5 text-base md:grid-cols-2">
      <?php foreach ($itinerarioArray as $dia => $descripcion) : ?>
        <li class="item-itinerario">
          <span class="text-blue-600 font-semibold">Día <?= htmlspecialchars($dia) ?>:</span> <?= htmlspecialchars($descripcion) ?>
        </li>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p class="text-gray-500 italic">Itinerario no disponible o formato inválido.</p>
  <?php endif; ?>



      </div>  
    </section>
  </main>

  <!-- PIE DE PÁGINA -->
  <footer class="pie-pagina bg-blue-900 text-white text-center py-6 mt-16">
    <p>&copy; 2025 TRAVEL AGENCY CUSCO - Todos los derechos reservados</p>
    <div class="mt-2 text-sm">
      <a href="#" class="hover:underline mx-2">Términos y Condiciones</a> |
      <a href="#" class="hover:underline mx-2">Política de Privacidad</a> |
      <a href="mailto:contacto@aventuratravel.com" class="hover:underline mx-2">contacto@travelagencycusco.com</a>
    </div>
  </footer>

  <!-- Script para el itinerario interactivo -->
  <script>
    document.querySelectorAll('.toggle-dia').forEach(button => {
      button.addEventListener('click', () => {
        const diaId = button.getAttribute('data-dia');
        const contenido = document.getElementById(diaId);
        contenido.classList.toggle('hidden');
      });
    });
  </script>

</body>
</html>
