<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

    public function __construct(){
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		
		$this->load->model('model_usuario');
		$this->load->model('model_imagen');
		
		$user = $this->session->userdata('user');
		if (is_null($user)){
			redirect('/login');
		}
    }

	public function index()
	{
		$msg = $this->session->userdata('msg_error');
		$user = $this->session->userdata('user');
		if (is_null($user)){
			$this->load->view('registro-cliente', array("msg" => $msg));
		} else {
			$this->load->view('perfil-cliente', array("msg" => $msg));
		}
	}

	
}
