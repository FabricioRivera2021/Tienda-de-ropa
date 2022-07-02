<h3>Carrito de compra</h3>

<table class="table-carrito">
    <tr>
        <th>Imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
    </tr>
    <!-- Iterando los productos de la sesion del carrito -->
    <?php foreach ($carrito as $index => $producto) : ?>
        <tr>
            <td><img class="img-edit" src="<?= base_url ?>uploads/img/<?= $producto['producto']->imagen ?>" alt="Sin imagen"></td>
            <td><?= $producto['producto']->nombre ?></td>
            <td>U$S <?= $producto['producto']->precio ?></td>
            <td><?= $producto['unidades'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php $stats = Utils::statsCarrito(); ?>
<br>
<br>
<div class="completar-compra">
    <h3>Precio Total: U$S <?= $stats['total'] ?></h3>
    <a href="#" class="button detalle-button">Completar compra</a>
</div>