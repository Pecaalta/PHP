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
		if (is_null($user)){
			$this->nav = array(
				"nav" => array(
					array( "href" => "", "texto" => "Home", "class" => "" )
				)
			);
		} else {
			if (is_null($user['rut'])) {
				$lImg = $this->model_usuario->getImgpefil($user["id"]);
				if (!is_null($lImg)&& sizeof($lImg) > 0){
					$lImg = $lImg[0]["img"];
				} else {
					$lImg = null;
				}
				$this->nav = array(
					"nav" => array(
						array( "href" => "home", "texto" => "Home", "class" => "active" ),
						array( "href" => "login/logout", "texto" => "Salir", "class" => "" )
					),
					"img" => $lImg,
					"id" => $user['id']
				);
			} else {
				$this->nav = array(
					"nav" => array(
						array( "href" => "", "texto" => "Home", "class" => "active" )
					),
					"img" => null,
					"id" => $user['id'],
					"rut" => $user['rut']
				);
			}
		}
	}

	/**
	 * Pagina de seleccion en registro
	 */
	public function perfil($id){

		$user = $this->model_usuario->get($id);
		$lImg = $this->model_usuario->getImgpefil($id);
		if (!is_null($lImg) && sizeof($lImg) > 0){
			$lImg = $lImg[0]["img"];
		} else {
			$lImg = null;
		}
		$data = array(
			"user" => json_decode(json_encode($user), true),
			"img" => $lImg
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

	public function cambio_password($id){

		$user = $this->model_usuario->get($id);

		$data = array(
			"user" => json_decode(json_encode($user), true),
		);
		$this->load->view('main/navbar', $this->nav);
		$this->load->view('editar-password', $data);
	}



}
