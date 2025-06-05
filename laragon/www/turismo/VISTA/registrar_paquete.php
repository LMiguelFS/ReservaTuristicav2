<?php
require_once __DIR__ . '/../CONTROLADOR/paqueteControlador.php';
//require_once 'CONTROLADOR/paqueteControlador.php';

$controlador = new PaqueteController();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $exito = $controlador->guardar($_POST, $_FILES);

    if ($exito) {
        echo "<script>alert('Paquete guardado exitosamente'); window.location.href='..
        
        
        
        
        
        +/VISTA/ver_paquete.php';</script>";
    } else {
        echo "<script>alert('Error al guardar el paquete'); history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registrar Paquete Turístico</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-b from-blue-50 to-white font-sans text-gray-800">

  <header class="menu-principal bg-gradient-to-r from-blue-800 to-blue-600 p-5 text-white shadow-lg sticky top-0 z-50">
    <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
      <h1 class="text-3xl font-bold mb-3 md:mb-0 hover:scale-105 transition-transform">🌎 TRAVEL AGENCY CUSCO</h1>
      <nav>
        <ul class="flex gap-6 text-lg">
          <li><a href="#" class="hover:text-yellow-300 transition-colors">Inicio</a></li>
          <li><a href="/reservaTuristicav2/VISTA/ver_paquetes.php" class="hover:text-yellow-300 transition-colors">Destinos</a></li>
          <li><a href="registrar_paquete.php" class="hover:text-yellow-300 transition-colors">Registrar</a></li>
        </ul>
      </nav>
    </div>
  </header>

  <main class="container mx-auto my-10 px-4">
  <section class="bg-white rounded-2xl shadow-2xl p-0 max-w-5xl mx-auto flex flex-col md:flex-row gap-8 overflow-hidden">
    <!-- Imagen previa -->
    <div class="md:w-1/2 flex items-center justify-center bg-blue-50 p-6">
      <img id="preview" class="w-full h-80 object-cover rounded-xl shadow-lg border-4 border-white transition-all duration-300 hidden" />
      <div id="placeholder-img" class="w-full h-80 flex items-center justify-center text-blue-300 text-7xl bg-blue-100 rounded-xl" style="display:block;">
        <span>📷</span>
      </div>
    </div>
    <!-- Formulario -->
    <div class="md:w-1/2 p-8 space-y-6">
      <h2 class="text-3xl font-bold text-blue-700 flex items-center gap-2">
        <span>✨</span> Registrar Paquete Turístico
      </h2>
      <form action="registrar_paquete.php" method="POST" enctype="multipart/form-data" class="space-y-4">
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Título del paquete</label>
          <input type="text" name="titulo" placeholder="Ej: Cusco Mágico: 5D/4N" class="w-full p-3 border rounded" required>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block font-semibold text-gray-700 mb-1">Destino</label>
            <input type="text" name="destino" placeholder="Destino" class="w-full p-3 border rounded" required>
          </div>
          <div>
            <label class="block font-semibold text-gray-700 mb-1">Fechas disponibles</label>
            <input type="text" name="fechas" placeholder="Ej: Junio - Julio 2025" class="w-full p-3 border rounded" required>
          </div>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block font-semibold text-gray-700 mb-1">Cupos disponibles</label>
            <input type="number" name="cupos" placeholder="Máximo personas" class="w-full p-3 border rounded" required>
          </div>
          <div>
            <label class="block font-semibold text-gray-700 mb-1">Precio</label>
            <input type="number" step="0.01" name="precio" placeholder="Ej: 499.99" class="w-full p-3 border rounded" required>
          </div>
        </div>
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Incluye</label>
          <textarea name="incluye" placeholder="Hotel 4⭐, alimentación, guías expertos, ..." class="w-full p-3 border rounded" required></textarea>
        </div>
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Actividades</label>
          <textarea name="actividades" placeholder="Caminatas, ritual andino, ..." class="w-full p-3 border rounded" required></textarea>
        </div>
        <div>
          <label class="block font-semibold text-gray-700 mb-1">Atracciones</label>
          <textarea name="atracciones" placeholder="Plaza de Armas, Sacsayhuamán, ..." class="w-full p-3 border rounded" required></textarea>
        </div>
        <div class="grid grid-cols-2 gap-4">
          <div>
            <label class="block font-semibold text-gray-700 mb-1">Duración</label>
            <input type="text" name="duracion" placeholder="Ej: 5D/4N" class="w-full p-3 border rounded" required>
          </div>
          <div>
            <label class="block font-semibold text-gray-700 mb-1">Frase promocional</label>
            <input type="text" name="frase" placeholder="Frase promocional" class="w-full p-3 border rounded">
          </div>
        </div>
        <!-- Itinerario -->
        <div id="itinerario" class="mt-6">
          <label class="block font-semibold mb-2 text-blue-600 flex items-center gap-2">
            <span>📅</span> Itinerario Detallado:
          </label>
          <div>
            <input type="text" name="itinerario[]" class="w-full p-3 border rounded mb-2" placeholder="Día 1: Actividades" required>
          </div>
        </div>
        <button type="button" onclick="agregarDia()" class="text-blue-700 hover:underline text-sm">+ Agregar Día</button>
        <!-- Imagen -->
        <div class="mt-6">
          <label class="block font-semibold text-blue-600 mb-2">📷 Imagen del paquete:</label>
          <input type="file" name="imagen" accept="image/*" class="w-full p-3 border rounded mb-2" onchange="mostrarVistaPrevia(event)">
        </div>
        <button type="submit" class="bg-blue-700 text-white px-6 py-3 rounded shadow hover:bg-blue-800 transition w-full text-lg font-semibold">
          Guardar Paquete
        </button>
      </form>
    </div>
  </section>
</main>
<script>
  let contadorDias = 1;
  function agregarDia() {
    contadorDias++;
    const contenedor = document.getElementById('itinerario');
    const div = document.createElement('div');
    div.innerHTML = `
      <input type="text" name="itinerario[]" class="w-full p-3 border rounded mb-2" placeholder="Día ${contadorDias}: Actividades" required>
    `;
    contenedor.appendChild(div);
  }
  function mostrarVistaPrevia(event) {
    const img = document.getElementById('preview');
    const placeholder = document.getElementById('placeholder-img');
    const archivo = event.target.files[0];
    if (archivo) {
      const lector = new FileReader();
      lector.onload = function(e) {
        img.src = e.target.result;
        img.classList.remove('hidden');
        placeholder.style.display = 'none';
      };
      lector.readAsDataURL(archivo);
    }
  }
</script>

</body>
</html>
