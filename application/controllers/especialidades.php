<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Especialidades extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('seguridad_model');
		$this->load->model('especialidades_model');
	}

	public function index()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$data['titulo'] = "Lista de especialidades";
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$data['especialidades'] = $this->especialidades_model->ListSpecialties();
		$this->load->view('especialidades/view_especialidades', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');
	}

	public function NuevaEspecialidad()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$data["titulo"] = "Nueva Especialidad";
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$this->load->view('especialidades/view_nueva_especialidad', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');
	}

	public function EditarEspecialidad($idEspecialidad)
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$idEspecialidad = base64_decode($idEspecialidad);
		$data["especialidades"] = $this->especialidades_model->SearchSpecialty($idEspecialidad);
		$data["titulo"] = "Editar Especialidad";
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$this->load->view('especialidades/view_nueva_especialidad', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');
	}

	public function GuardarEspecialidad()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$Especialidades = json_decode($this->input->post('EspecialidadesPost'));
		
		$response = array (
			"campo" => "",
			"success" => "",
			"error_msg" => ""
		);
		
		if($Especialidades->Descripcion == "")
		{
			$response["campo"] = "descripcion";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>La descripción es obligatoria.</div>";
		} else if($Especialidades->Estado == "0") {
			$response["campo"] = "estado";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El estado es obligatorio.</div>";
		} else {
			
			if($Especialidades->idEspecialidad == "")
			{
				$ExisteDescripcion = $this->especialidades_model->ExistDescription($Especialidades->Descripcion);
				if($ExisteDescripcion == true)
				{
					$response["success"] = false;
					$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>La descripción ya existe.</div>";

				} else {
					$AgregarEspecialidad = array(
						'descripcion'		=>	$Especialidades->Descripcion,
						'estado'			=>  $Especialidades->Estado,
						'fecha_registro'	=>	date('Y-m-j H:i:s')
					);
					$this->especialidades_model->SaveSpecialty($AgregarEspecialidad);					

					$response["success"] = true;
					$response["error_msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Información guardada correctamente.</div>";
				}
				
			} 

			if($Especialidades->idEspecialidad != "")
			{
				$ActualizarEspecialidad = array(
					'descripcion' 		=>	$Especialidades->Descripcion,
					'estado'	 		=>	$Especialidades->Estado,
					'fecha_actualizada'	=>	date('Y-m-j H:i:s')
				);
				$this->especialidades_model->UpdateSpecialty($ActualizarEspecialidad, $Especialidades->idEspecialidad);

				$response["success"] = true;
				$response["error_msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Información actualizada correctamente.</div>";
			}
			
		}
		echo json_encode($response);
	}

	public function EliminarEspecialidad()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$Especialidades = json_decode($this->input->post('ElimEspecialidadesPost'));
		$idEspecialidad = base64_decode($Especialidades->idEspecialidad);
		
		$response = array (
			"success"	=> "",
			"error_msg" => ""
		);
		$this->especialidades_model->DeleteSpecialty($idEspecialidad);

		$response["success"] = true;
		$response["error_msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Especialidad eliminada correctamente, la información se actualizará en unos segundos.</div>";
		echo json_encode($response);
	}

}