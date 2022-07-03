<?php

class Utils
{
    public static function deleteSession($name)
    {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
        }
    }

    public static function isAdmin()
    {
        if (!isset($_SESSION['admin'])) {
            header("location:" . base_url);
        } else {
            return true;
        }
    }

    public static function showCategorias()
    {
        require_once 'models/categoria.php';
        $categoria = new Categoria();
        $categorias = $categoria->getAll();
        return $categorias;
    }

    public static function statsCarrito()
    {
        $stats = array(
            'count' => 0,
            'total' => 0
        );

        if (isset($_SESSION['carrito'])) {
            $stats['count'] = count($_SESSION['carrito']);

            foreach($_SESSION['carrito'] as $index => $elem){
                $stats['total'] += $elem['precio'] * $elem['unidades'];
            }
        }
        return $stats;
    }

    public static function resetStatsCarrito(){
        if(isset($_SESSION['carrito'])){
            unset($_SESSION['carrito']);
        }
        
        if(isset($stats)){
          unset($stats);  
        }
    }

    public static function isLogged(){
        if(!isset($_SESSION['identity'])){
            header("location:".base_url);
        }else{
            return true;
        }
    }

    public static function showState($state){
        switch ($state) {
            case 'pendiente_de_envio':
                echo "Pendiente de pago";
                break;
            case 'en_preparacion':
                echo "Pago realizado";
                break;
            case 'en_transito':
                echo "En transito";
                break;
            case 'recibido':
                echo "Pedido recibido";
                break;
            case 'cancelado':
                echo "Pedido cancelado";
                break;
            default:
                echo "estado";
                break;
        }
    }
}