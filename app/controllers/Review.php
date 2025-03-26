<?php

/**
* @package CrossRiver Pay
* @author Nugi Technologies Development Team
* @copyright 2016
**/

class Review extends CI_Controller {

    const page_title = 'Customer Reviews | ';

	function __construct(){
	    parent::__construct();
        
        // if($this->session->loggedin !== TRUE){
        //     $this->session->set_flashdata('error', 'Only logged In Users can leave reviews. Please login to continue!');
        //     redirect(base_url('login'));
        // }

		$this->load->model(['buses_m', 'customer_m', 'rating_m']);
		$this->load->helper(['random_uuid', 'random_string']);
        $this->load->library('pagination');
	}

    public function index(){
    }

    public function bus(){
        if($_POST){
            $this->form_validation->set_rules($this->review_form_rules());

            $bus_id = $this->input->post('bus_id');
            $origin = $this->input->post('origin');
            $destination = $this->input->post('destination');
            $travel_time = $this->input->post('time');
            $travel_date = $this->input->post('date');

            if($this->form_validation->run() == FALSE){
                $this->session->set_flashdata('error',validation_errors('<span>','</span>'));
                redirect(base_url('booking/reserve/'.$bus_id.'/'.$destination.'/'.$origin.'/'.$travel_time.'/'.$travel_date.'#leaveReview'));
            }else{
                $customer_id = NULL;

                if($this->session->loggedIn == TRUE || NULL != $this->session->loggedInUserID){
                    $customer_id = $this->session->loggedInUserID;
                }

                $review_record = [
                    'review_id' => generateUuid(),
                    'customer_id' => $customer_id,
                    'bus_id' => $bus_id,
                    'review_title' => $this->input->post('review_title'),
                    'comment' => $this->input->post('review_comment'),
                    'rating' => (NULL != $this->input->post('rating') ? $this->input->post('rating') : 0),
                    'rating_desc' => (NULL != $this->input->post('rating_text') ? $this->input->post('rating_text') : 'Poor')
                ];

                $insert = $this->rating_m->insert_rating_record($review_record);

                if($insert){
                    $this->session->set_flashdata('success', 'Bus review saved successfully!');
                }else{
                    $this->session->set_flashdata('error', 'Bus review was not saved. Something went wrong!');
                }

                redirect(base_url('booking/reserve/' . $bus_id.'/'.$destination.'/'.$origin.'/'.$travel_time.'/'.$travel_date.'#leaveReview'));
            }
        }else{
            redirect(base_url('booking'));
        }
    }

    public function review_form_rules(){
        return [
            [
                'field' => 'review_title',
                'label' => 'Review Title',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'review_comment',
                'label' => 'Review Comment',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'rating',
                'label' => 'Review Rating',
                'rules' => 'trim|required'
            ]
        ];
    }
}