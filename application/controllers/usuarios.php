<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('seguridad_model');
		$this->load->model('usuarios_model');
	}

	public function index()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$data['titulo'] = "Lista de usuarios";
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$data['usuarios'] = $this->usuarios_model->ListarUsuarios();
		$this->load->view('usuarios/view_usuarios', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');
	}

	public function deleteuser()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$Usuarios = json_decode($this->input->post('ElimUsuariosPost'));
		$idUsuario = base64_decode($Usuarios->idUsuario);
		/*Array de response*/
		$response = array (
			"success"	=> "",
			"error_msg" => ""
		);
		$this->usuarios_model->EliminarUsuario($idUsuario);

		$response["success"] = true;
		$response["error_msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Usuario eliminado correctamente, la información de actualizara en unos segundos.</div>";
		echo json_encode($response);
	}

	public function nuevo()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		//$this->seguridad_model->SessionActivo($url);
		$data["titulo"] = "Nuevo Usuario";
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$this->load->view('usuarios/view_nuevo_usuario', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');
	}

	public function Editar($idUsuario)
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$idUsuario = base64_decode($idUsuario);
		$data["usuarios"] = $this->usuarios_model->BuscarUsuario($idUsuario);
		$data["titulo"] = "Editar Usuario";
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$this->load->view('usuarios/view_nuevo_usuario', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');
	}

	public function Save()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$Usuarios = json_decode($this->input->post('UsuariosPost'));
		$response = array (
			"campo" => "",
			"success" => "",
			"error_msg" => "",
			"log_error" => ""
		);
		
		if($Usuarios->Nombre == "")
		{
			$response["campo"] = "nombre";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El nombre es obligatorio.</div>";
		} else if($Usuarios->Apellidos == "") {
			$response["campo"] = "apellidos";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El apellido es obligatorio.</div>";
		} else if($Usuarios->Email == "") {
			$response["campo"] = "email";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El email es obligatorio.</div>";
		} else if($Usuarios->Password1 == "") {
			$response["campo"] = "password1";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>Password obligatorio.</div>";
		} else if($Usuarios->Password2 == "") {
			$response["campo"] = "password2";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>La confirmación del password es obligatorio.</div>";
		} else if($Usuarios->idRol == "0") {
			$response["campo"] = "id_rol";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El rol es obligatorio.</div>";
		} else if($Usuarios->Estado == "0") {
			$response["campo"] = "estado";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El estado es obligatorio.</div>";
		} else if($Usuarios->Password1 != $Usuarios->Password2) {
			$response["campo"] = "password2";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>La confirmación del password es incorrecta.</div>";
		} else {
			
			if($Usuarios->idUsuario == "")
			{
				$ExisteEmail = $this->usuarios_model->ExisteEmail($Usuarios->Email);
				if($ExisteEmail == true)
				{
					$response["campo"] = "email";
					$response["success"] = false;
					$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El email ya existe.</div>";
				} else {					
					
					$RegistraUser = array(
						'nombre'		 =>	 ucwords($Usuarios->Nombre),
						'apellidos'		 =>  ucwords($Usuarios->Apellidos),
						'email'			 =>  $Usuarios->Email,
						'password' 		 =>  $this->encrypt->sha1($Usuarios->Password1),
						'idRol'			 =>  $Usuarios->idRol,
						'estado'		 =>  $Usuarios->Estado,
						'fecha_registro' =>  date('Y-m-j H:i:s')
					);
					
					$idUsers = $this->usuarios_model->SaveUsuarios($RegistraUser);					

					//Asignamos Permisos Administrador
					if($Usuarios->idRol == "1")
					{
						for ($i = 2; $i <= 13; $i++) 
						{
							$arrayPermisos = array(
								'idUsuario'	 => $idUsers,
								'proteccion' => $i,
								'estado'   	 => 1
							);
							$this->usuarios_model->AsignaPermisosAdmin($arrayPermisos);
						}
					}

					//Asignamos Permisos Vendedor
					if($Usuarios->idRol == "2")
					{
						for ($i = 9; $i <= 13; $i++) 
						{
							$arrayPermisos = array(
								'idUsuario'   => $idUsers,
								'proteccion'  => $i,
								'estado'   	  => 1
							);
							$this->usuarios_model->AsignaPermisosAdmin($arrayPermisos);
						}
					}
					
					$response["success"] = true;
					$response["error_msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Información guardada correctamente.</div>";
					
				}				
			} 

			if($Usuarios->idUsuario != "")
			{
				$newPassword = $Usuarios->Password1;
				$newPassword = strlen($newPassword);
				
				if($newPassword >= 20)
				{
					$newPassword = $Usuarios->Password1;
				} else {
					$newPassword = $this->encrypt->sha1($Usuarios->Password1);
				}				
				$UpdateUser = array(
					'nombre'		 	=>	ucwords($Usuarios->Nombre),
					'apellidos'		 	=>	ucwords($Usuarios->Apellidos),
					'email'			 	=>	$Usuarios->Email,
					'password'		 	=>	$newPassword,
					'idRol'			 	=>	$Usuarios->idRol,
					'estado'		 	=>	$Usuarios->Estado,
					'fecha_actualizada' =>	date('Y-m-j H:i:s')
				);
				$this->usuarios_model->UpdateUsers($UpdateUser, $Usuarios->idUsuario);
				$response["success"] = true;
				$response["error_msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Información actualizada correctamente.</div>";
			}
			
		}
		echo json_encode($response);
	}

}