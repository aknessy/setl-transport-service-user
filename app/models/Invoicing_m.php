<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoicing_m extends CI_Model {

	private $table = "invoice";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_invoices(){
        return $this->db->get($this->table)->result();
    }

    public function insert_record($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id() > 0;
    }

    public function count_all()
	{
        /**
         * This should be joined with a payment records table where status is `Approved` or `Paid`
         */
	    return $this->db->count_all_results($this->table);
	}

    public function get_invoice($order_id, $is_logged_in=TRUE){
        if($is_logged_in){
            $this->db->select('inv.*,b.*')
                ->from($this->table . ' as inv')
                // ->join('customers as c', 'inv.customer_id = c.customer_id', 'INNER JOIN')
                ->join('buses as b', 'inv.bus_id = b.bus_id')
                // ->join('bookings as bk', 'bk.customer_id = c.customer_id')
                ->where('inv.status', 'UNPAID')
                ->where('inv.order_id', $order_id);
        }else{
            $this->db->select('inv.*,b.*')
                ->from($this->table . ' as inv')
                ->join('buses as b', 'inv.bus_id = b.bus_id')
                //->join('bookings as bk', 'inv.booking_id = bk.id')
                ->where('inv.status', 'UNPAID')
                ->where('inv.order_id', $order_id);
        }

        return $this->db->get()->row();
    }

    public function get_paginated($limit, $start, $order, $dir)
	{
        /**
         * This should be joined with a payment records table where status is `Approved` or `Paid`
         */
		$this->db->select('inv.*, c.*')
            ->from($this->table . ' as inv')
            ->join('customers as c', 'inv.customer_id = c.customer_id')
            ->where('inv.order_id', $search)
            ->or_like('c.first_name', $search)
            ->or_like('c.surname', $search)
	    	->or_like('inv.amount', $search)
			->or_like('inv.status', $search)
	    	->order_by($order, $dir)
			->limit($limit, $start);

	    return $this->db->get()->result();
	}

    public function get_search($limit, $start, $search, $order, $dir)
	{
		$this->db->select('inv.*, c.*')
            ->from($this->table . ' as inv')
            ->join('customers as c', 'inv.customer_id = c.customer_id')
            ->where('inv.order_id', $search)
            ->or_like('c.first_name', $search)
            ->or_like('c.surname', $search)
	    	->or_like('inv.amount', $search)
			->or_like('inv.status', $search)
	    	->order_by($order, $dir)
			->limit($limit, $start);

	    return $this->db->get()->result();
	}

    public function count_search($search)
	{
	    $this->db->select('inv.*, c.*')
            ->from($this->table . ' as inv')
            ->join('customers as c', 'inv.customer_id = c.customer_id')
            ->where('inv.order_id', $search)
            ->or_like('c.first_name', $search)
            ->or_like('c.surname', $search)
	    	->or_like('inv.amount', $search)
			->or_like('inv.status', $search);
		
		$query = $this->db->get()->result();

	    return ($query ? count($query) : 0);
	}

    public function delete($invoice_id){
        $this->db->delete($this->table, ['invoice_id' => $invoice_id]);
        return $this->db->affected_rows() == 1;
    }

    public function update_invoice_record($where, $set){
        $this->db->update($this->table, $set, $where);
        return $this->db->affected_rows() == 1;
    }

}