<?php

class Producto
{
    private $id;
    private $categoria_id;
    private $nombre;
    private $desc;
    private $precio;
    private $stock;
    private $oferta;
    private $fecha;
    private $imagen;
    private $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    //GETERS
    function getId()
    {
        return $this->id;
    }
    function getCategoria_id()
    {
        return $this->categoria_id;
    }
    function getNombre()
    {
        return $this->nombre;
    }
    function getDesc()
    {
        return $this->desc;
    }
    function getPrecio()
    {
        return $this->precio;
    }
    function getStock()
    {
        return $this->stock;
    }
    function getOferta()
    {
        return $this->oferta;
    }
    function getFecha()
    {
        return $this->fecha;
    }
    function getImagen()
    {
        return $this->imagen;
    }

    //SETERS
    function setId($id)
    {
        $this->id = $id;
    }
    function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $categoria_id;
    }
    function setNombre($nombre)
    {
        $this->nombre = $this->db->real_escape_string($nombre);
    }
    function setDesc($desc)
    {
        $this->desc = $this->db->real_escape_string($desc);
    }
    function setPrecio($precio)
    {
        $this->precio = $this->db->real_escape_string($precio);
    }
    function setStock($stock)
    {
        $this->stock = $this->db->real_escape_string($stock);
    }
    function setOferta($oferta)
    {
        $this->oferta = $this->db->real_escape_string($oferta);
    }
    function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }
    function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function getAll()
    {
        $productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC");
        return $productos;
    }

    public function getAllByCategory(){
        $sql = ("SELECT productos.*, categorias.nombre AS 'catNombre' FROM productos
                 INNER JOIN categorias ON categorias.id = productos.categoria_id
                 WHERE productos.categoria_id = {$this->getCategoria_id()}
                 ORDER BY id DESC;");
        $productos = $this->db->query($sql);
        return $productos;
    }

    public function getOne()
    {
        $producto = $this->db->query("SELECT * FROM productos WHERE id = {$this->getId()}");
        return $producto->fetch_object(); //lo devuelve como un objeto utilizable desde aqui
    }

    public function getRandom($limit){
        $productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");
        return $productos;
    }

    public function save()
    {
        $sql = "INSERT INTO productos
                VALUES(null, '{$this->getCategoria_id()}', '{$this->getNombre()}', '{$this->getDesc()}', '{$this->getPrecio()}', '{$this->getStock()}', null, CURDATE(), '{$this->getImagen()}');";
        $save = $this->db->query($sql);

        //Probando porque la consulta no andaba
        // echo $sql;
        // echo "<br>";
        // echo $this->db->error;
        // die();

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function update()
    {
        $sql = "UPDATE productos 
                SET nombre='{$this->getNombre()}', 
                descripcion='{$this->getDesc()}', 
                precio='{$this->getPrecio()}', 
                stock='{$this->getStock()}'";

        if ($this->getImagen() != null) { //Solo entra aca si existe una imagen sino sigue de largo
            $sql .= ", imagen='{$this->getImagen()}'";
        }

        $sql .= " WHERE id={$this->getId()};";
        $save = $this->db->query($sql);

        $result = false;
        if ($save) {
            $result = true;
        }
        return $result;
    }

    public function delete()
    {
        $sql = "DELETE FROM productos WHERE id={$this->id}";
        $delete = $this->db->query($sql);

        $result = false;
        if ($delete) {
            $result = true;
        }
        return $result;
    }
}
