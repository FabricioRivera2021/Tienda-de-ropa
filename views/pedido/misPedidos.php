<?php if (isset($gestion)) : ?>
    <h3>Gestionar pedidos</h3>
<?php else : ?>
    <h3>Mis Pedidos</h3>
<?php endif; ?>

<table class="table-carrito">
    <tr>
        <th>Numero de pedido</th>
        <th>Coste total</th>
        <th>Fecha</th>
        <th>Estado</th>
    </tr>

    <!-- Iterando los pedidos realizados por el usuario -->
    <?php while ($pedido = $pedidos->fetch_object()) : ?>
        <tr>
            <td><a href="<?= base_url ?>pedido/detalle&id=<?= $pedido->id ?>"><?= $pedido->id ?></a></td>
            <td>U$S <?= $pedido->coste ?></td>
            <td><?= $pedido->fecha ?></td>
            <td class="state"><?= $pedido->estado ?></td>
        </tr>
    <?php endwhile; ?>

</table>