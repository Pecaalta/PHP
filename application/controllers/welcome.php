<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class welcome extends CI_Controller {

    public function __construct(){
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('model_usuario');
		$this->load->model('model_imagen');
		$this->load->model('model_servicio');
    }

	public function perfil() {
		$this->load->view('registro-cliente');
	}

	public function index() {
		redirect('/home');
	}

	public function sugerencias() {
		$texto = $this->input->post("text");
		$array = $this->model_servicio->autocompletado($texto);
		if (sizeof($array) > 0) {
			foreach ($array as $key) {
				$this->load->view('componentes/item',$key);
			}
		}else {
			$this->load->view('componentes/item', array('href' => '#', 'name' => 'No se encontraron explora en home'));
		}
	}
	
	
}
