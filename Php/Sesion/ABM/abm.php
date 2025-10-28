<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ABM Autos</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        /* Estilo global */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa; /* Fondo claro */
            color: #212529; /* Texto oscuro */
            padding-top: 80px; /* Altura del encabezado */
            padding-bottom: 60px; /* Altura del pie de página */
        }

        /* Encabezado */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #2c3e50; /* Azul oscuro elegante */
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        header h1 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: bold;
        }

        header .btn-group {
            display: flex;
            gap: 10px;
        }

        header .btn-light {
            background-color: #ecf0f1; /* Botones claros */
            border: 1px solid #bdc3c7;
            color: #2c3e50;
            transition: all 0.3s ease;
        }

        header .btn-light:hover {
            background-color: #bdc3c7;
            color: white;
        }

        /* Pie de página */
        footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #2c3e50; /* Azul oscuro elegante */
            padding: 10px 0;
            text-align: center;
            color: white;
            border-top: 1px solid #1a252f;
            z-index: 1000;
        }

        /* Mensaje de espera */
        #mensajeEspera {
            display: none;
            text-align: center;
            margin-top: 10px;
            font-weight: bold;
            color: #1abc9c; /* Verde turquesa */
        }

        /* Estilo para los botones */
        .btn-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <!-- Botones para las acciones -->
    <div class="mt-3">
        <!-- Botón Cargar Datos -->
        <button type="button" class="btn btn-primary" id="cargarDatosBtn">Cargar Datos</button>

        <!-- Botón Limpiar Filtros -->
        <form method="POST" action="abm.php" class="d-inline">
            <button type="submit" name="limpiar_filtros" class="btn btn-secondary">Limpiar Filtros</button>
        </form>

        <!-- Botón para dar de Alta un Auto -->
        <a href="alta.php" class="btn btn-success d-inline">Alta de Auto</a>

        <!-- Botón para Borrar Datos -->
        <form method="GET" action="baja.php" class="d-inline">
            <input type="hidden" name="id" value="ID_DEL_AUTO"> <!-- Reemplazar con el id del auto que se quiere borrar -->
            <button type="submit" class="btn btn-danger">Borrar Datos</button>
        </form>
    </div>

    <!-- Formulario ABM -->
    <div class="container mt-5">
        <form id="filtroForm" method="POST">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>Color</th>
                        <th>Precio</th>
                        <th>PDFs</th>
                        <th>Acciones</th>
                    </tr>
                    <!-- Fila de filtros -->
                    <tr>
                        <td><input type="text" name="filtro_codigo" class="form-control" placeholder="Filtrar por código"></td>
                        <td><input type="text" name="filtro_marca" class="form-control" placeholder="Filtrar por marca"></td>
                        <td><input type="text" name="filtro_modelo" class="form-control" placeholder="Filtrar por modelo"></td>
                        <td><input type="number" name="filtro_anio" class="form-control" placeholder="Filtrar por año"></td>
                        <td><input type="text" name="filtro_color" class="form-control" placeholder="Filtrar por color"></td>
                        <td><input type="number" step="0.01" name="filtro_precio" class="form-control" placeholder="Filtrar por precio"></td>
                        <td colspan="2"></td>
                    </tr>
                </thead>
                <tbody id="tablaResultados">
                    <!-- Las filas de datos se cargarán aquí dinámicamente -->
                </tbody>
            </table>
        </form>
    </div>

    <script>
        // Función para cargar los datos de la base de datos y mostrar un alert
        document.getElementById("cargarDatosBtn").addEventListener("click", function() {
            fetch('cargar_datos.php')
                .then(response => response.json())
                .then(data => {
                    // Actualizar la tabla con los datos
                    const tablaResultados = document.getElementById('tablaResultados');
                    tablaResultados.innerHTML = ''; // Limpiar la tabla antes de agregar los datos

                    if (data.length > 0) {
                        let datosTexto = "";
                        data.forEach(auto => {
                            // Agregar los datos al alert
                            datosTexto += `Código: ${auto.codigo}\nMarca: ${auto.marca}\nModelo: ${auto.modelo}\nAño: ${auto.anio}\nColor: ${auto.color}\nPrecio: ${auto.precio}\n\n`;

                            // Insertar los datos en la tabla
                            const tr = document.createElement('tr');
                            tr.innerHTML = `
                                <td>${auto.codigo}</td>
                                <td>${auto.marca}</td>
                                <td>${auto.modelo}</td>
                                <td>${auto.anio}</td>
                                <td>${auto.color}</td>
                                <td>${auto.precio}</td>
                                <td>${auto.archivo ? `<a href="archivos/${auto.archivo}" target="_blank">Ver PDF</a>` : 'No disponible'}</td>
                                <td>
                                    <form method="GET" action="baja.php" class="d-inline">
                                        <input type="hidden" name="id" value="${auto.id}">
                                        <button type="submit" class="btn btn-danger">Borrar</button>
                                    </form>
                                </td>
                                <td>
                                    <a href="modi.php?id=${auto.id}" class="btn btn-warning">Modificar</a>
                                </td>
                            `;
                            tablaResultados.appendChild(tr);
                        });
                        // Mostrar el alert con los datos cargados
                        alert("Autos cargados:\n\n" + datosTexto);
                    } else {
                        alert("No hay autos registrados.");
                    }
                })
                .catch(error => {
                    console.error("Error al cargar los datos:", error);
                    alert("Hubo un error al cargar los autos.");
                });
        });
    </script>
</body>
</html>
