<?php

if(!isset($_SESSION)){ // SI NO ESTA REGISTRADO NO VA A INGRESAR 
    session_start();
}

if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
}



?>