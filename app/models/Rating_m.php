<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rating_m extends CI_Model {

	private $table = "reviews";

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function get_bus_ratings($bus_id){
        return $this->db->get_where($this->table, ['bus_id' => $bus_id])->result();
    }

    public function calculate_avg_rating($bus_id){
        $this->db->select('AVG(rating) as avg_rating')->from($this->table)->where('bus_id', $bus_id);
        return $this->db->get()->row();
    }

    public function insert_rating_record($data){
        $this->db->insert($this->table, $data);
        return $this->db->insert_id() > 0;
    }

    public function get_review_customer_info($review_customer_id){
        return $this->db->get_where('customers', ['customer_id' => $review_customer_id])->row();
    }

}