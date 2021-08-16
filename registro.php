<?php
if(isset($_POST)){

 // CONEXION A LA BASE DE DATOS  //
    require_once 'includes/conexion.php';

 // INICIAR SESIÓN // 
    if(!isset($_SESSION)){  //Por si no funciona el iniciar sesion en CONEXION.PHP
         session_start();
    }

 //      RECORRER LOS VALORES DEL FORMULARIO REGISTRO  -  (OPERADOR TERNARIO)  //

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db,$_POST['nombre']) : false;
 //         /--SI ESTO DA VERDADERO--| |-------------------HAZ ESTO--------------------| |Y SINO ESTO |

    $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;
    $password = isset($_POST['password']) ? mysqli_real_escape_string($db, $_POST['password']) : false;

 //      ARRAY DE ERRORES       //
    $errores = array();


 //  VALIDAR LOS DATOS ANTES DE GUARDARLOS EN LA BASE DE DATOS   //

            // VALIDAR NOMBRE //
    if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)){
        $nombre_valido = true;
    }else{
        $nombre_valido = false;
        $errores['nombre'] = "El nombre NO es valido..";
    }

            // VALIDAR APELLIDO //
    if(!empty($apellido) && !is_numeric($apellido) && !preg_match("/[0-9]/", $apellido)) {
        $apellido_valido = true;
    }else{
        $apellido_valido = false;
        $errores['apellido'] = "El apellido NO es valido..";
    }

            // VALIDAR EMAIL //
    if(!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)){
        $email_valido = true;
    }else{
        $email_valido = false;
        $errores['email'] = "El email NO es valido..";
    }

            // VALIDAR CONTRASEÑA //
    if(!empty($password)){
        $password_valido = true;
    }else{
        $password_valido = false;
        $errores['password'] = "La contraseña esta VACIA..";
    }

        // GUARDAR USUARIO A LA BASE DE DATOS  //

    $guardar_usuario = false;

    if(count($errores) == 0){
        $guardar_usuario = true;

        // CIFRAR LA CONTRASEÑA //
        $password_segura = password_hash($password,PASSWORD_BCRYPT,['cost'=>4]);
        password_verify($password,$password_segura);

        // INSERTAR USUARIOS EN LA TABLA USUARIOS DE LA BASE DE DATOS   //
        $sql =  "INSERT INTO usuarios VALUES (null,'$nombre','$apellido','$email','$password_segura', CURDATE());";
        $guardar = mysqli_query($db,$sql);

        if($guardar){
            $_SESSION['completado'] = 'El registro se ha completado con éxito';
        }else{
              $_SESSION['errores']['general'] = 'Fallo al guardar el usuario!';

        }

    }else{
        $_SESSION['errores'] = $errores;
    }
}
header('Location: index.php');

?>