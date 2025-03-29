<?php

/**
* @package CrossRiver Pay
* @author Nugi Technologies Development Team
* @copyright 2016
**/

class Customer extends CI_Controller {

    const page_title = 'Customer | ';

    const SCHEDULE_TIME = [
        '06' => '6:00 AM',
        '07' => '7:00 AM',
        '08' => '8:00 AM',
        '09' => '9:00 AM',
        '10' => '10:00 AM',
        '11' => '11:00 AM',
        '12' => '12:00 PM',
        '13' => '01:00 PM',
        '14' => '02:00 PM',
        '15' => '03:00 PM',
        '16' => '04:00 PM'
    ];

    public function __construct(){
		parent::__construct();
       
		$this->load->model(['customer_m', 'rating_m', 'buses_terminal_m']);
		$this->load->helper(['random_uuid', 'random_string', 'password_hash', 'locale']);
        $this->load->library(['pagination','mailer']);
	}

    public function index(){}

    public function register(){
        $this->data['title'] = self::page_title . 'Create Account';
        $this->data['subview'] = 'customer/register';

        if($_POST){
            $this->form_validation->set_rules($this->register_rules());

            if($this->form_validation->run() == FALSE){
                $this->register();
            }else{
                $customer_id = generateUuid();

                $lastname = $this->input->post('last_name');
                $firstname = $this->input->post('first_name');
                $middlename = $this->input->post('middle_name');
                $email = $this->input->post('email');
                $phone = $this->input->post('phone');

                $verification_code = getToken(6);

                $customer = [
                    'customer_id' => $customer_id,
                    'surname' => $lastname,
                    'middle_name' => $middlename,
                    'first_name' => $firstname,
                    'phone' => $phone,
                    'email' => $email,
                    'verification_code' => $verification_code,
                    'created_on' => date('Y-m-d H:i:s')
                ];

                $insert = $this->customer_m->create_customer($customer);

                if($insert){
                    $name = $surname . ', ' . $firstname;
                    $body = 'Hey ' . $name. '<br/>Use this code: ' . $verification_code . '<br/> to verify your email!';
                    $subject = 'E-mail Verification';
                    
                    $this->mailer->send($email,$name,$body,$subject);

                    $this->session->set_flashdata('success','Customer information saved successfully. A verification code has been sent to your email!');
                    redirect(base_url('customer/verifyemail'));
                }else{
                    $this->session->set_flashdata('error', 'Failed to save user information. Please try again!');
                    redirect(base_url('customer/register'));
                }
            }
        }else{
            $this->load->view('login_layout', $this->data);
        }
    }

    public function verifyemail(){
        $this->data['title'] = self::page_title . 'Verify Email Address';
        $this->data['subview'] = 'customer/verify_email';
        $this->load->view('login_layout', $this->data);
    }

    public function confirm_email(){
        if($_POST){
            $code = $this->input->post('verification_code');
            $confirm = $this->customer_m->verify_email($code);

            if($confirm){
                $password_text = getToken(6);
                $password = hash_string($password_text);

                $update = [
                    'password' => $password,
                    'email_verified' => 1,
                    'email_verified_at' => date('Y-m-d H:i:s')
                ];

                $update = $this->customer_m->update_customer_info(['verification_code' => $code], $update);

                if($update){
                    $email = $confirm->email;
                    $surname = $confirm->surname;
                    $firstname = $confirm->first_name;
                    $subject = 'Account Login Credentials';

                    $body = 'Hello ' . $surname. ', ' . $firstname;
                    $body .= '<br/><br /> Here are your login credentials: ';
                    $body .= '<br /><br />Password: ' . $password_text;
                    $body .= '<br />Email: ' . $email;
                    $body .= '<br /><br /><br />Thank you for your time!';

                    $this->mailer->send($email,$surname . ', ' . $firstname,$body,$subject);

                    $this->session->set_flashdata('success', 'Your email is verified & your login credentials have been sent to your verified email address!');
                    redirect(base_url('login'));
                }
            }else{
                $this->sessin->set_flashdata('error', 'Invalid Email Address!');
                redirect(base_url('customer/verifyemail'));
            }
        }
    }

