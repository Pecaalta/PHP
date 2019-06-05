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

    public function toptienda(){
        $sql = "
            select distinct CONCAT('Restaurante/principal/', Servicio.id_restaurante )  as href, usuario.nickname as nombre_restaurante, Servicio.*, avg(reservas.evalacion) as evalacion  from Servicio 
            join usuario on Servicio.id_restaurante = usuario.id
            left join reservas on reservas.id_restaurante = usuario.id
            where Servicio.is_active and usuario.is_active
            group by Servicio.id
            order by evalacion
            LIMIT 5
        ";
        return $this->_database->query($sql)->result_array(); 
    }
    public function alltienda($date, $offset, $limit){
        if ($offset == null || $offset < 0) $offset = 0;
        if ($limit == null || $limit < 1) $limit = 10;
        $sql = "
            select distinct CONCAT('Restaurante/principal/', Servicio.id_restaurante )  as href, usuario.nickname as nombre_restaurante, Servicio.*, avg(reservas.evalacion)  from Servicio 
            join usuario on Servicio.id_restaurante = usuario.id
            left join reservas on reservas.id_restaurante = usuario.id
            where Servicio.is_active and usuario.is_active
            group by Servicio.id
            LIMIT $limit OFFSET $offset
        ";
        return $this->_database->query($sql)->result_array(); 
    }
    public function alltiendaCount($date, $offset, $limit){
        if ($offset == null || $offset < 0) $offset = 0;
        if ($limit == null || $limit < 1) $limit = 10;
        $sql = "
            select COUNT(*) as COUNT from Servicio 
            join usuario on Servicio.id_restaurante = usuario.id
            left join reservas on reservas.id_restaurante = usuario.id
            where Servicio.is_active
        ";
        $list = $this->_database->query($sql)->result_array(); 
        if (sizeof($list) > 0) return $list[0]['COUNT'];
        else return 0;
    }

    public function autocompletado($name){
        $sql = "
            select distinct CONCAT('/Restaurante/principal/', Servicio.id_restaurante )  as href, usuario.nickname as restaurante, Servicio.nombre as name 
            from Servicio 
            join usuario on Servicio.id_restaurante = usuario.id
            left join zona on usuario.zona = zona.id
            left join restaurante_categoria on usuario.id = restaurante_categoria.id_restaurante
            left join Categoria on restaurante_categoria.id_categoria = Categoria.id
            where ( 
                (
                    LOWER(Servicio.nombre) LIKE LOWER('%$name%') 
                    and Servicio.is_active
                ) or (
                    LOWER(usuario.nickname) LIKE LOWER('%$name%') 
                    and usuario.is_active
                ) or (
                    LOWER(usuario.nombre) LIKE LOWER('%$name%') 
                    and usuario.is_active
                ) or (
                    LOWER(zona.nombre) LIKE LOWER('%$name%') 
                    and zona.is_active
                ) or (
                    LOWER(Categoria.nombre) LIKE LOWER('%$name%') 
                    and restaurante_categoria.is_active
                    and Categoria.is_active
                )
            )
            limit 10
        ";
        return $this->_database->query($sql)->result_array(); 
    }


    
    public function CountlistService($date, $offset, $limit,$categoria,$zona,$minimo,$maximo){
        if ($offset == null || $offset < 0) $offset = 0;
        if ($limit == null || $limit < 1) $limit = 10;
        $sqlwhere = "";
        $sqljoin = "";
        if ($categoria != null){
            $sqlwhere .= "
                and restaurante_categoria.id_categoria = $categoria 
                and restaurante_categoria.is_active ";
            $sqljoin .= " left join restaurante_categoria on usuario.id = restaurante_categoria.id_restaurante ";
        }
        if ($zona != null){
            $sqlwhere .= " and usuario.zona = $zona ";
        }
        if ($minimo != null){
            $sqlwhere .= " and Servicio.precio >= $minimo ";
        }
        if ($maximo != null){
            $sqlwhere .= " and Servicio.precio <= $maximo ";
        }
        $sql = "
            select distinct CONCAT('/Restaurante/principal/', Servicio.id_restaurante )  as href, usuario.nickname as nombre_restaurante, Servicio.*, avg(reservas.evalacion)  
            from Servicio 
            join usuario on Servicio.id_restaurante = usuario.id
            left join reservas on reservas.id_restaurante = usuario.id
            $sqljoin
            where Servicio.is_active = 1 and usuario.is_active = 1 
            $sqlwhere
            group by Servicio.id
        ";
        return sizeof($this->_database->query($sql)->result_array());
    }
    public function listService($date, $offset, $limit,$categoria,$zona,$minimo,$maximo){
        if ($offset == null || $offset < 0) $offset = 0;
        if ($limit == null || $limit < 1) $limit = 10;
        $sqlwhere = "";
        $sqljoin = "";
        if ($categoria != null){
            $sqlwhere .= "
                and restaurante_categoria.id_categoria = $categoria 
                and restaurante_categoria.is_active ";
            $sqljoin .= " left join restaurante_categoria on usuario.id = restaurante_categoria.id_restaurante ";
        }
        if ($zona != null){
            $sqlwhere .= " and usuario.zona = $zona ";
        }
        if ($minimo != null){
            $sqlwhere .= " and Servicio.precio >= $minimo ";
        }
        if ($maximo != null){
            $sqlwhere .= " and Servicio.precio <= $maximo ";
        }
        $sql = "
            select distinct CONCAT('/Restaurante/principal/', Servicio.id_restaurante )  as href, usuario.nickname as nombre_restaurante, Servicio.*, avg(reservas.evalacion)  
            from Servicio 
            join usuario on Servicio.id_restaurante = usuario.id
            left join reservas on reservas.id_restaurante = usuario.id
            $sqljoin
            where Servicio.is_active = 1 and usuario.is_active = 1 
            $sqlwhere
            group by Servicio.id
            LIMIT $limit OFFSET $offset
        ";
        return $this->_database->query($sql)->result_array(); 
    }
    public function listServiceMapa($date,$categoria,$zona,$minimo,$maximo){
        $sqlwhere = "";
        $sqljoin = "";
        if ($categoria != null){
            $sqlwhere .= "
                and restaurante_categoria.id_categoria = $categoria 
                and restaurante_categoria.is_active ";
            $sqljoin .= " left join restaurante_categoria on usuario.id = restaurante_categoria.id_restaurante ";
        }
        if ($zona != null){
            $sqlwhere .= " and usuario.zona = $zona ";
        }
        if ($minimo != null){
            $sqlwhere .= " and Servicio.precio >= $minimo ";
        }
        if ($maximo != null){
            $sqlwhere .= " and Servicio.precio <= $maximo ";
        }
        $sql = "
            select distinct CONCAT('/Restaurante/principal/', Servicio.id_restaurante )  as text, usuario.lat, usuario.lng 
            from Servicio 
            join usuario on Servicio.id_restaurante = usuario.id
            left join reservas on reservas.id_restaurante = usuario.id
            $sqljoin
            where Servicio.is_active = 1 and usuario.is_active = 1 and  usuario.lat is not null and usuario.lng is not NULL 
            $sqlwhere
        ";
        return $this->_database->query($sql)->result_array(); 
    }



    public function existeNombreServicio($data){
        $sql = "SELECT nombre
                FROM servicio 
                WHERE nombre = ? AND id_restaurante = ?";
        $query = $this->_database->query($sql, array($data['nombre'],$data['id_restaurante']))->result_array();
        return sizeof($query) == 0;
    }

    public function infoServicio($data){
        $sql = "SELECT *
                FROM servicio
                WHERE nombre = ? AND id_restaurante = ?";
        $query = $this->_database->query($sql, array($data['nombre'],$data['id_restaurante']))->result_array();
        return $query;
    }
}