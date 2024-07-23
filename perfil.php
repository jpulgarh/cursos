<?php
include 'config.php';
include 'header.php';

if (!isset($_SESSION['usuario']) || ($_SESSION['tipo'] != 1 && $_SESSION['tipo'] != 3)) {
    header("Location: index.html");
    exit();
}

$usuario = $_GET['usuario'];

$sql = "SELECT usuario, nombre, departamento, tipo FROM usuarios WHERE usuario = '$usuario'";
$result = $conn->query($sql);
$usuario = $result->fetch_assoc();
?>
    <main>
        <h1>Perfil del Alumno</h1>
        <p><strong>Usuario:</strong> <?php echo $usuario['usuario']; ?></p>
        <p><strong>Nombre:</strong> <?php echo $usuario['nombre']; ?></p>
        <p><strong>Departamento:</strong> <?php echo $usuario['departamento']; ?></p>
        <p><strong>Tipo:</strong> <?php echo $usuario['tipo'] == 1 ? 'Administrador' : ($usuario['tipo'] == 2 ? 'Usuario' : 'Profesor'); ?></p>
    </main>
</body>
</html>
