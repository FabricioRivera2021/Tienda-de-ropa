<?php
//Iniciando una session
session_start();
//Aqui en el index principal el que esta devolviendo toda la informacion segun a lo que se llame es el controlador
//Es el que hace la mayor parte del trabajo por lo que veo
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utilidades.php';
require_once 'views/layout/header.php';
require_once 'views/layout/sidebar.php';

// $controlador = new UsuarioController(); -- validacion debajo
// $controlador->mostrarTodos();
// $controlador->crear();

function show_error(){
    $error = new errorController();
    $error->index();
}

//Como forma de validacion media pedorra se puede hacer que si la clase controlador que estamos pasando por el get
//existe se cree una nueva instancia de ese controlador
if(isset($_GET['controller']) && class_exists($_GET['controller']."Controller")){//Concateno aqui el "controller" porq todos los controladores lo van a tener
    $nombre_controlador = $_GET['controller'] . "Controller";
    $controlador = new $nombre_controlador();//Se crea una instancia del controlador de manera dinamica

    //validamos si el metodo al que estamos llamando por la URL existe
    //Si existe se llama al metodo que se halla pasado por la URL de manera dinamica
    if(isset($_GET['action']) && method_exists($controlador, $_GET['action'])){
        $action = $_GET['action'];
        $controlador->$action();
    }elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
        $action_default = action_default;
        $controlador->$action_default;
    }else{
        show_error();
    }
}elseif(!isset($_GET['controller']) && !isset($_GET['action'])){
    $nombre_controlador = controller_default;
    $controlador = new $nombre_controlador();
    $controlador->index();
}else{
    show_error();
}

//NOTA:
//Con esta url podemos ver como tanto el controlador como el metodo existen y son mostrados en la pagina
//http://localhost/pruebas-php/php-Nivel5_MVC/?controller=UsuarioController&action=crear
//esto se conoce como CONTROLADOR FRONTAL

require_once 'views/layout/footer.php';

