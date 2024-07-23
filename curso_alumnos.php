<?php
include 'config.php';
include 'header.php';

if (!isset($_SESSION['usuario']) || ($_SESSION['tipo'] != 1 && $_SESSION['tipo'] != 3)) {
    header("Location: index.html");
    exit();
}

$curso_id = $_GET['id'];

$sql = "SELECT usuarios.usuario, usuarios.nombre, usuarios.departamento, usuarios.tipo FROM inscripciones 
        JOIN usuarios ON inscripciones.usuario_id = usuarios.usuario 
        WHERE inscripciones.curso_id = $curso_id";
$result = $conn->query($sql);
?>
    <main>
        <h1>Alumnos Inscritos en el Curso</h1>
        <ul>
            <?php while($row = $result->fetch_assoc()) { ?>
                <li>
                    <?php echo $row['nombre']; ?> (<?php echo $row['departamento']; ?>)
                    <a href="perfil.php?usuario=<?php echo $row['usuario']; ?>">Ver Perfil</a>
                    <?php if ($_SESSION['tipo'] == 1): ?>
                        <a href="editar_perfil.php?usuario=<?php echo $row['usuario']; ?>">Editar Perfil</a>
                    <?php endif; ?>
                </li>
            <?php } ?>
        </ul>
    </main>
</body>
</html>
