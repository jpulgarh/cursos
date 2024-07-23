<?php
include 'config.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_SESSION['usuario'];
    $curso_id = $_POST['curso_id'];

    $sql = "SELECT id FROM usuarios WHERE usuario = '$usuario'";
    $result = $conn->query($sql);
    $usuario_id = $result->fetch_assoc()['id'];

    $sql = "SELECT * FROM preguntas WHERE curso_id = $curso_id";
    $preguntas_result = $conn->query($sql);

    while($pregunta = $preguntas_result->fetch_assoc()) {
        $pregunta_id = $pregunta['id'];
        $respuesta_id = $_POST["respuesta_$pregunta_id"];

        $sql = "INSERT INTO respuestas_usuario (usuario_id, pregunta_id, respuesta_id) VALUES ($usuario_id, $pregunta_id, $respuesta_id)";
        $conn->query($sql);
    }
    header("Location: resultado.php?curso_id=$curso_id");
}
?>
