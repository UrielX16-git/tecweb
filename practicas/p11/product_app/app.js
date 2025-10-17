document.addEventListener('DOMContentLoaded', function() {
    const unidadesInput = document.getElementById('unidades');
    if (unidadesInput) {
        const unidadesOutput = document.getElementById('unidadesOutput');
        unidadesInput.addEventListener('input', () => {
            unidadesOutput.textContent = unidadesInput.value;
        });
    }
    cargarImagenes();
    buscarProducto();
});

function cargarImagenes() {
    fetch('./backend/get_images.php')
        .then(response => response.json())
        .then(images => {
            const imagenSelect = document.getElementById('imagen');
            imagenSelect.innerHTML = '<option value="">-- Seleccione una imagen --</option>';
            images.forEach(imagePath => {
                const option = document.createElement('option');
                option.value = imagePath;
                option.textContent = imagePath.split('/').pop();
                imagenSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error al cargar las imágenes:', error);
        });
}

function buscarProducto(e) {
    if (e) {
        e.preventDefault();
    }

    var search = document.getElementById('search').value;
    var client = getXMLHttpRequest();
    client.open('POST', './backend/read.php', true);
    client.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            let productos = JSON.parse(client.responseText);
            let template = '';

            if (productos.length > 0) {
                productos.forEach(p => {
                    template += `
                        <tr>
                            <td>${p.id}</td>
                            <td>${p.nombre}</td>
                            <td>${p.marca}</td>
                            <td>${p.modelo}</td>
                            <td>$${p.precio}</td>
                            <td>${p.unidades}</td>
                            <td>${p.detalles}</td>
                            <td><img src="${p.imagen}" alt="${p.nombre}" width="100px"></td>
                        </tr>
                    `;
                });
            } else {
                template = `<tr><td colspan="8" class="text-center">No se encontraron productos.</td></tr>`;
            }
            document.getElementById("productos").innerHTML = template;
        }
    };
    client.send("search=" + search);
}

function agregarProducto(e) {
    e.preventDefault();

    const product = {
        nombre: document.getElementById('nombre').value,
        marca: document.getElementById('marca').value,
        modelo: document.getElementById('modelo').value,
        precio: parseFloat(document.getElementById('precio').value),
        detalles: document.getElementById('detalles').value,
        unidades: parseInt(document.getElementById('unidades').value),
        imagen: document.getElementById('imagen').value
    };

    if (!product.nombre || !product.marca || !product.modelo || isNaN(product.precio) || isNaN(product.unidades)) {
        alert('Por favor, complete todos los campos requeridos.');
        return;
    }

    const productoJsonString = JSON.stringify(product);

    var client = getXMLHttpRequest();
    client.open('POST', './backend/create.php', true);
    client.setRequestHeader('Content-Type', "application/json;charset=UTF-8");
    client.onreadystatechange = function () {
        if (client.readyState == 4 && client.status == 200) {
            try {
                let response = JSON.parse(client.responseText);
                alert(response.message);
                if (response.status === 'success') {
                    document.getElementById('product-form').reset();
                    document.getElementById('unidadesOutput').textContent = '1';
                    buscarProducto();
                }
            } catch (e) {
                console.error("Error al parsear JSON:", client.responseText);
                alert("Ocurrió un error inesperado en el servidor.");
            }
        }
    };
    client.send(productoJsonString);
}

function getXMLHttpRequest() {
    var objetoAjax;
    try {
        objetoAjax = new XMLHttpRequest();
    } catch (err1) {
        try {
            objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (err2) {
            try {
                objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (err3) {
                objetoAjax = false;
            }
        }
    }
    return objetoAjax;
}