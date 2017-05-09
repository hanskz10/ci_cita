<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function CreateMenu($idUsuario)
	{
		$this->db->select('U.idUsuario, U.nombre, U.apellidos, AU.idUsuario, AU.idMenu, AU.estado, M.idMenu, M.linea, M.descripcion menu, M.url, M.iconos');
		$this->db->from('usuarios U');
		$this->db->join('accesosusuarios AU', 'U.idUsuario = AU.idUsuario');
		$this->db->join('menu M', 'AU.idMenu = M.idMenu');
		$this->db->where('AU.idUsuario', $idUsuario);
		$this->db->where('AU.estado', '1');
		$this->db->order_by('M.idMenu', 'asc');
		$query = $this->db->get();
		return $query->result();
    }

    public function LoginBD($email)
	{
		$this->db->select('U.idUsuario, U.nombre, U.apellidos, U.password, U.idRol, R.descripcion roles');
		$this->db->from('usuarios U');
		$this->db->join('roles R', 'U.idRol = R.idRol');
		$this->db->where('email', $email);
		return $this->db->get()->row();
	}

}