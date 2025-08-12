<?php
include 'conexion.php';

// Eliminar la verificación de sesión
// session_start();
// if (!isset($_SESSION['usuario'])) {
//     header("Location: formulariodelogin.html");
//     exit;
// }

// Variable para almacenar los datos de la tabla
$autos = [];

// Si se presiona el botón "Cargar datos"
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cargar_datos'])) {
    // Construir la consulta SQL con filtros
    $sql = "SELECT * FROM autos WHERE 1=1";
    $params = [];

    if (!empty($_POST['filtro_codigo'])) {
        $sql .= " AND codigo LIKE :codigo";
        $params[':codigo'] = '%' . $_POST['filtro_codigo'] . '%';
    }
    if (!empty($_POST['filtro_marca'])) {
        $sql .= " AND marca LIKE :marca";
        $params[':marca'] = '%' . $_POST['filtro_marca'] . '%';
    }
    if (!empty($_POST['filtro_modelo'])) {
        $sql .= " AND modelo LIKE :modelo";
        $params[':modelo'] = '%' . $_POST['filtro_modelo'] . '%';
    }
    if (!empty($_POST['filtro_anio'])) {
        $sql .= " AND anio = :anio";
        $params[':anio'] = $_POST['filtro_anio'];
    }
    if (!empty($_POST['filtro_color'])) {
        $sql .= " AND color LIKE :color";
        $params[':color'] = '%' . $_POST['filtro_color'] . '%';
    }
    if (!empty($_POST['filtro_precio'])) {
        $sql .= " AND precio <= :precio";
        $params[':precio'] = $_POST['filtro_precio'];
    }

    // Ejecutar la consulta
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $autos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($autos);
    exit;
}
?>
