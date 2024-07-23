<?php
include 'config.php';
include 'header.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}

$curso_id = $_GET['curso_id'];

$sql = "SELECT id FROM usuarios WHERE usuario = '{$_SESSION['usuario']}'";
$result = $conn->query($sql);
$usuario_id = $result->fetch_assoc()['id'];

$sql = "SELECT COUNT(*) AS total_preguntas FROM preguntas WHERE curso_id = $curso_id";
$total_preguntas_result = $conn->query($sql);
$total_preguntas = $total_preguntas_result->fetch_assoc()['total_preguntas'];

$sql = "SELECT COUNT(*) AS correctas
FROM respuestas_usuario ru
JOIN respuestas r ON ru.respuesta_id = r.id
WHERE ru.usuario_id = $usuario_id AND ru.pregunta_id IN (SELECT id FROM preguntas WHERE curso_id = $curso_id) AND r.es_correcta = 1";
$correctas_result = $conn->query($sql);
$correctas = $correctas_result->fetch_assoc()['correctas'];

$nota_final = ($correctas / $total_preguntas) * 100;
?>
<h1>Resultado del Curso</h1>
<p>Curso: <?php echo $curso_id; ?></p>
<p>Total de Preguntas: <?php echo $total_preguntas; ?></p>
<p>Preguntas Correctas: <?php echo $correctas; ?></p>
<p>Nota Final: <?php echo $nota_final; ?>%</p>
<h2>Respuestas Detalladas:</h2>
<ul>
<?php
$sql = "SELECT p.pregunta, r.respuesta, r.es_correcta
        FROM respuestas_usuario ru
        JOIN preguntas p ON ru.pregunta_id = p.id
        JOIN respuestas r ON ru.respuesta_id = r.id
        WHERE ru.usuario_id = $usuario_id AND p.curso_id = $curso_id";
$respuestas_result = $conn->query($sql);
while($row = $respuestas_result->fetch_assoc()) {
    echo "<li>";
    echo "<strong>Pregunta:</strong> " . $row['pregunta'] . "<br>";
    echo "<strong>Respuesta:</strong> " . $row['respuesta'] . "<br>";
    echo "<strong>Correcta:</strong> " . ($row['es_correcta'] ? 'Sí' : 'No') . "<br>";
    echo "</li>";
}
?>
</ul>
<a href="cursos.php">Volver a Cursos</a>
</body>
</html>
