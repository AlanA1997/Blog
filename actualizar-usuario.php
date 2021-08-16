<?php
if(isset($_POST)){

 // CONEXION A LA BASE DE DATOS  //
    require_once 'includes/conexion.php';

 //      RECORRER LOS VALORES DEL FORMULARIO DE ACTUALIZACIÓN -  (OPERADOR TERNARIO)  //

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db,$_POST['nombre']) : false;
 //         /--SI ESTO DA VERDADERO--| |-------------------HAZ ESTO--------------------| |Y SINO ESTO |

    $apellido = isset($_POST['apellido']) ? mysqli_real_escape_string($db, $_POST['apellido']) : false;
    $email = isset($_POST['email']) ? mysqli_real_escape_string($db, trim($_POST['email'])) : false;


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
        // GUARDAR USUARIO A LA BASE DE DATOS  //

    $guardar_usuario = false;

    if(count($errores) == 0){
        $usuario = $_SESSION['usuario'];
        $guardar_usuario = true;


        //  COMPROBAR SI EL EMAIL YA EXISTE //
        $sql = "SELECT id, email FROM usuarios WHERE email = '$email'";
        $isset_email = mysqli_query($db,$sql);
        $isset_user = mysqli_fetch_assoc($isset_email);

        if($isset_user['id'] == $usuario['id'] || empty($isset_user)){


            // ACTUALIZAR USUARIOS EN LA TABLA USUARIOS DE LA BASE DE DATOS   //
           
            $sql = "UPDATE usuarios SET nombre='$nombre',apellido='$apellido',email='$email' WHERE id=" . $_SESSION['usuario']['id'];            
            $guardar = mysqli_query($db,$sql);

            if($guardar){
                $_SESSION['usuarios']['nombre'] = $nombre;
                $_SESSION['usuarios']['apellido'] = $apellido;
                $_SESSION['usuarios']['email'] = $email;

                $_SESSION['completado'] = 'Tus datos se han actualizado con éxito';
            }else{
                $_SESSION['errores']['general'] = 'Fallo al actualizar tus datos!';

            }
        }else{
            $_SESSION['errores']['general'] = 'El usuario ya existe';
        }

    }else{
        $_SESSION['errores'] = $errores;
    }
}
header('Location: mis-datos.php');
