<?php

class Model_reserva extends MY_Model
{
    public $table = 'Reservas';
	public $primary_key = 'id'; 
	public $fillable = array(
        "id", "is_active", "fecha_emicion", "fecha_total", "personas", "precio", "evalacion", "id_restaurante", "id_usuario"

    ); 
	public $protected = array();
    function __construct()
    {
        parent::__construct();
    }

    public function instanciarPreReserva($data)
    {
        $sql = "SELECT *
                FROM reservas r
                WHERE r.id_usuario = ?
                AND r.is_active = 'false'
                "; 
        $query = $this->_database->query($sql, array($data['id_usuario']))->result_array();
        if(count($query) > 0){
            $idRes = "";
            foreach($query as $item){
                $idRes = $item["id"];
                $sql = "DELETE FROM `reservas_servicio` 
                        WHERE id_reserva = ?
                ;";
                $this->_database->query($sql, $idRes);
                $sql = "DELETE FROM `reservas` 
                        WHERE id = ?
                ;";
                $this->_database->query($sql, $idRes);
            }
        }
        $sql = "INSERT INTO `reservas`(`id_restaurante`,`id_usuario`)
                VALUES (?,?);";
        $this->_database->query($sql, array($data['id_restaurante'],$data['id_usuario']));   
    }

    public function disponibilidadMesa($data){
        $sql = "SELECT *
                FROM reservas r
                WHERE r.fecha_total = ?
                AND r.turno = ?
                AND r.id_restaurante = ?
                ";         
        $cantidadDeReservas = $this->_database->query($sql,array(
                                                                $data['fecha'],
                                                                $data['turno'],
                                                                $data['restaurante']->id
                                                                ))->result_array();

        if(count($cantidadDeReservas) < $data['restaurante']->cantidadMesas){
            $sql = "UPDATE reservas
                    SET fecha_total = ?, turno = ?
                    WHERE id_usuario = ?
                    AND is_active = 'false'";
            $this->_database->query($sql,array($data['fecha'],$data['turno'],$data['idUsuario']));        

            return "Mesas disponibles";
        }
        return "No hay mesas disponibles en el horario seleccionado";
    }
    
    public function prueba($data){
        $sql = "SELECT * FROM reservas";
        return $this->_database->query($sql)->result_array();
    }

    public function servicioIndicado($data){
        $sql = "SELECT *
                FROM servicio
                WHERE id_restaurante = ?
                AND nombre = ?";
        $servicio = $this->_database->query($sql, array(
                                                        $data['restaurante']->id,
                                                        $data['nombreServicio']
                                                        ));
        return $servicio;
    }

    public function agregarComida($data)
    {
        $sql = "SELECT id
                FROM reservas
                WHERE id_usuario = ?
                AND is_active = 'false'
                ";
        $idReserva = $this->_database->query($sql, array(
                                                        $data['idUsuario']
                                                        ))->row(); 
        $sql = "SELECT id 
                FROM reservas_servicio
                WHERE id_servicio = ?
                AND id_reserva = ?";
        $yaLoAgrego = $this->_database->query($sql, array(
                                                        $data['idServicio'],
                                                        $idReserva->id
                                                        ))->row();      
                                                        
        $sql = "SELECT *
                FROM servicio
                WHERE id = ?";
        $nomServicio = $this->_database->query($sql,array(
                                    $data['idServicio']
                                    ))->row();
                                                        
        if(is_null($yaLoAgrego)){
            $sql = "INSERT INTO `reservas_servicio`(`cantidad`, `id_reserva`, `id_servicio`)
                    VALUES (?,?,?)";
            $this->_database->query($sql,array($data['cantidad'],
                                            $idReserva->id,
                                            $data['idServicio']));   
            return "Se agrego ".$data['cantidad']." unidad/es de ".$nomServicio->nombre;                                
        }else{
            $sql = "UPDATE `reservas_servicio`
                    SET cantidad = ?
                    WHERE id_reserva = ?
                    AND id_servicio = ?";
            $this->_database->query($sql,array($data['cantidad'],
                                            $idReserva->id,
                                            $data['idServicio']));   
            return "Se actualizo la cantidad de ".$nomServicio->nombre;                                     
        }     
    }

