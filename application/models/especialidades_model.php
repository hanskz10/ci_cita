<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Especialidades_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function ListSpecialties()
	{
		$sql = "SELECT  * FROM especialidades ORDER BY descripcion ASC ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function SearchSpecialty($idEspecialidad)
	{
		$sql = "SELECT * FROM especialidades WHERE idEspecialidad = '".$idEspecialidad."' limit 1 ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function SaveSpecialty($array)
	{
		$id = 0;
		$this->db->trans_start();
     	$this->db->insert('especialidades', $array);
     	$id = $this->db->insert_id();
     	$this->db->trans_complete();
     	return $id;
	}
	
	public function UpdateSpecialty($array, $idEspecialidad)
	{
		$this->db->trans_start();
		$this->db->where('idEspecialidad', $idEspecialidad);
		$this->db->update('especialidades', $array); 
		$this->db->trans_complete();
	}

	public function ExistDescription($description)
	{
		$this->db->where("descripcion", $description);
		$check_exists = $this->db->get("especialidades");
		if($check_exists->num_rows() == 0)
		{
			return false;
		} else {
			return true;
		}
	}

	public function DeleteSpecialty($idEspecialidad)
	{
		$this->db->where('idEspecialidad', $idEspecialidad);
		return $this->db->delete('especialidades');
	}

}