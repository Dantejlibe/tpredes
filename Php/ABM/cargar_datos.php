<?php
include 'conexion.php';

// Consulta para obtener todos los autos
$stmt = $pdo->prepare("SELECT * FROM autos");
$stmt->execute();
$autos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolver los datos en formato JSON
header('Content-Type: application/json');
echo json_encode($autos);
?>
