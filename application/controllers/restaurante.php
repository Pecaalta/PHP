<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Restaurante extends CI_Controller
{

	private $nav;

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->library('form_validation');

		$this->load->model('model_usuario');
		$this->load->model('model_imagen');
		$this->load->model('model_servicio');
		$user = json_decode(json_encode($this->session->userdata('user')), true);
		$this->nav = array(
			"nav" => array(
				array("href" => "home", "texto" => "Inicio", "class" => ""),
				array("href" => "home/buscar", "texto" => "Servicios", "class" => "")
			)
		);
		if (!is_null($user)) {
			$this->nav = array(
				"img" => $user['avatar'],
				"id" => $user['id']
			);
			if (!is_null($user['rut'])) $this->nav["rut"] = $user['rut'];
			if (!is_null($user['id'])) $this->nav["nav"][] = array("href" => "login/logout", "texto" => "Salir", "class" => "");
		}
	}

	private function controlAcceso($id)
	{
		$user = json_decode(json_encode($this->session->userdata('user')), true);
		if (is_null($user) or $user['id'] != $id or is_null($user['rut'])) {
			$this->load->view('main/navbar', $this->nav);
			$this->load->view('errors/index');
			return false;
		}
		return true;
	}

	private function infoGeneral($id)
	{
		$user = $this->model_usuario->get($id);
		$lImg = $this->model_usuario->getImgpefil($id);
		$servicios = $this->model_servicio->serviciosDisponibles($id);
		if (!is_null($lImg) && sizeof($lImg) > 0) {
			$lImg = $lImg[0]["img"];
		} else {
			$lImg = null;
		}
		$data = array(
			"user" => json_decode(json_encode($user), true),
			"img" => $lImg,
			"servicio" => $servicios
		);
		return $data;
	}


	/**
	 * Pagina de restaurante -
	 */
	public function principal($id)
	{

		$data = $this->infoGeneral($id);
		$this->load->view('main/navbar', $this->nav);
		$this->load->view('restaurante/restaurante-index', $data);
	}

	public function editar($id)
	{

		if ($this->controlAcceso($id)) {
			$data = $this->infoGeneral($id);
			$this->load->view('main/navbar', $this->nav);
			$this->load->view('restaurante/restaurante-editar', $data);
		}
	}

	public function editarDatos($id)
	{
		if ($this->controlAcceso($id)) {
			$data = $this->infoGeneral($id);
			$this->load->view('main/navbar', $this->nav);
			$this->load->view('restaurante/restaurante-datos', $data);
		}
	}



	/**
	 * SERVICIOS - esto deberia ir en otro controlador pero por ahora lo dejo aca
	 */


	public function servicios($id)
	{
		if ($this->controlAcceso($id)) {
			$data = $this->infoGeneral($id);
			$this->load->view('main/navbar', $this->nav);
			$this->load->view('restaurante/restaurante-servicios', $data);
		}
	}

	public function existeServicio()
	{
		$user = json_decode(json_encode($this->session->userdata('user')), true);
		$data = array(
			"nombre" => $this->input->post('nombre'),
			"id_restaurante" => $user['id']
		);
		header('Content-Type: application/json');
		try {
			$exist = $this->model_servicio->existeNombreServicio($data);
			echo json_encode(array('status' => true, "body" => $exist));
		} catch (\Throwable $th) {
			echo json_encode(array('status' => false, "body" => $th));
		}
	}

	public function nuevoServicio()
	{

		$user = json_decode(json_encode($this->session->userdata('user')), true);
		$data = array(
			"nombre" => $this->input->post('nombre'),
			"is_active" => true,
			"descripcion" => $this->input->post('descripcion'),
			"precio" => $this->input->post('precio'),
			"id_restaurante" => $user['id'],
			"imagen" => null
		);

		$config['upload_path'] = './uploads/servicios/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload');
		$this->upload->initialize($config);
		$this->upload->do_upload('img');
		$data["imagen"] = $this->upload->data()["client_name"];

		$data["id"] = $this->model_servicio->insertar($data);
		redirect("/restaurante/servicios/" . $user["id"]);
	}

	public function modificarServicio()
	{

		$user = json_decode(json_encode($this->session->userdata('user')), true);
		$data = array(
			"nombre" => $this->input->post('nombre'),
			"descripcion" => $this->input->post('descripcion'),
			"precio" => $this->input->post('precio'),
			"id" => $this->input->post('id'),
			"imagen" => null
		);

		$data["id"] = $this->model_servicio->modificar($data);
		redirect("/restaurante/servicios/" . $user["id"]);
	}

	public function eliminarServicio()
	{
		$user = json_decode(json_encode($this->session->userdata('user')), true);
		$data = array(
			"id" => $this->input->post('id')
		);

		$data["id"] = $this->model_servicio->eliminar($data);
		redirect("/restaurante/servicios/" . $user["id"]);
	}

	public function info_servicio($id)
	{

		$servicio = $this->model_servicio->infoServicio($id);

		$this->load->view('main/navbar', $this->nav);
		$this->load->view('restaurante/verServicio',  $servicio);
	}
}
