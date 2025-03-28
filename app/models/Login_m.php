<?php

defined('BASEPATH') OR die('No direct script access allowed!');

/**
* @package CRSIRS
* @author Nugitech Dev. Team
* @copyright 2016
*/

class Login_m extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database(); 
		$this->load->library('encryption');
	}

	/**
	* Function for checking user's login validity
	* @param string $user
	* @param string $password
	* @return bool
	**/
	public function login($email, $password) 
	{
		$query = $this->db->get_where('customers', ['email' => $email, 'password' => $password, 'email_verified' => 1])->row();
		
		if($query){
			$array = [
				"loggedInUserID" => $query->customer_id,
				'email' => $email,
				'name' => $query->surname . ', ' . $query->first_name,
				'loggedIn' => TRUE,
			];

			$this->session->set_userdata($array);

			return TRUE;
		}

		return FALSE;
	}

	public function insert_user_otp($data){
		$this->db->insert('users_otp', $data);
		return true;
	}

	public function process_login($tin, $ot_password){
		$query = $this->db->get_where('users_otp', array("tin" => $tin, 'password'=> $ot_password))->row();

	   	if($query != null){

	     	return $query;
	   	}
	   	return false;
	}

	public function delete_otp_tin($tin){
		$this->db->where('tin', $tin);
		$this->db->delete('users_otp');

		if($this->db->affected_rows() > 0){
			return true;
		}
		return false;
	}

	public function check_otp_tin($tin){
		$query = $this->db->get_where('users_otp', array('tin'=>$tin))->result();
	   	if($query != null){
		   	return true;
	   }
	   return false;
	}
}