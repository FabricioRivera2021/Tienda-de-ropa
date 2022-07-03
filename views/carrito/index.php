<h3>Carrito de compra</h3>

<?php if (isset($carrito) && count($_SESSION['carrito']) >= 1) : ?>
    <table class="table-carrito">
        <tr>
            <th>Imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Quitar producto</th>
        </tr>
        <!-- Iterando los productos de la sesion del carrito -->
        <?php foreach ($carrito as $index => $producto) : ?>
            <tr>
                <td><img class="img-edit" src="<?= base_url ?>uploads/img/<?= $producto['producto']->imagen ?>" alt="Sin imagen"></td>
                <td><?= $producto['producto']->nombre ?></td>
                <td>U$S <?= $producto['producto']->precio ?></td>
                <td>
                    <div class="unidades-carrito">
                        <a href="<?= base_url ?>carrito/up&index=<?= $index ?>" class="button button-up">+</a>
                        <?= $producto['unidades'] ?>
                        <a href="<?= base_url ?>carrito/down&index=<?= $index ?>" class="button button-down">-</a>
                    </div>
                </td>
                <td><a href="<?= base_url ?>carrito/remove&index=<?= $index ?>" class="button button-red">Eliminar</a></td>

            </tr>
        <?php endforeach; ?>
    </table>

    <?php $stats = Utils::statsCarrito(); ?>
    <br>
    <br>
    <div class="completar-compra">
        <h3>Precio Total: U$S <?= $stats['total'] ?></h3>
        <a href="<?= base_url ?>carrito/delete" class="button detalle-button button-red">Cancelar</a>
        <a href="<?= base_url ?>pedido/makeOrder" class="button detalle-button">Realizar pedido</a>
    </div>
<?php else : ?>
    <br>
    <h4>El carrito esta vacio</h4>
    <p>Para agregar prductos al carrito presiona el boton comprar en algun producto</p>
    <br>
    <a href="<?= base_url ?>">Volver a la página principal</a>
<?php endif; ?>