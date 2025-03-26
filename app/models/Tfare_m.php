<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tfare_m extends CI_Model {

	private $table = "transportation_fare";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function traveling_cost($from, $to){
        return $this->db->get_where($this->table, ['traveling_from' => $from, 'traveling_to' => $to])->row();
    }

    public function insert($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id() > 0;
    }

    public function list_of_destinations(){
        $this->db->select('s.id, s.name, bt.terminal_name')
            ->from('state as s')
            ->join('buses_terminal as bt', 'bt.terminal_state = s.id')
            ->order_by('s.id', 'ASC');
        
        return $this->db->get()->result();
    }

    public function tfares(){
        return $this->db->get($this->table)->result(); 
    }

    public function get_tfare_by_filter($where){
        return $this->db->get_where($this->table, $where)->result();
    }

    public function get_all_discounts(){
        return $this->db->get('discounts')->result();
    }

    public function get_name_from($from){
        return $this->db->get_where('state', ['id' => $from])->row()->name;
    }

    public function count_all()
	{
	    return $this->db->count_all_results('discounts');
	}

    public function get_paginated($limit, $start, $order, $dir)
	{
		$this->db->select('discounts.*')
			->from('discounts')
			->where('active', 1)
            ->like('discount_code', $search)
            ->or_like('applies_to', $search)
	    	->or_like('min_amt', $search)
			->or_like('max_amt', $search)
	    	->or_like('start_date', $search)
            ->or_like('expiry_date', $search)
	    	->order_by($order, $dir)
			->limit($limit, $start);

	    return $this->db->get()->result();
	}

    public function get_search($limit, $start, $search, $order, $dir)
	{
		$this->db->select('discounts.*')
			->from('discounts')
			->where('active', 1)
            ->like('discount_code', $search)
            ->or_like('applies_to', $search)
	    	->or_like('min_amt', $search)
			->or_like('max_amt', $search)
	    	->or_like('start_date', $search)
            ->or_like('expiry_date', $search)
	    	->order_by($order, $dir)
			->limit($limit, $start);

	    return $this->db->get()->result();
	}

    public function count_search($search)
	{
	    $this->db->select('discounts.*')
			->from('discounts')
			->where('active', 1)
            ->like('discount_code', $search)
            ->or_like('applies_to', $search)
	    	->or_like('min_amt', $search)
			->or_like('max_amt', $search)
	    	->or_like('start_date', $search)
            ->or_like('expiry_date', $search)
	    	->order_by($order, $dir)
			->limit($limit, $start);
		
		$query = $this->db->get()->result();

	    return ($query ? count($query) : 0);
	}

    public function delete($tfare_id){
        $this->db->delete($this->table, ['id' => $tfare_id]);
        return $this->db->affected_rows() == 1;
    }

    public function get_discount_by_code($discount_code){
        return $this->db->get_where('discounts', ['discount_code' => $discount_code])->row();
    }

    public function create_discount($discount_data){
        $this->db->insert('discounts', $discount_data);
        return $this->db->insert_id() > 0;
    }

    public function delete_discount($discount_id){
        $this->db->delete('discounts', ['id' => $discount_id]);
        return $this->db->affected_rows() == 1;
    }
    
    public function update_discount($discount_code, $data){
        $this->db->update('discounts', $data, ['discount_code' => $discount_code]);
        return $this->db->affected_rows() == 1;
    }

    public function update($tfare_id, $data){
        $this->db->update($this->table, $data, ['id' => $tfare_id]);
        return $this->db->affected_rows() == 1;
    }

    public function filter_tfare(){
        $this->db->select('MIN(amount) as min_amt, MAX(amount) as max_amt')->from($this->table);
        return $this->db->get()->row();
    }
}