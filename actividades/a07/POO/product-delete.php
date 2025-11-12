<?php

namespace MyApi\Backend;

require_once __DIR__ . '/myapi/Products.php';

/*
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array(
        'status'  => 'error',
        'message' => 'La consulta falló'
    );
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_GET['id']) ) {
        $id = $_GET['id'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";
        if ( $conexion->query($sql) ) {
            $data['status'] =  "success";
            $data['message'] =  "Producto eliminado";
		} else {
            $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($conexion);
        }
		$conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
*/

$products = new Products('nombre_de_tu_bd', 'usuario_bd', 'password_bd'); // Replace with actual DB credentials
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $products->delete($id);
    echo $products->getData();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Product ID not provided']);
}

?>