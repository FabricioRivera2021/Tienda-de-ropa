<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <title>Tienda de camisetas</title>
</head>

<body>
    <div id="container">

        <!-- CABECERA -->
        <header id="header">
            <div id="logo">
                <img src="./assets/img/logo.jpg" alt="Logo">
                <a href="index.php">
                    <h1>Tienda de camisetas</h1>
                </a>
            </div>
        </header>

        <!-- MENU -->
        <nav id="menu">
            <ul>
                <li>
                    <a href="#">
                        Inicio
                    </a>
                </li>
                <li>
                    <a href="#">
                        Categoria 1
                    </a>
                </li>
                <li>
                    <a href="#">
                        Categoria 2
                    </a>
                </li>
                <li>
                    <a href="#">
                        Categoria 3
                    </a>
                </li>
                <li>
                    <a href="#">
                        Categoria 4
                    </a>
                </li>
                <li>
                    <a href="#">
                        Categoria 5
                    </a>
                </li>
            </ul>
        </nav>

        <div id="content">
            <!-- BARRA LATERAL -->
            <aside id="lateral">
                <div id="login" class="block_aside">
                    <h3>Login</h3>
                    <form action="#" method="POST">
                        <label for="email">Email</label>
                        <input type="email" name="email">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password">
                        <input type="submit" value="Enviar">
                    </form>
                    <ul>
                        <li>
                            <a href="#">Mis pedidos</a>
                        </li>
                        <li>
                            <a href="#">Gestionar pedidos</a>
                        </li>
                        <li>
                            <a href="#">Gestionar categorias</a>
                        </li>
                    </ul>
                </div>
            </aside>
            <!-- CONTENIDO CENTRAL -->
            <div id="central">
                <h1>Productos destacados</h1>
                <div class="product">
                    <img src="./assets/img/camiseta.jpg" alt="Imagen Pruducto">
                    <h2>Camiseta azul holgada</h2>
                    <p>30 euros</p>
                    <a href="#" class="button">Comprar</a>
                </div>
                <div class="product">
                    <img src="./assets/img/camiseta.jpg" alt="Imagen Pruducto">
                    <h2>Camiseta azul holgada</h2>
                    <p>30 euros</p>
                    <a href="#" class="button">Comprar</a>
                </div>
                <div class="product">
                    <img src="./assets/img/camiseta.jpg" alt="Imagen Pruducto">
                    <h2>Camiseta azul holgada</h2>
                    <p>30 euros</p>
                    <a href="#" class="button">Comprar</a>
                </div>

            </div>

            <!-- FOOTER -->
            <footer id="footer">
                <p>Desarrollado por Fabricio Rivera &copy; <?= date('Y') ?></p>
            </footer>
        </div>
    </div>
</body>

</html>