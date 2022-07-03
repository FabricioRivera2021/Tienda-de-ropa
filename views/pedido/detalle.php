<h2>Detalle del pedido</h2>
<?php if (isset($pedidoDetalle)) : ?>
    <?php if (isset($_SESSION['admin'])) : ?>
        <h3>Cambiar el estado del pedido</h3>
        <form action="<?= base_url ?>pedido/estado" method="POST">
            <input type="hidden" value="<?= $pedidoDetalle->id ?>" name="pedido_id">
            <select name="estado">
                <option value="pendiente_de_envio" <?= $pedidoDetalle->estado == "pendiente_de_envio" ? 'selected' : ''; ?>>Pendiente de envio</option>
                <option value="en_preparacion" <?= $pedidoDetalle->estado == "en_preparacion" ? 'selected' : ''; ?>>En preparación</option>
                <option value="en_transito" <?= $pedidoDetalle->estado == "en_transito" ? 'selected' : ''; ?>>En transito</option>
                <option value="recibido"> <?= $pedidoDetalle->estado == "recibido" ? 'selected' : ''; ?>Recibido</option>
                <option value="cancelado"> <?= $pedidoDetalle->estado == "cancelado" ? 'selected' : ''; ?>Cancelado</option>
            </select>
            <input type="submit" value="Cambiar estado">
        </form>
    <?php endif; ?>

    <div class="detalle-pedido">

        <div class="datos-pedido">
            <h4>Datos del Pedido:</h4>
            <p>Estado: <?= Utils::showState($pedidoDetalle->estado) ?></p>
            <p>Numero de pedido: <?= $pedidoDetalle->id ?></p>
            <p>Total a pagar: U$S <?= $pedidoDetalle->coste ?></p>
        </div>

        <div class="direccion-pedido">
            <h4>Dirección del pedido:</h4>
            <p>Departamento: <?= $pedidoDetalle->provincia ?></p>
            <p>Localidad: <?= $pedidoDetalle->localidad ?></p>
            <p>Dirección: <?= $pedidoDetalle->direccion ?></p>
        </div>

        <div class="datos-usu">
            <h4>Datos del usuario:</h4>
            <p>Nombre: <?= $pedidoDetalle->nombre ?> </p>
            <p>Apellido: <?= $pedidoDetalle->apellido ?></p>
            <p>Email: <?= $pedidoDetalle->email ?></p>
        </div>

        <div class="datos-fecha">
            <h4>Fecha y hora del pedido</h4>
            <p>Fecha: <?= $pedidoDetalle->fecha ?></p>
            <p>Hora: <?= $pedidoDetalle->hora ?></p>
        </div>
    </div>

    <table class="table-carrito">
        <?php while ($prod = $productos->fetch_object()) : ?>
            <tr>
                <td><?= $prod->nombre ?></td>
                <td>Precio: U$S <?= $prod->precio ?></td>
                <td>X<?= $prod->unidades ?></td>
                <td><img class="img-edit" src="<?= base_url ?>uploads/img/<?= $prod->imagen ?>" alt="sin imagen"></td>
            </tr>
        <?php endwhile; ?>
    </table>

<?php endif; ?>