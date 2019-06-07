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
                WHERE r.fecha_total BETWEEN SUBTIME(?, SUBTIME(?, '0:1:0')) AND ?
                AND r.id_restaurante = ?
                AND r.is_active = 'true'
                ";         
        $cantidadDeReservasPrevias = $this->_database->query($sql,array(
                                                                        $data['fecha'],
                                                                        $data['restaurante']->tiempoReserva,
                                                                        $data['fecha'],
                                                                        $data['restaurante']->id
                                                                        ))->result_array();
        $sql = "SELECT *
                FROM reservas r
                WHERE r.fecha_total BETWEEN ? AND ADDTIME(?, SUBTIME(?, '0:1:0'))
                AND r.id_restaurante = ?
                AND r.is_active = 'true'
                ";         
        $cantidadDeReservasPosteriores = $this->_database->query($sql,array(
                                                                        $data['fecha'],
                                                                        $data['fecha'],
                                                                        $data['restaurante']->tiempoReserva,
                                                                        $data['restaurante']->id
                                                                        ))->result_array();


        if(count($cantidadDeReservasPrevias) < $data['restaurante']->cantidadMesas
        and count($cantidadDeReservasPosteriores) < $data['restaurante']->cantidadMesas){
            $sql = "UPDATE reservas
                    SET fecha_total = ?
                    WHERE id_usuario = ?
                    AND is_active = 'false'";
            $this->_database->query($sql,array($data['fecha'],$data['idUsuario']));        

            return "Mesas disponibles |
                    previas: ".count($cantidadDeReservasPrevias)." 
                    posteriores:".count($cantidadDeReservasPosteriores)." 
                    id_restaurante: ".$data['restaurante']->id;
        }
        return "No hay mesas disponibles a esta hora 
                previas: ".count($cantidadDeReservasPrevias)." 
                posteriores:".count($cantidadDeReservasPosteriores)." 
                id_restaurante: ".$data['restaurante']->id;
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

    public function carritoComidas($data)
    {
        $sql = "SELECT servicio.*,reservas_servicio.* 
                FROM reservas
                left JOIN reservas_servicio ON reservas_servicio.id_reserva = reservas.id
                left JOIN servicio ON servicio.id = reservas_servicio.id_servicio
                WHERE reservas.id_usuario = ?
                AND reservas.is_active = 'false'";
        $carrito = $this->_database->query($sql, array(
                                                        $data['idUsuario']
                                                        ))->result_array();
                                                        var_dump($carrito); 
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
                                                        $reserva->id_restaurante
                                                        ))->row(); 

        $sql = "SELECT *
        FROM reservas r
        WHERE r.fecha_total BETWEEN SUBTIME(?, SUBTIME(?, '0:1:0')) AND ?
        AND r.id_restaurante = ?
        AND r.is_active = 'true'
        ";                                                             
        $cantidadDeReservasPrevias = $this->_database->query($sql,array(
                                                                        $reserva->fecha_total,
                                                                        $restaurante->tiempoReserva,
                                                                        $reserva->fecha_total,
                                                                        $restaurante->id
                                                                        ))->result_array();

        $sql = "SELECT *
                FROM reservas r
                WHERE r.fecha_total BETWEEN ? AND ADDTIME(?, SUBTIME(?, '0:1:0'))
                AND r.id_restaurante = ?
                AND r.is_active = 'true'
                ";         
        $cantidadDeReservasPosteriores = $this->_database->query($sql,array(
                                                                        $reserva->fecha_total,
                                                                        $reserva->fecha_total,
                                                                        $restaurante->tiempoReserva,
                                                                        $restaurante->id
                                                                        ))->result_array();         
                                                                        
        if(count($cantidadDeReservasPrevias) < $restaurante->cantidadMesas
        and count($cantidadDeReservasPosteriores) < $restaurante->cantidadMesas){
            $sql = "SELECT *
                    FROM reservas_servicio
                    WHERE id_reserva = ?";
            $reservas_servicio = $this->_database->query($sql, array(
                                                                $reserva->id
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
                                                $restaurante->id
                                                ));        

            return true;                                    
        }else{
            return false;
        }                                                             
    }
}    