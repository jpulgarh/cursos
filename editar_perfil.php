<?php
include 'config.php';
include 'header.php';

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 1) {
    header("Location: index.html");
    exit();
}

$usuario = $_GET['usuario'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $departamento = $_POST['departamento'];
    $tipo = $_POST['tipo'];

    $sql = "UPDATE usuarios SET nombre='$nombre', departamento='$departamento', tipo=$tipo WHERE usuario='$usuario'";
    if ($conn->query($sql) === TRUE) {
        header("Location: perfil.php?usuario=$usuario");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$sql = "SELECT usuario, nombre, departamento, tipo FROM usuarios WHERE usuario = '$usuario'";
$result = $conn->query($sql);
$usuario = $result->fetch_assoc();
?>
    <main>
        <h1>Editar Perfil</h1>
        <form action="editar_perfil.php?usuario=<?php echo $usuario['usuario']; ?>" method="POST">
            <div>
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" value="<?php echo $usuario['nombre']; ?>" required>
            </div>
            <div>
                <label for="departamento">Departamento:</label>
                <input type="text" id="departamento" name="departamento" value="<?php echo $usuario['departamento']; ?>" required>
            </div>
            <div>
                <label for="tipo">Tipo de Usuario:</label>
                <select id="tipo" name="tipo" required>
                    <option value="1" <?php echo $usuario['tipo'] == 1 ? 'selected' : ''; ?>>Administrador</option>
                    <option value="2" <?php echo $usuario['tipo'] == 2 ? 'selected' : ''; ?>>Usuario</option>
                    <option value="3" <?php echo $usuario['tipo'] == 3 ? 'selected' : ''; ?>>Profesor</option>
                </select>
            </div>
            <button type="submit">Guardar Cambios</button>
        </form>
    </main>
</body>
</html>
