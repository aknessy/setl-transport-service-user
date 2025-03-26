<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buses_terminal_m extends CI_Model {

	private $table = "buses_terminal";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_terminals(){
        return $this->db->get($this->table)->result();
    }

    public function get_terminal($id){
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    public function insert($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id() > 0;
    }

    public function update($terminal_id, $data){
        $this->db->update($this->table, $data, ['id' => $terminal_id]);
        return $this->db->affected_rows() > 0;
    }

    public function delete($route_id){
        $this->db->delete($this->table, ['id' => $route_id]);
        return $this->db->affected_rows() > 0;
    }

    public function get_buses_in_terminal($terminal_id){
        $this->db->select('b.id, b.bus_photo, b.bus_plate_number, b.bus_make, b.bus_model')
            ->from('buses as b')
            ->join('buses_terminal as bt', 'bt.id = b.bus_terminal')
            ->where(['b.bus_terminal' => $terminal_id, 'b.decommissioned' => 0]);

        return $this->db->get()->result();
    }

    public function get_buses_count_in_terminal($terminal_id){
        $this->db->select('COUNT(id) as buses_count')
            ->from('buses')
            ->where('start_terminal', $terminal_id);

        return $this->db->get()->row()->buses_count;
    }

    public function count_all()
	{
	    return $this->db->where('activated', 1)->count_all_results($this->table);
	}

    public function get_paginated($limit, $start, $order, $dir)
	{
		$this->db->select('bt.*, st.name as state, lg.name as lga')
			->from($this->table . ' as bt')
            ->join('state as st', 'st.id = bt.terminal_state')
            ->join('lga as lg', 'lg.id = bt.terminal_lga')
			->where('bt.activated', 1)
	    	->order_by($order, $dir)
	    	->limit($limit, $start);

	    return $this->db->get()->result();
	}

    public function get_search($limit, $start, $search, $order, $dir)
	{
		$this->db->select('bt.*, st.name as state, lg.name as lga')
			->from($this->table . ' as bt')
            ->join('state as st', 'st.id = bt.terminal_state')
            ->join('lga as lg', 'lg.id = bt.terminal_lga')
			->where('activated', 1)
	    	->like('terminal_name', $search)
	    	->or_like('st.name', $search)
			->or_like('lg.name', $search)
	    	->order_by($order, $dir)
			->limit($limit, $start);

	    return $this->db->get()->result();
	}

    public function count_search($search)
	{
	    $this->db->select('bt.*, st.name as state, lg.name as lg')
			->from($this->table . ' as bt')
            ->join('state as st', 'st.id = bt.terminal_state')
            ->join('lga as lg', 'lg.id = bt.terminal_lga')
			->where('activated', 1)
	    	->like('terminal_name', $search)
	    	->or_like('st.name', $search)
			->or_like('lg.name', $search);
		
		$query = $this->db->get()->result();

	    return ($query ? count($query) : 0);
	}

    public function check_terminal_exists($terminal_name, $state, $lga){
        $this->db->select('*')
            ->from($this->table)
            ->where(['terminal_state' => $state, 'terminal_lga' => $lga, 'terminal_name' => $terminal_name]);
        
        $query = $this->db->get()->result();

        return (count($query) > 0 ? TRUE : FALSE);
    }

    public function get_terminal_states(){
        return $this->db->get('state')->result();
    }

    public function get_terminal_lgas($state=9){
        return $this->db->get_where('lga', ['state_id' => $state])->result();
    }

    public function filter_terminals($where){
        return $this->db->get_where($this->table, $where)->result();
    }

}