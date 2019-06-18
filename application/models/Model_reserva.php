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
        $res = array();
        if(count($cantidadDeReservas) < $data['restaurante']->cantidadMesas){
            $sql = "UPDATE reservas
                    SET fecha_total = ?, turno = ?, personas = ?
                    WHERE id_usuario = ?
                    AND is_active = 'false'";
            $this->_database->query($sql,array($data['fecha'],$data['turno'],$data['cantPersonas'],$data['idUsuario']));        

            $res['positivo'] = "Mesa reservada en " . $data['restaurante']->nickname . " en la fecha " . $data['fecha'] . " en el turno " . $data['turno'];
            $res['negativo'] = "falso";
        }else{
                $res['negativo'] =  "No se pudo realizar la reserva, por favor revise lo que selecciono y compruebe que no hay ningun error";
                $res['positivo'] = "falso";
        }
        return $res;
    }

    public function disponibilidadTurno($data)
    {
        $sql = "SELECT *
        FROM reservas r
        WHERE r.fecha_total = ?
        AND r.turno = 'Dia'
        AND r.id_restaurante = ?
        ";         
        $cantidadDeReservasDia = $this->_database->query($sql,array(
                                                        $data['fecha'],
                                                        $data['restaurante']->id
                                                        ))->result_array();       
        $sql = "SELECT *
        FROM reservas r
        WHERE r.fecha_total = ?
        AND r.turno = 'Noche'
        AND r.id_restaurante = ?
        ";         
        $cantidadDeReservasNoche = $this->_database->query($sql,array(
                                                        $data['fecha'],
                                                        $data['restaurante']->id
                                                        ))->result_array();       

        $respuesta = array();
        if (count($cantidadDeReservasDia) < $data['restaurante']->cantidadMesas) {
                $respuesta["dia"] = true;
        } else{
                $respuesta["dia"] = false;
        }
        if(count($cantidadDeReservasNoche) < $data['restaurante']->cantidadMesas) {
                $respuesta["noche"] = true;
        } else{
                $respuesta["noche"] = false;
        }
        return $respuesta;
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
                SET tarjeta = ?, titularTarjeta = ?, cvc = ?
                WHERE id_usuario = ?
                AND is_active = 'false'";
        $this->_database->query($sql, array(
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
                WHERE id_usuario = ".$data['idUsuario']."
                AND is_active = false
                ";
        $reserva = $this->_database->query($sql)->row_array(); 

        $sql = "SELECT *
                FROM usuario
                WHERE id = ?
                ";
        $restaurante = $this->_database->query($sql, array(
                                                        $reserva{'id_restaurante'}
                                                        ))->row_array();      
                                                                        
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
                WHERE r.id_usuario = ".$data['idUsuario']."
                AND rs.id_reserva = r.id 
                AND r.id = ".$reserva['id'];
    
            $serviciosUsuario = $this->_database->query($sql)->result_array();
            if (count($serviciosUsuario) > 0) {
                foreach ($serviciosUsuario as $item) {
                        $sql = "SELECT * 
                                FROM Comentario c
                                WHERE c.id_servicio = ?
                                AND c.id_usuario = ?";
                        $comen = $this->_database->query($sql, array($item['id_servicio'],$data['idUsuario']))->result_array();     
                        if (sizeof($comen) > 0) {
                                $sql = "UPDATE Comentario c
                                        SET puedeComentar = true
                                        WHERE c.id_servicio = ?
                                        AND c.id_usuario = ?";
                        $this->_database->query($sql, array($item['id_servicio'],$data['idUsuario']));                   
                        }
                        else{
                                $sql = "INSERT INTO `Comentario` (`id_servicio`,`id_usuario`,`puedeComentar`)
                                        VALUES (?,?,true)";
                                $this->_database->query($sql, array($item['id_servicio'],$data['idUsuario']));  
                        }           
                    }   
            }  

            return true;                                    
        }else{
            return false;
        }                                                             
    }

    public function misReservas($data){

        $sql = "SELECT r.personas, r.precio, r.fecha_total, r.turno, u.nickname
                FROM reservas r, usuario u
                WHERE r.id_usuario = ?
                AND u.id = r.id_restaurante
                ORDER BY r.fecha_total DESC ";
         $result =  $this->_database->query($sql, array($data))->result();
         return $result;
    }
}    