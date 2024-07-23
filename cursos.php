<?php
include 'config.php';
include 'header.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$sql = "SELECT * FROM cursos";
$result = $conn->query($sql);
?>
    <main>
        <h1>Cursos Disponibles</h1>
        <ul>
            <?php while($row = $result->fetch_assoc()) { ?>
                <li>
                    <a href="curso.php?id=<?php echo $row['id']; ?>">
                        <?php echo $row['nombre']; ?>
                    </a>
                </li>
            <?php } ?>
        </ul>
    </main>
</body>
</html>