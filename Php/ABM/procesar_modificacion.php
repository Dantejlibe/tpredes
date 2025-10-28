<?php
session_start();
include 'conexion.php';

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Obtener los valores del formulario
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $codigo = isset($_POST['codigo']) ? $_POST['codigo'] : null;
    $marca = isset($_POST['marca']) ? $_POST['marca'] : null;
    $modelo = isset($_POST['modelo']) ? $_POST['modelo'] : null;
    $anio = isset($_POST['anio']) ? $_POST['anio'] : null;
    $color = isset($_POST['color']) ? $_POST['color'] : null;
    $precio = isset($_POST['precio']) ? $_POST['precio'] : null;

    // Verificar si los datos necesarios están presentes
    if ($id && $marca && $modelo && $anio && $color && $precio) {
        // Preparar la consulta para actualizar el auto
        $stmt = $pdo->prepare("UPDATE autos SET codigo = ?, marca = ?, modelo = ?, anio = ?, color = ?, precio = ? WHERE id = ?");
        $stmt->execute([$codigo, $marca, $modelo, $anio, $color, $precio, $id]);

        // Comprobar si se actualizó correctamente
        if ($stmt->rowCount() > 0) {
            echo '{"success":true}';
        } else {
            echo '{"success":false, "message": "No se pudo actualizar el auto."}';
        }
    } else {
        echo '{"success":false, "message": "Faltan datos en el formulario."}';
    }
} else {
    echo '{"success":false, "message": "Método de solicitud no válido."}';
}
?>
