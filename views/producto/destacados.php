<h1>Algunos productos de nuestra tienda</h1>

<div class="contenedor-producto">
    <?php while ($prod = $productos->fetch_object()) : ?>
        <div class="product">
            <a href="<?=base_url?>producto/ver&id=<?=$prod->id?>">
                <?php if ($prod->imagen != null) : ?>
                    <div class="contenedor-img">
                        <img src="<?= base_url ?>uploads/img/<?= $prod->imagen ?>" alt="Sin Imagen">
                    </div>
                <?php else : ?>
                    <div class="contenedor-img">
                        <img src="assets/img/camiseta.jpg">
                    </div>
                <?php endif; ?>
                <h2><?= $prod->nombre ?></h2>
            </a>
            <p><?= $prod->precio ?></p>
            <a href="<?=base_url?>carrito/add&id=<?=$prod->id?>" class="button">Agregar a carrito</a>
        </div>
    <?php endwhile; ?>
</div>