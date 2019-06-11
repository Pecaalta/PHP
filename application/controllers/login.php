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
		$this->session->unset_userdata('msg_error');
		$this->load->view('login', array("msg" => $msg));
	}

	public function logout() {
		$this->session->unset_userdata('user');
		$this->session->unset_userdata('msg_error');
		$this->session->sess_destroy();
		redirect('/login');
	}

	public function login() {
		$this->session->unset_userdata('msg_error');
		if ($this->input->post('nickname') == "") {
			$this->session->set_userdata('msg_error', "Falta el campo del nick");
			redirect('/login');
		}else if ($this->input->post('nickname') == "") {
			$this->session->set_userdata('msg_error', "Falta una contraseña");
			redirect('/login');
		}else{
			$usuario = $this->model_usuario->login($this->input->post('nickname'),$this->input->post('password'));		
			if ($usuario["status"]) {
				$this->session->set_userdata('user',$usuario["msg"]);
				redirect('/home');
			} else {
				$this->session->set_userdata('msg_error', $usuario["msg"]);
				redirect('/login');
			}
		}
	}

}
