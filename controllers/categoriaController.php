<?php
require_once 'models/categoria.php';
require_once 'models/producto.php';

class categoriaController{
    public function index(){
        $categoria = new Categoria();
        $categorias = $categoria->getAll();

        require_once 'views/categoria/index.php';
    }

    public function crear(){
        Utils::isAdmin();
        include_once 'views/categoria/crear.php';
    }

    public function save(){
        Utils::isAdmin();//Comprueba si el usuario logueado es admin y si no lo es lo manda al index
        if(isset($_POST) && isset($_POST['nombre'])){
            //Guardar la categoria en la BD
            $categoria = new Categoria();
            $categoria->setNombre($_POST['nombre']);
            $save = $categoria->save();// <---ESTE METODO SAVE ES EL DEL MODELO
        }
        header("location:" . base_url . "categoria/index");
    }

    public function ver(){
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            //Conseguir la categoria por ID
            $categoria = new Categoria();
            $categoria->setId($id);
            $cat = $categoria->getOne();//Esto tendria que devolver la categoria de esa ID

            //Conseguir los productos de esa categoria
            $producto = new Producto();
            $producto->setCategoria_id($id);
            $productos = $producto->getAllByCategory();
        }
        require_once 'views/categoria/ver.php';
    }
}