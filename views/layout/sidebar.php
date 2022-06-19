    <!-- BARRA LATERAL -->
    <aside id="lateral">
                <div id="login" class="block_aside">

                    <?php if(!isset($_SESSION['identity'])): ?>
                    <h3>Login</h3>
                    <form action="<?=base_url?>usuario/login" method="POST">
                        <label for="email">Email</label>
                        <input type="email" name="email">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password">
                        <input type="submit" value="Enviar">
                    </form>
                    <?php elseif(!isset($_SESSION['admin'])): ?>
                    <h3><?=$_SESSION['identity']->nombre . " " . $_SESSION['identity']->apellido?></h3> <!--Como es un objeto se manda con -> -->
                    <a href="<?=base_url?>usuario/logout"><button class="logout">Cerrar Sesión</button></a>
                    <ul>
                        <li><a href="#">Mis pedidos</a></li>
                    </ul>
                    <?php else: ?>
                    <h3><?=$_SESSION['identity']->nombre . " " . $_SESSION['identity']->apellido?></h3> <!--Como es un objeto se manda con -> -->
                    <a href="<?=base_url?>usuario/logout"><button class="logout">Cerrar Sesión</button></a>
                    <ul>
                        <li><a href="#">Gestionar pedidos</a></li>
                        <li><a href="#">Gestionar categorias</a></li>
                    </ul>
                    <?php endif; ?>
                </div>
            </aside>
            <!-- CONTENIDO CENTRAL -->
            <div id="central">