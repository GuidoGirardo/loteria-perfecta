<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "lp";

$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error){
    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $usuario = $_POST["usuario"];
    $gmail = $_POST["gmail"];
    $password = $_POST["password"];

    $sql = "SELECT usuario FROM usuarios WHERE usuario = '$usuario'";
    $resultado = $conn->query($sql);
    if($resultado->num_rows > 0){
        header("Location: index.php?mensajeErrorISR=" . urlencode("Usuario '$usuario' ya existe, pruebe con otro por favor."));
        exit();
    }

    $sql = "SELECT gmail FROM usuarios WHERE gmail = '$gmail'";
    $resultado = $conn->query($sql);
    if($resultado->num_rows > 0){
        header("Location: index.php?mensajeErrorISR=" . urlencode("Correo electrónico '$gmail' ya utilizado, pruebe con otro por favor."));
        exit();
    }

    /* AGREGAR HASH Y SALT PARA CONTRASEÑA DESPUÉS */

    $sql = "INSERT INTO usuarios (usuario, password, gmail) VALUES ('$usuario', '$password', '$gmail')";
        
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php?usuario=" . urlencode($usuario));
    } else echo "Error al registrar usuario: " . $conn->error;

    mysqli_close($conn);
}

?>