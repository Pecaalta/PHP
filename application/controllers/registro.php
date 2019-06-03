<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Registro extends CI_Controller
{

	private $nav;


	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');

		$this->load->model('model_usuario');
		$this->load->model('model_imagen');
		$user = json_decode(json_encode($this->session->userdata('user')), true);
		if (is_null($user)) {
			$this->nav = array(
				"nav" => array(
					array("href" => "", "texto" => "Home", "class" => "active")
				)
			);
		} else {
			if (is_null($user['rut'])) {
				$this->nav = array(
					"nav" => array(
						array("href" => "home", "texto" => "Home", "class" => "active"),
						array("href" => "login/logout", "texto" => "Salir", "class" => "")
					),
					"img" => null,
					"id" => $user['id']
				);
			} else {
				$lImg = $this->model_usuario->getImgpefil($user["id"]);
				$this->nav = array(
					"nav" => array(
						array("href" => "", "texto" => "Home", "class" => "active"),
						array("href" => "login", "texto" => "Entrar", "class" => ""),
						array("href" => "login/logout", "texto" => "Salir", "class" => "")
					),
					"img" => $lImg[0]["img"],
					"rut" => $user['rut']
				);
			}
		}
	}

	/**
	 * Pagina de seleccion en registro
	 */
	public function index()
	{
		$user = $this->session->userdata('user');
		if (!is_null($user)) {
			redirect('/home');
		}
		$this->load->view('registro/registro-seleccion');
	}

	/**
	 * Registro de restaurante
	 */
	public function restaurante()
	{
		$msg = $this->session->userdata('msg_error');
		$user = $this->session->userdata('user');
		if (is_null($user)) {
			$this->load->view('registro/registro-restaurante', array("msg" => $msg));
		} else if (!$user["end_perfil"]) {
			$this->load->view('main/navbar', $this->nav);
			$this->load->view('registro/registro-restaurante_upload_Img', array("msg" => $msg));
		}
	}

	/**
	 * Registro de cliente
	 */
	public function cliente()
	{
		$user = $this->session->userdata('user');
		if (!is_null($user)) {
			redirect('/home');
		}
		$msg = $this->session->userdata('msg_error');
		$this->load->view('registro/registro-cliente', array("msg" => $msg));
	}



	public function post_restaurante()
	{
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

		$this->session->set_userdata('user', $data);
		redirect(current_url());
	}

	public function post_cliente()
	{
		$data = array(
			"nickname" => $this->input->post('nickname'),
			"nombre" => $this->input->post('nombre'),
			"rut" => $this->input->post('rut'),
			"direccion" => $this->input->post('direccion'),
			"zona" => $this->input->post('zona'),
			"telefono" => $this->input->post('telefono'),
			"email" => $this->input->post('email'),
			"apellido" => $this->input->post('apellido'),
			"password" => $this->input->post('password'),
			"fecha_de_nacimiento" => $this->input->post('fecha_de_nacimiento'),
			"end_perfil" => false,
			"is_active" => false
		);
		$data["id"] = $this->model_usuario->insert($data);

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload');
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('img')) {
			$this->session->set_userdata('msg_error', $this->upload->display_errors());
		} else {
			$data["id_img"] = $this->model_imagen->insert(array("img" => $this->upload->data()["client_name"], "usuario_id" => $data["id"]));
		}

		$this->load->library('email');
		//Indicamos el protocolo a utilizar
		$config['protocol'] = 'ssmtp';
		//El servidor de correo que utilizaremos
		$config['smtp_host'] = 'ssl: //ssmtp.googlemail.com';
		//Nuestro usuario
		$config['smtp_user'] = 'contacto.reserbar@gmail.com';
		//Nuestra contraseña
		$config['smtp_pass'] = 'reserbar123';
		//El puerto que utilizará el servidor smtp
		$config['smtp_port'] = '587';
		//El juego de caracteres a utilizar
		$config['charset'] = 'utf-8';
		//Permitimos que se puedan cortar palabras
		$config['wordwrap'] = TRUE;
		//El email debe ser valido 
		$config['validate'] = true;

		$config['mailtype'] = 'html';
		$this->email->initialize($config);
		$this->email->from('contacto.reserbar@gmail.com', 'ReserBAR');
		$this->email->to($this->input->post('email'));
		$this->email->subject('Registro de Usuario en ReserBAR');
		$this->email->message('<h2><b>' . $data['nickname'] . ', te damos la bienvenida a ReserBAR! ' . '</b></h2>' .
			'Te has registrado con los siguientes
		datos: <br><br><b> Nombre:</b> ' . $data['nombre'] . '<br> <b>Apellido:</b> ' . $data['apellido'] 
		. '<br> <b>Fecha de Nacimiento:</b> ' . $data['fecha_de_nacimiento'] . '<br><br>' . 'Ya puedes comenzar a buscar 
		restaurantes y servicios donde deleitar el paladar. <br> Gracias por elegirnos. <br> El equipo de ReserBAR. ');

		$this->email->send();

		$this->session->set_userdata('user', $data);
		redirect("/home");
	}

	public function editar_cliente()
	{

		$user = json_decode(json_encode($this->session->userdata('user')), true);

		$data = array(
			"nombre" => $this->input->post('nombre'),
			"rut" => $this->input->post('rut'),
			"direccion" => $this->input->post('direccion'),
			"zona" => $this->input->post('zona'),
			"telefono" => $this->input->post('telefono'),
			"email" => $this->input->post('email'),
			"apellido" => $this->input->post('apellido'),
			"fecha_de_nacimiento" => $this->input->post('fecha_de_nacimiento')
		);
		$this->model_usuario->where('id', $user['id']);
		$data["id"] = $this->model_usuario->update($data);

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload');
		$this->upload->initialize($config);
		if (!$this->upload->do_upload('img')) {
			$this->session->set_userdata('msg_error', $this->upload->display_errors());
		} else {
			$data["id_img"] = $this->model_imagen->insert(array("img" => $this->upload->data()["client_name"], "usuario_id" => $data["id"]));
		}
		$this->session->unset_userdata('user');
		$usuario = $this->model_usuario
			->where('nickname', $user['nickname'])
			->where('password', $user['password'])
			->get();
		$this->session->set_userdata('user', $usuario);
		redirect("/home");
	}

	public function editar_pass()
	{

		$user = json_decode(json_encode($this->session->userdata('user')), true);

		$data = array(
			"password" => $this->input->post('password'),
		);
		$this->model_usuario->where('id', $user['id']);
		$data["id"] = $this->model_usuario->update($data);

		$this->session->unset_userdata('user');
		$usuario = $this->model_usuario
			->where('nickname', $user['nickname'])
			->where('password', $this->input->post('password'))
			->get();
		$this->session->set_userdata('user', $usuario);
		redirect("/home");
	}
}
