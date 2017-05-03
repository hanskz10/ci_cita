<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Doctores extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('seguridad_model');
		$this->load->model('doctores_model');
		$this->load->model('especialidades_model');
	}

	public function index()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$data['titulo'] = "Lista de doctores";
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$data['doctores'] = $this->doctores_model->ListDoctors();
		$this->load->view('doctores/view_doctores', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');		
	}

	public function NuevoDoctor()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$data["titulo"] = "Nuevo Doctor";
		$data["especialidades"] = $this->especialidades_model->ListSpecialties(1);
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$this->load->view('doctores/view_nuevo_doctor', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');
	}

	public function EditarDoctor($idDoctor)
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$idDoctor = base64_decode($idDoctor);
		$data["titulo"] = "Editar Doctor";
		$data["doctores"] = $this->doctores_model->SearchDoctor($idDoctor);
		$data["especialidades"] = $this->especialidades_model->ListSpecialties(1);
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$this->load->view('doctores/view_nuevo_doctor', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');
	}

	public function GuardarDoctor()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$Doctores = json_decode($this->input->post('DoctoresPost'));
		
		$response = array (
			"campo" => "",
			"success" => "",
			"error_msg" => ""
		);
		
		if($Doctores->Nombre == "")
		{
			$response["campo"] = "nombre";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El nombre es obligatorio.</div>";
		} else if($Doctores->Apellidos == "") {
			$response["campo"] = "apellidos";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El apellido es obligatorio.</div>";
		} else if($Doctores->idEspecialidad == "0") {
			$response["campo"] = "especialidad";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>La especialidad es obligatoria.</div>";
		} else if($Doctores->Email == "") {
			$response["campo"] = "email";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>Email obligatorio.</div>";
		} else if($Doctores->Direccion == "") {
			$response["campo"] = "direccion";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>La dirección es obligatoria.</div>";
		} else if($Doctores->Celular == "") {
			$response["campo"] = "celular";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El celular es obligatorio.</div>";		
		} else if($Doctores->Estado == "0") {
			$response["campo"] = "estado";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El estado es obligatorio.</div>";
		} else {
			
			if($Doctores->idDoctor == "")
			{
				$ExisteEmail = $this->doctores_model->ExistEmail($Doctores->Email);
				if($ExisteEmail == true)
				{
					$response["success"] = false;
					$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Email ya existe.</div>";
				} else {
					$AgregarDoctor = array(
					'nombre'			=>	ucwords($Doctores->Nombre),
					'apellidos'			=>	ucwords($Doctores->Apellidos),
					'idEspecialidad'	=>	$Doctores->idEspecialidad,
					'email'				=>	$Doctores->Email,
					'direccion'			=>	$Doctores->Direccion,
					'celular'			=>	$Doctores->Celular,
					'estado'			=>  $Doctores->Estado,
					'fecha_registro'	=>	date('Y-m-j H:i:s')
				);				
				$this->doctores_model->SaveDoctor($AgregarDoctor);					

				$response["success"] = true;
				$response["error_msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Información guardada correctamente.</div>";
				}									
			} 

			if($Doctores->idDoctor != "")
			{
				$ActualizarDoctor = array(
					'nombre'			=>	ucwords($Doctores->Nombre),
					'apellidos' 		=>	ucwords($Doctores->Apellidos),
					'idEspecialidad'	=>	$Doctores->idEspecialidad,
					'email'				=>	$Doctores->Email,
					'direccion'			=>	$Doctores->Direccion,
					'celular'			=>	$Doctores->Celular,
					'estado'	 		=>	$Doctores->Estado,
					'fecha_actualizada'	=>	date('Y-m-j H:i:s')
				);
				$this->doctores_model->UpdateDoctor($ActualizarDoctor, $Doctores->idDoctor);

				$response["success"] = true;
				$response["error_msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Información actualizada correctamente.</div>";
			}
			
		}
		echo json_encode($response);
	}

	public function EliminarDoctor()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$Doctores = json_decode($this->input->post('ElimDoctoresPost'));
		$idDoctor = base64_decode($Doctores->idDoctor);
		
		$response = array (
			"success"	=> "",
			"error_msg" => ""
		);
		$this->doctores_model->DeleteDoctor($idDoctor);

		$response["success"] = true;
		$response["error_msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Doctor eliminado correctamente, la información se actualizara en unos segundos.</div>";
		echo json_encode($response);
	}

}