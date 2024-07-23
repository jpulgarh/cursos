<?php
include 'config.php';
include 'header.php';

if (!isset($_SESSION['usuario']) || $_SESSION['tipo'] != 1) {
    header("Location: index.html");
    exit();
}

$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
?>
<main>
    <h1>Administrar Usuarios</h1>
    <ul>
        <?php while($row = $result->fetch_assoc()) { ?>
            <li>
                <?php echo $row['nombre']; ?> (<?php echo $row['departamento']; ?>)
                <a href="perfil.php?usuario=<?php echo $row['usuario']; ?>">Ver Perfil</a>
                <a href="editar_perfil.php?usuario=<?php echo $row['usuario']; ?>">Editar Perfil</a>
            </li>
        <?php } ?>
    </ul>
</main>
</body>
</html>
