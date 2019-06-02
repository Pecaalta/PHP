<?php

class Model_usuario extends MY_Model
{
    public $table = 'Usuario';
	public $primary_key = 'id'; 
	public $fillable = array(
		"nickname","nombre","rut","avatar","direccion","zona","telefono","email","apellido","fecha_de_nacimiento","end_perfil","is_active","password","descripcionRestaurante","updated_at"
    ); 
	public $protected = array();
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

    public function getImgpefil($id)
    {
        $result = $this->_database->select("imagen.*")
        ->from('imagen')
        ->where('usuario_id', $id)
        ->get()->result_array();
        return $result;
    }

    public function listaZona()
    {
        return $this->_database->select("id, nombre")
        ->from('zona')
        ->where('is_active', 1)
        ->get()->result_array();
    }
    public function listaCategorias()
    {
        
        return $this->_database->select("id, nombre")
        ->from('Categoria')
        ->where('is_active', 1)
        ->get()->result_array();
    }
    
}