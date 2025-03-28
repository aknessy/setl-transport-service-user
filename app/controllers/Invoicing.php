<?php

/**
* @package CrossRiver Pay
* @author Nugi Technologies Development Team
* @copyright 2016
**/

class Invoicing extends CI_Controller {

    const page_title = 'Bus Booking | ';

	function __construct(){
		parent::__construct();
       
		$this->load->model(
            [
                'buses_m', 
                'buses_terminal_m', 
                'booking_m', 
                'tfare_m', 
                'customer_m', 
                'invoicing_m'
            ]
        );

		$this->load->helper(['random_uuid', 'random_string']);
        $this->load->library('pagination');
	}

    public function index(){}

    public function invoice($order_id){
        $is_logged_in = FALSE;

        if($this->session->loggedIn || $this->session->loggedInUserID != NULL){
            $is_logged_in = TRUE;
        }

        $invoice_record = $this->invoicing_m->get_invoice($order_id, $is_logged_in);
        
        if(empty($invoice_record))
        {
            $this->session->set_flashdata('error', 'No invoice record found for the given Order ID `'. $order_id . '`');
            redirect(base_url('booking'));
        }

        $booking_record = $this->booking_m->get_booking_rel_inv($invoice_record->booking_id);
        
        $this->data['traveling_from'] = $booking_record->traveling_from;
        $this->data['traveling_to'] = $booking_record->arriving_at;
        $this->data['user_selected_seats'] = $booking_record->seats;
        
        $this->data['booking'] = $booking_record;

        $this->data['title'] = self::page_title . 'Payment Invoice';
        $this->data['invoice'] = $invoice_record;
        $this->data['subview'] = 'invoicing/invoice';
        $this->load->view('_layout', $this->data);
    }
}