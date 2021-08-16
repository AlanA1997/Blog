<?php
// INICIAR LA SESIÓN Y LA CONEXIÓN A LA BASE DE DATOS //
require_once 'includes/conexion.php';


// RECOGER DATOS DEL FORMULARIO //
if(isset($_POST)){


    // BORRAR DATOS ANTIGUOS  //

    if (isset($_SESSION['error_login'])) {
        session_unset();
    }


    // RECOGER DATOS DEL FORMULARIO //

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // CONSULTA PARA COMPROBAR LAS CREDENCIALES DEL USUARIO //
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($db, $sql);

    if($login && mysqli_num_rows($login) == 1) { // que cuente el numero de filas que me devuelve la consulta
        $usuario = mysqli_fetch_assoc($login); // esto me trae un objeto o un array asociativo

        // COMPROBAR LA CONTRASEÑA - CIFRARLA DE NUEVO
        $verify = password_verify($password, $usuario['password']);

        if($verify){
            // UTILIZAR UNA SESIÓN PARA GUARDAR LOS DATOS DEL USUARIO LOGUEADO //
            $_SESSION['usuario'] = $usuario;

        }else{
          // SI ALGO FALLA ENVIAR UNA SESIÓN CON EL FALLO //
          $_SESSION['error_login'] = "Usuario INCORRECTO";
        }

    }else{
        // MENSAJE DE ERROR //
        $_SESSION['error_login'] = "Usuario INCORRECTO";
    }
}

// REDIRIGIR AL INDEX.PHP//

header('Location: index.php');


?>