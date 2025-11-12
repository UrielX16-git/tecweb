<?php

namespace MyApi\Backend;

require_once __DIR__ . '/myapi/Products.php';

/*
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();
    // SE VERIFICA HABER RECIBIDO EL ID
    if( isset($_GET['id']) ) {
        $id = $_GET['id'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        $sql = "SELECT * FROM productos WHERE id = '{$id}' AND eliminado = 0";
        if ( $result = $conexion->query($sql) ) {
            // SE OBTIENEN LOS RESULTADOS
			$row = $result->fetch_array(MYSQLI_ASSOC);

            if(!is_null($row)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($row as $key => $value) {
                    $data[$key] = utf8_encode($value);
                }
            }
			$result->free();
		} else {
            die('Query Error: '.mysqli_error($conexion));
        }
		$conexion->close();
    } 
    
    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
*/

$products = new Products('nombre_de_tu_bd', 'usuario_bd', 'password_bd'); // Replace with actual DB credentials
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $products->single($id);
    echo $products->getData();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Product ID not provided']);
}

?>