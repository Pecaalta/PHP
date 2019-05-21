<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registro extends CI_Controller {

	
	public function __construct(){
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');

	}
	
	/**
	 * Pagina de seleccion en registro
	 */
	public function index(){
		$user = $this->session->userdata('user');
		if (!is_null($user)){
			redirect('/home');
		}
		$this->load->view('registro/registro-seleccion');
	}

	/**
	 * Registro de restaurante
	 */
	public function restaurante(){
		$msg = $this->session->userdata('msg_error');
		$user = $this->session->userdata('user');
		if (is_null($user)){
			$this->load->view('registro/registro-restaurante', array("msg" => $msg));
		} else if(!$restaurante["end_perfil"]) {
			$this->load->view('main/navbar');
			$this->load->view('registro-restaurante_upload_Img', array("msg" => $msg));
		}
	}

	/**
	 * Registro de cliente
	 */
	public function cliente(){
		$user = $this->session->userdata('user');
		if (!is_null($user)){
			redirect('/home');
		}
		$msg = $this->session->userdata('msg_error');
		$this->load->view('registro/registro-cliente', array("msg" => $msg));
	}
	

	
	public function post_restaurante(){
		$data = array(
			"nickname" => $this->input->post('nickname'),
			"nombre" => $this->input->post('nombre'),
			"rut" => $this->input->post('rut'),
			"direccion" => $this->input->post('direccion'),
			"zona" => $this->input->post('zona'),
			"telefono" => $this->input->post('telefono'),
			"email" => $this->input->post('email'),
			"apellido" => $this->input->post('apellido'),
			"fecha_de_nacimiento" => $this->input->post('fecha_de_nacimiento'),
			"end_perfil" => false,
			"is_active" => false
		);
		$data["id"] = $this->model_usuario->insert($data);
		
		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$this->load->library('upload');

		$this->session->set_userdata('user',$data);
		redirect(current_url());
	}

}
