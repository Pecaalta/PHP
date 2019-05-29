<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurante extends CI_Controller {

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
	 * Pagina de restaurante -
	 */
	public function principal($id){

		$user = $this->model_usuario->get($id);
		$lImg = $this->model_usuario->getImgpefil($id);
		$servicios = $this->model_servicio->serviciosDisponibles($id);
		if (!is_null($lImg) && sizeof($lImg) > 0){
			$lImg = $lImg[0]["img"];
		} else {
			$lImg = null;
		}
		$data = array(
			"user" => json_decode(json_encode($user), true),
			"img" => $lImg,
			"servicio" => $servicios
		);
		$this->load->view('main/navbar', $this->nav);
		$this->load->view('restaurante/restaurante-index', $data);
	}

	public function editar($id){

		$user = json_decode(json_encode($this->session->userdata('user')), true);
		if (is_null($user) or $user['id'] != $id or is_null($user['rut'])) {
			$this->load->view('main/navbar', $this->nav);
			$this->load->view('errors/index');
		} else {
			$this->load->view('main/navbar', $this->nav);
			$this->load->view('restaurante/restaurante-editar');
		}
	}
}
