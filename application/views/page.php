<?php

$pagina = $this->uri->segment(1);

switch ($pagina) {
	case 'usuarios':
		echo '<script src="'.base_url().'assets/js/jsonUsuarios.js"></script>';
		break;
	case 'roles':
		echo '<script src="'.base_url().'assets/js/jsonRoles.js"></script>';
		break;
	case 'menu':
		echo '<script src="'.base_url().'assets/js/jsonMenu.js"></script>';
		break;
	case 'permisos':
		echo '<script src="'.base_url().'assets/js/jsonPermisos.js"></script>';
		break;
	case 'especialidades':
		echo '<script src="'.base_url().'assets/js/jsonEspecialidades.js"></script>';
		break;
	case 'doctores':
		echo '<script src="'.base_url().'assets/js/jsonDoctores.js"></script>';
		break;	
	case 'pacientes':
		echo '<script src="'.base_url().'assets/js/jsonPacientes.js"></script>';
		break;
	default:
		break;
}