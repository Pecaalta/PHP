<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio extends CI_Controller {
	
	private $nav;

    public function __construct(){
			parent::__construct();
			$this->load->library('session');
			$this->load->library('form_validation');
			$this->load->helper('url');
			$this->load->helper('form');

			$this->load->model('model_usuario');
			$this->load->model('model_imagen');
			$this->load->model('model_servicio');
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
		if (is_null($user) or $user['id'] != $id or is_null($user['rut'])) {
			$this->load->view('main/navbar', $this->nav);
			$this->load->view('errors/index');
			return false;
		}
		return true;
	}

	public function info_servicio($id)
	{
		$servicio = $this->model_servicio->infoServicio($id);
		$comentarios = $this->model_servicio->listaComentarios($id);

		$data = array(
			'servicio' => $servicio,
			'comentarios' => $comentarios
		);

		$this->load->view('main/navbar', $this->nav);
		$this->load->view('restaurante/verServicio', $data );
	}

	public function comentar_servicio($id)
	{
		$servicio = $this->model_servicio->comentar($id);
	
		$data = array(
			'servicio' => $servicio,
		);
		$this->load->view('main/navbar', $this->nav);
		$this->load->view('restaurante/comentario', $data );
	}

	public function enviar_comentario(){

		$user = json_decode(json_encode($this->session->userdata('user')), true);

		$data = array(
			"valoracion" => $this->input->post('valoracion'),
			"id_servicio" => $this->input->post('idServicio'),
			"comentar" => $this->input->post('descripcion'),
			"user" => $user['id'],
		);
		
		$data["id"] = $this->model_servicio->updateComentario($data);
		redirect("/");
	}

}