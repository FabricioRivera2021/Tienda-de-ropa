<?php
require_once 'models/producto.php';

class carritoController
{
    public function index()
    {
        $carrito = $_SESSION['carrito'];

        require_once 'views/carrito/index.php';
    }

    public function add()
    {
        if (isset($_GET['id'])) {
            $producto_id = $_GET['id'];
        } else {
            header("location:" . base_url);
        }

        if (isset($_SESSION['carrito'])) {
            $counter = 0;
            foreach ($_SESSION['carrito'] as $index => $elemento) {
                if ($elemento['id_producto'] == $producto_id) {//Si el producto de la sesion es el mismo
                    $_SESSION['carrito'][$index]["unidades"]++;//Si lo es, se le suma uno a "unidades"
                    $counter++;//se aumenta el contador del carrito
                }
            }
        }

        if (!isset($counter) || $counter == 0) {
            //conseguir producto
            $producto = new Producto;
            $producto->setId($producto_id);
            $prod = $producto->getOne();

            //añadir al carrito
            if (is_object($prod)) {
                $_SESSION['carrito'][] = array(
                    "id_producto" => $prod->id,
                    "precio" => $prod->precio,
                    "unidades" => 1,
                    "producto" => $prod
                );
            }
        }

        header("location:" . base_url . "carrito/index");
    }

    public function remove()
    {
    }

    public function delete()
    {
        unset($_SESSION['carrito']);
        header("location:" . base_url . "carrito/index");
    }
}
