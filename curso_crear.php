<?php
include 'config.php';
include 'header.php';

if (!isset($_SESSION['usuario']) || ($_SESSION['tipo'] != 1 && $_SESSION['tipo'] != 3)) {
    header("Location: index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $preguntas = $_POST['preguntas']; // Array de preguntas

    // Insertar el curso en la base de datos
    $sql = "INSERT INTO cursos (nombre, descripcion) VALUES ('$nombre', '$descripcion')";
    if ($conn->query($sql) === TRUE) {
        $curso_id = $conn->insert_id;

        // Insertar cada pregunta y sus alternativas en la base de datos
        foreach ($preguntas as $pregunta) {
            $texto_pregunta = $pregunta['texto'];
            $correcta = $pregunta['correcta'];

            $sql = "INSERT INTO preguntas (curso_id, texto, correcta) VALUES ($curso_id, '$texto_pregunta', $correcta)";
            if ($conn->query($sql) === TRUE) {
                $pregunta_id = $conn->insert_id;

                // Insertar cada alternativa de la pregunta
                foreach ($pregunta['alternativas'] as $indice => $texto_alternativa) {
                    $sql = "INSERT INTO alternativas (pregunta_id, texto, indice) VALUES ($pregunta_id, '$texto_alternativa', $indice)";
                    $conn->query($sql);
                }
            }
        }

        header("Location: cursos_admin.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
    <main>
        <h1>Crear Curso</h1>
        <form action="curso_crear.php" method="POST">
            <label for="nombre">Título:</label><br>
            <input type="text" id="nombre" name="nombre" required><br>
            <label for="descripcion">Descripción:</label><br>
            <textarea id="descripcion" name="descripcion" required></textarea>
            
            <div id="preguntas">
                <div class="pregunta">
                    <label>Pregunta:</label><br>
                    <input type="text" name="preguntas[0][texto]" required><br>
                    <label>Alternativas:</label><br>
                    <input type="text" name="preguntas[0][alternativas][0]" required><br>
                    <input type="text" name="preguntas[0][alternativas][1]" required><br>
                    <input type="text" name="preguntas[0][alternativas][2]" required><br>
                    <input type="text" name="preguntas[0][alternativas][3]" required><br>
                    <label>Respuesta Correcta:</label><br>
                    <select name="preguntas[0][correcta]" required>
                        <option value="0">Alternativa 1</option>
                        <option value="1">Alternativa 2</option>
                        <option value="2">Alternativa 3</option>
                        <option value="3">Alternativa 4</option>
                    </select>
                </div>
            </div>
            <button type="button" onclick="agregarPregunta()">Agregar Pregunta</button>
            <button type="submit">Crear Curso</button>
        </form>
    </main>
</body>
</html>
