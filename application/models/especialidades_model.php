<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Especialidades_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	// 0 --> Mostrará toda la lista de Especialidades
	// 1 --> Mostrará solo los registros con estado Activo
	// 2 --> Mostrará solo los registros con estado Inactivo
	public function ListSpecialties($estado = 0)
	{
		$this->db->select('*');
		$this->db->from('especialidades');
		if($estado != 0)
			$this->db->where('estado', $estado);
		$this->db->order_by("descripcion", "asc");
		$query = $this->db->get(); 
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