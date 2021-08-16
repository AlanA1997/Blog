<?php

// CONEXIÓN

$servidor = 'localhost';
$usuario ='root';
$password = '';
$basededatos = 'blog_master';

$db = mysqli_connect($servidor, $usuario, $password, $basededatos);

mysqli_query($db,"SET NAMES 'utf8'"); // Cuando venga algun dato con Ñ o algun caracter similiar, lo acepte


// INICIAR LA SESIÓN;

if (!isset($_SESSION)) {
    session_start();
}


//BORRAR SESIÓN

?>