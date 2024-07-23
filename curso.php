<?php
include 'config.php';
include 'header.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$curso_id = $_GET['id'];
$usuario_id = $_SESSION['usuario'];

// Verificar si el usuario ya está suscrito
$sql = "SELECT * FROM inscripciones WHERE curso_id = $curso_id AND usuario_id = '$usuario_id'";
$result = $conn->query($sql);
$ya_suscrito = $result->num_rows > 0;

if ($_SERVER["REQUEST_METHOD"] == "POST" && !$ya_suscrito) {
    $sql = "INSERT INTO inscripciones (curso_id, usuario_id) VALUES ($curso_id, '$usuario_id')";
    if ($conn->query($sql) === TRUE) {
        $ya_suscrito = true;
    }
}

$sql = "SELECT * FROM cursos WHERE id = $curso_id";
$result = $conn->query($sql);
$curso = $result->fetch_assoc();
?>
    <main>
        <h1><?php echo $curso['nombre']; ?></h1>
        <p><?php echo $curso['descripcion']; ?></p>
        <?php if ($ya_suscrito): ?>
            <p>Ya estás suscrito a este curso.</p>
            <a href="curso_contenido.php?id=<?php echo $curso_id; ?>">Acceder al Curso</a>
        <?php else: ?>
            <form action="curso.php?id=<?php echo $curso_id; ?>" method="POST">
                <button type="submit">Suscribirse al Curso</button>
            </form>
        <?php endif; ?>
    </main>
</body>
</html>
