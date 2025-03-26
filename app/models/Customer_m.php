<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_m extends CI_Model {

	private $table = "customers";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function create_customer($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_customer($customer_id){
        return $this->db->get_where($this->table, ['customer_id' => $customer_id])->row();
    }

    public function get_customer_by_id($id){
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

}