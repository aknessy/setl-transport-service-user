<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* @package Setl Tranport Company
* @author Nugi Technologies Development Team
* @copyright 2025
**/

class Tfare extends CI_Controller {

    const page_title = 'Transportation Fare Management | ';

	function __construct(){
		parent::__construct();

        // if($this->session->loggedIn == FALSE){
        //     $this->session->set_flashdata('error', 'You must be logged In!');
        //     redirect(base_url('login'));
        // }
       
		$this->load->model(array('booking_m', 'buses_m', 'buses_terminal_m', 'tfare_m'));
        $this->load->helper('random_string');
	}

    public function calculate_discount_price(){
        if($_POST){
            $customer_id = $this->session->loggedInUserID;

            $discount_code = $this->input->post('discountCode');
            // $origin = $this->input->post('origin');
            // $destination = $this->input->post('destination');

            $discount = $this->tfare_m->get_discount_by_code($discount_code);
            // $travel_cost = $this->tfare_m->traveling_cost($origin, $destination);
            $discount_to_apply = 0;
            $msg = '';

            if(!empty($discount)){
                $active = $discount->active;
                $start_date = $discount->start_date;
                $expiry_date = (NULL != $discount->expiry_date ? strtotime($discount->expiry_date) : NULL);

                $current_timestamp = strtotime(date('Y-m-d'));

                if($active == 1){
                    if(NULL != $expiry_date && ($current_timestamp < $expiry_date)){
                        $applicable_to = $discount->applies_to;
                        $percent_discounted = $discount->percent_discounted;

                        $num_customer_travels = 0;

                        if($applicable_to == 'Travels Made'){
                            $num_customer_travels = $this->count_customer_travels($customer_id);
                            $qualified_num_travels = intval($discount->min_num_of_travels);

                            if($num_customer_travels >= $qualified_num_travels){
                                //$cost = (!empty($travel_cost) ? $travel_cost->amount : 0);
                                //$amt_to_discount = $this->actual_discount_amt($percent_discounted, $cost);
                                //$payable_amt = ($cost - $amt_to_discount);
                                $discount_to_apply = $percent_discounted;
                                $msg = 'Discount Calculated';
                            }else{
                                $msg = 'Customer Not Qualified';
                            }
                        }

                        if($applicable_to == 'Amount Spent'){
                            $amt_customer_spent = $this->calculate_amt_customer_spent($customer_id);
                            $min_amt_to_qualify = $discount->min_amt;

                            if($amt_customer_spent >= $min_amt_to_qualify){
                                //$cost = (!empty($travel_cost) ? $travel_cost->amount : 0);
                                //$amt_to_discount = $this->actual_discount_amt($percent_discounted, $cost);
                                //$payable_amt = ($cost - $amt_to_discount);
                                $discount_to_apply = $percent_discounted;
                                $msg = 'Discount Calculated';
                            }else{
                                $msg = 'Customer Not Qualified';
                            }
                        }
                    }else{
                        $msg = 'Discount/Voucher Code has expired!';
                    }
                }else{
                    $msg = 'Discount/Voucher Code is not active!';
                }
            }else{
                $msg = 'Invalid Discount/Voucher Code';
            }

            echo json_encode(
                [
                    'applicable_discount' => $discount_to_apply,
                    'msg' => $msg
                ]
            );
        }
    }

    private function count_customer_travels($customer_id){
        $records = $this->booking_m->get_customer_bookings($customer_id);
    
        if($records){
            return count($records);
        }

        return 0;
    }

    private function calculate_amt_customer_spent($customer_id){
        $record = $this->booking_m->amount_spent_by_customer($customer_id);
        $total_amt = 0;

        if($record){
            $total_amt = $record->total_amt;
        }

        return $total_amt;
    }

    private function actual_discount_amt($percent_value, $amt_to_discount){
        $percent_value = ($percent_value / 100);
        return ($amt_to_discount * $percent_value);
    }

}