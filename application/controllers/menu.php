<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('seguridad_model');
		$this->load->model('menu_model');
	}

	public function index()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$data['titulo'] = "Lista del menú";
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$data['menus'] = $this->menu_model->ListMenus(1);
		$this->load->view('menu/view_menu', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');
	}

	public function NuevoMenu()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$data["titulo"] = "Nuevo Menú";
		$data["list_menus"] = $this->menu_model->ListMenus();
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$this->load->view('menu/view_nuevo_menu', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');
	}

	public function EditarMenu($idMenu)
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$idMenu = base64_decode($idMenu);
		$data["titulo"] = "Editar Menú";
		$data["menu"] = $this->menu_model->SearchMenu($idMenu);
		$data["list_menus"] = $this->menu_model->ListMenus();
		$data["linea"] = $this->menu_model->getLine($idMenu);
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$this->load->view('menu/view_nuevo_menu', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');
	}

	public function GuardarMenu()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$Menu = json_decode($this->input->post('MenuPost'));
		
		$response = array (
			"campo" => "",
			"success" => "",
			"error_msg" => ""
		);

		if($Menu->Descripcion == "")
		{
			$response["campo"] = "descripcion";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>La descripción es obligatoria.</div>";
		} else if($Menu->Linea == "0") {
			$response["campo"] = "linea";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>La línea es obligatoria.</div>";
		} else if($Menu->Url == "") {
			$response["campo"] = "url";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>La url es obligatoria.</div>";
		} else if($Menu->Estado == "0") {
			$response["campo"] = "estado";
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>El estado es obligatorio.</div>";
		} else {
			
			if($Menu->idMenu == "")
			{				
				$AgregarMenu = array(
					'linea'			=>	$Menu->Linea,
					'descripcion'	=>	trim($Menu->Descripcion),
					'url'			=>	trim($Menu->Url),
					'iconos'		=>	trim($Menu->Iconos),
					'estado'		=>	$Menu->Estado
				);				
				$this->menu_model->SaveMenu($AgregarMenu);					

				$response["success"] = true;
				$response["error_msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Información guardada correctamente.</div>";
			} 

			if($Menu->idMenu != "")
			{
				$ActualizarMenu = array(
					'linea'			=>	$Menu->Linea,
					'descripcion'	=>	trim($Menu->Descripcion),
					'url'			=>	trim($Menu->Url),
					'iconos'		=>	trim($Menu->Iconos),
					'estado'		=>	$Menu->Estado
				);
				$this->menu_model->UpdateMenu($ActualizarMenu, $Menu->idMenu);

				$response["success"] = true;
				$response["error_msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button> Información actualizada correctamente.</div>";
			}
			
		}
		echo json_encode($response);
	}

	public function EliminarMenu()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$Menu = json_decode($this->input->post('ElimMenuPost'));
		$idMenu = base64_decode($Menu->idMenu);
		
		$response = array (
			"success"	=> "",
			"error_msg" => ""
		);
		$this->menu_model->DeleteMenu($idMenu);

		$response["success"] = true;
		$response["error_msg"] = "<div class='alert alert-success text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Menú eliminado correctamente, la información se actualizará en unos segundos.</div>";
		echo json_encode($response);
	}

}