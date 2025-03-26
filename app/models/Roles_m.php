<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Roles_m extends CI_Model {

	private $table = "roles";
 
	public function insert($data){
		return $this->db->insert($this->table, $data);
	}

	public function getAll(){
		return $this->db->get($this->table)->result();
	}

	public function insertFeature($data){
		return $this->db->insert("features", $data);
	}

	public function getAllFeatures(){
		$this->db->order_by('feature_id', 'DESC');
		return $this->db->get("features")->result();
	}

	public function getFilterFeatures($array){
		$this->db->order_by('feature_id', 'DESC');
		return $this->db->get_where("features", $array)->result();
	}

	public function getOneFeature($array){
		return $this->db->get_where("features", $array)->row();
	}

	public function updateFeature($set, $where){
		$this->db->where($where);
		return $this->db->update("features", $set);
	}

	public function deleteFeature($where){
		$this->db->where($where);
		return $this->db->delete("features");
	}

	public function getFilter($array){
		$this->db->order_by('role_id', 'DESC');
		return $this->db->get_where($this->table, $array)->result();
	}

	public function getOne($array){
		return $this->db->get_where($this->table, $array)->row();
	}

	public function update($set, $where){
		$this->db->where($where);
		return $this->db->update($this->table, $set);
	}

	public function delete($where){
		$this->db->where($where);
		return $this->db->delete($this->table);
	}
}