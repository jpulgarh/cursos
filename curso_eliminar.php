<?php
include 'config.php';
session_start();

if (!isset($_SESSION['usuario']) || ($_SESSION['tipo'] != 1 && $_SESSION['tipo'] != 3)) {
    header("Location: index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $curso_id = $_POST['curso_id'];

    // Eliminar inscripciones relacionadas
    $sql = "DELETE FROM inscripciones WHERE curso_id = $curso_id";
    $conn->query($sql);

    // Eliminar respuestas relacionadas
    $sql = "DELETE FROM respuestas WHERE pregunta_id IN (SELECT id FROM preguntas WHERE curso_id = $curso_id)";
    $conn->query($sql);

    // Eliminar alternativas relacionadas
    $sql = "DELETE FROM alternativas WHERE pregunta_id IN (SELECT id FROM preguntas WHERE curso_id = $curso_id)";
    $conn->query($sql);

    // Eliminar preguntas relacionadas
    $sql = "DELETE FROM preguntas WHERE curso_id = $curso_id";
    $conn->query($sql);

    // Eliminar calificaciones relacionadas
    $sql = "DELETE FROM calificaciones WHERE curso_id = $curso_id";
    $conn->query($sql);

    // Finalmente, eliminar el curso
    $sql = "DELETE FROM cursos WHERE id = $curso_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: cursos_admin.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
