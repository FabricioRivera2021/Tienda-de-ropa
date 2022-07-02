<!-- BARRA LATERAL -->
<aside id="lateral">

    <div id="carrito" class="block_aside">
        <h3>Carrito de compra</h3>
        <ul>
            <?php $stats = Utils::statsCarrito(); ?>
            <li>Productos (<?= $stats['count'] ?>)</li>
            <li>Costo acumulado: U$S <?= $stats['total'] ?></li>
            <li><a href="<?= base_url ?>carrito/index">Ver carrito</a></li>
        </ul>
    </div>

    <div id="login" class="block_aside">

        <!-- Usuario ***NO**** logueado -->
        <?php if (!isset($_SESSION['identity'])) : //Si no existe el login muestra el form. de LOGUIN 
        ?>
            <h3>Login</h3>
            <form action="<?= base_url ?>usuario/login" method="POST">
                <label for="email">Email</label>
                <input type="email" name="email">
                <label for="password">Contraseña</label>
                <input type="password" name="password">
                <input type="submit" value="Enviar">
            </form>
            <ul>
                <li><a href="<?= base_url ?>usuario/registro">Registrate</a></li>
            </ul>

            <!-- Esto pasa si el usuario esta LOGUEADO previamente -->
        <?php elseif (!isset($_SESSION['admin'])) : //pregunta si no es admin 
        ?>
            <!-- Se muestra cuando el usuario **NO ES ADMIN** -->
            <h3><?= $_SESSION['identity']->nombre . " " . $_SESSION['identity']->apellido ?></h3>
            <!--Como es un objeto se manda con -> -->
            <ul>
                <li><a href="#">Mis pedidos</a></li>
            </ul>
            <a href="<?= base_url ?>usuario/logout"><button class="logout">Cerrar Sesión</button></a>


            <!-- Esto se muestra si el ususario *****ES UN ADMIN**** -->
        <?php else : ?>
            <h3><?= $_SESSION['identity']->nombre . " " . $_SESSION['identity']->apellido ?></h3>
            <!--Como es un objeto se manda con -> -->
            <ul>
                <li><a href="<?= base_url ?>producto/gestion">Gestionar productos</a></li>
                <li><a href="#">Gestionar pedidos</a></li>
                <li><a href="<?= base_url ?>categoria/index">Gestionar categorias</a></li>
            </ul>
            <a href="<?= base_url ?>usuario/logout"><button class="logout">Cerrar Sesión</button></a>
        <?php endif; ?>
    </div>
</aside>
<!-- CONTENIDO CENTRAL -->
<div id="central">