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
			if(isset($user['avatar']) && !is_null($user['avatar'])) $this->nav["img"] = $user['avatar'];
			else $this->nav["img"] = null;
			if(isset($user['rut']) && !is_null($user['rut'])) $this->nav["rut"] = $user['rut'];
			if(isset($user['id']) && !is_null($user['id'])) $this->nav["id"] = $user['id'];
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

	public function nick_disponible(){

		$data = array(
			"nickname" => $this->input->post('nombre')
		);
		header('Content-Type: application/json');
		try {
			$disponible = $this->model_usuario->nickDisponible2($data);
			$msj = $disponible? "Disponible": "Ya lo an usado"; 
			echo json_encode( array('status' => true , "body" => $msj, "boolean" => $disponible ) );
		} catch (\Throwable $th) {
			echo json_encode( array('status' => false , "body" => $th ) );
		}
	}

	public function email_disponible(){

		$data = array(
			"email" => $this->input->post('email')
		);
		header('Content-Type: application/json');
		try {
			$disponible = $this->model_usuario->emailDisponible($data);
			$msj = $disponible? "Disponible": "Ya lo an usado"; 
			echo json_encode( array('status' => true , "body" => $msj, "boolean" => $disponible ) );
		} catch (\Throwable $th) {
			echo json_encode( array('status' => false , "body" => $th ) );
		}
	}


    public function listaCategorias() {
		$list = $this->model_servicio->listaCategorias($this->input->post('codigo'));
		$arreglo = array();
		foreach ($list as $value) {
			$arreglo[$value["nombre"]] = null;
		}
		echo json_encode($arreglo);
    }
    

}
