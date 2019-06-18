<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reserva extends CI_Controller {

    private $nav;

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library('form_validation');

		$this->load->model('model_usuario');
		$this->load->model('model_imagen');
		$this->load->model('model_servicio');
		$this->load->model('model_reserva');
		$user = json_decode(json_encode($this->session->userdata('user')), true);
		$msg_error = $this->session->set_userdata('msg_error');
		$this->session->unset_userdata('msg_error');
		$this->nav = array(
			"nav" => array(
				array( "href" => "home", "texto" => "Inicio", "class" => "" ),
				array( "href" => "home/buscar", "texto" => "Servicios", "class" => "" )
			),
			"msg_error" => $msg_error
		);
		if (!is_null($user)){
			if(!is_null($user['avatar'])) $this->nav["img"] = $user['avatar'];
			else $this->nav["img"] = null;
			if(!is_null($user['rut'])) $this->nav["rut"] = $user['rut'];
			if(!is_null($user['id'])) $this->nav["id"] = $user['id'];
		}
	}

	private function controlAcceso($id){
		$user = json_decode(json_encode($this->session->userdata('user')), true);
		if (is_null($user) or $user['id'] == $id or !is_null($user['rut'])) {
			$this->load->view('main/navbar', $this->nav);
			$this->load->view('errors/index');
			return false;
		}
		return true;
	}

	private function infoGeneral($id, $id_restaurante){
		$user = $this->model_usuario->get($id);
		$lImg = $this->model_usuario->getImgpefil($id);
        $servicios = $this->model_servicio->serviciosDisponibles($id_restaurante);
        $userRestaurante = $this->model_usuario->get($id_restaurante);
		if (!is_null($lImg) && sizeof($lImg) > 0){
			$lImg = $lImg[0]["img"];
		} else {
			$lImg = null;
		}
		$data = array(
			"user" => json_decode(json_encode($user), true),
			"img" => $lImg,
            "servicio" => $servicios,
            "userRestaurante" => $userRestaurante
		);
		return $data;
    }

    public function realizarReserva($id_restaurante){
		if ($this->controlAcceso($id_restaurante)) {
			$user = json_decode(json_encode($this->session->userdata('user')), true);
			if (!is_null($user)){
				$data = array(
					"id_usuario" => $user['id'],
					"id_restaurante" => $id_restaurante
				);
				$this->model_reserva->instanciarPreReserva($data);
				$data = $this->infoGeneral($user['id'], $id_restaurante);
				$this->load->view('main/navbar', $this->nav);
				$this->load->view('reserva/realizarReserva', $data);
			}
		}
    }

    public function fechaDisponible(){
		$user = json_decode(json_encode($this->session->userdata('user')), true);
		$userRestaurante = $this->model_usuario->get($this->input->post('id_restaurante'));

		$data = array(
			"cantPersonas" => $this->input->post('cantPersonas'),
			"fecha" => $this->input->post('fechaIndicada'),
			"turno" => $this->input->post('turnoIndicado'),
			"restaurante" => $userRestaurante,
			"idUsuario" => $user['id']
		);
		$array = array(
			"respuesta2" => $this->model_reserva->disponibilidadMesa($data)
		);

		$this->load->view('componentes/reserva/puedeReservar', $array);
	}

	public function turnoDisponible()
	{
		$user = json_decode(json_encode($this->session->userdata('user')), true);
		$userRestaurante = $this->model_usuario->get($this->input->post('id_restaurante'));

		$data = array(
			"fecha" => $this->input->post('fechaIndicada'),
			"restaurante" => $userRestaurante,
			"idUsuario" => $user['id']
		);
		$array = array(
			"respuesta" => $this->model_reserva->disponibilidadTurno($data)
		);

		$this->load->view('componentes/reserva/fecha', $array);
	}

	public function infoServicio(){
		$user = json_decode(json_encode($this->session->userdata('user')), true);
		$userRestaurante = $this->model_usuario->get($this->input->post('id_restaurante'));

		$array = array(
			"servicio" => $this->model_servicio->serviciosDisponibles($userRestaurante->id),
			"nombreServicio" => $this->input->post('nombreServicio')
		);
		
		$this->load->view('componentes/reserva/infoServicio', $array);
	}

	public function agregarComida(){
		$user = json_decode(json_encode($this->session->userdata('user')), true);
		$userRestaurante = $this->model_usuario->get($this->input->post('id_restaurante'));
		$data = array(
			"idUsuario" => $user["id"],
			"idRestaurante" => $userRestaurante->id,
			"idServicio" => $this->input->post('idServicio'),
			"cantidad" => $this->input->post('cantidad')
		);

		echo $this->model_reserva->agregarComida($data);
	}
	
	public function eliminarComida(){
		$user = json_decode(json_encode($this->session->userdata('user')), true);

		$data = array(
			"idUsuario" => $user["id"],
			"idServicio" => $this->input->post('idServicio')
		);

		$this->model_reserva->eliminarComida($data);
	}

	public function datosPago()
	{
		$user = json_decode(json_encode($this->session->userdata('user')), true);
		$data = array(
			"tarjeta" => $this->input->post('tarjeta'),
			"titularTarjeta" => $this->input->post('titularTarjeta'),
			"cvc" => $this->input->post('cvc'),
			"idUsuario" => $user['id']
		);
		
		$this->model_reserva->datosPago($data);
		
	}

	public function finalizarReserva()
	{
		$user = json_decode(json_encode($this->session->userdata('user')), true);
		$data = array(
			"idUsuario" => $user['id']
		);
		if($this->model_reserva->validacionFinalUltimate($data)){
			echo "Putin te tiene en su gloria, esto funciono :)";
		}else{
			echo "Error, la fecha y hora que seleccionaste ya no estan disponibles, por favor elige otra";
		}
	}

	public function mis_reservas(){

		$user = json_decode(json_encode($this->session->userdata('user')), true);

		$reserva = $this->model_reserva->misReservas($user['id']);

		$data = array(
			'reserva' => $reserva,
		);

		$this->load->view('main/navbar', $this->nav);
		$this->load->view('reserva/reservas-cliente', $data);
	}

}    