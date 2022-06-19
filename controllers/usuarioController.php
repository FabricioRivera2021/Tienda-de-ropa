<?php
require_once 'models/usuario.php';

class usuarioController{
    public function index(){
        echo "Controlador de usuarios, accion 'Index'";
    }

    public function registro(){
        require_once 'views/usuario/registro.php';
    }

    public function save(){
        if(isset($_POST)){
            if(isset($_POST['nombre']) && !is_numeric($_POST['nombre']) && !preg_match("/[0-9]/", $_POST['nombre'])){
                $nombre = $_POST['nombre'];
            }else{
                $nombre = false;
            }

            if(isset($_POST['apellido']) && !is_numeric($_POST['apellido']) && !preg_match("/[0-9]/", $_POST['apellido'])){
                $apellido = $_POST['apellido'];
            }else{
                $apellido = false;
            }

            if(isset($_POST['email'])){
                $email = $_POST['email'];
            }else{
                $email = false;
            }

            if(isset($_POST['password'])){
                $password = $_POST['password'];
            }else{
                $password = false;
            }

            if(($nombre != false) && ($apellido != false) && ($email != false) && ($password != false)){
                $usuario = new Usuario();
                $usuario->setNombre($nombre);
                $usuario->setApellido($apellido);
                $usuario->setEmail($email);
                $usuario->setPassword($password);
    
                $save = $usuario->save(); //aqui validamos si la consulta para insertar al usuario funciono o no
                if ($save == true){
                    $_SESSION['register'] = "Completado";
                } else {
                    $_SESSION['register'] = "Failed";
                }
            }else{
                $_SESSION['register'] = "Bad_fields";
            }
        }else{
            $_SESSION['register'] = "Empty_field";
        }
        header("Location:".base_url."usuario/registro");
    }

    public function login(){
        if(isset($_POST)){
            //identificar al usuario
            //consultar a la base de datos
            $usuario = new Usuario();
            $usuario->setEmail($_POST['email']);
            $usuario->setPassword($_POST['password']);
            $identity = $usuario->login();

            if($identity && is_object($identity)){
                $_SESSION['identity'] = $identity;

                if($identity->rol == 'admin'){
                    $_SESSION['admin'] = true;
                }
            }else{
                $_SESSION['error_login'] = 'identificacion fallida';
            }

            //crear una sesion
        }
        header('Location:'.base_url);
    }

    public function logout(){
        if(isset($_SESSION['identity'])){
            unset($_SESSION['identity']);
        }

        if(isset($_SESSION['admin'])){
            unset($_SESSION['admin']);
        }

        header('Location:'.base_url);
    }
} //FIN CLASE