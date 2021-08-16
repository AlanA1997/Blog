<!-- BARRA LATERAL-->
<aside id="sidebar">

    <div id="buscador" class="bloque">
        <h3>Buscar</h3>
        <form action="buscar.php" method="POST">
            <input type="text" name="busqueda">
            <input type="submit" value="Buscar">

        </form>
    </div>


    <?php if (isset($_SESSION['usuario'])) : ?>
        <div id="usuario_logueado" class="bloque">
            <h3>Bienvenido/a, <?= $_SESSION['usuario']['nombre'] . ' ' . $_SESSION['usuario']['apellido'] . '.'; ?><br></br>¡Gracias por ingresar!</h3><br />

            <!-- BOTONES  -->
            <a href="crear-entradas.php" class="boton boton-verde">Crear entradas</a>
            <a href="crear-categorias.php" class="boton boton-azul">Crear categorias</a>
            <a href="mis-datos.php" class="boton boton-naranja">Mis datos</a>
            <a href="cerrar.php" class="boton">Cerrar Sesión</a>
        </div>

    <?php endif; ?>

    <?php if (!isset($_SESSION['usuario'])) : ?>
        <div id="login" class="bloque">
            <h3>Iniciar Sesión</h3>

            <?php if (isset($_SESSION['error_login'])) : ?>
                <div class="alerta alerta_error">
                    <?= $_SESSION['error_login']; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
                <label for="email">Email:</label>
                <input type="email" name="email">

                <label for="password">Contraseña:</label>
                <input type="password" name="password">

                <input type="submit" name="submit" value="Entrar">

            </form>
        </div>

        <div id="register" class="bloque">
            <h3>Registrarse (usuario nuevo)</h3>

            <!--     MOSTRAR ERRORES    -->

            <?php if (isset($_SESSION['completado'])) : ?>
                <div class="alerta alerta-exito">
                    <?= $_SESSION['completado'] ?>
                </div>
            <?php elseif (isset($_SESSION['errores']['general'])) : ?>
                <div class="alerta alerta_error">
                    <?= $_SESSION['errores']['general']; ?>
                </div>

            <?php endif; ?>
            <form action="registro.php" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'nombre') : ''; ?>

                <label for="apellido">Apellido:</label>
                <input type="text" name="apellido">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'apellido') : ''; ?>

                <label for="email">Email:</label>
                <input type="email" name="email">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'email') : ''; ?>

                <label for="password">Contraseña:</label>
                <input type="password" name="password">
                <?php echo isset($_SESSION['errores']) ? mostrarError($_SESSION['errores'], 'password') : ''; ?>

                <input type="submit" value="Registrar">
                <?php borrarError(); ?>
            </form>
        </div>
    <?php endif; ?>
</aside>