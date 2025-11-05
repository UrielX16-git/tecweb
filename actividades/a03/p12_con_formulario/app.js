// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
  };

function init() {
    /**
     * Convierte el JSON a string para poder mostrarlo
     * ver: https://developer.mozilla.org/es/docs/Web/JavaScript/Reference/Global_Objects/JSON
     */
    let JsonString = JSON.stringify(baseJSON,null,2);
    $("#description").val(JsonString);
}

$(document).ready(function () {
    // SE INICIALIZA LA PÁGINA
    init();

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

        var productoJsonString = $('#description').val();
        var finalJSON = JSON.parse(productoJsonString);
        finalJSON['nombre'] = $('#name').val();
        
        let url = $('#productId').val() ? './backend/product-update.php' : './backend/product-add.php';
        if($('#productId').val()){
            finalJSON['id'] = $('#productId').val();
        }

        productoJsonString = JSON.stringify(finalJSON, null, 2);

        $.ajax({
            url: url,
            type: 'POST',
            data: productoJsonString,
            contentType: 'application/json;charset=UTF-8',
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

                $('#product-form').trigger('reset');
                let JsonString = JSON.stringify(baseJSON,null,2);
                $("#description").val(JsonString);
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
                let JsonString = JSON.stringify(producto,null,2);
                $("#description").val(JsonString);
                $('#productId').val(producto.id);
            }
        });
    });
});
