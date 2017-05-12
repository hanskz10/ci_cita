<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Permisos_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function ListPermission($idRol = 0)
	{
		$this->db->select('*');
		$this->db->from('accesosmenu');
		if($idRol != 0)
			$this->db->where('idRol', $idRol);
		$this->db->order_by('idMenu', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	public function AddPermissionMenu($array)
	{
		$this->db->trans_start();
     	$this->db->insert('accesosmenu', $array);
     	$this->db->trans_complete();
	}

	public function DeletePermissionMenu($idRol)
	{
		$this->db->trans_start();
		$this->db->where('idRol', $idRol);
		$this->db->delete('accesosmenu');
		$this->db->trans_complete();		
	}	

}