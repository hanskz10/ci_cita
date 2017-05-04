<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pacientes_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	// 0 --> Mostrará toda la lista de Pacientes
	// 1 --> Mostrará solo los registros con estado Activo
	// 2 --> Mostrará solo los registros con estado Inactivo
	public function ListPatients($estado = 0)
	{
		$this->db->select('*');
		$this->db->from('pacientes');
		if($estado != 0)
			$this->db->where('estado', $estado);
		$this->db->order_by("apellidos", "asc");
		$query = $this->db->get(); 
		return $query->result();
	}

	public function SearchPatient($idPaciente)
	{
		$this->db->select('*');
		$this->db->from('pacientes');
		$this->db->where('idPaciente', $idPaciente);
		$this->db->limit(1);
		$query = $this->db->get(); 
		return $query->result();
	}
	
	public function SavePatient($array)
	{
		$id = 0;
		$this->db->trans_start();
     	$this->db->insert('pacientes', $array);
     	$id = $this->db->insert_id();
     	$this->db->trans_complete();
     	return $id;
	}
	
	public function UpdatePatient($array, $idPaciente)
	{
		$this->db->trans_start();
		$this->db->where('idPaciente', $idPaciente);
		$this->db->update('pacientes', $array); 
		$this->db->trans_complete();
	}

	public function ExistEmail($email)
	{
		$this->db->where("email", $email);
		$check_exists = $this->db->get("pacientes");
		if($check_exists->num_rows() == 0)
		{
			return false;
		} else {
			return true;
		}
	}

	public function DeletePatient($idPaciente)
	{
		$this->db->where('idPaciente', $idPaciente);
		return $this->db->delete('pacientes');
	}

}