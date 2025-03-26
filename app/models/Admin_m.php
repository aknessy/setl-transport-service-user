<?php
defined('BASEPATH') OR EXIT('No direct script access allowed!');

/**
* @package CRIRS
* @author Nugitech Dev. Team
* @copyright 2016
**/

class Admin_m extends CI_Model
{


	public function __construct(){

		parent::__construct();
		//$this->load->database();
		$this->casDB = $this->load->database('cas', TRUE);
		// $this->load->library(['cas']);
	}


	public function update_users($user, $data){
		$this->db->where('username', $user);
		return $this->db->update('users', $data);
	}

	public function update_staff_users($user, $data){
		$this->db->where('username', $user);
		return $this->db->update('staff', $data);
	}

	public function get_admin($array) {
    return $this->casDB->get_where('admins', $array)->row();
  }

	/**
	* Get the currently logged in admin user id based on the admin username
	* @param string $username
	* @return int
	**/
	public function get_admin_user_id($username){

		$this->db->select('id')->where('username', $username);
		$query = $this->db->get('users');

		/**
		* return 0 if there isn't a row that matches
		* our select.
		**/
		return ($query->num_rows() > 0 ? $query->result() : 0 );

	}

	/**
	* Count the total number of rows from the mda table
	* @param string $column
	* @param string $table
	* return int
	**/
	public function get_mda_row_count(){

		$sql = "SELECT COUNT( id ) AS id FROM mda";
		$query = $this->db->query($sql);

		/**
		* return 0 if no result was found
		**/
		return ($query->num_rows() > 0 ? $query->result_array() : 0 );

	}

	/**
	* Count the total number of rows from the sector table
	* @param string $column
	* @param string $table
	* return int
	**/
	public function get_sector_row_count(){

		$sql = "SELECT COUNT( id ) AS id FROM sector";
		$query = $this->db->query($sql);

		/**
		* return 0 if no result was found
		**/
		return ($query->num_rows() > 0 ? $query->result_array() : 0 );

	}

	/**
	* Count the total number of rows from the taxoffice table
	* @param string $column
	* @param string $table
	* return int
	**/
	public function get_taxoffice_row_count(){

		$sql = "SELECT COUNT( id ) AS id FROM taxoffice";
		$query = $this->db->query($sql);

		/**
		* return 0 if no result was found
		**/
		return ($query->num_rows() > 0 ? $query->result_array() : 0 );

	}

	/**
	* Count the total number of rows from the revenue table
	* @param string $column
	* @param string $table
	* return int
	**/
	public function get_revenue_row_count(){

		$sql = "SELECT COUNT( id ) AS id FROM revenue_heads";
		$query = $this->casDB->query($sql);

		/**
		* return 0 if no result was found
		**/
		return ($query->num_rows() > 0 ? $query->result_array() : 0 );

	}

	/**
	* Count the total number of rows from the taxpayers table
	* @param string $column
	* @param string $table
	* return int
	**/
	public function get_taxpayer_row_count(){

		$sql = "SELECT COUNT( id ) AS id FROM users";
		$query = $this->casDB->query($sql);

		/**
		* return 0 if no result was found
		**/
		return ($query->num_rows() > 0 ? $query->result_array() : 0 );

	}

	public function get_taxoffice_taxpayer_row_count($id){

		$sql = "SELECT COUNT( id ) AS id FROM taxpayer where taxoffice_id = '$id'";
		$query = $this->db->query($sql);

		/**
		* return 0 if no result was found
		**/
		return ($query->num_rows() > 0 ? $query->result_array() : 0 );

	}


	/**
	* Count the total number of rows from the taxpayers table
	* @param string $column
	* @param string $table
	* return int
	**/
	public function get_group_taxpayer_row_count($group=''){
		if($group = ''){
			$sql = "SELECT COUNT( id ) AS id FROM users";
		}elseif(strtolower($group) == 'individual'){
			//	$sql = "SELECT COUNT( id ) AS id FROM taxpayer WHERE group = 'individual'";
		}elseif(strtolower($group) == 'company'){
			//	$sql = "SELECT COUNT( id ) AS id FROM taxpayer WHERE group = 'company'";
		}

		$query = $this->casDB->query($sql);

		/**
		* return 0 if no result was found
		**/
		return ($query->num_rows() > 0 ? $query->result_array() : 0 );

	}

	/**
	* Use to upload admin cover photo/profile photo
	* @param int $usid
	* @param string $filename
	* @param int $img_height
	* @param int $img_width
	* @param date $datetime
	* @param string $upload_type
	* @return int
	**/
	public function create_admin_image($usid, $filename, $img_height, $img_width, $datetime = null, $upload_type = 'cover')
	{

		$datetime = ( is_null($datetime) ? date('Y-m-d h:i:s') : $datetime);
		$insert_id = 0;
		$table = 'admin_user_images';

		$data = array(
			'user_id'=>$usid,
			'user_photo'=>$filename,
			'photo_img_h'=>$img_height,
			'photo_img_w'=>$img_width,
			'modified_date'=>$datetime,
			'photo_type'=>$upload_type);

			if($this->find_if_user_image_exists($usid,$upload_type,$table) === TRUE){

				$this->db->update($table, $data, array('user_id'=>$usid,'photo_type'=>$upload_type));
				$insert_id = $this->db->insert_id();

			}else{

				$this->db->insert($table, $data);
				$insert_id = $this->db->insert_id();

			}

			return $insert_id;

		}

