<?php

class Model_usuario extends MY_Model
{
    public $table = 'Usuario';

    public $primary_key = 'id';
    public $fillable = array(
        "nickname", "nombre","avatar","lat", "rut", "direccion", "zona", "telefono", "email", "apellido", "fecha_de_nacimiento", "end_perfil", "is_active", "password", "descripcionRestaurante", "updated_at", "cantidadMesas"
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

    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    public function isExist($nick)
    {
        $result = $this->_database->select("imagen.*")
            ->from('usuario')
            ->where('nickname', $nick)
            ->get()->result_array();
        return sizeof($result) == 0;
    }

    public function nickDisponible($nick)
    {
        $result = $this->_database->select("usuario.nickname")
            ->from('usuario')
            ->where('nickname', $nick)
            ->get()->result_array();
         if(sizeof($result) == 0){
             return "Disponible";
         }
         return "Ya existe el nickname";
    }

    public function nickDisponible2($data){
        $sql = "SELECT nickname
                FROM usuario 
                WHERE nickname = ?";
        $query = $this->_database->query($sql, array($data['nickname']))->result_array();
        if(sizeof($query) == 0){
            return "Disponible";
        }
        return "Ya tienes un servicio con ese nombre";
    }

 
}
