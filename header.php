<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal de Cursos SENAPRED</title>
    <link rel="stylesheet" href="styles.css">
    <script src="scripts.js"></script>
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="cursos.php">Cursos</a></li>
                <li><a href="ayuda.php">Ayuda</a></li>
                <li><a href="logout.php">Cerrar Sesión</a></li>
                <?php if (isset($_SESSION['usuario']) && ($_SESSION['tipo'] == 1 || $_SESSION['tipo'] == 3)): ?>
                    <li><a href="cursos_admin.php">Administrar Cursos</a></li>
                    <?php if ($_SESSION['tipo'] == 1): ?>
                        <li><a href="usuarios_admin.php">Administrar Usuarios</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
