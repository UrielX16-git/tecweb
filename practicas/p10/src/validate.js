function validateForm() {
    const nombre = document.getElementById('nombre').value;
    const marca = document.getElementById('marca').value;
    const modelo = document.getElementById('modelo').value;
    const precio = document.getElementById('precio').value;
    const detalles = document.getElementById('detalles').value;
    const unidades = document.getElementById('unidades').value;
    const alphanumeric = /^[a-z0-9]+$/i;

    if (nombre.trim() === '') {
        alert('El campo "Nombre" es requerido.');
        return false;
    }
    if (nombre.length > 100) {
        alert('El "Nombre" no debe exceder los 100 caracteres.');
        return false;
    }

    if (marca === '') {
        alert('Debe seleccionar una "Marca".');
        return false;
    }

    if (modelo.trim() === '') {
        alert('El campo "Modelo" es requerido.');
        return false;
    }
    if (!alphanumeric.test(modelo)) {
        alert('El "Modelo" solo puede contener caracteres alfanuméricos.');
        return false;
    }
    if (modelo.length > 25) {
        alert('El "Modelo" no debe exceder los 25 caracteres.');
        return false;
    }

    if (precio.trim() === '') {
        alert('El campo "Precio" es requerido.');
        return false;
    }
    if (parseFloat(precio) <= 99.99) {
        alert('El "Precio" debe ser mayor a 99.99.');
        return false;
    }

    if (detalles.length > 250) {
        alert('Los "Detalles" no deben exceder los 250 caracteres.');
        return false;
    }

    if (unidades.trim() === '') {
        alert('El campo "Unidades" es requerido.');
        return false;
    }
    if (parseInt(unidades) < 0) {
        alert('Las "Unidades" deben ser un número mayor or igual a 0.');
        return false;
    }

    return true;
}