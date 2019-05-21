<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->view('main/navbar');

		$this->load->model('usuario');
		$this->load->model('restaurante');
		$this->load->model('Cliente');
	}
		
	public function index(){
		$this->load->view('welcome_message');
	}




	public function login(){
		$usuario = $this->Usuario->get($id);
		if (!is_null($usuario)) {
			$cliente = $this->Cliente->get($usuario->id);
			$restaurante = $this->restaurante->get($usuario->id);
			if (!is_null($cliente)) {
				$this->session->set_userdata('usuario', $usuario);
				$this->session->set_userdata('role', 1);
			} else if (!is_null($restaurante)) {
				$this->session->set_userdata('usuario', $usuario);
				$this->session->set_userdata('role', 2);
			}
		}
	}
	public function post_logout(){}


}
