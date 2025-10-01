<?php
    header("Content-Type: application/json; charset=utf-8"); 
    $data = array();

	if(isset($_GET['tope']))
    {
		$tope = $_GET['tope'];
    }
    else
    {
        die('Parámetro "tope" no detectado...');
    }

	if (!empty($tope))
	{
		// Definir credenciales de la base de datos
        $db_host = 'localhost';
        $db_user = 'root';
        $db_pass = '161202';
        $db_name = 'marketzone';

		/** SE CREA EL OBJETO DE CONEXION */
		@$link = new mysqli($db_host, $db_user, $db_pass, $db_name);

		/** comprobar la conexión */
		if ($link->connect_errno) 
		{
			die('Falló la conexión a la base de datos: '.$link->connect_error.'<br/>');
		}

		/** Crear una tabla que no devuelve un conjunto de resultados */
		if ( $result = $link->query("SELECT * FROM productos WHERE unidades <= $tope") ) 
		{
            /** Se extraen las tuplas obtenidas de la consulta */
			$row = $result->fetch_all(MYSQLI_ASSOC);

            /** Se crea un arreglo con la estructura deseada */
            foreach($row as $num => $registro) {            // Se recorren tuplas
                foreach($registro as $key => $value) {      // Se recorren campos
                    $data[$num][$key] = utf8_encode($value);
                }
            }

			/** útil para liberar memoria asociada a un resultado con demasiada información */
			$result->free();
		}

		$link->close();

        /** Se devuelven los datos en formato JSON */
        echo json_encode($data, JSON_PRETTY_PRINT);
	}
	?>