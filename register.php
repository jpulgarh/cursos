<?php
include 'config.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);
    $nombre = $_POST['nombre'];
    $departamento = $_POST['departamento'];
    $tipo = $_POST['tipo'];

    $sql = "INSERT INTO usuarios (usuario, clave, nombre, departamento, tipo) VALUES ('$usuario', '$clave', '$nombre', '$departamento', '$tipo')";
    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
    <h1>Registro</h1>
    <form action="registro.php" method="POST">
        <div>
            <label for="usuario">Usuario:</label>
            <input type="text" id="usuario" name="usuario" required>
        </div>
        <div>
            <label for="clave">Clave:</label>
            <input type="password" id="clave" name="clave" required>
        </div>
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required>
        </div>
        <div>
            <label for="departamento">Departamento:</label>
            <input type="text" id="departamento" name="departamento" required>
        </div>
        <div>
            <label for="tipo">Tipo:</label>
            <select id="tipo" name="tipo" required>
                <option value="1">Administrador</option>
                <option value="2">Usuario</option>
                <option value="3">Profesor</option>
            </select>
        </div>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
