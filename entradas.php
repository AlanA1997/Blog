<?php require_once 'includes/cabecera.php'; ?>
<?php require_once 'includes/lateral.php'; ?>

<!-- CAJA PRINCIPAL -->
<div id="principal">
    <h1>Todas las entradas</h1>

    <?php

    $entradas = conseguirEntradas($db);
    if (!empty($entradas)) :
        while ($entrada = mysqli_fetch_assoc($entradas)) :
    ?>
            <article class="entrada">
                <a href="entrada.php?id=<?= $entrada['id'] ?>">
                    <h2><?= $entrada['titulo']; ?></h2>
                    <span class="fecha"><?= $entrada['categorias'] . ' |' . $entrada['fecha']; ?></span>
                    <p>
                        <?= substr($entrada['descripcion'], 0, 200) . "..."; ?>
                        <!-- le pongo un limite de letras -->
                    </p>
                </a>
            </article>
    <?php
        endwhile;
    endif;
    ?>

    <div id="volver">
        <a href="index.php">Volver</a>
    </div>
</div> <!--    FIN PRINCIPAL   -->

<?php require_once 'includes/pie.php'; ?>