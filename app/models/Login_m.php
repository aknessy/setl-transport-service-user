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
	public function login() {

		//process flow
		//get the username/TIN and the password
		//check for availablity in the users table,
		//if it exists in the users table, then get the usertype and process login based on the usertype
		//else check the tin table for availability
		//if it exists, use the taxpayer_id to get the taxpayer type and process login acordingly

		$user = $this->input->post('username');
		$password = $this->input->post('password');

		$pwd = $this->_hash($password);
		$query = $this->db->get_where('users', array("username" => $user, "password" => $pwd))->row();
		 
		// echo "<pre>"; print_r($query); die;
		if($query){
			$this->update_user_login($query->id);

			$array = array(
				"userID" => $query->id,
				"username" => $query->username,
				"fullname" => $query->first_name . ' ' . $query->last_name,
				'usertype' => $query->type,
				'createdOn' => $query->created_on,
				'last_login' => $query->last_login,
				"loggedin" => TRUE,
				"active" => 1,
				'usertype' => 'Super Admin',
			);

			return $array;
			exit;
		}

		 

		$query = $this->db->get_where('staff', array("username" => $user, "password" => $pwd))->row();

		if($query){
			$role = $this->db->get_where('roles', ['role_id' => $query->role_id])->row();

			$array = array(
				"userID" => $query->id,
				'usertype' => "staff",
				'username' => $query->username,
				'fullname' => $query->first_name . ' ' . $query->last_name,
				'role' => $role->role_unique,
				'role_id' => $role->role_id,
				'roleName' => $role->role,
				'photo' => $query->photo,
				'taxoffice_id' => $query->taxoffice_id,
				"loggedin" => TRUE,
				"active" => $query->active
			);

			return $array;
			exit;
		}

	 

		return false;

	}

 
	public function api_login(){

		$user = $this->input->post('username');
		$password = $this->input->post('password');

		$pwd = $this->_hash($password);

		$this->db->select("*");
		$this->db->from("crirs_tin");
		$this->db->join('taxpayer', 'crirs_tin.taxpayer_id = taxpayer.id', 'LEFT');
		$this->db->where("tin",$user);
		$query = $this->db->get()->row();

		if($query){

			// Update last time the tax payer logged in
			$time= date('Y-m-d H:i:s');
			$this->db->where('id',$query->id)->update('taxpayer',array('last_login'=>$time));

			$array = array(
				'tin' => $user,
				'usertype' => $query->type,
				'userID'=>$query->id,
				'name'=>$query->name,
				'email'=>$query->email,
				'phone'=>$query->phone,
				'last_login'=> $query->last_login,
				'loggedin' => TRUE
			);

			return $array;
			exit;

		}
	}

	/**
	* Gets the taxpayer information
	* @param int $tin_id
	* @return array
	**/
	private function fetch_taxpayer_every($tin_id){

		$query = $this->db->select('*')->where('tin_id',$tin_id)->order_by('id','desc')->get('taxpayer');

		return $query->result();

	}

	/**
	* Updates user's login
	* @param int $id
	* @return void
	**/
	private function update_user_login($id){

		$this->db->where('id',$id)->update('users',array('last_login'=>time()));

	}

	/**
	* Verifies the user's password from the database
	* @param int $id
	* @return string
	**/
	private function password_verify($id, $password){

		$query = $this->db->select('password')
						->where('id',$id)
						->limit(1)
						->order_by('id','desc')
						->get('users');

		$hashed = $query->row();

		if($query->num_rows() !== 1){

			return false;

		}

		if($password == $hashed->password){

			return true;

		}

	}

	// public function _password_verify($password)
	// {
	// 	return $this->db->get_where('staff', ['password' => $password])->row();
	// }
	
	public function _password_verify($password){
		$staff = $this->db->get_where('staff', ['password' => $password])->row();
		if (!$staff) {
			$user = $this->db->get_where('users', ['password' => $password])->row();
			if ($user) {
				return $user;
			}
		} else {
			return $staff;
		}
		
		return false; 
	}

	public function _hash($string) {
		return hash("sha512", $string . config_item("encryption_key"));
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