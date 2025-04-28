<?php
//phpinfo();
$servername = "localhost"; // Cambia esto si tu servidor MySQL está en otro lugar
$username = "root"; // Tu nombre de usuario de MySQL
$password = "70377537"; // Tu contraseña de MySQL
$database = "bdagenciatours"; // Nombre de tu base de datos

// Crear conexión
$conn = mysqli_connect($servername, $username, $password, $database);
// Comprobar conexión
/*if (!$conn) {
    echo ("Conexión fallida:". mysqli_connect_error()."<br>");
}else{
    echo "Conexion exitosa";
}*/
?>