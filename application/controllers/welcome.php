<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class welcome extends CI_Controller {

    public function __construct(){
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
    }

	public function perfil() {
		$this->load->view('registro-cliente');
	}

	public function index() {
		redirect('/home');
	}

	public function sugerencias() {
		$texto = $this->input->post('texto');
		$array = array(
			array('href' => "sada" , "name" => "sada" ),
			array('href' => "sada" , "name" => "sada" ),
			array('href' => "sada" , "name" => "sada" )
		);
		foreach ($array as $key) {
			$this->load->view('componentes/item',$key);
		}
	}
	
}
