<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings_m extends CI_Model {

	private $table = "settings";

	public function __construct(){
		parent::__construct();
		$this->load->database();
	}
	public function insert($data){
		return $this->db->insert($this->table, $data);
	}

	public function getAll(){
		return $this->db->get($this->table)->result();
	}

	public function insertPaymentMethod($data){
		return $this->db->insert("payment_methods", $data);
	}

	public function getAllPaymentMethods(){
		$this->db->order_by('methodId', 'DESC');
		return $this->db->get("payment_methods")->result();
	}

	public function getFilterPaymentMethods($array){
		$this->db->order_by('methodId', 'DESC');
		return $this->db->get_where("payment_methods", $array)->result();
	}

	public function getOnePaymentMethod($array){
		return $this->db->get_where("payment_methods", $array)->row();
	}

	public function updatePaymentMethod($set, $where){
		$this->db->where($where);
		return $this->db->update("payment_methods", $set);
	}

	public function deletePaymentMethod($where){
		$this->db->where($where);
		return $this->db->delete("payment_methods");
	}

	public function getFilter($array){
		$this->db->order_by('id', 'ASC');
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