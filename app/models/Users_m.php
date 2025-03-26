<?php

defined('BASEPATH') OR die('No direct script access allowed!');

/**
* @package CRSIRS
* @author Nugitech Dev. Team
* @copyright 2016
*/

class Users_m extends CI_Model
{

	public function staff_list(){
		return $this->db->get_where('users', array("deleted" => 0))->result();
	}

	public function add_staff($array){
		return $this->db->insert('users', $array);
	}

	public function delete_staff($userID, $array){
		$this->db->where('id', $userID);
		$this->db->update('users', $array);
	}

	public function get_single_staff($staffID){
		return $this->db->get_where('users', array("active" => 1))->row();
	}

}