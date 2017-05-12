<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Permisos extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('seguridad_model');
		$this->load->model('roles_model');
		$this->load->model('menu_model');
		$this->load->model('permisos_model');
	}

	public function index()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$data['titulo'] = "Lista de permisos";
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$data['roles'] = $this->roles_model->ListRoles();
		$this->load->view('permisos/view_permisos', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');
	}

	public function EditarPermiso($idRol)
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$idRol = base64_decode($idRol);
		$data["titulo"] = "Dar Permisos";
		$data["roles"] = $this->roles_model->SearchRole($idRol);
		$data["menus"] = $this->menu_model->ListMenus(1,1); //Muestra los items con estado activo del menú
		$data["permisos"] = $this->permisos_model->ListPermission($idRol);
		$this->load->view('constant');
		$this->load->view('layout/view_header', $data);
		$this->load->view('permisos/view_nuevo_permiso', $data);
		$this->load->view('layout/view_footer');
		$this->load->view('page');
	}

	public function GuardarPermiso()
	{
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$this->seguridad_model->SessionActivo($url);
		$Permisos = json_decode($this->input->post('PermisosPost'));
		
		$response = array (
			"success" => "",
			"error_msg" => ""
		);

		if(is_null($Permisos->Menu))
		{
			$response["success"] = true;
			$response["error_msg"] = '<div class="alert alert-danger text-center" alert-dismissable> <button type="button" class="close" data-dismiss="alert">&times;</button> El menú es obligatorio.</div>';
		} else {

			if($Permisos->idRol != "")
			{
				$menu = $Permisos->Menu;
				$permisos = $this->permisos_model->ListPermission($Permisos->idRol);

				if(count($permisos) > 0)
				{

					$this->permisos_model->DeletePermissionMenu($Permisos->idRol);

					for ($i=0; $i<count($menu); $i++) 
					{
						$PermisosMenu = array(
							'idRol'		=>	$Permisos->idRol,
							'idMenu'	=>	$menu[$i]
						);

						$this->permisos_model->AddPermissionMenu($PermisosMenu);
					}

				} else {

					for ($i=0; $i<count($menu); $i++) 
					{
						$PermisosMenu = array(
							'idRol'		=>	$Permisos->idRol,
							'idMenu'	=>	$menu[$i]
						);

						$this->permisos_model->AddPermissionMenu($PermisosMenu);
					}

				}
			}

			$response["success"] = true;
			$response["error_msg"] = '<div class="alert alert-success text-center" alert-dismissable> <button type="button" class="close" data-dismiss="alert">&times;</button> Información guardada correctamente.</div>';
			
		}

		echo json_encode($response);
	}

}