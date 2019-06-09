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
			if(isset($user['avatar']) && !is_null($user['avatar'])) $this->nav["img"] = $user['avatar'];
			else $this->nav["img"] = null;
			if(isset($user['rut']) && !is_null($user['rut'])) $this->nav["rut"] = $user['rut'];
			if(isset($user['id']) && !is_null($user['id'])) $this->nav["id"] = $user['id'];
		}

    }

	/**
	 * Retorna HTML de los elementos
	 */
	public function ajax_elementos() {
		echo $this->elementos(false);
	}

	/**
	 * Datos de mapa
	 */
	public function ajax_mapa() {
		echo $this->mapa();
	}

	/**
	 * Pagina buscador
	 */
	public function buscar() {
		$this->nav['nav'][1]['class'] = 'active'; 
		$this->load->view('main/navbar', $this->nav);

		$msg = $this->session->userdata('msg_error');
		$this->session->unset_userdata('msg_error');
		
		$data = array(
			"mapalista" => $this->mapa(),
			"tienda" => $this->elementos(false),
			"get" => $this->input->get(),
			"zonas" => $this->model_usuario->listaZona(),
			"categorias" => $this->model_usuario->listaCategorias(),
		);
		$this->load->view('home/listado_servicios',$data);
	}

	/**
	 * Pagina home
	 */
	public function index() {
		$this->nav['nav'][0]['class'] = 'active'; 
		$this->load->view('main/navbar', $this->nav);
		$this->load->model('model_servicio');
	
		$data = array(
			"top" => $this->carusel(),
			"tienda" =>  $this->elementos(true, base_url()."/home/"),
		);
		$this->load->view('home/listado_tiendas',$data);
	}

	// - Logica Componentes ----------------------------------------------------------------------------------------------------------------------//

	/**
	 * Metodo carga datos de input y retorna datos de Mapa
	 */
	private function mapa() {
		$this->load->model('model_servicio');
		$data = $this->input->get("data");
		$page = $this->input->get("per_page");
		$limit = $this->input->get("limit");
		$zona = $this->input->get("zona");
		$categoria = $this->input->get("categoria");
		$minimo = $this->input->get("minimo");
		$maximo = $this->input->get("maximo");
		return json_encode($this->model_servicio->listServiceMapa(null, $categoria,$zona,$minimo,$maximo));
	}

	/**
	 * Metodo extrae top y retorna carusel
	 */
	private function carusel() {
		$this->load->model('model_servicio');
		$top = $this->model_servicio->toptienda();
		if(sizeof($top) > 0) {
			$top[0]["class"] = "active";
			for ($i=0; $i < sizeof($top); $i++) { 
				$top[$i]["index"] = $i;
			}
		}
		return $top;
	}

	/**
	 * Retorna html de elementos
	 * @param $isAll boolean true significa quiero todo sin filtros
	 */
	private function elementos($isAll,$base_url = null)
	{
		$this->load->model('model_servicio');
		$this->load->library('pagination');
		
		$data = $this->input->get("data");
		$page = $this->input->get("per_page");
		$limit = $this->input->get("limit");
		$zona = $this->input->get("zona");
		$categoria = $this->input->get("categoria");
		$minimo = $this->input->get("minimo");
		$maximo = $this->input->get("maximo");
		
		if($base_url == null)$base_url = base_url()."/home/buscar";

		if ($page == null) $page = 0;
		if ($limit == null) $limit = 9;
		$offset = $page * $limit;
		$gets = $this->input->get();
		$filter = array();
		if ($isAll){
			$lTiendas = $this->model_servicio->alltienda(null,$offset,$limit);
			$lCountTiendas = $this->model_servicio->alltiendaCount(null,$offset,$limit);
		} else {
			$lTiendas = $this->model_servicio->listService(null, $offset, $limit,$categoria,$zona,$minimo,$maximo);
			$lCountTiendas = $this->model_servicio->CountlistService(null, $offset, $limit,$categoria,$zona,$minimo,$maximo);
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
		}
		
		// Configuracion de paginador
		$config['base_url'] = $base_url;
		$config['total_rows'] = $lCountTiendas/$limit;
		$config['per_page'] = 1;
		$config['display_pages'] = true;
		$config['page_query_string'] = true;
		$config['first_link'] = 'Primera';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Ultima';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';
		$config['attributes'] = array('class' => 'page-link');
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li class="page-item">';
		$config['num_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$this->pagination->initialize($config); 

		return $this->load->view('componentes/cards_home',array("tienda" => $lTiendas,"page" => $this->pagination->create_links(), "filter"=> $filter), true);
		
	}
}







