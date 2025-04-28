function sumar() {
    var numero1 = document.getElementById("numero1").value;
    var numero2 = document.getElementById("numero2").value;
    var suma = parseInt(numero1) * parseInt(numero2);
    return suma;

}

function mostrarResultado() {
    var resultadoInput = document.getElementById("resultado");
    resultadoInput.value = sumar();
}

function alerta () {
    alert("NO HAY PROMOCIONES DISPONIBLES");
  }

function regresar() {
    window.location.href = "index.php";
}

function mostraralerta() {
    alert("EN MANTENIMIENTO 😞😞😞" );
}


