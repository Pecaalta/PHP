<?php

class Model_usuario extends MY_Model
{
    public $table = 'Usuario';
	public $primary_key = 'id'; 
	public $fillable = array(
		"id","nickname","nombre","rut","avatar","cantidadMesas", "apertura", "clausura", "lat", "lng","direccion","zona","telefono","email","apellido","fecha_de_nacimiento","end_perfil","is_active","password","descripcionRestaurante","updated_at","cantiadMesas","apertura","clausura","tiempoReserva"
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
        $result = $this->_database->select("*")
            ->from('restaurante_imagen')
            ->where('id_restaurante', $id)
            ->where('is_active', 1)
            ->get()->result_array();
        return $result;
    }
    
    
    
    

	public function login($nickname, $password) {
		$usuario = $this->model_usuario
			->where('nickname', $nickname)
            ->get();
        $status = false;
		if ($usuario === false) {
			$msg = "No se encontro el usaurio";
		} else if ($usuario->password != $password){    
            $msg = "La contraseña no coincide";
		} else {
            $msg = $usuario;
            $status = true;
        }
        return array(
            "msg" => $msg,
            "status" => $status
        );
	}
    
    
    
    
    public function isExist($nick){    
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
        return (sizeof($query) == 0);
    }

    public function emailDisponible($data){
        $sql = "SELECT email
                FROM usuario 
                WHERE email = ?";
        $query = $this->_database->query($sql, array($data['email']))->result_array();
        return (sizeof($query) == 0);
    }



    //De aca para abajo va todo lo realcionado con el usuario tipo RESTAURANTE

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


    public function addCategoria($nombre)
    {
        $sql = "SELECT * FROM categoria WHERE nombre = '".$nombre."'";
        $query = $this->_database->query($sql)->result_array();
        if (sizeof($query) == 0) {
            $sql = "INSERT INTO `categoria`(`nombre`, `is_active`) VALUES ('".$nombre."',1)";
            $query = $this->_database->query($sql);
            $sql = "SELECT * FROM categoria WHERE nombre = '".$nombre."'";
            $query = $this->_database->query($sql)->result_array();
        }
        return $query[0]['id'];
    }

    public function VaciarCategoriaRestaurante($id_restaurante)
    {
        $sql = "UPDATE restaurante_categoria SET is_active=0 WHERE id_restaurante=".$id_restaurante;
        $query = $this->_database->query($sql);    
    }

    public function CategoriaRestaurante($id_categoria,$id_restaurante)
    {

        $sql = "SELECT * FROM restaurante_categoria WHERE id_categoria = ".$id_categoria." AND id_restaurante=".$id_restaurante;
        $query = $this->_database->query($sql)->result_array();
        if (sizeof($query) == 0) {
            $sql = "INSERT INTO `restaurante_categoria`(`id_categoria`, `id_restaurante`) VALUES (".$id_categoria.",".$id_restaurante.")";
            $query = $this->_database->query($sql);
        }else {
            $sql = "UPDATE restaurante_categoria SET id_categoria = ".$id_categoria.",id_restaurante = ".$id_restaurante.",is_active=1
            WHERE id_categoria = ".$id_categoria." AND id_restaurante=".$id_restaurante;
            $query = $this->_database->query($sql);        
        }
    }

    public function misCategorias($id)
    {
        $sql = "SELECT *
                FROM categoria
                join restaurante_categoria on restaurante_categoria.id_categoria = categoria.id 
                WHERE categoria.is_active = 1 AND restaurante_categoria.is_active = 1 AND id_restaurante=".$id;
        return $this->_database->query($sql)->result_array();
    }
    
    
    
}
