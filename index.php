<?php

// CONEXION DB
$servername = "localhost";
$username = "root";
$password = "";
$database = "lp";

$conn = new mysqli($servername, $username, $password, $database);
if($conn->connect_error) die("La conexión a la base de datos ha fallado: " . $conn->connect_error);


// TOTAL USUARIOS
$sql = "SELECT COUNT(*) as total_usuarios FROM usuarios";
$resultado = $conn->query($sql);

if($resultado->num_rows == 1){
    $row = $resultado->fetch_assoc();
    $totalUsuarios = $row["total_usuarios"];
}else $totalUsuarios = 0;


// TOTAL TICKET/S
$sql = "SELECT SUM(tickets) as total_tickets FROM usuarios";
$resultado = $conn->query($sql);

if($resultado->num_rows == 1){
        $row = $resultado->fetch_assoc();
        $totalTickets = $row["total_tickets"];
}else $totalTickets = 0;


// LISTA PARTICIPANTES
$sql = "SELECT usuario FROM usuarios";
$resultado = $conn->query($sql);

$listaParticipantes = array();

if($resultado->num_rows > 0){
    while($row = $resultado->fetch_assoc()){
        $listaParticipantes[] = $row["usuario"];
    }
}else $listaParticipantes[] = "Ningún participante";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lp</title>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;900&family=Roboto&display=swap" rel="stylesheet">
</head>
<body>

    <div id="divISR">
        <button id="btnIS">iniciar sesión</button><button id="btnR">registrarse</button>
    </div>

    <?php
    if(isset($_GET['mensajeErrorISR'])){
        $mensajeErrorISR = $_GET['mensajeErrorISR'];
        echo "<p class='mensajes'>$mensajeErrorISR</p>";
    }

    if(isset($_GET['usuario'])){
        $usuario = $_GET['usuario'];
        echo "<p id='txtBienvenido' class='mensajes'>Bienvenido, $usuario.</p>";
    }
    ?>

    <script>
        let txtBienvenido = document.getElementById("txtBienvenido");
        let divISR = document.getElementById("divISR");
        if(txtBienvenido !== null){
            divISR.style.display = "none";
        }
    </script>

    <h1 class="classCenter">LOTERIA PERFECTA</h1>

    <h2 class="classCenter">CUENTAS REGISTRADAS:&nbsp;&nbsp; <?php echo $totalUsuarios; ?> &nbsp;&nbsp;&nbsp;-&nbsp;&nbsp;&nbsp; TICKETS/S EN CIRCULACION:&nbsp;&nbsp; <?php echo $totalTickets; ?></h2>

    <div class="classCenter"><button id="btnPagos">COMPRAR TICKET/S</button></div>

    <div id="listaParticipantes" class="classCenter">
    <ul>
    <h3>PARTICIPANTES</h3>
        <?php
        foreach($listaParticipantes as $participante){
            $sql = "SELECT tickets FROM usuarios WHERE usuario = '$participante'";
            $resultado = $conn->query($sql);
            
            if($resultado->num_rows == 1){
                $row = $resultado->fetch_assoc();
                $ticketsParticipante = $row["tickets"];
            }else $ticketsParticipante = 0;

            echo "<li>" . $participante . " - TICKET/S: " . $ticketsParticipante . "</li>";
        }
        ?>
    </ul>
    </div>

    <section id="sectionIS" class="classCenter">
        <p>INICIAR SESION</p>
        <form method="post" action="http://localhost/xampp/lp/login.php">
            <input type="text" name="usuario" placeholder="Usuario">
            <input type="text" name="password" placeholder="Contraseña">
            <input type="submit" value="ENVIAR">
        </form>
        <button id="btnCloseIS">X</button>
    </section>

    <section id="sectionR" class="classCenter">
        <p>REGISTRARSE</p>
        <form method="post" action="http://localhost/xampp/lp/register.php" id="formulario">
            <input type="text" name="usuario" placeholder="Usuario">
            <input type="text" name="gmail" placeholder="Correo electrónico">
            <input type="text" name="password" placeholder="Contraseña">
            <input type="submit" value="ENVIAR">
        </form>
        <button id="btnCloseR">X</button>
    </section>

    <section id="sectionPagos">
        <p>PAGOS</p>
        <button id="btnClosePagos">X</button>
    </section>

    <link rel="stylesheet" href="style.css">
    <script src="script.js"></script>
</body>
</html>

<?php
    mysqli_close($conn);
?>