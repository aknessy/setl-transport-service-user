<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seats_m extends CI_Model {

	private $table = "seats";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_seats(){
        return $this->db->get($this->table)->result();
    }

    public function get_bus_seat_by_id($bus_id, $seat_id){
        return $this->db->get_where($this->table, ['bus_id' => $bus_id, 'id' => $seat_id])->row();
    }

    public function count_all_bus_seats($bus_id){
        return $this->db->where('bus_id', $bus_id)->count_all_results($this->table);
    }

    public function count_all_buses_seats(){
        $this->db->select('b.bus_id, b.bus_photo, b.bus_plate_number, b.bus_capacity, b.bus_make, b.bus_model, s.id, COUNT(s.id) as numOfSeats')
            ->from('buses as b')
            ->join('seats as s', 'b.bus_id = s.bus_id')
            ->group_by('b.bus_id');

        $query = $this->db->get()->result();

        return ($query ? count($query) : 0);
    }

    public function search_seats_by_bus($bus_id, $limit, $start, $search, $order, $dir)
	{
		$this->db->select('s.*, b.bus_capacity, b.bus_plate_number, b.bus_make, b.bus_model, b.created_on')
            ->from($this->table . ' as s')
            ->join('buses as b', 'b.bus_id = s.bus_id')
            ->where('s.bus_id', $bus_id)
			->or_like('b.bus_make', $search)
			->or_like('b.bus_model', $search)
			->or_like('s.seat_type', $search)
			->or_like('s.seat_type', $search)
			->or_like('s.seat_amt', $search)
	    	->order_by($order, $dir)
			->limit($limit, $start);

	    return $this->db->get($this->table)->result();
	}

    public function count_search_seats_by_bus($bus_id, $search)
	{
	    $this->db->select('s.*, b.bus_capacity, b.bus_plate_number, b.bus_make, b.bus_model, b.created_on')
            ->from($this->table . ' as s')
            ->join('buses as b', 'b.bus_id = s.bus_id')
            ->where('s.bus_id', $bus_id)
			->or_like('b.bus_make', $search)
			->or_like('b.bus_model', $search)
			->or_like('s.seat_type', $search)
			->or_like('s.seat_type', $search)
			->or_like('s.seat_amt', $search);
		
		$query = $this->db->get()->result();

	    return ($query ? count($query) : 0);
	}

    public function get_paginated_seats_by_bus($bus_id, $limit, $start, $order, $dir)
	{
		$this->db->select('s.*, b.bus_capacity, b.bus_plate_number, b.bus_make, b.bus_model, b.created_on')
            ->from($this->table . ' as s')
            ->join('buses as b', 'b.bus_id = s.bus_id')
            ->where('s.bus_id', $bus_id)
	    	->order_by($order, $dir)
	    	->limit($limit, $start);

	    return $this->db->get($this->table)->result();
	}

    public function search_seats($limit, $start, $search, $order, $dir){
        $this->db->select('b.bus_id, b.bus_plate_number, b.bus_photo, b.bus_capacity, b.bus_make, b.bus_model, b.created_on')
            ->from('buses as b')
			->or_like('b.bus_make', $search)
			->or_like('b.bus_model', $search)
			->or_like('b.bus_capacity', $search)
	    	->order_by($order, $dir)
            ->group_by('b.bus_id')
			->limit($limit, $start);

	    return $this->db->get($this->table)->result();
    }

    public function count_searched_seats($search){
        $this->db->select('b.bus_id, b.bus_plate_number, b.bus_photo, b.bus_capacity, b.bus_make, b.bus_model, b.created_on')
            ->from('buses as b')
            ->or_like('b.bus_make', $search)
			->or_like('b.bus_model', $search)
			->or_like('b.bus_capacity', $search)
            ->group_by('b.bus_id');

        $query = $this->db->get()->result();

        return ($query ? count($query) : 0);
    }

    public function get_paginated_seats($limit, $start, $order, $dir){
        $this->db->select('b.bus_id, b.bus_plate_number, b.bus_photo, b.bus_capacity, b.bus_make, b.bus_model, b.created_on')
            ->from('buses as b')		
	    	->order_by($order, $dir)
            ->group_by('b.bus_id')
			->limit($limit, $start);

	    return $this->db->get($this->table)->result();
    }

    public function insert($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id() > 0;
    }

    public function get_bus_seats($bus_id){
        $this->db->select('s.*, b.bus_capacity, b.bus_plate_number, b.bus_make, b.bus_model')
            ->from($this->table . ' as s')
            ->join('buses as b', 'b.bus_id = s.bus_id')
            ->where('s.bus_id', $bus_id);

        return $this->db->get()->result();
    }

    public function update_bus_seat($bus_id, $seat_id, $data){
        $this->db->update($this->table, $data, ['bus_id' => $bus_id, 'id' => $seat_id]);
        return $this->db->affected_rows() == 1;
    }

    public function count_buses_seats_by_bus($bus_id){
        $this->db->select('COUNT(id) as count')
            ->from($this->table)
            ->where('bus_id', $bus_id);

        $query = $this->db->get()->row();

        return ($query ? $query->count : 0);
    }

}