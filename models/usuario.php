<?php
//En los modelos creamos como si fuera una fila del elemento que estemos creando 
//En este caso usuario y los campos de usuario como variables privadas

class Usuario {
    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $password;
    private $rol;
    private $img;
    private $db;

    //consturctor de la coneccion a la DB
    public function __construct(){
        $this->db = Database::connect();
    }

    // GETERS
    public function getId(){
        return $this->id;
    }
    public function getNombre(){
        return $this->nombre;
    }
    public function getApellido(){
        return $this->apellido;
    }
    public function getEmail(){
        return $this->email;
    }
    public function getPassword(){
        return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
    }
    public function getRol(){
        return $this->rol;
    }
    public function getImg(){
        return $this->img;
    }

    // SETTERS
    public function setId($id){
        $this->id = $id;
    }
    public function setNombre($nombre){
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    public function setApellido($apellido){
        $this->apellido = $this->db->real_escape_string($apellido);
    }
    public function setEmail($email){
        $this->email = $this->db->real_escape_string($email);
    }
    public function setPassword($password){
        $this->password = $password;
    }
    public function setRol($rol){
        $this->rol = $rol;
    }
    public function setImg($img){
        $this->img = $img;
    }

    public function save(){
        $sql = "INSERT INTO usuarios 
                VALUES(null, '{$this->getNombre()}', '{$this->getApellido()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', null)";
        $save = $this->db->query($sql);

        $result = false;
        if($save){
            $result = true;
        }
        return $result;
    }

    public function login(){
        $result = false;
        $email = $this->email;
        $password = $this->password;
        //comprobar si existe el usuario
        $sql = "SELECT * FROM usuarios WHERE email = '$email';";
        $login = $this->db->query($sql);

        if($login && $login->num_rows == 1){
            $usuario = $login->fetch_object();
            //verifio la contraseña
            $verify = password_verify($password, $usuario->password);
            if($verify){
                $result = $usuario;
            }
            return $result;
        }
    }
}