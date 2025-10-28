<?php
include 'conexion.php';

// Validar que el formulario sea enviado por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $codigo = $_POST['codigo'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $anio = $_POST['anio'];
    $color = $_POST['color'];
    $precio = $_POST['precio'];

    // Verificar si el código ya existe en la base de datos
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM autos WHERE codigo = ?");
    $stmt->execute([$codigo]);
    $existeCodigo = $stmt->fetchColumn();

    if ($existeCodigo > 0) {
        echo "Error: El código '$codigo' ya está registrado.";
        exit; // Salir si el código ya existe
    }

    // Manejo del archivo
    $archivo = null;
    if ($_FILES['archivo']['error'] === UPLOAD_ERR_OK) {
        $archivo = $_FILES['archivo']['name'];
        move_uploaded_file($_FILES['archivo']['tmp_name'], "archivos/$archivo");
    }

    // Insertar en la base de datos
    $stmt = $pdo->prepare("INSERT INTO autos (codigo, marca, modelo, anio, color, precio, archivo) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$codigo, $marca, $modelo, $anio, $color, $precio, $archivo]);

    header("Location: abm.php");
    exit;
}
?>
