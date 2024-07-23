<?php
include 'config.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}

$usuario_id = $_SESSION['usuario_id'];
$curso_id = $_POST['curso_id'];
$respuestas = $_POST['respuestas'];

$correctas = 0;
$total = count($respuestas);

foreach ($respuestas as $pregunta_id => $respuesta) {
    $sql = "SELECT correcta FROM preguntas WHERE id = $pregunta_id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    if ($row['correcta'] == $respuesta) {
        $correctas++;
    }

    // Almacena la respuesta en la base de datos
    $sql = "INSERT INTO respuestas (usuario_id, pregunta_id, respuesta) VALUES ($usuario_id, $pregunta_id, $respuesta)";
    $conn->query($sql);
}

// Calcula la calificación final
$nota_final = ($correctas / $total) * 100;

// Almacena la calificación final
$sql = "INSERT INTO calificaciones (usuario_id, curso_id, nota) VALUES ($usuario_id, $curso_id, $nota_final)";
$conn->query($sql);

header("Location: curso_resultado.php?curso_id=$curso_id");
?>
