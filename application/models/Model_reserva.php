<?php

class Model_reserva extends MY_Model
{
    public $table = 'Reservas';
	public $primary_key = 'id'; 
	public $fillable = array(
        "id", "is_active", "fecha_emicion", "fecha", "hora", "personas", "precio", "evalacion", "id_restaurante", "id_usuario"

    ); 
	public $protected = array();
    function __construct()
    {
        parent::__construct();
    }

    public function disponibilidadMesa($data){
        $sql = "SELECT r.fecha, r.hora
                FROM reservas r, usuario u
                WHERE u.id = ? 
                AND r.fecha = ?";
        $query = $this->_database->query($sql, array($data['id_restaurante'], $data['fecha']))->result_array();
    }
    
    public function prueba($data){
        $sql = "SELECT CURRENT_DATE()";
        $query = $this->_database->query($sql);
        return $query;
    }
}    