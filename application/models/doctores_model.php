<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Doctores_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	// 0 --> Mostrará toda la lista de Doctores
	// 1 --> Mostrará solo los registros con estado Activo
	// 2 --> Mostrará solo los registros con estado Inactivo
	public function ListDoctors($estado = 0)
	{
		$this->db->select('d.idDoctor, d.nombre, d.apellidos, d.email, e.descripcion especialidad, d.estado');
		$this->db->from('doctores d');
		$this->db->join('especialidades e', 'd.idEspecialidad = e.idEspecialidad');		
		if($estado != 0)
			$this->db->where('d.estado', $estado);
		$this->db->order_by("d.apellidos", "asc");
		$query = $this->db->get();
		return $query->result();
	}

	public function SearchDoctor($idDoctor)
	{
		$sql = "SELECT * FROM doctores WHERE idDoctor = '".$idDoctor."' limit 1 ";
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function SaveDoctor($array)
	{
		$id = 0;
		$this->db->trans_start();
     	$this->db->insert('doctores', $array);
     	$id = $this->db->insert_id();
     	$this->db->trans_complete();
     	return $id;
	}
	
	public function UpdateDoctor($array, $idDoctor)
	{
		$this->db->trans_start();
		$this->db->where('idDoctor', $idDoctor);
		$this->db->update('doctores', $array); 
		$this->db->trans_complete();
	}

	public function ExistEmail($email)
	{
		$this->db->where("email", $email);
		$check_exists = $this->db->get("doctores");
		if($check_exists->num_rows() == 0)
		{
			return false;
		} else {
			return true;
		}
	}

	public function DeleteDoctor($idDoctor)
	{
		$this->db->where('idDoctor', $idDoctor);
		return $this->db->delete('doctores');
	}

}