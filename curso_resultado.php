<?php
include 'config.php';
include 'header.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}

$curso_id = $_GET['curso_id'];
$usuario_id = $_SESSION['usuario_id'];

// Obtén los detalles del curso
$sql = "SELECT * FROM cursos WHERE id = $curso_id";
$curso = $conn->query($sql)->fetch_assoc();

// Obtén las calificaciones del curso
$sql = "SELECT nota FROM calificaciones WHERE usuario_id = $usuario_id AND curso_id = $curso_id";
$calificacion = $conn->query($sql)->fetch_assoc();

// Obtén las preguntas y las respuestas del usuario
$sql = "SELECT p.texto AS pregunta, r.respuesta, a.texto AS alternativa, p.correcta 
        FROM respuestas r
        JOIN preguntas p ON r.pregunta_id = p.id
        JOIN alternativas a ON p.id = a.pregunta_id AND r.respuesta = a.indice
        WHERE r.usuario_id = $usuario_id AND p.curso_id = $curso_id";
$respuestas = $conn->query($sql);
?>
    <main>
        <h1>Resultado del Curso: <?php echo $curso['titulo']; ?></h1>
        <p>Calificación final: <?php echo $calificacion['nota']; ?>%</p>
        <h2>Detalles de las Respuestas</h2>
        <ul>
            <?php while ($row = $respuestas->fetch_assoc()): ?>
                <li>
                    <strong><?php echo $row['pregunta']; ?></strong><br>
                    Tu respuesta: <?php echo $row['alternativa']; ?>
                    <?php if ($row['respuesta'] == $row['correcta']): ?>
                        <span style="color: green;">(Correcta)</span>
                    <?php else: ?>
                        <span style="color: red;">(Incorrecta)</span>
                    <?php endif; ?>
                </li>
            <?php endwhile; ?>
        </ul>
    </main>
</body>
</html>
