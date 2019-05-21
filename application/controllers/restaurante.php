<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurante extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->helper('url');
		
        $this->load->library('session');
		$this->load->model('model_usuario');
		$user = $this->session->userdata('user');
		if (is_null($user)){
			redirect('/login');
		}

    }

	public function index() {
		$restaurante = $this->session->userdata('user');
		$msg = $this->session->userdata('msg_error');
		if (is_null($restaurante)){
			$this->load->view('registro-restaurante', array("msg" => $msg));
		} else if(!$restaurante["end_perfil"]) {
			$this->load->view('main/navbar');
			$this->load->view('registro-restaurante_upload_Img', array("msg" => $msg));
		} else {
			redirect('/producto/'.$restaurante->id);
		}
	}
	public function upload_Img() {
		$msg = $this->session->userdata('msg_error');
		$this->load->view('registro-restaurante_upload_Img', array("msg" => $msg));
	}


	public function producto($id) {
		$lImg = array(
			array(
				"alt" => "altura", 
				"img" => "https://mdbootstrap.com/img/Photos/Slides/img%20(130).jpg",
				"class" => "active",
				"index" => 0
			),
			array(
				"alt" => "altura", 
				"img" => "https://mdbootstrap.com/img/Photos/Slides/img%20(129).jpg",
				"class" => "",
				"index" => 1
			),
			array(
				"alt" => "altura", 
				"img" => "https://mdbootstrap.com/img/Photos/Slides/img%20(70).jpg",
				"class" => "",
				"index" => 2
			)
		);
		$data = array(
			"img" => $lImg,
			'nombre' => "nombre 1",
			"calificacin" => 5,
			"tags" => [ 
				"tag1", 
				"tag1", 
				"tag1", 
				"tag1" 
			]
		);
		$this->enviar();
		$this->load->view('servicio',$data);
	}

	public function servicio() {
		$this->load->view('servicio');
	}
	
	public function registro(){
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

	public function do_upload()
	{

		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->output->set_output(json_encode($error));
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			$this->output->set_output(json_encode($error));

		}
		redirect('/');
	}
/*
	public function enviar(){
		$this->load->library('email');

	} 
	*/

}