    public function profile(){
        if($this->session->loggedIn || NULL != $this->session->loggedInUserID){
            $customer_id = $this->session->loggedInUserID;

            $this->data['title'] = self::page_title . 'Profile';
            $this->data['subview'] = 'customer/profile';
            $this->data['customer'] = $this->customer_m->get_customer($customer_id);
            $this->data['states'] = $this->customer_m->get_states();

            $this->load->view('_layout', $this->data);
        }else{
            redirect(base_url());
        }
    }

    public function update_basic_information()
    {
        if($_POST){
            $this->form_validation->set_rules($this->update_info_rules());

            if($this->form_validation->run() == FALSE){
                $this->profile();
            }else{
                $customer_id = $this->session->loggedInUserID;

                $lastname = $this->input->post('last_name');
                $firstname = $this->input->post('first_name');
                $middlename = $this->input->post('middle_name');
                $email = $this->input->post('email');
                $phone = $this->input->post('phone');
                $address = $this->input->post('address');
                $state_of_origin = $this->input->post('state_of_origin');
                $lga_of_origin = $this->input->post('lga_of_origin');
                $nok_name = $this->input->post('nok_name');
                $nok_phone = $this->input->post('nok_phone');
                $nok_address = $this->input->post('nok_address');

                $photo = NULL;

                if($_FILES['customer_photo']){
                    // Handle Image Upload here!
                }

                $customer = [
                    'surname' => $lastname,
                    'middle_name' => $middlename,
                    'first_name' => $firstname,
                    'phone' => $phone,
                    'email' => $email,
                    'address' => $address,
                    'nok_name' => $nok_name,
                    'nok_phone' => $nok_phone,
                    'nok_address' => $nok_address,
                    'state_of_origin' => $state_of_origin,
                    'lga_of_orign' => $lga_of_origin
                ];

                $update = $this->customer_m->update_customer_info(['customer_id' => $customer_id], $customer);

                if($update){
                    $this->session->set_flashdata('success', 'Customer\'s Basic information Updated!');
                }else{
                    $this->session->set_flashdata('error', 'Failed to update customer information');
                }

                redirect(base_url('customer/profile'));
            }
        }
    }

    public function travel_history(){
        if($this->session->loggedIn || NULL != $this->session->loggedInUserID){
            $customer_id = $this->session->loggedInUserID;
            $travel_record = $this->customer_m->get_travel_history($customer_id);;
            
            $this->data['title'] = self::page_title . 'Travel History';
            $this->data['subview'] = 'customer/travel_history';
            $this->data['travel_record'] = $travel_record;
            $this->load->view('_layout', $this->data);
        }else{
            $this->session->set_flashdata('warning', 'Unauthorized User!');
            redirect(base_url('customer/profile'));
        }
    }

