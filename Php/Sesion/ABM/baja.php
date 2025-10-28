<?php
session_start();
include 'conexion.php';

// Verificar si se proporcionó un ID válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Eliminar el registro de la base de datos
    $stmt = $pdo->prepare("DELETE FROM autos WHERE id = ?");
    $stmt->execute([$id]);

    // Redirigir de vuelta a la página principal
    header("Location: abm.php");
    exit;
} else {
    die("ID no válido.");
}
?>
