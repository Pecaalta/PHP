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

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload');
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('img')){
			$this->session->set_userdata('msg_error', $this->upload->display_errors());
		}else{
			$data["id_img"] = $this->model_imagen->insert(array("img" => $this->upload->data()["client_name"]));
		}
		$this->session->set_userdata('user',$data);
	}

/*
	// Pantallas
	public function perfil()
	{
		$this->load->view('registro-cliente');
	}

	// Ajax
	public function post_crea(){

		$data = array(
            'name' => $this->input->post('name'),
            'water_morning' => $this->input->post('water_morning')? $this->input->post('water_morning') : 0,
            'water_noon' => $this->input->post('water_noon')? $this->input->post('water_noon') : 0,
            'water_afternoon' => $this->input->post('water_afternoon')? $this->input->post('water_afternoon') : 0,
            'updated_at' => '0000-00-00 00:00:00'
        );
	}
	public function put_edita(){
		if ( ! $this->input->post('id')) {
            show_404();
		}

		$pasos = 0;
		// Usuario
		$data = array(
            'name' => $this->input->post('name'),
            'water_morning' => $this->input->post('water_morning')? $this->input->post('water_morning') : 0,
            'water_noon' => $this->input->post('water_noon')? $this->input->post('water_noon') : 0,
            'water_afternoon' => $this->input->post('water_afternoon')? $this->input->post('water_afternoon') : 0,
            'updated_at' => '0000-00-00 00:00:00'
		);
		if ($this->flower_pot->update($this->input->post('id'), $data)) {
			$pasos++;
		}

		// Cliente
		$data = array(
            'name' => $this->input->post('name'),
            'water_morning' => $this->input->post('water_morning')? $this->input->post('water_morning') : 0,
            'water_noon' => $this->input->post('water_noon')? $this->input->post('water_noon') : 0,
            'water_afternoon' => $this->input->post('water_afternoon')? $this->input->post('water_afternoon') : 0,
            'updated_at' => '0000-00-00 00:00:00'
		);
		if ($this->flower_pot->update($this->input->post('id'), $data)) {
			$pasos++;
		}

		if ($pasos == 2) {
			http_response_code(200);
            $response = array('message' => lang('update_success'));
        } else {
            http_response_code(400);
            $response = array('message' => lang('general_error'));
		}
		

        $this->output->set_output(json_encode($response));
	}*/

	
}
