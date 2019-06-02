<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class usuario extends CI_Controller {

	private $nav;

	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');

		$this->load->model('model_usuario');
		$this->load->model('model_imagen');
		$this->load->model('model_servicio');
		$user = json_decode(json_encode($this->session->userdata('user')), true);
		$this->nav = array(
			"nav" => array(
				array( "href" => "home", "texto" => "Inicio", "class" => "" ),
				array( "href" => "home/buscar", "texto" => "Servicios", "class" => "" )
			)
		);
		if (!is_null($user)){
			$this->nav = array(
				"img" => $user['avatar'],
				"id" => $user['id']
			);
			if(!is_null($user['rut'])) $this->nav["rut"] = $user['rut'];
			if(!is_null($user['id'])) $this->nav["nav"][] = array( "href" => "login/logout", "texto" => "Salir", "class" => "" );
		}
	}

	/**
	 * Pagina de seleccion en registro
	 */
	public function perfil($id){

		$user = $this->model_usuario->get($id);

		$data = array(
			"user" => json_decode(json_encode($user), true),
			"img" => $user->avatar
		);
		$this->load->view('main/navbar', $this->nav);
		$this->load->view('perfil-cliente', $data);
	}

	public function editar($id){

		$user = $this->model_usuario->get($id);

		$data = array(
			"user" => json_decode(json_encode($user), true),
		);
		$this->load->view('main/navbar', $this->nav);
		$this->load->view('editar-cliente', $data);
	}

	public function id_exist(){
		$nick = $this->input->post('nick');
		header('Content-Type: application/json');
		try {
			$exist = $this->model_usuario->isExist($nick);
			echo json_encode( array('status' => true , "body" => $exist ) );
		} catch (\Throwable $th) {
			echo json_encode( array('status' => false , "body" => $th ) );
		}
	}

	public function cambio_password($id){

		$user = $this->model_usuario->get($id);

		$data = array(
			"user" => json_decode(json_encode($user), true),
		);
		$this->load->view('main/navbar', $this->nav);
		$this->load->view('editar-password', $data);
	}



}
