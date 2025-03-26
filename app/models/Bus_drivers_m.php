<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bus_drivers_m extends CI_Model {

	private $table = "bus_drivers";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_bus_drivers(){
        return $this->db->get($this->table)->result();
    }

    public function get_driver_by_id($bus_driver_id){
        $this->db->select('bd.*, bt.terminal_name')
			->from($this->table . ' as bd')
			->join('buses_terminal as bt','bd.terminal_id = bt.id')
			->where('bd.bus_driver_id', $bus_driver_id);

        return $this->db->get()->row();
    }

    public function get_driver_assigned_to_bus($bus_id){
		$this->db->select('bd.*')
			->from($this->table . ' as bd')
			->join('buses as b', 'b.bus_driver = bd.bus_driver_id')
			->where('b.bus_id', $bus_id);

        return $this->db->get_where($this->table, ['bus_id' => $bus_id])->row();
    }

    public function count_all()
	{
	    return $this->db->where(['active' => 1, 'deleted' => 0])->count_all_results($this->table);
	}

    public function get_paginated($limit, $start, $order, $dir)
	{
		$this->db->select('bd.*, bt.terminal_name')
			->from($this->table . ' as bd')
			->join('buses_terminal as bt','bd.terminal_id = bt.id', 'LEFT')
			->where(['bd.active' => 1,'bd.deleted' => 0])
	    	->order_by($order, $dir)
	    	->limit($limit, $start);

	    return $this->db->get($this->table)->result();
	}

    public function get_search($limit, $start, $search, $order, $dir)
	{
		$this->db->select('bd.*, bt.terminal_name')
			->from($this->table . ' as bd')
			->join('buses_terminal as bt','bd.terminal_id = bt.id', 'LEFT')
			->where(['bd.active' => 1,'bd.deleted' => 0])
	    	->like('bd.first_name', $search)
			->or_like('bd.last_name', $search)
	    	->or_like('bd.username', $search)
			->or_like('bd.phone_number', $search)
            ->or_like('bd.date_of_birth', $search)
            ->or_like('bd.age', $search)
	    	->order_by($order, $dir)
			->limit($limit, $start);

	    return $this->db->get($this->table)->result();
	}

    public function count_search($search)
	{
	    $this->db->select('bd.*, bt.terminal_name')
			->from($this->table . ' as bd')
			->join('buses_terminal as bt','bd.terminal_id = bt.id', 'LEFT')
			->where(['bd.active' => 1,'bd.deleted' => 0])
	    	->like('bd.first_name', $search)
			->or_like('bd.last_name', $search)
	    	->or_like('bd.username', $search)
			->or_like('bd.phone_number', $search)
            ->or_like('bd.date_of_birth', $search)
            ->or_like('bd.age', $search);
		
		$query = $this->db->get()->result();

	    return ($query ? count($query) : 0);
	}

    public function check_if_driver_exists($where){
        return $this->db->get_where($this->table, $where)->result();
    }

    public function insert($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id() > 0;
    }

	public function update($bus_driver_id, $data){
		$this->db->update($this->table, $data, ['bus_driver_id' => $bus_driver_id]);
		return $this->db->affected_rows() == 1;
	}

}