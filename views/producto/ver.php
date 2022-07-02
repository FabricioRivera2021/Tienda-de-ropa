<?php if (isset($prod) && is_object($prod)) : ?>
    <h1><?= $prod->nombre ?></h1>

    <div class="detalle-contenedor">
        <?php if ($prod->imagen != null) : ?>
            <div class="detalle-img">
                <img src="<?= base_url ?>uploads/img/<?= $prod->imagen ?>" alt="Sin Imagen">
            </div>
        <?php else : ?>
            <div class="detalle-img">
                <img src="assets/img/camiseta.jpg">
            </div>
        <?php endif; ?>
        <div class="detalle-text">
            <p class="detalle-p"><?= $prod->nombre ?></p>
            <p class="detalle-p"><?= $prod->descripcion ?></p>
            <p class="detalle-p"><?= $prod->precio ?> U$S</p>
            <a href="<?=base_url?>carrito/add&id=<?=$prod->id?>" class="button detalle-button">Comprar</a>
        </div>
    </div>

<?php else : ?>
    <h1>El producto no existe</h1>
<?php endif; ?>