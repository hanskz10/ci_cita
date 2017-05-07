<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pacientes extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('seguridad_model');
		$this->load->model('pacientes_model');
	}

	public function index()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$data['titulo'] = "Lista de pacientes";
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$data['pacientes'] = $this->pacientes_model->ListPatients();
		$this->load->view('pacientes/view_pacientes', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');
	}

	public function NuevoPaciente()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$data["titulo"] = "Nuevo Paciente";
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$this->load->view('pacientes/view_nuevo_paciente', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');
	}

	public function EditarPaciente($idPaciente)
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$idPaciente = base64_decode($idPaciente);
		$data["titulo"] = "Editar Paciente";
		$data["pacientes"] = $this->pacientes_model->SearchPatient($idPaciente);
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$this->load->view('pacientes/view_nuevo_paciente', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');
	}

	public function GuardarPaciente()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$Pacientes = json_decode($this->input->post('PacientesPost'));
		
		$response = array (
			"campo" => "",
			"success" => "",
			"error_msg" => ""
		);
		
		if($Pacientes->Nombre == "")
		{
			$response["campo"] = "nombre";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>El nombre es obligatorio.</div>";
		} else if($Pacientes->Apellidos == "") {
			$response["campo"] = "apellidos";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El apellido es obligatorio.</div>";
		} else if($Pacientes->Email == "") {
			$response["campo"] = "email";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>Email obligatorio.</div>";
		} else if($Pacientes->Direccion == "") {
			$response["campo"] = "direccion";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>La dirección es obligatoria.</div>";
		} else if($Pacientes->Celular == "") {
			$response["campo"] = "celular";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El celular es obligatorio.</div>";		
		} else if($Pacientes->Estado == "0") {
			$response["campo"] = "estado";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El estado es obligatorio.</div>";
		} else {
			
			if($Pacientes->idPaciente == "")
			{
				$ExisteEmail = $this->pacientes_model->ExistEmail($Pacientes->Email);
				if($ExisteEmail == true)
				{
					$response["success"] = false;
					$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Email ya existe.</div>";
				} else {
					$AgregarPaciente = array(
					'nombre'			=>	ucwords($Pacientes->Nombre),
					'apellidos'			=>	ucwords($Pacientes->Apellidos),
					'email'				=>	$Pacientes->Email,
					'direccion'			=>	$Pacientes->Direccion,
					'celular'			=>	$Pacientes->Celular,
					'estado'			=>  $Pacientes->Estado,
					'fecha_registro'	=>	date('Y-m-j H:i:s')
				);				
				$this->pacientes_model->SavePatient($AgregarPaciente);					

				$response["success"] = true;
				$response["error_msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Información guardada correctamente.</div>";
				}									
			} 

			if($Pacientes->idPaciente != "")
			{
				$ActualizarPaciente = array(
					'nombre'			=>	ucwords($Pacientes->Nombre),
					'apellidos' 		=>	ucwords($Pacientes->Apellidos),
					'email'				=>	$Pacientes->Email,
					'direccion'			=>	$Pacientes->Direccion,
					'celular'			=>	$Pacientes->Celular,
					'estado'	 		=>	$Pacientes->Estado,
					'fecha_actualizada'	=>	date('Y-m-j H:i:s')
				);
				$this->pacientes_model->UpdatePatient($ActualizarPaciente, $Pacientes->idPaciente);

				$response["success"] = true;
				$response["error_msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Información actualizada correctamente.</div>";
			}
			
		}
		echo json_encode($response);
	}

	public function EliminarPaciente()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$Pacientes = json_decode($this->input->post('ElimPacientesPost'));
		$idPaciente = base64_decode($Pacientes->idPaciente);
		
		$response = array (
			"success"	=> "",
			"error_msg" => ""
		);
		$this->pacientes_model->DeletePatient($idPaciente);

		$response["success"] = true;
		$response["error_msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Paciente eliminado correctamente, la información se actualizará en unos segundos.</div>";
		echo json_encode($response);
	}

}