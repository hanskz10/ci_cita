<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Roles extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('seguridad_model');
		$this->load->model('roles_model');
	}

	public function index()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$data['titulo'] = "Lista de roles";
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$data['roles'] = $this->roles_model->ListRoles();
		$this->load->view('roles/view_roles', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');
	}

	public function NuevoRol()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		//$this->seguridad_model->SessionActivo($url);
		$data["titulo"] = "Nuevo Rol";
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$this->load->view('roles/view_nuevo_rol', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');
	}

	public function EditarRol($idRol)
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$idRol = base64_decode($idRol);
		$data["roles"] = $this->roles_model->SearchRole($idRol);
		$data["titulo"] = "Editar Rol";
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$this->load->view('roles/view_nuevo_rol', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');
	}

	public function GuardarRol()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$Roles = json_decode($this->input->post('RolesPost'));
		$ExisteDescripcion = $this->roles_model->ExistDescription($Roles->Descripcion);

		$response = array (
			"campo" => "",
			"success" => "",
			"error_msg" => ""
		);
		
		if($Roles->Descripcion == "")
		{
			$response["campo"] = "descripcion";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>La descripción es obligatoria.</div>";
		} else if($Roles->Estado == "0") {
			$response["campo"] = "estado";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El estado es obligatorio.</div>";
		} else if($ExisteDescripcion == true) {
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>La descripción ya existe.</div>";
		} else {
			
			if($Roles->idRol == "")
			{						
				$RegisterRol = array(
					'descripcion'	=>	ucwords($Roles->Descripcion),
					'estado'		=>  $Roles->Estado
				);				
				$this->roles_model->SaveRoles($RegisterRol);					

				$response["success"] = true;
				$response["error_msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Información guardada correctamente.</div>";					
			} 

			if($Roles->idRol != "")
			{
				$UpdateRol = array(
					'descripcion' 	=>	ucwords($Roles->Descripcion),
					'estado'	 	=>	$Roles->Estado
				);
				$this->roles_model->UpdateRoles($UpdateRol, $Roles->idRol);

				$response["success"] = true;
				$response["error_msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Información actualizada correctamente.</div>";
			}
			
		}
		echo json_encode($response);
	}

	public function EliminarRol()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$Roles = json_decode($this->input->post('ElimRolesPost'));
		$idRol = base64_decode($Roles->idRol);
		
		$response = array (
			"success"	=> "",
			"error_msg" => ""
		);
		$this->roles_model->DeleteRole($idRol);

		$response["success"] = true;
		$response["error_msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Rol eliminado correctamente, la información de actualizara en unos segundos.</div>";
		echo json_encode($response);
	}	

}