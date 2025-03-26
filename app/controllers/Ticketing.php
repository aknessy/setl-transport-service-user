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

        $this->data['title'] = self::page_title . 'Customer\'s Ticket';
        $this->data['record'] = $this->invoicing_m->get_invoice($order_id, $is_logged_in);        
        $this->data['subview'] = 'ticketing/ticket';
        $this->load->view('_layout', $this->data);
    }
}