<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class home extends CI_Controller {

	private $nav;

    public function __construct(){
        parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');	
		$this->load->model('model_usuario');

		$user = json_decode(json_encode($this->session->userdata('user')), true);
		if (is_null($user)){
			$this->nav = array(
				"nav" => array(
					array( "href" => "", "texto" => "Home", "class" => "active" )
				)
			);
		} else {
			if (!is_null($user['id'])) {
				$lImg = $this->model_usuario->getImgpefil($user["id"]);
				if (!is_null($lImg) && sizeof($lImg) > 0){
					$lImg = $lImg[0]["img"];
				} else {
					$lImg = null;
				}
				if(is_null($user['rut'])){
					$this->nav = array(
						"nav" => array(
							array( "href" => "home", "texto" => "Home", "class" => "active" ),
							array( "href" => "login/logout", "texto" => "Salir", "class" => "" )
						),
						"img" => $lImg,
						"id" => $user['id']
					);
				}
				else{
					$this->nav = array(
						"nav" => array(
							array( "href" => "home", "texto" => "Home", "class" => "active" ),
							array( "href" => "login/logout", "texto" => "Salir", "class" => "" )
						),
						"img" => $lImg,
						"id" => $user['id'],
						"rut" => $user['rut']
					);
				}
			} else {
				$this->nav = array(
					"nav" => array(
						array( "href" => "", "texto" => "Home", "class" => "active" )
					),
					"img" => null,
					"rut" => $user['rut']
				);
			}
		}

    }

	public function perfil() {
		$this->load->view('registro-cliente');
	}

	public function index() {
		$this->load->view('main/navbar', $this->nav);
		$this->load->model('model_servicio');

		$data = $this->input->get("data");
		$page = $this->input->get("per_page");
		$limit = $this->input->get("limit");

		if ($page == null) $page = 0;
		if ($limit == null) $limit = 9;
		$offset = $page * $limit;
		
		$msg = $this->session->userdata('msg_error');
		$lTiendas = $this->model_servicio->alltienda(null,$offset,$limit);
		$lCountTiendas = $this->model_servicio->alltiendaCount(null,$offset,$limit);
		$top = $this->model_servicio->toptienda();
		$top[0]["class"] = "active";
		for ($i=0; $i < sizeof($top); $i++) { 
			$top[$i]["index"] = $i;
		}

		// Carga parametros que no sean del paginador
		$gets = $this->input->get();
		$base_url = base_url()."/home";
		if (sizeof($gets) > 0){
			$array = array( );
			foreach ($gets as $key => $value) {
				if($key != "per_page")
					$array[] = $key."=".$value;
			}
			$base_url .= "?". join("&", $array);
		}

		// Configuracion de paginador
		$this->load->library('pagination');
		
		$config['base_url'] = $base_url;
		$config['total_rows'] = $lCountTiendas/$limit;
		$config['per_page'] = 1;
		$config['display_pages'] = true;

		$config['page_query_string'] = true;
		$config['first_link'] = 'Primera';
		$config['last_link'] = 'Ultima';
		$config['attributes'] = array('class' => 'page-link');
		// Activo
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		// Numeros
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';

		
	  
	  
		$this->pagination->initialize($config); 
		$data = array(
			"top" => $top,
			"tienda" => $lTiendas,
			"page" => $this->pagination->create_links()
		);
		$this->load->view('home/listado_tiendas',$data);
	}
}
