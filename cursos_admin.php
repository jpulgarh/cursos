<?php
include 'config.php';
include 'header.php';

if (!isset($_SESSION['usuario']) || ($_SESSION['tipo'] != 1 && $_SESSION['tipo'] != 3)) {
    header("Location: index.html");
    exit();
}

$sql = "SELECT * FROM cursos";
$result = $conn->query($sql);
?>
    <main>
        <h1>Administrar Cursos</h1>
        <a href="curso_crear.php">Crear Nuevo Curso</a>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($curso = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $curso['id']; ?></td>
                        <td><?php echo $curso['nombre']; ?></td>
                        <td><?php echo $curso['descripcion']; ?></td>
                        <td>
                            <a href="curso_editar.php?id=<?php echo $curso['id']; ?>">Editar</a>
                            <form action="curso_eliminar.php" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este curso?');" style="display:inline;">
                                <input type="hidden" name="curso_id" value="<?php echo $curso['id']; ?>">
                                <button type="submit">Eliminar</button>
                            </form>
                            <a href="curso_alumnos.php?curso_id=<?php echo $curso['id']; ?>">Ver Alumnos</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </main>
</body>
</html>

