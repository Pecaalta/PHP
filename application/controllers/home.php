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

		$this->nav = array(
			"nav" => array(
				array( "href" => "home", "texto" => "Inicio", "class" => "" ),
				array( "href" => "home/buscar", "texto" => "Servicios", "class" => "" )
			)
		);
		if (!is_null($user)){
			if(!is_null($user['avatar'])) $this->nav["img"] = $user['avatar'];
			else $this->nav["img"] = null;
			if(!is_null($user['rut'])) $this->nav["rut"] = $user['rut'];
			if(!is_null($user['id'])) $this->nav["id"] = $user['id'];
		}

    }

	public function buscar() {
		$this->nav['nav'][1]['class'] = 'active'; 
		$this->load->view('main/navbar', $this->nav);
		$this->load->model('model_servicio');

		$data = $this->input->get("data");
		$page = $this->input->get("per_page");
		$limit = $this->input->get("limit");
		$zona = $this->input->get("zona");
		$categoria = $this->input->get("categoria");
		$minimo = $this->input->get("minimo");
		$maximo = $this->input->get("maximo");
		  

		if ($page == null) $page = 0;
		if ($limit == null) $limit = 9;
		$offset = $page * $limit;
		
		$msg = $this->session->userdata('msg_error');
		
		$mapalista = $this->model_servicio->listServiceMapa(null, $categoria,$zona,$minimo,$maximo);
		$lTiendas = $this->model_servicio->listService(null, $offset, $limit,$categoria,$zona,$minimo,$maximo);
		$lCountTiendas = $this->model_servicio->CountlistService(null, $offset, $limit,$categoria,$zona,$minimo,$maximo);
		$lZone = $this->model_usuario->listaZona();
		$lCategorias = $this->model_usuario->listaCategorias();
		
		$top = $this->model_servicio->toptienda();
		$top[0]["class"] = "active";
		for ($i=0; $i < sizeof($top); $i++) { 
			$top[$i]["index"] = $i;
		}

		// Carga parametros que no sean del paginador
		$gets = $this->input->get();
		$base_url = base_url()."/home/buscar";
		$filter = array();
		if (sizeof($gets) > 0){
			$array = array( );
			foreach ($gets as $key => $value) {
				if ( $value != "" && $key != "per_page" ) {
					$filter[] = array("key" => $key, "value" => $value );
					$array[] = $key."=".$value;
				}
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
			"mapalista" => json_encode($mapalista),
			"tienda" => $lTiendas,
			"page" => $this->pagination->create_links(),
			"get" => $gets,
			"zonas" => $lZone,
			"categorias" => $lCategorias,
			"filter" => $filter
		);
		$this->load->view('home/listado_servicios',$data);
	}

	public function calendario()
	{
		$this->load->library('calendar');

		$data = array(
				3  => 'http://example.com/news/article/2006/06/03/',
				7  => 'http://example.com/news/article/2006/06/07/',
				13 => 'http://example.com/news/article/2006/06/13/',
				26 => 'http://example.com/news/article/2006/06/26/'
		);
		
		$this->load->view('main/navbar', $this->nav);
		echo $this->calendar->generate(2006, 6, $data);
		$this->load->view('home/Calendario');
		
	}

	public function index() {
		$this->nav['nav'][0]['class'] = 'active'; 
		$this->load->view('main/navbar', $this->nav);
		$this->load->model('model_servicio');

		$data = $this->input->get("data");
		$page = $this->input->get("per_page");
		$limit = $this->input->get("limit");

		if ($page == null) $page = 0;
		if ($limit == null) $limit = 9;
		$offset = $page * $limit;
		
		$msg = $this->session->userdata('msg_error');
		$top = $this->model_servicio->toptienda();
		$lTiendas = $this->model_servicio->alltienda(null,$offset,$limit);
		$lCountTiendas = $this->model_servicio->alltiendaCount(null,$offset,$limit);
		$top[0]["class"] = "active";
		for ($i=0; $i < sizeof($top); $i++) { 
			$top[$i]["index"] = $i;
		}

		// Carga parametros que no sean del paginador
		$gets = $this->input->get();
		$base_url = base_url()."/home";
		$filter = array();
		if (sizeof($gets) > 0){
			$array = array( );
			foreach ($gets as $key => $value) {
				if ( $value != "" && $key != "per_page" ) {
					$filter[] = array("key" => $key, "value" => $value );
					$array[] = $key."=".$value;
				}
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
