<?php
include 'config.php';
include 'header.php';

if (!isset($_SESSION['usuario']) || ($_SESSION['tipo'] != 1 && $_SESSION['tipo'] != 3)) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Curso</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        function agregarPregunta() {
            var contenedor = document.getElementById("preguntas");
            var preguntaIndex = contenedor.children.length + 1;
            var nuevaPregunta = `
                <div>
                    <h3>Pregunta ${preguntaIndex}</h3>
                    <input type="text" name="preguntas[${preguntaIndex}][texto]" placeholder="Texto de la pregunta" required>
                    <div>
                        <input type="text" name="preguntas[${preguntaIndex}][alternativas][1]" placeholder="Alternativa 1" required>
                        <input type="radio" name="preguntas[${preguntaIndex}][correcta]" value="1" required> Correcta
                    </div>
                    <div>
                        <input type="text" name="preguntas[${preguntaIndex}][alternativas][2]" placeholder="Alternativa 2" required>
                        <input type="radio" name="preguntas[${preguntaIndex}][correcta]" value="2" required> Correcta
                    </div>
                    <div>
                        <input type="text" name="preguntas[${preguntaIndex}][alternativas][3]" placeholder="Alternativa 3" required>
                        <input type="radio" name="preguntas[${preguntaIndex}][correcta]" value="3" required> Correcta
                    </div>
                    <div>
                        <input type="text" name="preguntas[${preguntaIndex}][alternativas][4]" placeholder="Alternativa 4" required>
                        <input type="radio" name="preguntas[${preguntaIndex}][correcta]" value="4" required> Correcta
                    </div>
                </div>
            `;
            contenedor.insertAdjacentHTML('beforeend', nuevaPregunta);
        }
    </script>
</head>
<body>
    <?php include 'header.php'; ?>
    <main>
        <h1>Crear Curso</h1>
        <form action="curso_crear.php" method="POST">
            <div>
                <label for="titulo">Título del curso:</label>
                <input type="text" id="titulo" name="titulo" required>
            </div>
            <div>
                <label for="descripcion">Descripción del curso:</label>
                <textarea id="descripcion" name="descripcion" required></textarea>
            </div>
            <div id="preguntas">
                <h3>Pregunta 1</h3>
                <input type="text" name="preguntas[1][texto]" placeholder="Texto de la pregunta" required>
                <div>
                    <input type="text" name="preguntas[1][alternativas][1]" placeholder="Alternativa 1" required>
                    <input type="radio" name="preguntas[1][correcta]" value="1" required> Correcta
                </div>
                <div>
                    <input type="text" name="preguntas[1][alternativas][2]" placeholder="Alternativa 2" required>
                    <input type="radio" name="preguntas[1][correcta]" value="2" required> Correcta
                </div>
                <div>
                    <input type="text" name="preguntas[1][alternativas][3]" placeholder="Alternativa 3" required>
                    <input type="radio" name="preguntas[1][correcta]" value="3" required> Correcta
                </div>
                <div>
                    <input type="text" name="preguntas[1][alternativas][4]" placeholder="Alternativa 4" required>
                    <input type="radio" name="preguntas[1][correcta]" value="4" required> Correcta
                </div>
            </div>
            <button type="button" onclick="agregarPregunta()">Agregar Pregunta</button>
            <button type="submit">Crear Curso</button>
        </form>
    </main>
</body>
</html>
