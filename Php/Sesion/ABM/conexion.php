<?php
// Eliminar la verificación de sesión
// session_start();
// if (!isset($_SESSION['usuario'])) {
//     header("Location: formulariodelogin.html"); // Cambia esto a tu archivo de inicio de sesión
//     exit;
// }

$host = 'localhost';
$dbname = 'amb_autos'; // Cambiar a la base de datos de autos
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
?>
