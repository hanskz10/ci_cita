<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function CreaMenu($idUser)
	{
		$sql = "SELECT U.idUsuario, U.nombre, U.apellidos, AU.idUsuario, AU.proteccion, AU.estado, M.idMenu, M.linea, ";
     	$sql = $sql." M.descripcion, M.url, M.iconos FROM usuarios as U INNER JOIN accesosusuarios as AU on U.idUsuario = AU.idUsuario ";
		$sql = $sql." INNER JOIN menu as M on AU.proteccion = M.idMenu WHERE AU.idUsuario = '".$idUser."' AND AU.estado = 1 ORDER BY M.idMenu ASC";
		$query = $this->db->query($sql);
		return $query->result();
    }

    function LoginBD($username)
	{
		$this->db->where('EMAIL', $username);
		//$this->db->where('PASSWORD', $password);
		return $this->db->get('usuarios')->row();
	}

}