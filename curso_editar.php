<?php
include 'config.php';
include 'header.php';

if (!isset($_SESSION['usuario']) || ($_SESSION['tipo'] != 1 && $_SESSION['tipo'] != 3)) {
    header("Location: index.html");
    exit();
}

$curso_id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];

    $sql = "UPDATE cursos SET nombre='$nombre', descripcion='$descripcion' WHERE id=$curso_id";
    if ($conn->query($sql) === TRUE) {
        header("Location: cursos_admin.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT * FROM cursos WHERE id=$curso_id";
$result = $conn->query($sql);
$curso = $result->fetch_assoc();
?>
    <main>
        <h1>Editar Curso</h1>
        <form action="curso_editar.php?id=<?php echo $curso_id; ?>" method="POST">
            <div>
                <label for="nombre">Nombre del Curso:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $curso['nombre']; ?>" required>
            </div>
            <div>
                <label for="descripcion">Descripción:</label>
                <textarea id="descripcion" name="descripcion" required><?php echo $curso['descripcion']; ?></textarea>
            </div>
            <button type="submit">Guardar Cambios</button>
        </form>
    </main>
</body>
</html>
