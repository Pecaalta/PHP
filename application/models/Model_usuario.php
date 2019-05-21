<?php

class Model_usuario extends MY_Model
{
    public $table = 'Usuario'; // you MUST mention the table name
	public $primary_key = 'id'; // you MUST mention the primary key
	public $fillable = array(
		"nickname","nombre","rut","direccion","zona","telefono","email","apellido","fecha_de_nacimiento","end_perfil","is_active","password"
    ); // If you want, you can set an array with the fields that can be filled by insert/update
	public $protected = array(); // ...Or you can set an array with the fields that cannot be filled by insert/update
    function __construct()
    {
        parent::__construct();
    }

    public function tiendas()
    {
        return $this->_database->select("usuario.*, avg(reservas.evalacion)")
            ->from('usuario')
            ->join('reservas', 'reservas.id_usuario = usuario.id', 'left')
            ->where('usuario.rut !=', null)
            ->group_by('usuario.id')
			->get()->result_array();
    }

    
}