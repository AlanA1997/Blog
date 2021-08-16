<?php

//  AYUDAS DE LIBRERIAS DE PHP //

function mostrarError($errores, $campo)
{
    $alerta = '';
    if (isset($errores[$campo]) && !empty($campo)) {
        $alerta = "<div class='alerta alerta_error'>" . $errores[$campo] . '</div>';
    }

    return $alerta;
}

function borrarError(){
    $borrar = false;

    if (isset($_SESSION['errores'])) {
        $_SESSION['errores'] = null;
        $borrar = true;
    }

    if (isset($_SESSION['errores_entradas'])) {
        $_SESSION['errores_entradas'] = null;
        $borrar = true;
    }


    if (isset($_SESSION['completado'])) {
        $_SESSION['completado'] = null;
        $borrar = true;
    }


    return $borrar;
}

function conseguirCategorias($conexion){
    $sql = 'SELECT * FROM categorias ORDER BY id ASC';
    $categorias = mysqli_query($conexion, $sql);

    $resultado = array();

    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        $resultado = $categorias;
    }

    return $resultado;
}

function conseguirCategoria($conexion,$id)
{
    $sql = "SELECT * FROM categorias WHERE id = $id;";
    $categorias = mysqli_query($conexion, $sql);

    $resultado = array();
    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        $resultado = mysqli_fetch_assoc($categorias);
    }

    return $resultado;
}

function conseguirentrada($conexion,$id){
    $sql = " SELECT e.*, c.nombre AS 'categoria', CONCAT(u.nombre, ' ',u.apellido) AS usuario".
    " FROM entradas e".
    " INNER JOIN categorias c ON e.categoria_id = c.id ".
    " INNER JOIN usuarios u ON e.usuario_id = u.id ".
    " WHERE  e.id = $id ";

    $entrada = mysqli_query($conexion, $sql);

    $resultado = array ();
    if($entrada && mysqli_num_rows($entrada) >= 1 ){
        $resultado = mysqli_fetch_assoc($entrada);
    }

    return $resultado;
}

function conseguirEntradas($conexion, $limit = null, $categoria = null){
    $sql = " SELECT e.*, c.nombre AS 'categorias' FROM entradas e "
    . " INNER JOIN categorias c ON e.categoria_id = c.id ";

    if(!empty($categoria)){
        $sql .= " WHERE e.categoria_id = $categoria "; // con el punto le concateno una consulta
    }

    $sql .= " ORDER BY e.id DESC ";

    if($limit){
        $sql .= " LIMIT 4";
        // $sql = $sql."LIMIT 4"; es lo mismo que el de arriba
    }

    $entradas = mysqli_query($conexion,$sql);

    
    $resultado = array();

    if($entradas && mysqli_num_rows($entradas) >= 1){
        $resultado = $entradas;
    }

    return $entradas;
}

function buscarEntradas($conexion, $limit = null, $categoria = null, $busqueda = null){
    $sql = " SELECT e.*, c.nombre AS 'categorias' FROM entradas e "
    . " INNER JOIN categorias c ON e.categoria_id = c.id ";

    if (!empty($categoria)) {
        $sql .= " WHERE e.categoria_id = $categoria "; // con el punto le concateno una consulta
    }

    if (!empty($busqueda)) {
        $sql .= " WHERE e.titulo LIKE '%$busqueda%' "; // con el punto le concateno una consulta
    }

    $sql .= " ORDER BY e.id DESC ";

    if ($limit) {
        $sql .= " LIMIT 4";
        // $sql = $sql."LIMIT 4"; es lo mismo que el de arriba
    }

    $entradas = mysqli_query($conexion, $sql);


    $resultado = array();

    if ($entradas && mysqli_num_rows($entradas) >= 1) {
        $resultado = $entradas;
    }

    return $entradas;
}

?>

<!-- <li>
    <a href="index.php">Categoria 1</a>
</li>
<li>
    <a href="index.php">Categoria 2</a>
</li>
<li>
    <a href="index.php">Categoria 3</a>
</li>
<li>
    <a href="index.php">Categoria 4</a>
</li> -->
