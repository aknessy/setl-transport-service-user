<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_m extends CI_Model {

	private $table = "customers";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function create_customer($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_customer($customer_id){
        return $this->db->get_where($this->table, ['customer_id' => $customer_id])->row();
    }

    public function get_customer_by_id($id){
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function check_email_exists($email){
        return $this->db->get_where($this->table, ['email' => $email])->row();
    }

    public function verify_email($code){
        return $this->db->get_where($this->table, ['verification_code' => $code])->row();
    }

    public function update_customer_info($where, $data){
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows() == 1;
    }

    public function get_states(){
        return $this->db->get('state')->result();
    }

    public function get_lgas($state=9){
        return $this->db->get_where('lga', ['state_id' => $state])->result();
    }

    public function get_travel_history($customer_id){
        $this->db->select('bk.*, inv.*')
            ->from('bookings as bk')
            ->join('invoice as inv', 'inv.customer_id = bk.customer_id', 'LEFT')
            ->where('inv.status', 'PAID')
            ->where('bk.customer_id', $customer_id);

            return $this->db->get()->result();
    }

    public function count_all_user_journeys($customer_id)
	{
	    $this->db->select('bk.*, inv.*')
            ->from('bookings as bk')
            ->join('invoice as inv', 'inv.customer_id = bk.customer_id', 'LEFT')
            ->where('inv.status', 'PAID')
            ->where('bk.customer_id', $customer_id);        
        
        $query = $this->db->get()->result();

        return ($query ? count($query) : 0);
	}

    public function get_customer_travels_search($customer_id, $limit, $start, $search, $order, $dir)
	{
		$this->db->select('bk.*, inv.*, bs.*')
            ->from('bookings as bk')
            ->join('invoice as inv', 'inv.customer_id = bk.customer_id', 'LEFT')
            ->join('buses as bs', 'bk.bus_id = bs.bus_id', 'LEFT')
            ->where('inv.status', 'PAID')
            ->where('bk.customer_id', $customer_id)
			->or_like('bk.departure_date', $search)
			->or_like('bk.departure_time', $search)
			->or_like('bs.bus_make', $search)
			->or_like('bs.bus_model', $search)
	    	->order_by($order, $dir)
			->limit($limit, $start);

	    return $this->db->get($this->table)->result();
	}

    public function get_customer_travels_search_count($customer_id, $limit, $start, $search, $order, $dir)
	{
		$this->db->select('bk.*, inv.*, bs.*')
            ->from('bookings as bk')
            ->join('invoice as inv', 'inv.customer_id = bk.customer_id', 'LEFT')
            ->join('buses as bs', 'bk.bus_id = bs.bus_id', 'LEFT')
            ->where('inv.status', 'PAID')
            ->where('bk.customer_id', $customer_id)
			->or_like('bk.departure_date', $search)
			->or_like('bk.departure_time', $search)
			->or_like('bs.bus_make', $search)
			->or_like('bs.bus_model', $search)
	    	->order_by($order, $dir)
			->limit($limit, $start);

	    $query = $this->db->get()->result();

        return ($query ? count($query) : 0);
	}

    public function get_customer_travels_search_paginated($customer_id, $limit, $start, $order, $dir)
	{
		$this->db->select('bk.*, inv.*, bs.*')
            ->from('bookings as bk')
            ->join('invoice as inv', 'inv.customer_id = bk.customer_id', 'LEFT')
            ->join('buses as bs', 'bk.bus_id = bs.bus_id', 'LEFT')
            ->where('inv.status', 'PAID')
            ->where('bk.customer_id', $customer_id)
	    	->order_by($order, $dir)
			->limit($limit, $start);

	    return $this->db->get()->result();
	}

}