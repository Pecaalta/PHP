<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio extends CI_Controller {
	
	private $nav;

    public function __construct(){
			parent::__construct();
			$this->load->library('session');
			$this->load->library('form_validation');
			$this->load->helper('url');
			$this->load->helper('form');

			$this->load->model('model_usuario');
			$this->load->model('model_imagen');
			$this->load->model('model_servicio');
			$user = json_decode(json_encode($this->session->userdata('user')), true);
			$this->nav = array(
				"nav" => array(
					array( "href" => "home", "texto" => "Inicio", "class" => "" ),
					array( "href" => "home/buscar", "texto" => "Servicios", "class" => "" )
				)
			);
			if (!is_null($user)){
				$this->nav = array(
					"img" => $user['avatar'],
					"id" => $user['id']
				);
				if(!is_null($user['rut'])) $this->nav["rut"] = $user['rut'];
				if(!is_null($user['id'])) $this->nav["nav"][] = array( "href" => "login/logout", "texto" => "Salir", "class" => "" );
			}
    }

    private function controlAcceso($id){
		$user = json_decode(json_encode($this->session->userdata('user')), true);
		if (is_null($user) or $user['id'] != $id or is_null($user['rut'])) {
			$this->load->view('main/navbar', $this->nav);
			$this->load->view('errors/index');
			return false;
		}
		return true;
	}

    public function nuevoServicio(){
        $data = array(
			"nombre" => $this->input->post('nombre'),
            "is_active" => true,
            "descripcion" => $this->input->post('descripcion'),
            "precio" => $this->input->post('precio'),
            "id_restaurante" => 2,
            "imagen" => null
		);    
		
		$config = array(
			array(
					'field' => $data["nombre"],
					'label' => 'Nombre de servicio',
					'rules' => 'required | alpha_numeric_spaces',
					'errors' => array(
						'required' => 'El %s es inválido.'
						)
			),
			array(
					'field' => $data["descripcion"],
					'label' => 'Descripcion del servicio',
					'rules' => 'required | alpha_numeric_spaces',
					'errors' => array(
							'required' => 'La %s es inválida.'
					),
			),
			array(
					'field' => $data["precio"],
					'label' => 'Precio del servicio',
					'rules' => 'required | decimal | less_than[0]'
			)
		);
	
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() === FALSE) {
			$user = json_decode(json_encode($this->session->userdata('user')), true);
			$this->load->view('main/navbar', $this->nav);
			$this->load->view('/restaurante/servicios'.$user["id"]);
		} else {
			$data["id"] = $this->model_servicio->insertar($data);

        	redirect("/restaurante/servicios");
		}
	}

}