

$(document).ready(function () {
    // SE INICIALIZA LA PÁGINA
    // Script para el slider de unidades
    const unidadesInput = document.getElementById('unidades');
    const unidadesOutput = document.getElementById('unidadesOutput');
    unidadesInput.addEventListener('input', () => {
        unidadesOutput.textContent = unidadesInput.value;
    });

    // Script para poblar el selector de imágenes
    $.ajax({
        url: './backend/get_images.php',
        type: 'GET',
        success: function (images) {
            const imagenSelect = document.getElementById('imagen');
            
            const defaultOption = document.createElement('option');
            defaultOption.value = "";
            defaultOption.textContent = "-- Seleccione una imagen --";
            imagenSelect.appendChild(defaultOption);

            if (images.length > 0) {
                images.forEach(imagePath => {
                    const option = document.createElement('option');
                    option.value = imagePath;
                    option.textContent = imagePath.split('/').pop(); // Muestra solo el nombre del archivo
                    imagenSelect.appendChild(option);
                });
            } else {
                const option = document.createElement('option');
                option.textContent = 'No hay imágenes en el directorio';
                option.disabled = true;
                imagenSelect.appendChild(option);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('Error fetching images:', textStatus, errorThrown);
            console.error('Response Text:', jqXHR.responseText);
            const imagenSelect = document.getElementById('imagen');
            const option = document.createElement('option');
            option.textContent = 'Error al cargar imágenes';
            option.disabled = true;
            imagenSelect.appendChild(option);
        }
    });

    // SE LISTAN TODOS LOS PRODUCTOS
    listarProductos();

    /**
     * FUNCIÓN DE BÚSQUEDA
     */
    $('#search').keyup(function () {
        if ($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php?search=' + search,
                type: 'GET',
                success: function (response) {
                    if (!response.error) {
                        let productos = JSON.parse(response);
                        let template = '';
                        let template_bar = '';
                        productos.forEach(producto => {
                            let descripcion = '';
                            descripcion += '<li>precio: ' + producto.precio + '</li>';
                            descripcion += '<li>unidades: ' + producto.unidades + '</li>';
                            descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                            descripcion += '<li>marca: ' + producto.marca + '</li>';
                            descripcion += '<li>detalles: ' + producto.detalles + '</li>';

                            template += `
                                <tr productId="${producto.id}">
                                    <td>${producto.id}</td>
                                    <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                    <td><ul>${descripcion}</ul></td>
                                    <td>
                                        <button class="product-delete btn btn-danger">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>
                            `;

                            template_bar += `
                                <li>${producto.nombre}</li>
                            `;
                        });
                        $('#product-result').show();
                        $('#container').html(template_bar);
                        $('#products').html(template);
                    }
                }
            })
        }
        else {
            $('#product-result').hide();
        }
    });

    /**
     * FUNCIÓN PARA LISTAR PRODUCTOS
     */
    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function (response) {
                let productos = JSON.parse(response);
                let template = '';
                productos.forEach(producto => {
                    let descripcion = '';
                    descripcion += '<li>precio: ' + producto.precio + '</li>';
                    descripcion += '<li>unidades: ' + producto.unidades + '</li>';
                    descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                    descripcion += '<li>marca: ' + producto.marca + '</li>';
                    descripcion += '<li>detalles: ' + producto.detalles + '</li>';

                    template += `
                        <tr productId="${producto.id}">
                            <td>${producto.id}</td>
                            <td><a href="#" class="product-item">${producto.nombre}</a></td>
                            <td><ul>${descripcion}</ul></td>
                            <td>
                                <button class="product-delete btn btn-danger">
                                    Eliminar
                                </button>
                            </td>
                        </tr>
                    `
                });
                $('#products').html(template);
            }
        });
    }

    /**
     * FUNCIÓN PARA AGREGAR PRODUCTO
     */
    $('#product-form').submit(function (e) {
        e.preventDefault();

        let isValid = true;
        $('#product-form input, #product-form select, #product-form textarea').each(function() {
            let field = $(this);
            let validationStatus = validateField(field);
            if (!validationStatus.valid) {
                updateStatusBar(field, validationStatus.message, true);
                field.focus();
                isValid = false;
                return false; // Break the loop
            }
        });

        if (!isValid) {
            return;
        }

        const finalJSON = {
            nombre: $('#name').val(),
            precio: $('#precio').val(),
            unidades: $('#unidades').val(),
            modelo: $('#modelo').val(),
            marca: $('#marca').val(),
            detalles: $('#detalles').val(),
            imagen: $('#imagen').val()
        };
        
        let url = $('#productId').val() ? './backend/product-update.php' : './backend/product-add.php';
        if($('#productId').val()){
            finalJSON['id'] = $('#productId').val();
        }

        const productoJsonString = JSON.stringify(finalJSON, null, 2);

        $.ajax({
            url: url,
            type: 'POST',
            data: productoJsonString,
            contentType: 'application/json;charset=UTF-8',
            success: function (response) {
                let respuesta = JSON.parse(response);
                let productResult = $('#product-result');
                productResult.find('.card-body').html(`<p class="text-success">${respuesta.message}</p>`);
                productResult.removeClass('d-none');

                setTimeout(function() {
                    productResult.addClass('d-none');
                }, 3000);

                listarProductos();

                $('#product-form').trigger('reset');
                $('#unidadesOutput').text('1');
                $('#productId').val('');
            }
        });
    });

    /**
     * FUNCIÓN PARA ELIMINAR PRODUCTO
     */
    $(document).on('click', '.product-delete', function () {
        if (confirm('De verdad deseas eliminar el Producto')) {
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('productId');
            $.ajax({
                url: './backend/product-delete.php?id=' + id,
                type: 'GET',
                success: function (response) {
                    let respuesta = JSON.parse(response);
                    let template_bar = '';
                    template_bar += `
                                <li style="list-style: none;">status: ${respuesta.status}</li>
                                <li style="list-style: none;">message: ${respuesta.message}</li>
                            `;

                    $('#product-result').show();
                    $('#container').html(template_bar);
                    listarProductos();
                }
            });
        }
    });

    /**
     * FUNCIÓN PARA OBTENER UN PRODUCTO AL HACER CLICK EN EL NOMBRE
     */
    $(document).on('click', '.product-item', function (e) {
        e.preventDefault();
        let element = $(this)[0].parentElement.parentElement;
        let id = $(element).attr('productId');
        $.ajax({
            url: './backend/product-single.php?id=' + id,
            type: 'GET',
            success: function (response) {
                let producto = JSON.parse(response);
                $('#name').val(producto.nombre);
                $('#precio').val(producto.precio);
                $('#unidades').val(producto.unidades);
                $('#unidadesOutput').text(producto.unidades);
                $('#modelo').val(producto.modelo);
                $('#marca').val(producto.marca);
                $('#detalles').val(producto.detalles);
                $('#imagen').val(producto.imagen);
                $('#productId').val(producto.id);
            }
        });
    });

    // VALIDACIONES
    function validateField(field) {
        let status = {
            valid: true,
            message: ''
        };
        if (field.prop('required') && !field.val()) {
            status.valid = false;
            status.message = 'Este campo es requerido';
        } 
        return status;
    }

    function updateStatusBar(field, message, isError) {
        let feedbackDiv = field.next('.invalid-feedback');
        feedbackDiv.text(message);
        if (isError) {
            field.addClass('is-invalid');
            feedbackDiv.show();
        } else {
            field.removeClass('is-invalid');
            feedbackDiv.hide();
        }
    }

    $('#name').keyup(function() {
        let nombre = $(this).val();
        if (nombre) {
            $.ajax({
                url: './backend/product-check-name.php?nombre=' + nombre,
                type: 'GET',
                success: function(response) {
                    let data = JSON.parse(response);
                    if (data.status === 'error') {
                        updateStatusBar($('#name'), data.message, true);
                    } else {
                        updateStatusBar($('#name'), data.message, false);
                    }
                }
            });
        }
    });

    $('#product-form input, #product-form select, #product-form textarea').blur(function() {
        let field = $(this);
        let validationStatus = validateField(field);
        if (!validationStatus.valid) {
            updateStatusBar(field, validationStatus.message, true);
        } else {
            updateStatusBar(field, '', false);
        }
    });
});