    public function carritoComidas($idUsuario)
    {
        $sql = "SELECT id
                FROM reservas
                WHERE id_usuario = ?
                AND is_active = 'false'
                ";
        $idReserva = $this->_database->query($sql, array(
                                                        $idUsuario
                                                        ))->row(); 
        $sql = "SELECT *
                FROM reservas_servicio
                WHERE id_reserva = ? 
                ";
        $servicios = $this->_database->query($sql,array(
                                                        $idReserva->id
                                                        ))->result_array();
        $carrito = array();                                                
        foreach($servicios as $item){
            $sql = "SELECT *
                    FROM servicio
                    WHERE id = ?";
            $ser = $this->_database->query($sql, array($item['id_servicio']))->row(); 
            $result = json_decode(json_encode($ser), true);
            $nombreCantidadPrecio = array(
                "nombre" => $result['nombre'],
                "precio" => $result['precio'],
                "id" => $result['id'],
                "cantidad" => $item['cantidad']
            );
            $carrito[] = $nombreCantidadPrecio;
        }
        return $carrito;                                                            
    }

    public function eliminarComida($data)
    {
        $sql = "SELECT id
                FROM reservas
                WHERE id_usuario = ?
                AND is_active = 'false'
                ";
        $idReserva = $this->_database->query($sql, array(
                                                        $data['idUsuario']
                                                        ))->row(); 
        $sql = "DELETE FROM `reservas_servicio`
                WHERE id_servicio = ? 
                AND id_reserva = ?";
        $this->_database->query($sql, array(
                                            $data['idServicio'],
                                            $idReserva->id
                                            ));        
    }

    public function datosPago($data)
    {
        $sql = "UPDATE reservas
                SET personas = ?, tarjeta = ?, titularTarjeta = ?, cvc = ?
                WHERE id_usuario = ?
                AND is_active = 'false'";
        $this->_database->query($sql, array(
                                            $data['cantidadPersonas'],
                                            $data['tarjeta'],
                                            $data['titularTarjeta'],
                                            $data['cvc'],
                                            $data['idUsuario']
                                            ));             
    }

    public function validacionFinalUltimate($data)
    {
        $sql = "SELECT *
                FROM reservas
                WHERE id_usuario = ?
                AND is_active = 'false'
                ";
        $reserva = $this->_database->query($sql, array(
                                                        $data['idUsuario']
                                                        ))->row(); 

        $sql = "SELECT *
                FROM usuario
                WHERE id = ?
                ";
        $restaurante = $this->_database->query($sql, array(
                                                        $reserva['id_restaurante']
                                                        ))->row();      
                                                                        
        if(true){       
            $sql = "SELECT *
                    FROM reservas_servicio
                    WHERE id_reserva = ?";
            $reservas_servicio = $this->_database->query($sql, array(
                                                                $reserva['id']
                                                                ))->result_array(); 

            $precioTotal = 0;                                                    
            foreach($reservas_servicio as $item){
                $sql = "SELECT *
                        FROM servicio
                        WHERE id = ?";
                $servicio = $this->_database->query($sql, array(
                                                                $item['id_servicio']
                                                                ))->row();    
                $result = json_decode(json_encode($servicio), true);    
                $precioTotal = $precioTotal + ($result['precio']*$item['cantidad']);                                                    
            }
                                                                

            $sql = "UPDATE reservas
                    SET is_active = true, fecha_emicion = NOW(), precio = ?
                    WHERE id_usuario = ?
                    AND id_restaurante = ?
                    AND is_active = 'false'";
            $this->_database->query($sql,array(
                                                $precioTotal,
                                                $data['idUsuario'],
                                                $restaurante['id']
                                                ));      
                                                
            //Instancio los comentarios
            $sql = "SELECT DISTINCT rs.* 
                FROM reservas_servicio rs, reservas r
                WHERE r.id_usuario = ?
                AND rs.id_reserva = r.id;";
            $serviciosUsuario = $this->_database->query($sql,array($data['idUsuario']))->result_array();
            if (count($serviciosUsuario) > 0) {
                foreach ($serviciosUsuario as $item) {
                        $sql = "SELECT * 
                                FROM Comentario c
                                WHERE c.id_servicio = ?
                                AND c.id_usuario = ?";
                        $comen = $this->_database->query($sql, array($item['id'],$data['idUsuario']))->row();     
                        if ($comen != null) {
                                $sql = "UPDATE Comentario c
                                        SET puedeComentar = true
                                        WHERE c.id_servicio = ?
                                        AND c.id_usuario = ?";
                        $this->_database->query($sql, array($item['id'],$data['idUsuario']));                   
                        }
                        else{
                                $sql = "INSERT INTO `Comentario` (`id_servicio`,`id_usuario`,`puedeComentar`)
                                        VALUES (?,?,true)";
                                $this->_database->query($sql, array($item['id'],$data['idUsuario']));  
                        }           
                    }   
            }  

            return true;                                    
        }else{
            return false;
        }                                                             
    }
}    