let tipos = [];
let notasCredito = [];

function render() {
    const tbDatos = document.getElementById("tbDatos");
    tbDatos.innerHTML = "";
    
    notasCredito.forEach(nota => {
        const tipo = tipos.find(t => t.codigoTipo === nota.codTipoComprobante)?.descripcionTipo || "";
        const row = document.createElement("tr");
        row.innerHTML = `
            <td>${nota.nroComprobante}</td>
            <td>${nota.nroDeFacturaImputada}</td>
            <td>${tipo}</td>
            <td class="hidden-sm">${nota.codCliente}</td>
            <td>${nota.observaciones}</td>
            <td>${nota.fechaComprobante}</td>
            <td>$${nota.totalNetoComprobante.toFixed(2)}</td>
        `;
        tbDatos.appendChild(row);
    });
}

function cargarTiposComprobante() {
    tipos = tiposComprobanteData.tiposComprobante;
    const selectTipo = document.getElementById("selectTipo");
    selectTipo.innerHTML = "";
    
    tipos.forEach(t => {
        const option = document.createElement("option");
        option.value = t.codigoTipo;
        option.textContent = t.descripcionTipo;
        selectTipo.appendChild(option);
    });
}

function cargarNotasCredito() {
    notasCredito = notasCreditoData.notasCredito;
    render();
}

function vaciarTabla() {
    document.getElementById("tbDatos").innerHTML = "";
}

function mostrarFormulario() {
    document.getElementById("contenedor").className = "app-container contenedorPasivo";
    document.getElementById("ventanaModal").className = "ventanaModalPrendido";
}

function cerrarModal() {
    document.getElementById("contenedor").className = "app-container contenedorActivo";
    document.getElementById("ventanaModal").className = "ventanaModalApagado";
}

// Inicialización cuando se carga el DOM
document.addEventListener('DOMContentLoaded', function() {
    // Cargar tipos de comprobante
    cargarTiposComprobante();
    
    // Asignar eventos a los botones
    document.getElementById("btnCargar").addEventListener("click", cargarNotasCredito);
    document.getElementById("btnVaciar").addEventListener("click", vaciarTabla);
    document.getElementById("btnFormulario").addEventListener("click", mostrarFormulario);
    document.getElementById("cerrarModal").addEventListener("click", cerrarModal);
    
    // Cerrar modal al hacer clic fuera del contenido
    document.getElementById("ventanaModal").addEventListener("click", function(e) {
        if (e.target === this) {
            cerrarModal();
        }
    });
    
    // Cerrar modal con tecla Escape
    document.addEventListener("keydown", function(e) {
        if (e.key === "Escape") {
            cerrarModal();
        }
    });
});
