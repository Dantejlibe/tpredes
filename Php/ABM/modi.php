<?php
session_start();
include 'conexion.php';

// Verificar si se proporcionó un ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Obtener los datos del auto desde la base de datos
    $stmt = $pdo->prepare("SELECT * FROM autos WHERE id = ?");
    $stmt->execute([$id]);
    $auto = $stmt->fetch();

    if ($auto) {
        // Mostrar el formulario con los datos del auto para modificar
        echo '
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>Modificar Auto</title>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
            <style>
                body {
                    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
                    background-color: #f8f9fa;
                    padding-top: 80px;
                    padding-bottom: 60px;
                }

                .container {
                    max-width: 600px;
                    margin-top: 30px;
                }

                .form-group {
                    margin-bottom: 15px;
                }

                .btn {
                    width: 100%;
                }

                .btn-primary {
                    background-color: #007bff;
                    border: 1px solid #007bff;
                }

                .btn-primary:hover {
                    background-color: #0056b3;
                    border-color: #004085;
                }

                .form-control {
                    width: 100%;
                    padding: 10px;
                    border-radius: 5px;
                    border: 1px solid #ced4da;
                    background-color: #ffffff;
                }

                .form-label {
                    font-weight: bold;
                    display: block;
                    margin-bottom: 5px;
                }

                h2 {
                    text-align: center;
                    color: #333;
                }

                .alert {
                    margin-top: 20px;
                }
            </style>
        </head>
        <body>
            <div class="container">
                <h2>Modificar Auto</h2>
                <form method="POST" action="procesar_modificacion.php">
                    <input type="hidden" name="id" value="' . $auto['id'] . '">
                    
                    <div class="form-group">
                        <label for="codigo" class="form-label">Código:</label>
                        <input type="text" class="form-control" name="codigo" value="' . $auto['codigo'] . '" readonly>
                    </div>
                    
                    <div class="form-group">
                        <label for="marca" class="form-label">Marca:</label>
                        <input type="text" class="form-control" name="marca" value="' . $auto['marca'] . '" required>
                    </div>

                    <div class="form-group">
                        <label for="modelo" class="form-label">Modelo:</label>
                        <input type="text" class="form-control" name="modelo" value="' . $auto['modelo'] . '" required>
                    </div>

                    <div class="form-group">
                        <label for="anio" class="form-label">Año:</label>
                        <input type="number" class="form-control" name="anio" value="' . $auto['anio'] . '" required>
                    </div>

                    <div class="form-group">
                        <label for="color" class="form-label">Color:</label>
                        <input type="text" class="form-control" name="color" value="' . $auto['color'] . '" required>
                    </div>

                    <div class="form-group">
                        <label for="precio" class="form-label">Precio:</label>
                        <input type="number" class="form-control" name="precio" value="' . $auto['precio'] . '" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Modificar</button>
                    </div>
                </form>

                <div class="alert alert-info" role="alert">
                    Si deseas cambiar los detalles del auto, solo modifica los campos y presiona "Modificar".
                </div>
            </div>
        </body>
        </html>
        ';
    } else {
        echo '<div class="alert alert-danger" role="alert">Auto no encontrado.</div>';
    }
} else {
    echo '<div class="alert alert-warning" role="alert">ID no válido.</div>';
}
?>