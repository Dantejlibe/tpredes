<?php include 'conexion.php'; session_start(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Auto</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Agregar Auto</h1>
        <form action="procesar_alta.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="codigo" class="form-label">Código</label>
                <input type="text" name="codigo" id="codigo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" name="marca" id="marca" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="modelo" class="form-label">Modelo</label>
                <input type="text" name="modelo" id="modelo" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="anio" class="form-label">Año</label>
                <input type="number" name="anio" id="anio" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="color" class="form-label">Color</label>
                <select name="color" id="color" class="form-select" required>
                    <option value="">Cargando colores...</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" step="0.01" name="precio" id="precio" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="archivo" class="form-label">Selecciona un archivo (PDF):</label>
                <input type="file" name="archivo" id="archivo" class="form-control" accept=".pdf">
            </div>
            <button type="submit" class="btn btn-primary">Dar de alta</button>
        </form>
    </div>

    <script>
        // Cargar colores desde el archivo JSON
        fetch('json_colores.php')
            .then(response => response.json())
            .then(colores => {
                const colorSelect = document.getElementById('color');
                colorSelect.innerHTML = ''; // Limpiar opciones existentes
                colores.forEach(color => {
                    const option = document.createElement('option');
                    option.value = color;
                    option.textContent = color;
                    colorSelect.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error al cargar los colores:', error);
            });
    </script>
</body>
</html>
