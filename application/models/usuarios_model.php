<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	public function ListarUsuarios()
	{
		$sql = "SELECT  * FROM usuarios ORDER BY nombre ASC ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function BuscarUsuario($idUsuario)
	{
		$sql = "SELECT * FROM usuarios WHERE idUsuario = '".$idUsuario."' limit 1 ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function SaveUsuarios($array)
	{
		$id = 0;
		$this->db->trans_start();
     	$this->db->insert('usuarios', $array);
     	$id = $this->db->insert_id();
     	$this->db->trans_complete();
     	return $id;
	}

	public function UpdateUsers($array, $idUsuario)
	{
		$this->db->trans_start();
		$this->db->where('idUsuario', $idUsuario);
		$this->db->update('usuarios', $array); 
		$this->db->trans_complete();
	}

	public function ExisteEmail($email)
	{
		$this->db->where("EMAIL", $email);
        $check_exists = $this->db->get("usuarios");
        if($check_exists->num_rows() == 0)
        {
        	return false;
        }else{
            return true;
        }
	}

	public function EliminarUsuario($idUsuario)
	{
		$this->db->where('idUsuario', $idUsuario);
		return $this->db->delete('usuarios');
	}

	public function AsignaPermisosAdmin($array)
	{
		$this->db->trans_start();
     	$this->db->insert('accesosusuarios', $array);
     	$this->db->trans_complete();
	}

}