    public function travelDatatableAjax(){
        $columns = ['vehicle', 'depart_from', 'arrived_at', 'travel_time', 'travel_date', 'action'];

        $customer_id = $this->session->loggedInUserID;

        $output = NULL;

	    $limit = $this->input->post('length');
	    $start = $this->input->post('start');
	    $order = $columns[$this->input->post('order')[0]['column']];
	    $dir = $this->input->post('order')[0]['dir'];

	    $search = $this->input->post('search')['value'];

	    $totalData = $this->customer_m->count_all_user_journeys($customer_id);
        $totalFiltered = $totalData;

        $records = [];
        $data = [];

        if(!empty($search)){
            $records = $this->customer_m->get_customer_travels_search($customer_id, $limit, $start, $search, $order, $dir);
            $totalFiltered = $this->customer_m->get_customer_travels_search_count($customer_id, $search);
        }else{
            $records = $this->customer_m->get_customer_travels_search_paginated($customer_id, $limit, $start, $order, $dir);
        }
        
	    $aws_base_url = $this->settings_m->getOne(array('skey' => 'aws_base_url'))->value;
        $placeholder = 'https://imageplaceholder.net/600';

	    if($records){
		    for ($i = 0; $i < $totalFiltered; $i++){
                $img = '';

                $expiry_date = (NULL!=$records[$i]->departure_date?strtotime($records[$i]->departure_date) : NULL);
                $current_timestamp = strtotime(date('Y-m-d'));

                if(!empty($records[$i]->bus_photo) && json_decode($records[$i]->bus_photo)){
                    $photo = json_decode($records[$i]->bus_photo)[0];
                    $single_photo = str_replace("\\", '', $photo);

                    $img = "<img class='rounded-circle me-2' src='" . $aws_base_url . $single_photo . "' alt='" . $records[$i]->bus_plate_number . "' style='width:40px;height:40px;' />";
                }else{
                    $img = "<img class='rounded-circle me-2' src='" . $placeholder . "' alt='" . $records[$i]->bus_plate_number . "' style='width:40px;height:40px;' />";
                }

                $traveling_from = $this->buses_terminal_m->get_terminal($records[$i]->traveling_from);
                $arriving_at = $this->buses_terminal_m->get_terminal($records[$i]->$arriving_at);

		      	$html = '<div class="d-flex align-items-center">';
				$html .= $img;
				$html .= '<div class="d-flex flex-column">';
				$html .= '<h6 class="fw-semibold mb-1" style="font-size:13px">' . strtoupper($records[$i]->bus_make . ' ' . $records[$i]->bus_model) . '</h6>';
				$html .= '<p class="fw-normal mb-0 m-0" style="font-size:13px">' . $records[$i]->bus_plate_number . '</p>';
				$html .= '</div>';
				$html .= '</div>';

		         $data[] = [
                    "vehicle" => $html,
                    "depart_from" => '<span class="d-flex align-self-start"  style="font-size:12px">' . ($traveling_from ? $traveling_from->terminal_name : '') . "</span>",
		            "arrived_at" => '<span class="d-flex align-self-start"  style="font-size:12px">' . ($arriving_at ? $arriving_at->terminal_name : '') . "</span>",
                    'travel_time' => '<span class="d-flex align-self-start"  style="font-size:12px">' . $records[$i]->departure_time . '</span>',
                    'travel_date' => '<span class="d-flex align-self-start"  style="font-size:12px">' . $records[$i]->departure_date . '</span>',
                    'action' => $current_timestamp < $expiry_date ? '
		            	<a href="' . base_url('ticketing/ticket/' . $records[$i]->order_id) . '" role="button" disabled>
							<span class="badge text-bg-primary"><i class="fa-solid fa-print-slash"></i></span></a>' : 
                        '<a href="#" role="button"><span class="badge text-bg-secondary"><i class="fa-solid fa-print"></i></span></a>'
		        ];
		    }

		     $output = [
		         "draw" => intval($this->input->post('draw')),
		         "recordsTotal" => intval($totalData),
		         "recordsFiltered" => intval($totalFiltered),
		         "data" => $data
		     ];

		     
		 }else{
		 	$output = [
		         "draw" => intval($this->input->post('draw')),
		         "recordsTotal" => 0,
		         "recordsFiltered" => 0,
		         "data" => []
		     ];
		 }

		echo json_encode($output);
		exit;
    }

    public function reviews(){
        if($this->session->loggedIn || (NULL != $this->session->loggedInUserID)){
            $customer_id = $this->session->loggedInUserID;

            $review_records = $this->rating_m->get_customer_ratings($customer_id);
            $review_avg = $this->rating_m->get_avg_customer_ratings($customer_id);
            $progress = $this->rating_m->progress_bar_data($customer_id);
            
            $this->data['title'] = 'Customer\'s Ratings/Reviews';
            $this->data['subview'] = 'customer/reviews';
            $this->data['reviews'] = $review_records;
            $this->data['avg_customer_rating'] = $review_avg->avg_rating;

            $this->data['rating_progress'] = json_encode($progress);

            $this->load->view('_layout', $this->data);
        }else{
            $this->session->set_flashdata('error', 'Unauthorized request! Please Login!!');
            redirect(base_url());
        }
    }