		/**
		* Gets user's image from the database
		* @param $usid
		* @param string $type=> default is 'cover'
		* @return array
		**/
		public function get_admin_image($usid, $type='cover'){

			$query = $this->db->select('user_photo,photo_img_h,photo_img_w')
			->where(array('user_id'=>$usid,'photo_type'=>$type))
			->get('admin_user_images');

			return $query->result_array();

		}

		/**
		* Find out if a user image & photo_type exists in a particular table
		* @param int $usid
		* @param string $table
		* @return bool
		**/
		private function find_if_user_image_exists( $usid,$type,$table ){

			$query = $this->db->get_where($table, array('user_id'=>$usid,'photo_type'=>$type), 1);

			return ( $query->num_rows() > 0 ? TRUE : FALSE );

		}

		/**
		* Get All the admin users
		* @param string $search => Optional by default
		* @param int $limit => Limits the number of rows returned if not null
		* @param int $offset => Used with limit clause for pagination purposes
		* @param bool $count => Whether to only count the users (default is false)
		* @return mixed
		**/
		public function get_admin_users($search='',$limit=null,$offset=null,$count=false){

			$keyword = ($search !== '');
			$return = null;
			$query = null;

			if(!$keyword){

				$this->db->select('users.id,users.username,users.email,users.first_name,users.last_name,users.phone', FALSE);
				$this->db->select("users_groups.id AS 'grp_id'", FALSE);
				$this->db->select("groups.name AS 'level'", FALSE);
				$this->db->from('users');
				$this->db->join('users_groups','users_groups.user_id = users.id','left');
				$this->db->join('groups','groups.id = users_groups.group_id','left');
				$this->db->order_by('users.id');

				if(!is_null($limit)){

					$this->db->limit($limit);

				}elseif(!is_null($limit) && !is_null($offset) ){

					$this->db->limit($limit, $offset);

				}

				$query = $this->db->get();

			}else{

				$this->db->select('users.id,users.username,users.email,users.first_name,users.last_name,users.phone',FALSE);
				$this->db->select("users_groups.id AS 'grp_id'", FALSE);
				$this->db->select("groups.name AS 'level'", FALSE);
				$this->db->from('users');
				$this->db->join('users_groups','users_groups.user_id = users.id','left');
				$this->db->join('groups','groups.id = users_groups.group_id','left');
				$this->db->like('users.username',$search);
				$this->db->or_like('users.first_name',$search);
				$this->db->or_like('users.last_name',$search);
				$this->db->order_by('users.id');

				if(!is_null($limit)){

					$this->db->limit($limit);

				}elseif(!is_null($limit) && !is_null($offset) ){

					$this->db->limit($limit, $offset);

				}

				$query = $this->db->get();

			}

			if($query->num_rows() > 0 && !$count){

				$return = $query->result_array();

			}elseif($query->num_rows() > 0 && $count){

				$return = $query->num_rows();

			}else{

				$return = 0;

			}

			return $return;

		}

		/**
		* Fetches information for a paricular user.
		* This method should be called mainly when a user is to be edited
		* @param $id
		* @return mixed
		**/
		public function get_user_edit_info($id){

			$this->db->select('username,password,email,first_name,last_name,company,phone')
			->from('users')
			->where('id',$id);

			$query = $this->db->get();

			return ($query->num_rows() > 0 ? $query->result() : 0 );

		}

		/**
		* Deletes a user with a given id, from a given table
		* @param string $table
		* @param int $id
		* @return bool
		**/
		public function delete_person($table, $id){

			$this->db->where('id',$id)
			->delete($table);

			return ($this->db->affected_rows() > 0 ? true : false);

		}

		/**
		* Update a user's group
		* @param int $id
		* @param string $new => The new value
		* @return bool
		**/
		public function update_users_group($id, $new){

			$this->db->where('user_id', $id);
			$this->db->update('users_groups', array('group_id'=>$new));

			return ($this->db->affected_rows() > 0 ? true : false);

		}

		/**
		* Gets the users groups. A similiar function is already in use
		* by the ion_auth library, we're going to require ours to behave
		* slightly differently from that of the library
		* @param int $id => The current user's id (This is optional)
		* @return mixed
		**/
		public function get_users_groups($id=null){

			if( $id == null ){

				$this->db->select('id,name')
				->from('groups');

			}else{

				$this->db->select('ugrp.id,grp.name')
				->from('users_groups AS ugrp')
				->join('groups AS grp','ugrp.group_id = grp.id','inner')
				->where('ugrp.user_id',$id);

			}

			$query = $this->db->get();

			return ($query->num_rows() > 0 ? $query->result() : 0);

		}

		/**
		* Gets all the sectors by name from the sector table
		* @param none
		* @return mixed
		**/
		public function get_sector_names(){

			$this->db->select('name')
			->from('sector');

			$query = $this->db->get();

			return ( $query->num_rows() > 0 ? $query->result() : 0 );

		}


	}