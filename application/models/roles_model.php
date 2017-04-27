<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function ListRoles()
	{
		$sql = "SELECT  * FROM roles ORDER BY descripcion ASC ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function SearchRole($idRol)
	{
		$sql = "SELECT * FROM roles WHERE idRol = '".$idRol."' limit 1 ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function SaveRoles($array)
	{
		$id = 0;
		$this->db->trans_start();
     	$this->db->insert('roles', $array);
     	$id = $this->db->insert_id();
     	$this->db->trans_complete();
     	return $id;
	}
	
	public function UpdateRoles($array, $idRol)
	{
		$this->db->trans_start();
		$this->db->where('idRol', $idRol);
		$this->db->update('roles', $array); 
		$this->db->trans_complete();
	}

	public function ExistDescription($description)
	{
		$this->db->where("descripcion", $description);
		$check_exists = $this->db->get("roles");
		if($check_exists->num_rows() == 0)
		{
			return false;
		} else {
			return true;
		}
	}

	public function DeleteRole($idRol)
	{
		$this->db->where('idRol', $idRol);
		return $this->db->delete('roles');
	}

}