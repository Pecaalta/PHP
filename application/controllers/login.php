<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class login extends CI_Controller {

    public function __construct(){
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('model_usuario');
		$this->session->unset_userdata('user');
		$user = $this->session->userdata('user');
		if (!is_null($user)){
			redirect('/home');
		}
	}
	
	public function index() {
		$msg = $this->session->userdata('msg_error');
		$this->load->view('login', array("msg" => $msg));
	}

	public function logout() {
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('msg_error');
		$this->session->sess_destroy();
		redirect('/login');
	}

	public function login() {
		$this->session->set_userdata('msg_error', "");
		$usuario = $this->model_usuario
			->where('nickname', $this->input->post('nickname'))
			->where('password', $this->input->post('password'))
			->get();
		if ($usuario == false) {
			$this->session->set_userdata('msg_error', "No se encontro el usaurio, algun dato puede estar mal");
			redirect('/login');
		} else {
			$this->session->set_userdata('user',$usuario);
			redirect('/home');
		}
	}

}
