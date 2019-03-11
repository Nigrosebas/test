<?php include('conexion.php'); $conexion=conectarDB();

    $cod_region = $_GET['cod_region'];
    $query = "select * from cl_comuna where cod_region = '$cod_region'";
    $resultado= pg_query($conexion, $query) or die ('Consulta Mala'.pg_query_error($conexion));

    $json = array();
    $nr=pg_num_rows($resultado);
    if($nr>0){
        while($filas=pg_fetch_array($resultado)){       
            $json[] = array(
                'cod_comuna' => $filas['cod_comuna'],
                'nombre_comuna' => $filas['nombre_comuna'],
            );                              
        }
        $jsonstring = json_encode($json);
        echo $jsonstring;
    }
    else echo "No hay datos";

?>
