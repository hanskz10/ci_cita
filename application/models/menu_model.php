<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	// 0 --> Mostrará toda la lista del menú
	// 1 --> Mostrará solo los registros con estado Activo
	// 2 --> Mostrará solo los registros con estado Inactivo
	public function ListMenus($linea = 0, $estado = 0)
	{
		$this->db->select('*');
		$this->db->from('menu');
		if($estado != 0)
			$this->db->where('estado', $estado);
		if($linea != 0)
			$this->db->where('linea !=', 0);
		$this->db->order_by("idMenu", "asc");
		$query = $this->db->get();
		return $query->result();
	}

	public function getLine($idMenu, $estado = 0)
	{
		$this->db->select('*');
		$this->db->from('menu');
		if($estado != 0)
			$this->db->where('estado', $estado);
		$this->db->where('idMenu', $idMenu);
		$query = $this->db->get();
		foreach ($query->result() as $row)
			return $row->linea;
	}

	public function SearchMenu($idMenu)
	{
		$this->db->select('*')
			 	 ->from('menu')
			 	 ->where('idMenu', $idMenu)
			 	 ->limit(1);
		$query = $this->db->get();
		return $query->result();
	}
	
	public function SaveMenu($array)
	{
		$id = 0;
		$this->db->trans_start();
     	$this->db->insert('menu', $array);
     	$id = $this->db->insert_id();
     	$this->db->trans_complete();
     	return $id;
	}
	
	public function UpdateMenu($array, $idMenu)
	{
		$this->db->trans_start();
		$this->db->where('idMenu', $idMenu);
		$this->db->update('menu', $array); 
		$this->db->trans_complete();
	}

	public function DeleteMenu($idMenu)
	{
		$this->db->where('idMenu', $idMenu);
		return $this->db->delete('menu');
	}

}