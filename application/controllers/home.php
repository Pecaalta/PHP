<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

	private $nav;

    public function __construct(){
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');	
		$this->load->model('model_usuario');

		$user = $this->session->userdata('user');
		if (is_null($user)){
			redirect('/login');
		} else if (is_null($user["rut"])) {
			$this->nav = array(
				"nav" => array(
					array( "href" => "home", "texto" => "Home", "class" => "active" ),
					array( "href" => "login/logout", "texto" => "Salir", "class" => "" )
				)
			);
		} else {
			$this->nav = array(
				"nav" => array(
					array( "href" => "ss", "texto" => "sdssssad", "class" => "active" ),
					array( "href" => "sdsad", "texto" => "sdsad", "class" => "" )
				)
			);
		}

    }

	public function perfil() {
		$this->load->view('registro-cliente');
	}

	public function index() {
		$this->load->view('main/navbar', $this->nav);
		$msg = $this->session->userdata('msg_error');
		$lTiendas = array(
			array(
				'nombre' => "nombre 1",
				"imagen" => "https://mdbootstrap.com/img/Photos/Others/img%20(27).jpg",
				"calificacin" => 5,
				"tags" => [ "tag1", "tag2" ]
			),
			array(
				'nombre' => "nombre 1",
				"imagen" => "https://mdbootstrap.com/img/Photos/Others/img%20(27).jpg",
				"calificacin" => 5,
				"tags" => [ "tag1", "tag2" ]
			),
			array(
				'nombre' => "nombre 1",
				"imagen" => "https://mdbootstrap.com/img/Photos/Others/img%20(27).jpg",
				"calificacin" => 5,
				"tags" => [ "tag1", "tag2" ]
			),
			array(
				'nombre' => "nombre 1",
				"imagen" => "https://mdbootstrap.com/img/Photos/Others/img%20(27).jpg",
				"calificacin" => 5,
				"tags" => [ 
					"tag1", 
					"tag1", 
					"tag1", 
					"tag1" 
				]
			)
		);
		
		$breadcrumb = array(
			array(
				"text" => "Home",
				"value" => "Home"
			),
			array(
				"text" => "Home",
				"value" => "Home"
			),
			array(
				"text" => "Home",
				"value" => "Home"
			)
		);
		$page = array(
			array(
				"text" => "1",
				"value" => "Home"
			),
			array(
				"text" => "2",
				"value" => "Home"
			),
			array(
				"text" => "3",
				"value" => "Home"
			)
		);
		$data = array(
			"tienda" => $lTiendas,
			"page" => $page
		);
		$this->load->view('home/listado_tiendas',$data);
	}
}
