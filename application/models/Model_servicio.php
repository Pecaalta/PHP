<?php

class Model_servicio extends MY_Model
{
    public $table = 'Servicio';
	public $primary_key = 'id'; 
	public $fillable = array(
		"nombre","is_active","descripcion","precio","id_restaurante","imagen","updated_at"
    ); 
	public $protected = array();
    function __construct()
    {
        parent::__construct();
    }

    public function serviciosDisponibles($id){
        $sql = "select * from servicio where id_restaurante = ?";
        $query = $this->_database->query($sql, array($id));
        return $query;
    }

    public function insertar($data){
        $sql = "INSERT INTO `Servicio`(`nombre`, `is_active`, `descripcion`, `precio`, `id_restaurante`, `imagen`) VALUES (?,?,?,?,?,?)";
        $query = $this->_database->query($sql, array($data['nombre'],$data['is_active'],$data['descripcion'],$data['precio'],$data['id_restaurante'],$data['imagen']));
        //return $query;
    }

    public function modificar($data){
        $sql = "UPDATE Servicio SET nombre = ? , descripcion = ? , precio = ? WHERE id= ?";
        $query = $this->_database->query($sql, array($data['nombre'],$data['descripcion'],$data['precio'],$data['id']));
    }

    public function eliminar($data){
        $sql = "UPDATE Servicio SET is_active = 'false' WHERE id= ?";
        $query = $this->_database->query($sql, array($data['id']));
    }
}