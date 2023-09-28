<?php

$servername = "localhost";
$username = "root";
$passwordd = "";
$database = "lp";

$conn = new mysqli($servername, $username, $passwordd, $database);

if($conn->connect_error){
    die("La conexión a la base de datos ha fallado: " . $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

$sql = "SELECT usuario FROM usuarios WHERE usuario = '$usuario'";
$resultado = $conn->query($sql);
if($resultado->num_rows != 1){
    header("Location: index.php?mensajeErrorISR=" . urlencode("Error. Registre un nuevo usuario."));
    exit();
}

$stmt = mysqli_prepare($conn, "SELECT password FROM usuarios WHERE usuario = ?");
mysqli_stmt_bind_param($stmt, "s", $usuario);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$existinginfo = mysqli_fetch_assoc($result);
$passwordGuardada = $existinginfo["password"];

if($passwordGuardada != $password){
    header("Location: index.php?mensajeErrorISR=" . urlencode("Contraseña incorrecta. Prueba otra vez."));
    exit();
}

header("Location: index.php?usuario=" . urlencode($usuario));

mysqli_close($conn);
}


?>