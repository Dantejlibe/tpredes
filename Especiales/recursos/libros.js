const productos_libros = {
    libros: [
      {
        "cod": 1001,
        "titulo": "Cien Años de Soledad",
        "autor": "Gabriel García Márquez",
        "genero": "Novela",
        "numero_paginas": 417,
        "fecha_publicacion": "1967-06-05",
        "edicion_especial": true
      },
      {
        "cod": 1002,
        "titulo": "El Quijote",
        "autor": "Miguel de Cervantes",
        "genero": "Clásico",
        "numero_paginas": 1072,
        "fecha_publicacion": "1605-01-16",
        "edicion_especial": false
      },
      
      {
        "cod": 1003,
        "titulo": "1984",
        "autor": "George Orwell",
        "genero": "Distopía",
        "numero_paginas": 328,
        "fecha_publicacion": "1949-06-08",
        "edicion_especial": true
      },
      {
        "cod": 1004,
        "titulo": "Crimen y Castigo",
        "autor": "Fiódor Dostoyevski",
        "genero": "Filosófico",
        "numero_paginas": 671,
        "fecha_publicacion": "1866-01-01",
        "edicion_especial": false
      },
      {
        "cod": 1005,
        "titulo": "El Principito",
        "autor": "Antoine de Saint-Exupéry",
        "genero": "Infantil",
        "numero_paginas": 96,
        "fecha_publicacion": "1943-04-06",
        "edicion_especial": true
      }
    ]
  }
  
  const dataTabla = document.getElementById("tbody");
  
  $('#cargarDatos').on("click", function() {
    productos_libros.libros.forEach(function (libro) {
      let row = document.createElement("tr")
      row.innerHTML = `
      <td dataTabla = 'cod'>${libro.cod}</td>
      <td dataTabla = 'titulo'>${libro.titulo}</td>
      <td dataTabla = 'autor'>${libro.autor}</td>
      <td dataTabla = 'genero'>${libro.genero}</td>
      <td dataTabla = 'numero_paginas'>${libro.numero_paginas}</td>
      <td dataTabla = 'fecha_publicacion'>${libro.fecha_publicacion}</td>
      <td dataTabla = 'edicion_especial'>${libro.edicion_especial ? 'Sí' : 'No'}</td>
      `
      dataTabla.appendChild(row)
    })
  })
  
  $('#vaciarDatos').on("click", function() {
    $('#tbody').empty()
    console.log("Datos vaciados")
  })
  
  $('#cargarFormulario').on("click", function() {
    window.location.href = '/Especiales/esp05FormVariableArregloDeObjetos/index.html';  
  })
  