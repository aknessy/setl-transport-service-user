<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* @package Setl Tranport Company
* @author Nugi Technologies Development Team
* @copyright 2025
**/

class Ticketing extends CI_Controller {

    const page_title = 'Ticketing | ';

	function __construct(){
		parent::__construct();

        // if(!$this->session->loggedin){
        //     $this->session->set_flashdata('error', 'You must be logged In!');
        //     redirect(base_url('login'));
        // }
       
		$this->load->model(
            [
                'booking_m', 
                'invoicing_m', 
                'buses_m', 
                'buses_terminal_m',
                'customer_m'
            ]);
	}

    public function ticket($order_id){
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
        
        $this->data['title'] = self::page_title . 'Customer\'s Ticket';
        $this->data['record'] = $invoice_record;        
        $this->data['subview'] = 'ticketing/ticket';
        $this->load->view('_layout', $this->data);
    }
}