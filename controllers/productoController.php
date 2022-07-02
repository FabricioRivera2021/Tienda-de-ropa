<?php
require_once 'models/producto.php'; //para poder usar los metodos del modelo de producto

class productoController
{
    public function index()
    {
        $producto = new Producto();
        $productos = $producto->getRandom(6);
        //renderizar una vista
        require_once 'views/producto/destacados.php';
    }

    public function ver(){
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $producto = new Producto();
            $producto->setId($id);
            $prod = $producto->getOne(); //Metodo que devuelve un producto de DB
            require_once 'views/producto/ver.php';
        } 
    }

    public function gestion()
    {
        Utils::isAdmin(); //validar que el usuario sea admin

        $producto = new Producto();
        $productos = $producto->getAll();

        require_once 'views/producto/gestion.php';
    }

    public function crear()
    {
        Utils::isAdmin();
        require_once 'views/producto/crear.php';
    }

    public function save()
    {
        Utils::isAdmin();
        if (isset($_POST)) {
            $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
            $desc = isset($_POST['desc']) ? $_POST['desc'] : false;
            $precio = isset($_POST['precio']) ? $_POST['precio'] : false;
            $stock = isset($_POST['stock']) ? $_POST['stock'] : false;
            $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : false;
            $img = isset($_POST['img']) ? $_POST['img'] : false;

            if ($nombre && $desc && $precio && $stock && $categoria) {
                $producto = new Producto();
                $producto->setNombre($nombre);
                $producto->setDesc($desc);
                $producto->setPrecio($precio);
                $producto->setStock($stock);
                $producto->setCategoria_id($categoria);

                //Guardar la imagen del producto
                //         Variable super global de donde sacaremos la imagen
                if (isset($_FILES['img'])) {
                    $file = $_FILES['img'];
                    $filename = $file['name'];
                    $mimetype = $file['type'];
                    $newFileName = preg_replace("/[[:space:]]/", "-", $filename);

                    if ($mimetype == "image/jpg" || $mimetype == "image/jpeg" || $mimetype == "image/png" || $mimetype == 'image/gif') {
                        if (!is_dir('uploads/img')) { //si no existe el directorio lo crea
                            mkdir('uploads/img', 0777, true); //el true es para que se creen directorios recursivos
                        }

                        move_uploaded_file($file['tmp_name'], 'uploads/img/' . $newFileName); //mueve la imagen al fichero creado antes
                        $producto->setImagen($newFileName); //para guardar el nombre en la DB
                    }
                }

                //Validamos si viene la id por el GET, Como cuando se crea un producto los datos se pasan por POST
                //La unica forma de que llegar algo por GET seria que estuvieramos editando un producto
                if(isset($_GET['id'])){
                    $id = $_GET['id'];
                    $producto->setId($id);
                    $save = $producto->update();
                }else{
                    $save = $producto->save();
                }

                if ($save) {
                    $_SESSION['producto'] = 'Success';
                } else {
                    $_SESSION['producto'] = 'Failed - Error en el insert';
                }
            } else {
                $_SESSION['producto'] = 'Failed - Error en los datos del formulario';
            }
        } else {
            $_SESSION['producto'] = 'Failed - No hay datos en POST';
        }
        header('Location:' . base_url . 'producto/gestion');
    }

    public function editar()
    {
        Utils::isAdmin();
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $editar = true; //Flag para mostrar el formulario de edicion
            $producto = new Producto();
            $producto->setId($id);
            $prod = $producto->getOne(); //Metodo que devuelve un producto de DB
            require_once 'views/producto/crear.php';
        } else {
            header('Location:' . base_url . 'producto/gestion');
        }
    }

    public function eliminar()
    {
        Utils::isAdmin();

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $producto = new Producto();
            $producto->setId($id);
            $delete = $producto->delete();

            if ($delete) {
                $_SESSION['delete'] = "Success";
            } else {
                $_SESSION['delete'] = "Fallo al borrar";
            }
        } else {
            $_SESSION['delete'] = "Fallo al borrar";
        }
        header("location:" . base_url . "producto/gestion");
    }
}
