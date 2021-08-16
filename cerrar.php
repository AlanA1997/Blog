<?php
session_start();

if(isset($_SESSION['usuario'])){
    session_unset();
}

header("Location: index.php");

?>