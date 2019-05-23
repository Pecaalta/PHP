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
		$user = $this->session->userdata('user');
		if (!is_null($user)){
			redirect('/login');
		} else if (is_null($user["rut"])) {
			$this->nav = array(
				"nav" => array(
					array( "href" => "home", "texto" => "Home", "class" => "active" ),
					array( "href" => "login/logout", "texto" => "Salir", "class" => "" )
				)
			);
		} else {
			$this->nav = array(
				"nav" => array(
					array( "href" => "ss", "texto" => "sdssssad", "class" => "active" ),
					array( "href" => "sdsad", "texto" => "sdsad", "class" => "" )
				)
			);
		}
	}
	
	/**
	 * Pagina de seleccion en registro
	 */
	public function perfil($id){
		
		$user = $this->model_usuario->get($id);
		$lImg = $this->model_usuario->getImgpefil($id);
		$data = array(
			"user" => json_decode(json_encode($user), true),
			"img" => $lImg
		);
		$this->load->view('main/navbar', $this->nav);
		$this->load->view('perfil-cliente', $data);
	}


}
