<?php include('conexion.php'); $conexion=conectarDB();


    $query = "select * from cl_region";
    $resultado= pg_query($conexion, $query) or die ('Consulta Mala'.pg_query_error($conexion));

    $json = array();
    $nr=pg_num_rows($resultado);
    if($nr>0){
        while($filas=pg_fetch_array($resultado)){       
            $json[] = array(
                'cod_region' => $filas['cod_region'],
                'nombre_region' => $filas['nombre_region']
            );                              
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    else echo "No hay datos";

?>
