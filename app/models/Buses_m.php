<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buses_m extends CI_Model {

	private $table = "buses";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function insert($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id() > 0;
    }

	/**
	 * Get all buses assigned to *active routes
	 */
	public function get_all(){
		$this->db->select('b.*')
			->from($this->table . ' as b')
			//->join('buses_terminal as bt','b.bus_terminal = bt.id', 'LEFT')
			//->join('bus_drivers as bd','b.bus_driver = bd.bus_driver_id', 'LEFT')
			->where('b.decommissioned', 0);
			//->where('br.activated', 1);
		
		return $this->db->get()->result();
	}

	public function get_buses_without_drivers(){
		return $this->db->get_where($this->table, ['bus_driver' => NULL])->result();
	}

	public function count_all()
	{
	    return $this->db->where('decommissioned', 0)->count_all_results($this->table);
	}

	public function get_bus_by_id($id){
		$this->db->select('b.*')
			->from($this->table . ' as b')
			//->join('buses_terminal as bt','b.bus_terminal = bt.id', 'LEFT')	
			->where('b.bus_id', $id);

	    return $this->db->get($this->table)->row();
	}

	public function get_bus_by_plate_number($plate){
		$this->db->select('b.*')
			->from($this->table . ' as b')
			//->join('buses_terminal as bt','b.bus_terminal = bt.id', 'LEFT')
			//->join('bus_drivers as bd','b.bus_driver = bd.bus_driver_id', 'LEFT')			
			->where('b.bus_plate_number', $plate);

	    return $this->db->get($this->table)->row();
	}

	public function get_bus_seats($bus_id){
		return $this->db->get_where('seats', ['bus_id' => $bus_id])->result();
	}

    public function get_paginated($limit, $start, $order, $dir)
	{
		$this->db->select('b.*')
			->from($this->table . ' as b')
			//->join('buses_terminal as bt','b.bus_terminal = bt.id')
	    	->where(['b.decommissioned' => 0])
	    	->order_by($order, $dir)
	    	->limit($limit, $start);

	    return $this->db->get($this->table)->result();
	}

	public function get_search($limit, $start, $search, $order, $dir)
	{
		$this->db->select('b.*')
			->from($this->table . ' as b')
			//->join('buses_terminal as bt','b.bus_terminal = bt.id', 'LEFT')			
			->where('b.decommissioned', 0)
			->or_like('b.bus_make', $search)
			->or_like('b.bus_model', $search)
			->or_like('b.bus_capacity', $search)
			->or_like('b.bus_mileage', $search)
			->or_like('b.bus_color', $search)
			->or_like('b.bus_type',$search)
	    	->order_by($order, $dir)
			->limit($limit, $start);

	    return $this->db->get($this->table)->result();
	}

	public function count_search($search)
	{
	    $this->db->select('b.*')
			->from($this->table . ' as b')			
			->where('b.decommissioned', 0)
			->or_like('b.bus_make', $search)
			->or_like('b.bus_model', $search)
			->or_like('b.bus_capacity', $search)
			->or_like('b.bus_mileage', $search)
			->or_like('b.bus_type',$search)
			->or_like('b.bus_color', $search);
		
		$query = $this->db->get()->result();

	    return ($query ? count($query) : 0);
	}

	public function update($bus_id, $data){
		$this->db->update($this->table, $data, ['bus_id' => $bus_id]);
		return $this->db->affected_rows() == 1;
	}

	public function delete($bus_id){
		$this->db->delete($this->table, ['bus_id' => $bus_id]);
		return $this->db->affected_rows() > 0;
	}

	public function create_bus_seats($data){
		$this->db->insert('seats', $data);
		return $this->db->insert_id() > 0;
	}

	public function update_bus_seats($bus_id, $data){
		$this->db->update($this->table, $data, ['bus_id' => $bus_id]);
		return $this->db->affected_rows() == 1;
	}

	public function update_reserved_seats($bus_id, $seat_id, $reserved){
		$this->db->update('seats', $reserved, ['id' => $seat_id, 'bus_id' => $bus_id]);
		return $this->db->affected_rows() == 1;
	}

	public function get_bus_destination_name($id){
		return $this->db->get_where('state', ['id' => $id])->row();
	}

	public function get_bus_features($bus_id){
		return $this->db->get_where('bus_features', ['bus_id' => $bus_id])->row();
	}

	public function get_bus_by_driver($driver_id){
		return $this->db->get_where($this->table, ['bus_driver' => $driver_id])->row();
	}

	public function create_bus_features($data){
		$this->db->insert('bus_features', $data);
		return $this->db->insert_id() > 0;
	}

	public function get_seat_info($seat_id){
		return $this->db->get_where('seats', ['id' => $seat_id])->row();
	}

	public function count_vacant_seats($bus_id){
		return $this->db->where(['bus_id' => $bus_id, 'is_reserved' => 0])->count_all_results('seats');
	}

	public function create_bus_schedule($data){
		$this->db->insert('bus_schedule', $data);
		return $this->db->insert_id() > 0;
	}

	public function get_bus_schedule($bus_id){
		return $this->db->get_where('bus_schedule', ['bus_id' => $bus_id])->result();
	}

	public function update_bus_schedule($bus_id, $schedule_id, $record){
		$this->db->update('bus_schedule', $record, ['bus_id' => $bus_id, 'id' => $schedule_id]);
		return $this->db->affected_rows() == 1;
	}

	public function filter_bus_manufacturer(){
		$this->db->distinct();
		$this->db->select('bus_make')->from($this->table);
		return $this->db->get()->result();
	}

	public function filter_bus_type(){
		$this->db->distinct();
		$this->db->select('bus_type')->from($this->table);
		return $this->db->get()->result();
	}

	public function filter_schedules(){
		$this->db->distinct();
		$this->db->select('schedule_time')->from('bus_schedule');
		return $this->db->get()->result();
	}

}