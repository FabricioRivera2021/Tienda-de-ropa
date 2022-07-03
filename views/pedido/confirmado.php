<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'Pedido registrado!') : ?>
    <h2>Tu pedido ha sido realizado con éxito</h2>
    <p>Ya solo falta que nos hagas una transferencia del dinero para que te enviemos el pedido.</p>
    <br>
    <?php if (isset($pedidoByUser)) : ?>
        <h4>Datos del Pedido</h4>
        <br>
        <pre>
            Numero de pedido: <?= $pedidoByUser->id ?>
            Total a pagar: U$S <?= $pedidoByUser->coste ?>
        </pre>
        <br>
        <table class="table-carrito">
            <?php while ($prod = $productos->fetch_object()) : ?>
                <tr>
                    <td><?=$prod->nombre?></td>
                    <td>Precio: U$S <?=$prod->precio?></td>
                    <td>X<?=$prod->unidades?></td>
                    <td><img class="img-edit" src="<?=base_url?>uploads/img/<?=$prod->imagen?>" alt="sin imagen"></td>
                </tr>
            <?php endwhile; ?>
        </table>
        <br>
        <a class="button button-small" href="<?=base_url?>">Volver a la tienda</a>
    <?php endif; ?>
<?php else : ?>
    <h2>El pedido no pudo procesarse</h2>
<?php endif; ?>