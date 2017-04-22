<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('home_model');
	}

	public function index()
	{
		$data['titulo'] = 'Admin Citas';
		if($this->session->userdata('is_logged_in'))
		{
			$this->load->view('constant');
			$this->load->view('layout/view_header', $data);
			$this->load->view('view_home');
			$this->load->view('layout/view_footer');			
		} else {
			$this->load->view('constant');
			$this->load->view('view_login');	
		}		
	}

	function CerrarSesion()
	{
		if($this->session->userdata('is_logged_in'))
        {
        	$this->session->sess_destroy(); 
            redirect('home', 'refresh');
        }
    }

	public function ValidaAcceso()
	{
		session_start();
		$Login = json_decode($this->input->post('LoginPost'));
		$response = array (
			"success"	=> "",
			"error_msg" => ""
	    );

	    if($Login->Email == "")
	    {
	    	$response["success"] = false;
	    	$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable> <button type='button' class='close' data-dismiss='alert'>&times;</button>Email es obligatorio.</div>";
		} else if($Login->Password == "") {
			$response["success"] = false;
			$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>Password obligatorio.</div>";
		} else {
			$user = $this->home_model->LoginBD($Login->Email);  
			if(count($user) == 1) 
			{
				$encrypt = $this->encrypt->sha1($Login->Password);

				if($user->password == $encrypt)
				{
					$rolUser = "Administrador";
					if($user->idRol == 2){ $rolUser = "Vendedor"; }
					$session = array(
						'ID'			=>	$user->idUsuario,
                        'NOMBRE'       	=> 	$user->nombre,
                        'APELLIDOS'    	=> 	$user->apellidos,
                        'EMAIL'        	=> 	$Login->Email,
                        'ROLUSUARIO'  	=> 	$user->idRol,
                        'ROLUSUARIOMS'	=> 	$rolUser,
                        'is_logged_in' 	=> 	TRUE,                 
                    );
					$Menu = $this->home_model->CreaMenu($user->idUsuario);
					//$Menu = json_encode($Menu);
					$this->session->set_userdata($session);//Cargamos la sesion de datos del usuario logeado
	                $_SESSION['Menu'] = $Menu;//cargamos la sesion del menu de acuerdo a los permisos
	                $response['success'] =  true;
	                $response["error_msg"] = '<div class="alert alert-info text-center" alert-dismissable><button type="button" class="close" data-dismiss="alert">&times;</button>Datos ingresados correctamente </div>';
				} else {
					$response['success'] = false;
					$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>Password es inválida </div>";
				}
				
			} else {
				$response['success'] = false;
				$response["error_msg"] = "<div class='alert alert-danger text-center' alert-dismissable><button type='button' class='close' data-dismiss='alert'>&times;</button>Email inválido </div>";
			}
		}
		echo json_encode($response);
	}

}