    public function update_login(){
        if($this->session->loggedIn == TRUE || (NULL != $this->session->loggedInUserID)){
            $customer_id = $this->session->loggedInUserID;
            $customer = $this->customer_m->get_customer($customer_id);

            $this->data['title'] = 'Update Login';
            $this->data['customer'] = $customer;
            $this->data['subview'] = 'customer/update_login';
            $this->load->view('_layout', $this->data);
        }else{
            $this->session->set_flashdata('error', 'Unauthorized request! Please Login!!');
            redirect(base_url());
        }
    }

    public function do_update_login(){
        if($_POST){
            $this->form_validation->set_rules($this->update_login_rules());

            if($this->form_validation->run() == FALSE){
                $this->update_login();
            }else{
                $customer_id = $this->session->loggedInUserID;
                $customer = $this->customer_m->get_customer($customer_id);

                $username = $this->input->post('usn');
                $password = $this->input->post('pwd');
                $update = FALSE;

                if($username != '' || (NULL != $username)){
                    $data = ['username' => $username];
                    $update = $this->customer_m->update_customer_info(['customer_id' => $customer_id], $data);
                }

                if($password != '' || (NULL != $password)){
                    $password_hash = hash_string($password);

                    $email = $customer->email;
                    $surname = $customer->surname;
                    $firstname = $customer->first_name;
                    $subject = 'Account Update';

                    $request_time = date('F jS, Y H:i', strtotime(date('Y-m-d H:i:s')));

                    $body = 'Hello ' . $surname. ', ' . $firstname;
                    $body .= '<br/><br /> A password update request was made on your account on <b>' . $request_time . '</b>';
                    $body .= '<br />If you did not make this request, please contact our web administrator immediately!';
                    $body .= '<br /><br /><br />Thank you for your time, always!';

                    $this->mailer->send($email,$surname . ', ' . $firstname,$body,$subject);

                    $update = $this->customer_m->update_customer_info(['customer_id' => $customer_id], ['password' => $password_hash]);
                }

                if($update){
                    $this->session->set_flashdata('success', 'Requested action has been completed successfully!!');
                    redirect(base_url('customer/update_login'));
                }else{
                    $this->session->set_flashdata('success', 'Update request failed! Please try again!');
                    redirect(base_url('customer/update_login'));
                }
            }
        }else{
            $this->session->set_flashdata('error', 'Invalid Request!');
            redirect(base_url('customer/update_login'));
        }
    }

    public function get_lgas(){
        $state = $this->input->post('state');
        $lgas = $this->customer_m->get_lgas($state);
        $output = NULL;

        if(NULL!=$lgas){
            foreach($lgas as $key){
                $output[] = [
                    'id' => $key->id,
                    'name' => $key->name
                ];
            }
        }

        echo json_encode(['data' => $output]);
    }

    public function register_rules(){
        return [
            [
                'field' => 'last_name',
                'label' => 'Last Name/Surname',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'first_name',
                'label' => 'First Name',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'phone',
                'label' => 'Phone Number',
                'rules' => 'trim|required|min_length[11]|max_length[15]'
            ],
            [
                'field' => 'email',
                'label' => 'Email Address',
                'rules' => 'trim|required|valid_email'
            ]
        ];
    }

    public function update_info_rules(){
        return [
            [
                'field' => 'last_name',
                'label' => 'Last Name/Surname',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'first_name',
                'label' => 'First Name',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'phone',
                'label' => 'Phone Number',
                'rules' => 'trim|required|min_length[11]|max_length[15]'
            ],
            [
                'field' => 'email',
                'label' => 'Email Address',
                'rules' => 'trim|required|valid_email'
            ],
            [
                'field' => 'address',
                'label' => 'Customer Address',
                'rules' => 'trim|required'
            ]
        ];
    }

    public function update_login_rules(){
        return [
            [
                'field' => 'pwd',
                'label' => 'Password',
                'rules' => 'trim|alpha_numeric'
            ],
            [
                'field' => 'usn',
                'label' => 'Username',
                'rules' => 'trim'
            ]
        ];
    }

}