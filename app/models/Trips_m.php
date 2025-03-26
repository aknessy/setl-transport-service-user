<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trips_m extends CI_Model {

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function count_all(){
        return ($this->get_all_trips() ? count($this->get_all_trips()) : 0);
    }

    public function get_all_trips(){
        $this->db->select('b.*, bk.id as bookingID, bk.seats, bk.traveling_from, bk.departure_time')
            ->from('buses as b')
            ->join('bookings as bk', 'b.bus_id = bk.bus_id', 'INNER JOIN')
            ->where('b.decommissioned', 0)
            ->group_by('b.bus_id, b.schedule_date')
            ->order_by('bk.id ASC');

        return $this->db->get()->result();
    }

    public function get_search($limit, $start, $search, $order, $dir)
	{
        $this->db->select('b.*, bk.id as bookingID, bk.seats, bk.traveling_from, bk.departure_time')
            ->from('buses as b')
            ->join('bookings as bk', 'b.bus_id = bk.bus_id', 'INNER JOIN')
            ->where('b.decommissioned', 0)
            ->or_like('b.bus_make', $search)
			->or_like('b.bus_model', $search)
			->or_like('b.bus_color', $search)
			->or_like('b.bus_type',$search)
            ->or_like('bk.departure_time',$search)
            ->or_like('bk.departure_date',$search)
            ->group_by('b.bus_id,b.schedule_date')
            ->order_by('bk.id ASC')
            ->limit($limit, $start);

        return $this->db->get()->result();
    }

    public function count_search($search)
	{
        $this->db->select('b.*, bk.id as bookingID, bk.seats, bk.traveling_from, bk.departure_time')
            ->from('buses as b')
            ->join('bookings as bk', 'b.bus_id = bk.bus_id', 'INNER JOIN')
            ->where('b.decommissioned', 0)
            ->or_like('b.bus_make', $search)
			->or_like('b.bus_model', $search)
			->or_like('b.bus_color', $search)
			->or_like('b.bus_type',$search)
            ->or_like('bk.departure_time',$search)
            ->or_like('bk.departure_date',$search);

        $query = $this->db->get()->result();

        return ($query ? count($query) : 0);
    }

    public function get_paginated($limit, $start, $order, $dir)
	{
        $this->db->select('b.*, bk.id as bookingID, bk.seats, bk.traveling_from, bk.departure_time')
            ->from('buses as b')
            ->join('bookings as bk', 'b.bus_id = bk.bus_id', 'INNER JOIN')
            ->where('b.decommissioned', 0)
            ->group_by('b.bus_id,b.schedule_date')
            ->order_by($order, $dir)
	    	->limit($limit, $start);

        return $this->db->get()->result();
    }

}