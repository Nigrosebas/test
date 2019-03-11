<?php include('conexion.php'); $conexion=conectarDB();

    $nombre = $_POST['nombreyapellido'];
    $alias = $_POST['alias'];
    $rut = $_POST['rut'];
    $email = $_POST['email'];
    $cod_region = $_POST['region'];
    $cod_comuna = $_POST['comuna'];
    $candidato = $_POST['candidatos'];
    $checkbox = $_POST['checkbox'];

    $query = "select * from cl_votos where alias = '$alias'";
    $resultado= pg_query($conexion, $query) or die ('Consulta Mala');
    $nr=pg_num_rows($resultado);
    if($nr>0){
        $respuesta = 2;
        echo $respuesta;
    }
    else{
        $query2 = "select * from cl_votos where rut = '$rut'";
        $resultado2= pg_query($conexion, $query2) or die ('Consulta Mala');
        $nr2=pg_num_rows($resultado2);
        if($nr2>0){
            $respuesta = 3;
            echo $respuesta;
        }
        else{
            $query3 = "insert into cl_votos(nombre,alias,rut,email,cod_region,cod_comuna,candidato,difusion) values ('$nombre','$alias','$rut','$email','$cod_region','$cod_comuna','$candidato','$checkbox')";
            $resultado3= pg_query($conexion, $query3) or die ('Consulta Mala');
            if(!$resultado3){
                die ('Mala inserción');
            }
            $respuesta = 4;
            echo $respuesta;
        }
    }
?>
