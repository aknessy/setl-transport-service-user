<?php

/**
* @package CrossRiver Pay
* @author Nugi Technologies Development Team
* @copyright 2016
**/

class Booking extends CI_Controller {

    const page_title = 'Bus Booking | ';

	function __construct(){
		parent::__construct();
       
		$this->load->model('login_m');
		$this->load->helper(['random_uuid', 'random_string']);
        $this->load->library('pagination');
	}

    public function index(){
        $this->data['title'] = self::page_title . 'Login';
        $this->data['subview'] = 'login/index';
        $this->load->view('login_layout', $this->data);
    }

}