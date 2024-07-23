<?php
include 'config.php';
include 'header.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario' AND clave = '$clave'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($clave == $row['clave']) {
            $_SESSION['usuario'] = $row['usuario'];
            $_SESSION['tipo'] = $row['tipo'];
            header("Location: cursos.php");
        } else {
            $error = "Clave incorrecta";
        }
    } else {
        $error = "Usuario no encontrado";
    }
}
?>
    <main>
        <h1>Iniciar Sesión</h1>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <div>
                <label for="usuario">Usuario:</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>
            <div>
                <label for="clave">Clave:</label>
                <input type="password" id="clave" name="clave" required>
            </div>
            <button type="submit">Iniciar Sesión</button>
        </form>
    </main>
</body>
</html>
