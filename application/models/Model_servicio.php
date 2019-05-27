<?php

class Model_servicio extends MY_Model
{
    public $table = 'Servicio';
	public $primary_key = 'id'; 
	public $fillable = array(
		"nombre","is_active","descripcion","precio","id_restaurante","imagen"
    ); 
	public $protected = array();
    function __construct()
    {
        parent::__construct();
    }

    public function serviciosDisponibles($id){
        $result = $this->_database->select("servicio.*")
        ->from('servicio')
        ->where('id_restaurante', $id)
        ->get()->result_array();
        return $result;
    }
    
}