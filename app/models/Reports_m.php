<?php
defined('BASEPATH') OR EXIT('No direct script access allowed!');

/**
* @package CrossRiver Pay
* @author Nugi Technologies Development Team
* @copyright 2016
**/

class Reports_m extends CI_Model{
	private $cas;
	public function __construct(){

		parent::__construct();
		//$this->load->model('Reports_m');
		// $this->cas = $this->load->database('cas', TRUE);
	}

	 
	// function getTaxOffice($code){
	// 	return $this->cas->get_where("taxoffice", array("code" => $code))->row();
	// }

 	// function getTaxOffices(){
	// 	return $this->cas->get("taxoffice")->result();
	// }
	 
 }