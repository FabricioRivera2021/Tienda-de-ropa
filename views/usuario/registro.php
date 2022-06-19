<h1>Registrarse</h1>

<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'Completado'): ?>
        <strong class="success">Registro completado correctamente</strong>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'Bad_fields'): ?>
        <strong class="fail">Error: algun campo contiene informacion erronea</strong>
<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'Empty_fields'): ?>
        <strong class="fail">Error: no se aceptan campos vacios</strong>
<?php endif; ?>
<?php Utils::deleteSession('register'); ?>


<form action="<?=base_url?>usuario/save" method="POST">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" required/>
    
    <label for="apellido">Apellido</label>
    <input type="text" name="apellido" required/>
    
    <label for="email">Email</label>
    <input type="email" name="email" required/>
    
    <label for="password">Contraseña</label>
    <input type="password" name="password" required/>

    <input type="submit" value="Registrarse" />
</form>