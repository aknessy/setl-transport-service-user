<?php

/**
* @package CrossRiver Pay
* @author Nugi Technologies Development Team
* @copyright 2016
**/

class Login extends CI_Controller {

    const page_title = 'Customer Login | ';

	function __construct(){
		parent::__construct();
       
		$this->load->model('login_m');
		$this->load->helper(['random_uuid', 'random_string', 'password_hash']);
        $this->load->library('pagination');
	}

    public function index(){
        $this->data['title'] = self::page_title . 'Index';
        $this->data['subview'] = 'login/index';

        if($_POST){
            $this->form_validation->set_rules($this->login_form_rules());

            if($this->form_validation->run() == FALSE){
                $this->index();
            }else{
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $password_hash = hash_string(trim($password));
                
                $login = $this->login_m->login(trim($email), $password_hash);

                if($login){
                    $this->session->set_flashdata('success', 'Login successful!');
                    redirect(base_url());
                }

                $this->session->set_flashdata('error', 'Login credentials are invalid!');
                redirect(base_url('login'));
            }
        }else{
            $this->load->view('login_layout', $this->data);
        }
    }

    public function logout(){
		session_destroy();
        $refer =  $_SERVER['HTTP_REFERER'];
		$url = ($refer ? '?url='.$refer : '');
		redirect(base_url('login'.$url));
	}

    public function login_form_rules(){
        return [
            [
                'field' => 'email',
                'label' => 'Email',
                'rules' => 'trim|required|valid_email'
            ],
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|required'
            ]
        ];
    }

}