<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_m extends CI_Model {

	private $table = "staff";

	public function insert($data){
		return $this->db->insert($this->table, $data);
	}

	public function getAll(){
		// $this->db->order_by('faqId', 'DESC');
		$this->db->join('roles', 'roles.role_id=staff.role_id');
		$this->db->order_by('id', 'DESC');
		return $this->db->get_where($this->table, ['deleted' => 0])->result();
	}

	public function count_all()
	{
	    return $this->db->where('deleted', 0)->count_all_results($this->table);
	}

	public function count_search($search)
	{
	    $this->db->like('first_name', $search);
	    $this->db->or_like('last_name', $search);
	    $this->db->or_like('username', $search);
	    $this->db->where('deleted', 0);
	    return $this->db->count_all_results($this->table);
	}

	public function get_paginated($limit, $start, $order, $dir)
	{
			$this->db->select('staff.*, roles.*');
			$this->db->join('roles', 'roles.role_id=staff.role_id');
	    // $this->db->join('tax_offices', 'tax_offices.id = staff.taxoffice_id');
	    $this->db->where('staff.deleted', 0);
	    $this->db->order_by($order, $dir);
	    $this->db->limit($limit, $start);
	    return $this->db->get($this->table)->result();
	}

	public function get_search($limit, $start, $search, $order, $dir)
	{
			$this->db->select('staff.*, roles.*');
			$this->db->join('roles', 'roles.role_id=staff.role_id');
	    // $this->db->join('tax_offices', 'tax_offices.id = staff.taxoffice_id');
	    $this->db->like('staff.first_name', $search);
	    $this->db->or_like('staff.last_name', $search);
	    $this->db->or_like('staff.username', $search);
	    $this->db->where('staff.deleted', 0);
	    $this->db->order_by($order, $dir);
	    $this->db->limit($limit, $start);
	    return $this->db->get($this->table)->result();
	}


public function countFiltered($search = null)
{
    $this->db->from('staff')
             ->join('roles', 'roles.role_id = staff.role_id', 'left')
             // ->join('tax_office', 'tax_office.id = staff.taxoffice_id', 'left')
             ->where('staff.deleted', 0);

    if (!empty($search)) {

        $this->db->like('staff.first_name', $search);
        $this->db->or_like('staff.last_name', $search);
        $this->db->or_like('staff.username', $search);
        $this->db->or_like('staff.phone', $search);
        $this->db->or_like('roles.role', $search);

    }

    return $this->db->count_all_results();
}

public function countAll()
{
    $this->db->from('staff')
             ->where('deleted', 0);

    return $this->db->count_all_results();
}


	public function getFilter($array){
		$array['deleted'] = 0;
		$this->db->join('roles', 'roles.role_id=staff.role_id');
		$this->db->order_by('id', 'DESC');
		return $this->db->get_where($this->table, $array)->result();
	}

	public function delete_staff($userID, $array){
		$this->db->where('id', $userID);
		$this->db->update($this->table, $array);
	}

	public function getOne($array){
		$array['deleted'] = 0;
		$this->db->join('roles', 'roles.role_id=staff.role_id');
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

	public function verify_otp($otp, $email)
	{
		$this->db->select('email, otp, otp_expiry');
		$this->db->where('otp', $otp);
		$this->db->where('email', $email);
		return $this->db->get($this->table)->row();
	}

	public function get_drivers(){
		return $this->db->get_where('staff', ['designation' => 'Driver'])->result();
	}

	public function get_staff_by_id($staff_id){
		return $this->db->get_where('staff', ['id' => $staff_id])->row();
	}

}