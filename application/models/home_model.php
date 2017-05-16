<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function LoginBD($email)
	{
		$this->db->select('U.idUsuario, U.nombre, U.apellidos, U.password, U.idRol, R.descripcion roles');
		$this->db->from('usuarios U');
		$this->db->join('roles R', 'U.idRol = R.idRol');
		$this->db->where('email', $email);
		return $this->db->get()->row();
	}
	
	public function CreateMenu($idRol)
    {
    	$this->db->select('U.idUsuario, U.idRol, AM.idMenu, M.linea, M.descripcion menu, M.url, M.iconos, M.estado');
    	$this->db->from('usuarios U');
    	$this->db->join('accesosmenu AM', 'U.idRol = AM.idRol');
		$this->db->join('menu M', 'AM.idMenu = M.idMenu');
		$this->db->where('U.idRol', $idRol);
		$this->db->where('M.linea', '1');
		$this->db->where('M.estado', '1');
		$this->db->order_by('AM.idMenu', 'asc');
		$query = $this->db->get();

		$menu = '';
		foreach ($query->result() as $key => $value) 
		{
			$menu .= '<li class="treeview">';
            $menu .= '<a href="'.$value->url.'">';
            $menu .= '<i class="fa '.$value->iconos.'"></i> <span>'.$value->menu.'</span>';
            $menu .= '<span class="pull-right-container">';
            $menu .= '<i class="fa fa-angle-left pull-right"></i>';
            $menu .= '</span>';
            $menu .= '</a>';
            $menu .= '<ul class="treeview-menu">'.$this->getChildrenMenu($value->idRol, $value->idMenu).'</ul>';
            $menu .= '</li>';
		}

		return $menu;
	}

	public function getChildrenMenu($idRol, $parent)
    {
    	$this->db->select('U.idUsuario, U.idRol, AM.idMenu, M.linea, M.descripcion menu, M.url, M.iconos, M.estado');
    	$this->db->from('usuarios U');
    	$this->db->join('accesosmenu AM', 'U.idRol = AM.idRol');
		$this->db->join('menu M', 'AM.idMenu = M.idMenu');
		$this->db->where('U.idRol', $idRol);
		$this->db->where('M.linea', $parent);
		$this->db->where('M.estado', '1');
		$this->db->order_by('AM.idMenu', 'asc');
		$query = $this->db->get();

		$m_children = '';
		foreach ($query->result() as $key => $value) 
		{
			$m_children .= '<li><a href="'.base_url().$value->url.'"><i class="fa fa-circle-o"></i> '.$value->menu.'</a></li>';		
		}

		return $m_children;
    }

}