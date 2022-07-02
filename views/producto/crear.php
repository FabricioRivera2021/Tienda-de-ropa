<?php if ((isset($editar)) && isset($prod) && is_object($prod)): ?>
    <h1>Editar producto</h1>
    <?php $url_action = base_url . "producto/save&id=" . $prod->id ?>
<?php else : ?>
    <h1>Ingresar nuevo producto</h1>
    <?php $url_action = base_url . "producto/save" ?>
<?php endif; ?>

<div class="form">
    <!--                                                    Con este enctype podremos enviar ***IMG***-->
    <form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="<?=isset($prod) && isset($prod) && is_object($prod) ? $prod->nombre : "" ?>">

        <label for="desc">Descripción</label>
        <textarea name="desc" cols="30" rows="5"><?=isset($prod) && isset($prod) && is_object($prod) ? $prod->descripcion : "" ?></textarea>

        <label for="precio">Precio</label>
        <div class="precio-contenedor">
            <p class="precio">U$S</p><input class="input-precio" type="text" name="precio" value="<?=isset($prod) && isset($prod) && is_object($prod) ? $prod->precio : "" ?>">
        </div>

        <label for="stock">Stock</label>
        <input type="number" name="stock" value="<?=isset($prod) && isset($prod) && is_object($prod) ? $prod->stock : "" ?>">

        <label for="categoria">Categoria</label>
        <?php $categorias = Utils::showCategorias(); ?>
        <select name="categoria">
            <?php while ($cat = $categorias->fetch_object()) : ?>
                <option value="<?= $cat->id ?>" <?=isset($prod) && isset($prod) && is_object($prod) && $cat->id == $prod->categoria_id ? "selected" : "" ?>>
                    <?= $cat->nombre ?>
                </option>
            <?php endwhile; ?>
        </select>

        <label for="img">Imagen <span class="desc">Jpeg, Jpg o Gif</span></label>
        <?php if(isset($prod) && is_object($prod) && !empty($prod->imagen)): ?>
            <img class="img-edit" src="<?=base_url?>uploads/img/<?=$prod->imagen?>" alt="Sin imagen">
        <?php endif; ?> 
        <input type="file" name="img">

        <input type="submit" value="Guardar">
    </form>
</div>