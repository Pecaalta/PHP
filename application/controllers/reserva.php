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
		$this->nav = array(
			"nav" => array(
				array( "href" => "home", "texto" => "Inicio", "class" => "" ),
				array( "href" => "home/buscar", "texto" => "Servicios", "class" => "" )
			)
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
		if (is_null($user) or $user['id'] != $id or is_null($user['rut'])) {
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
        $user = json_decode(json_encode($this->session->userdata('user')), true);
        if ($this->controlAcceso($user['id'])){
            $data = $this->infoGeneral($user['id'], $id_restaurante);
            $this->load->view('main/navbar', $this->nav);
			$this->load->view('reserva/realizarReserva', $data);
        }
    }

    public function fechaDisponible(){
        $user = json_decode(json_encode($this->session->userdata('user')), true);
		$data = array(
			"fecha" => $this->input->post('fechaIndicada'),
			"hora" => $this->input->post('horaIndicada'),
			"id_restaurante" => $this->input->post('id_restaurante')
		);
		header('Content-Type: application/json');
		try {
            $exist = $this->model_reserva->prueba($data);
            $tipo = gettype($exist);
			echo json_encode( array('status' => true , "body" => $exist ) );
		} catch (\Throwable $th) {
			echo json_encode( array('status' => false , "body" => $th ) );
		}
    }

}    