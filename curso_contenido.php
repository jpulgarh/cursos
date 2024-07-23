<?php
include 'config.php';
include 'header.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}

$curso_id = $_GET['id'];

// Obtén los detalles del curso
$sql = "SELECT * FROM cursos WHERE id = $curso_id";
$curso = $conn->query($sql)->fetch_assoc();

// Obtén las preguntas del curso
$sql = "SELECT * FROM preguntas WHERE curso_id = $curso_id";
$preguntas = $conn->query($sql);
?>
    <main>
        <h1><?php echo $curso['nombre']; ?></h1>
        <p><?php echo $curso['descripcion']; ?></p>
        <form action="curso_finalizar.php" method="POST">
            <input type="hidden" name="curso_id" value="<?php echo $curso_id; ?>">
            <?php while ($pregunta = $preguntas->fetch_assoc()): ?>
                <div>
                    <h3><?php echo $pregunta['texto']; ?></h3>
                    <?php
                    $pregunta_id = $pregunta['id'];
                    $sql = "SELECT * FROM alternativas WHERE pregunta_id = $pregunta_id";
                    $alternativas = $conn->query($sql);
                    ?>
                    <?php while ($alternativa = $alternativas->fetch_assoc()): ?>
                        <div>
                            <input type="radio" name="respuestas[<?php echo $pregunta_id; ?>]" value="<?php echo $alternativa['indice']; ?>" required>
                            <label><?php echo $alternativa['texto']; ?></label>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endwhile; ?>
            <button type="submit">Finalizar Curso</button>
        </form>
    </main>
</body>
</html>
