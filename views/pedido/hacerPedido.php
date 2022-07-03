<?php if (isset($_SESSION['identity'])) : ?>
    <h2>Completar compra</h2>
    <br>
    <a href="<?= base_url ?>carrito/index"><- Volver al carrito de compra</a>
    <br>
    <hr>
    <br>
    <h3>Datos para el envío: </h3>
    <br>
    <form action="<?= base_url ?>pedido/add" method="POST">
        <label for="departamento">Departamento</label>
        <input type="text" name="departamento" required>

        <label for="localidad">Localidad</label>
        <input type="text" name="localidad" required>

        <label for="direccion">Dirección</label>
        <input type="text" name="direccion" required>

        <input type="submit" value="Realizar pedido">
    </form>
<?php else : ?>
    <h2>No estas logueado!</h2>
    <h3>Se requiere estar identificado en la página para poder realizar pedidos</h3>
<?php endif; ?>