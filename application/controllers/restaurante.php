<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurante extends CI_Controller {

    private $nav;

	public function __construct(){
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

	private function controlAcceso($id){
		$user = json_decode(json_encode($this->session->userdata('user')), true);
		if (is_null($user) or $user['id'] != $id or is_null($user['rut'])) {
			$this->load->view('main/navbar', $this->nav);
			$this->load->view('errors/index');
			return false;
		}
		return true;
	}

	private function infoGeneral($id){
		$user = $this->model_usuario->get($id);
		$lImg = $this->model_usuario->getImgpefil($id);
		$servicios = $this->model_servicio->serviciosDisponibles($id);
		
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
	public function principal($id){

		$data = $this->infoGeneral($id);
		
		$carusel = array();
		for ($i=0; $i < sizeof($data["img"]) ; $i++) { 
			$carusel[] = array(
				"class" => "",
				"img" => $data["img"][$i]["img"],
				"index" => $i
			);
		}
		if (sizeof($data["img"]) > 0) {
			$carusel[0]["class"] = "active";
		} 
		$data["carusel"] = $carusel;

		$this->load->view('main/navbar', $this->nav);
		$this->load->view('restaurante/restaurante-index', $data);
	}

	public function editar($id){

		if($this->controlAcceso($id)){
			$data = $this->infoGeneral($id);
			$this->load->view('main/navbar', $this->nav);
			$this->load->view('restaurante/restaurante-editar', $data);
		}
	}

	public function imagenes($id){
		$user = json_decode(json_encode($this->session->userdata('user')), true);

		if($this->controlAcceso($id)){
			if (isset($_FILES['img'])) {
				$avatar = $this->uploadImg($id);
				if($avatar != null) {
					$data = array(
						"img" => $avatar,
						"id_restaurante" => $id
					);
					$this->model_imagen->insert($data);
				}
			}
			$data = $this->infoGeneral($id);
			$this->load->view('main/navbar', $this->nav);
			$this->load->view('restaurante/restaurante_upload_Img', $data);
		}
	}

	public function imagenesdelete($id){
		
		$user = json_decode(json_encode($this->session->userdata('user')), true);
		$data = $this->model_imagen->get($id);
		$user_id = $data->id_restaurante;
		$data->is_active = false;
		$this->model_imagen->update($data, $id);
		redirect("restaurante/imagenes/".$user_id);
	}



	public function editarDatos($id){
		if($this->controlAcceso($id)){
			$user = json_decode(json_encode($this->session->userdata('user')), true);
			if ($id == $user['id']) {
				if ( $this->input->post('actpassword') == $user['password']) {
					$data = array(
						"id" => $id,
						"nickname" => $this->input->post('nickname'),
						"nombre" => $this->input->post('nombre'),
						"rut" => $this->input->post('rut'),
						"direccion" => $this->input->post('direccion'),
						"zona" => $this->input->post('zona'),
						"telefono" => $this->input->post('telefono'),
						"email" => $this->input->post('email'),
						"apellido" => $this->input->post('apellido'),
						"fecha_de_nacimiento" => $this->input->post('fecha_de_nacimiento'),
						"lat" => $this->input->post('lat'),
						"lng" => $this->input->post('lng')
					);
					if ($this->input->post('password') == $this->input->post('repassword') ){
						$data["password"] = $this->input->post('password');
					}				
					if (isset($_FILES['img'])){
	

							$config['upload_path'] = './uploads/';
							$config['allowed_types'] = 'gif|jpg|png';
							$this->load->library('upload');
							$this->upload->initialize($config);
							if ( ! $this->upload->do_upload('img')){
								$this->session->set_userdata('msg_error', $this->upload->display_errors());
							}else{
								$upload_data = $this->upload->data();
							
								$config['image_library'] = 'gd2';
								$config['source_image'] = $upload_data['full_path'];
								$config['maintain_ratio'] = TRUE;
								$config['width']     = 200;
								$config['height']   = 200;
								$this->load->library('image_lib', $config); 
								$this->image_lib->resize();
	
								$data["avatar"] = './uploads/' . $this->upload->data()["client_name"];
								 
							}

						
						
					}
					$this->model_usuario->update($data,"id");
					$this->session->set_userdata('user',$data);
				} else {
					$this->session->set_userdata('msg_error', "la contraseña no coincide");
				}
			} else {
				$this->session->set_userdata('msg_error', "No estas autorizado");
			}
			$data = $this->infoGeneral($id);
			$this->load->view('main/navbar', $this->nav);
			$this->load->view('restaurante/restaurante-datos', $data);
		}
	}

	public function uploadImg($id){

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload');
		$this->upload->initialize($config);
		if ( ! $this->upload->do_upload('img')){
			$this->session->set_userdata('msg_error', $this->upload->display_errors());
		}else{
			return './uploads/' . $this->upload->data()["client_name"];
		}
		return null;
	}


	/**
	 * SERVICIOS - esto deberia ir en otro controlador pero por ahora lo dejo aca
 	 */


	public function servicios($id){
		if($this->controlAcceso($id)){
			$data = $this->infoGeneral($id);
			$this->load->view('main/navbar', $this->nav);
			$this->load->view('restaurante/restaurante-servicios',$data);
		}
		
	}

	public function existeServicio(){
		$user = json_decode(json_encode($this->session->userdata('user')), true);
		$data = array(
			"nombre" => $this->input->post('nombre'),
			"id_restaurante" => $user['id']
		);
		header('Content-Type: application/json');
		try {
			$exist = $this->model_servicio->existeNombreServicio($data);
			echo json_encode( array('status' => true , "body" => $exist ) );
		} catch (\Throwable $th) {
			echo json_encode( array('status' => false , "body" => $th ) );
		}
	}

	public function nuevoServicio(){

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
		redirect("/restaurante/servicios/".$user["id"]);
	}

	public function modificarServicio(){

		$user = json_decode(json_encode($this->session->userdata('user')), true);
        $data = array(
			"nombre" => $this->input->post('nombre'),
            "descripcion" => $this->input->post('descripcion'),
            "precio" => $this->input->post('precio'),
            "id" => $this->input->post('id'),
            "imagen" => null
		);    

		$data["id"] = $this->model_servicio->modificar($data);
		redirect("/restaurante/servicios/".$user["id"]);
	}

	public function eliminarServicio(){

		$user = json_decode(json_encode($this->session->userdata('user')), true);
        $data = array(
            "id" => $this->input->post('id')
		);    
		
		$data["id"] = $this->model_servicio->eliminar($data);
		redirect("/restaurante/servicios/".$user["id"]);
	}

}
