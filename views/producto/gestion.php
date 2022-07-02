<h1>Gestion de productos</h1>

<a href="<?=base_url?>producto/crear" class="button button-small">Crear producto</a>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Imagen</th>
        <th>Modificar/Borrar</th>
    </tr>
    <?php while($prod = $productos->fetch_object())://Iterar sobre el objetos de categorias?>
        <tr>
            <td><?=$prod->id;?></td>
            <td><?=$prod->nombre;?></td>
            <td><?=$prod->precio;?></td>
            <td><?=$prod->stock;?></td>
            <td><img class="img-gestion" src="<?=base_url . 'uploads/img/' . $prod->imagen;?>" alt="No se encontro img"></td>
            <td id="prod">
                <div class="mod-prod">
                    <!-- NOTA IMPORTANTE: como no es el primer parametro get que estamos pasando. La ID se agrega con "&" -->
                    <!-- Aqui se pasa el id del producto por el metodo GET al controlador de productos -->
                    <a href="<?=base_url?>producto/editar&id=<?=$prod->id;?>" class="button button-small button-mod">Modificar</a>
                    <a href="<?=base_url?>producto/eliminar&id=<?=$prod->id;?>" class="button button-small button-delete">Borrar</a>
                </div>
            </td>
        </tr>
    <?php endwhile; ?>
</table>

<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'Success'): ?>
    <strong class="success">Exito!</strong>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != 'Success'): ?>
    <strong class="fail">Ocurrio un error</strong>
    <p><?=$_SESSION['producto']?></p>
<?php endif; ?>
<?php Utils::deleteSession('producto') ?>
