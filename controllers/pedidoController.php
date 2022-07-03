<?php
require_once 'models/pedido.php';

class pedidoController
{
    public function makeOrder()
    {

        require_once 'views/pedido/hacerPedido.php';
    }

    public function add()
    {
        if (isset($_SESSION['identity'])) {
            //validar datos del pedido
            $usuario_id = $_SESSION['identity']->id;
            $departamento = isset($_POST['departamento']) ? $_POST['departamento'] : false;
            $localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
            $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
            $stats = Utils::statsCarrito();
            $coste = $stats['total'];

            if ($departamento && $localidad && $direccion) {
                //Crear el objeto y setearlo.. para guardar en la BD
                $pedido = new Pedido();
                $pedido->setUsuario_id($usuario_id);
                $pedido->setProvincia($departamento);
                $pedido->setLocalidad($localidad);
                $pedido->setDireccion($direccion);
                $pedido->setCoste($coste);

                //se guarda en la BD
                $save = $pedido->save();
                
                //Guardar linea de pedido
                $saveLinea = $pedido->saveLineaPedido();

                if ($save && $saveLinea) {
                    $_SESSION['pedido'] = "Pedido registrado!";
                } else {
                    $_SESSION['pedido'] = "Fallo!";
                }
            } else {
                $_SESSION['pedido'] = "Fallo en el formulario!";
            }
            header("location:".base_url."pedido/confirmado");

        } else {
            //redirigir al index
            header("location:" . base_url);
        }    
    }

    public function confirmado(){
        if(isset($_SESSION['identity'])){
            $user = $_SESSION['identity'];
            $pedido = new Pedido();
            $pedido->setUsuario_id($user->id);
            
            //sacar pedido por usuario
            $pedidoByUser = $pedido->getOneByUserId();
            
            //sacar producto por pedido
            $pedido_productos = new Pedido();
            $productos = $pedido_productos->getProdByPedido($pedidoByUser->id);

            //resetear las stats del carrito
            Utils::resetStatsCarrito();
        }
        require_once 'views/pedido/confirmado.php';
    }

    public function misPedidos(){
        Utils::isLogged();
        $userId = $_SESSION['identity'];
        $pedido = new Pedido();
        $pedido->setUsuario_id($userId->id);

        //sacar registros de pedidos por usuario
        $pedidos = $pedido->getAllByUserId();

        require_once 'views/pedido/misPedidos.php';
    }

    public function detalle(){
        Utils::isLogged();
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            
            $pedido = new Pedido();
            $pedido->setId($id);
            
            //Sacar el registro del pedido
            $pedidoDetalle = $pedido->getOne();

            //Sacar los productos del pedido
            $productosPedido = new Pedido();
            $productos = $productosPedido->getProdByPedido($id); 
            
            require_once 'views/pedido/detalle.php';
        }else{
            header("location:".base_url."pedido/misPedidos.php");
        }

    }

    public function gestion(){
        Utils::isAdmin();
        $gestion = true;

        $pedido = new Pedido();
        $pedidos = $pedido->getAll();

        require_once 'views/pedido/misPedidos.php';
    }

    public function estado(){
        Utils::isAdmin();
        if(isset($_POST['pedido_id'])){
            //update del estado del pedido
            $id = $_POST['pedido_id'];
            $pedido = new Pedido();
            $pedido->setId($id);
            $pedido->setEstado($_POST['estado']);

            //llamo al metodo update
            $pedido->updateState();

            header("location:".base_url."pedido/detalle&id=".$id);
        }else{
            header("location:".base_url);
        }
    }
}

