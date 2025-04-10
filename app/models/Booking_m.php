<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Booking_m extends CI_Model {

	private $table = "bookings";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_one_reservation($booking_id)
    {
		$this->db->select('b.*, c.customer_id, c.first_name, c.surname, c.phone, c.email, bs.bus_make, bs.bus_model, bt.terminal_name, inv.amount, inv.order_id, inv.invoice_for, inv.status')
			->from($this->table . ' as b')
            ->join('customers as c', 'c.customer_id = b.customer_id', 'INNER JOIN')
            ->join('buses as bs', 'b.bus_id = bs.bus_id', 'INNER JOIN')
            ->join('buses_terminal as bt', 'bs.start_terminal = bt.id', 'INNER JOIN')
            ->join('invoice as inv', 'b.id = inv.booking_id', 'LEFT')
            ->where('b.id', $booking_id);
        
	    return $this->db->get()->row();
    }

    public function get_reservation_without_customer($booking_id)
    {
		$this->db->select('b.*, bs.bus_make, bs.bus_model, bt.terminal_name, inv.amount, inv.order_id, inv.invoice_for, inv.status')
			->from($this->table . ' as b')
            ->join('buses as bs', 'b.bus_id = bs.bus_id', 'INNER JOIN')
            ->join('buses_terminal as bt', 'bs.start_terminal = bt.id', 'INNER JOIN')
            ->join('invoice as inv', 'b.id = inv.booking_id', 'LEFT')
            ->where('b.id', $booking_id);
        
	    return $this->db->get()->row();
    }
    
    public function count_all()
	{
        /**
         * This should be joined with a payment records table where status is `Approved` or `Paid`
         */
	    return $this->db->where('active', 1)->count_all_results($this->table);
	}

    public function get_available($options){
        $this->db->select('b.*')
            ->from('buses as b')
            //->join('buses_terminal as bt','bt.id = b.start_terminal')
            ->where('b.decommissioned', 0)
            ->where($options);

        return $this->db->get()->result();
    }

    public function filter_available_buses($options){
        $this->db->select('b.*')
            ->from('buses as b')
            //->join('buses_terminal as bt','bt.id = b.start_terminal')
            ->where('b.decommissioned', 0)
            ->where($options);

        return $this->db->get()->result();
    }

    public function insert_booking_record($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_selected_seats($booking_id, $bus_id){
        return $this->db->get_where($this->table, [
            'id' => $booking_id,
            'bus_id' => $bus_id]
        )->row();
    }

    public function update($booking_id, $data){
        $this->db->update($this->table, $data, ['id' => $booking_id]);
        return $this->db->affected_rows() == 1;
    }

    public function get_booking_by_bus_schedule($bus_id,$schedule){
        return $this->db->get_where($this->table, ['bus_id' => $bus_id, 'departure_date' => $schedule])->result();
    }

    public function delete_booking($booking_id){
        $this->db->delete($this->table, ['id' => $booking_id]);
        return $this->db->affected_rows() == 1;
    }

    public function create_reschedule_record($data){
        $this->db->insert('reschedules', $data);
        return $this->db->insert_id() > 0;
    }

    public function get_reschedule_record($where){
        return $this->db->get_where('reschedules', $where)->row();
    }

    public function delete_reschedule_record($where){
        $this->db->delete('reschedules', $where);
        return $this->db->affected_rows() == 1;
    }

    public function get_customer_bookings($customer_id){
        $this->db->select('bk.*')
            ->from($this->table . ' as bk')
            ->join('invoice as inv', 'inv.customer_id = bk.customer_id', 'INNER JOIN')
            ->where('bk.customer_id', $customer_id)
            ->where('inv.status', 'PAID');

        return $this->db->get()->result();
    }

    public function amount_spent_by_customer($customer_id){
        $this->db->select('SUM(amount) as total_amt')
            ->from('invoice')
            ->where('customer_id', $customer_id)
            ->where('status', 'PAID');

        return $this->db->get()->row();
    }

    /**
     * Get a booking that is related to an invoice
     */
    public function get_booking_rel_inv($booking_id){
        return $this->db->get_where($this->table, ['id' => $booking_id])->row();
    }

    /**
     * We will use the code below to try and free up reserved seats from our buses.
     * This code will run every specific time (say 30 minutes) via javascript.
     */
    public function get_expired_bookings(){
        $currentTimestamp = date('Y-m-d H:i:s');

        return $this->db->select('bus_id, seats')
            ->from($this->table)
            ->where('departure_date <', $currentTimestamp)
            ->get()
            ->result();
    }

}