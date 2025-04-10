<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* @package Setl Tranport Company
* @author Nugi Technologies Development Team
* @copyright 2025
**/

class Payment extends CI_Controller {

    const page_title = 'Payment | ';

    const REVERSE_SCHEDULE_TIME = [
        '6:00 AM' => '06',
        '7:00 AM' => '07',
        '8:00 AM' => '08',
        '9:00 AM' => '09',
        '10:00 AM' => '10',
        '11:00 AM' => '11',
        '12:00 PM' => '12',
        '01:00 PM' => '13',
        '02:00 PM' => '14',
        '03:00 PM' => '15',
        '04:00 PM' => '16'
    ];

	function __construct(){
		parent::__construct();

        // if(!$this->session->loggedin){
        //     $this->session->set_flashdata('error', 'You must be logged In!');
        //     redirect(base_url('login'));
        // }
       
		$this->load->model(
            [
                'buses_m', 
                'buses_terminal_m', 
                'booking_m', 
                'tfare_m', 
                'customer_m', 
                'invoicing_m'
            ]);

		$this->load->helper(['random_uuid', 'random_string']);
        $this->load->library('mailer');
	}

    public function index(){
        if($_POST){
            $order_id = $this->input->post('orderID');
            $payment_desc = $this->input->post('paymentDesc');
            $payment_amt = $this->input->post('amount');

            $create = NULL;
            $customer_id = NULL;

            $payer = '';
            $payer_phone = '';
            $payer_email = '';
            $nok = '';
            $nok_phone = '';

            if($this->session->loggedIn || NULL!= $this->session->loggedInUserID){
                $customer_id = $this->session->loggedInUserID;
                $customer = $this->customer_m->get_customer($customer_id);
                $payer = $customer->surname . ', ' . $customer->first_name . ' ' . $customer->middle_name;
                $payer_phone = $customer->phone;
                $payer_email = $customer->email;
                $nok = $customer->nok_name;
                $nok_phone = $customer->phone;
            }else{
                $payer_fname = $this->input->post('first_name');
                $payer_lname = $this->input->post('last_name');
                $payer_phone = $this->input->post('phone');
                $payer_email = $this->input->post('email');
                $nok = $this->input->post('nok_name');
                $nok_phone = $this->input->post('nok_phone');

                $payer = $payer_lname . ', ' . $payer_fname;

                $save_info = $this->input->post('save_info');

                if($save_info){
                    $this->form_validation->set_rules($this->booking_rules());

                    if($this->form_validation->run() == FALSE){
                        $this->session->set_flashdata('form_errors', validation_errors('<span>','</span>'));
                        $this->session->set_flashdata('form_data', $this->input->post());
                        
                        redirect(base_url('invoicing/invoice/'.$order_id));
                    }else{
                        $customer = [
                            'customer_id' => generateUuid(),
                            'surname' => $payer_lname,
                            'first_name' => $payer_fname,
                            'phone' => $payer_phone,
                            'email' => $payer_email,
                            'nok_name' => $nok,
                            'nok_phone' => $nok_phone,
                            'created_on' => date('Y-m-d H:i:s')
                        ];

                        $create = $this->customer_m->create_customer($customer);
                        unset($this->session->form_data);

                        $body = 'Hey ' . $payer. '<br/>Use this code: ' . $verification_code . '<br/> to verify your email!';
                        $subject = 'E-mail Verification';
                        
                        $this->mailer->send($payer_email,$name,$body,$subject);

                        $this->session->set_flashdata('success', 'Customer Information saved! Please check your registered email for a verification code.');
                    }
                }
            }

            $update_bus_seats = [];
            $is_logged_in = FALSE;

            if($this->session->loggedIn || $this->session->loggedInUserID != NULL){
                $is_logged_in = TRUE;
            }

            /**
             * The following should be handled after payment gateway has confirmed customer's payment.
             * 
             * 1.) Update the payment status in the invoice table to 'PAID' for successful payment
             * 2.) Update the selected seat(s) to 1 to signify the seat has been reserved. Currently the status
             *      is 2 for "Seat Selected."
             * 3.) Redirect to Ticketing Controller for the user's ticket
             */
            $invoice_record = $this->invoicing_m->get_invoice($order_id, $is_logged_in);

            if(empty($invoice_record)){
                $this->session->set_flashdata('error', 'No invoice record found for the given Order ID `'. $order_id . '`');
                redirect(base_url('invoicing/invoice/'.$order_id));
            }

            $booking = $this->booking_m->get_selected_seats($invoice_record->booking_id, $invoice_record->bus_id);
            $saved_seats = $this->buses_m->get_bus_seats($invoice_record->bus_id);            
            $selected_seats = NULL;

            if(NULL!= $create){
                $new_customer = $this->customer_m->get_customer_by_id($create);

                if($new_customer){
                    $this->invoicing_m->update_invoice_record(['id' => $new_customer->id], ['customer_id' => $new_customer->customer_id]);
                    $this->booking_m->update($invoice_record->booking_id, ['customer_id' => $new_customer->customer_id]);
                }
            }

            /**
             * We could have easily fetched the seats from the invoice records object, but what if the customer 
             * has previously traveled with the same bus to the same destination more than once?
             */
            if(!empty($booking)){
                $selected_seats = $booking->seats;
            }else{
                $this->session->set_flashdata('error', 'No bus reservation was found associated with the giving Order ID!');
                redirect(
                    base_url(
                        'booking/reserve/'.$booking->bus_id.'/'
                        .$booking->arriving_at.'/'
                        .$booking->traveling_from.'/'
                        .self::REVERSE_SCHEDULE_TIME[$booking->departure_time].'/'
                        .str_replace('-',':',$booking->departure_date)
                    )
                );
            }

            if(strpos($selected_seats, ',') == TRUE){
                $reserved_seats = explode(',', $selected_seats);
                $count_seats = count($reserved_seats);
                
                foreach($saved_seats as $seat) {
                    foreach($reserved_seats as $rseat){		
                        $seat_id = explode(':',$rseat)[0];
                        $seat_label = explode(':', $rseat)[1];

                        if ($seat->id == $seat_id && $seat->seat_label == $seat_label && $seat->is_reserved != 1) {
                            $update_bus_seats [$seat_id] = [
                                'is_reserved' => 1 // Since payment was successful, this seat is now reserved!
                            ];
                        }
                    }
                }
            }else{					
                $seat_id = explode(':',$selected_seats)[0];
                $seat_label = explode(':', $selected_seats)[1];
                
                foreach($saved_seats as $seat)
                {
                    if($seat->id == $seat_id && $seat->seat_label == $seat_label && $seat->is_reserved != 1){
                        $update_bus_seats [$seat_id] = [
                            'is_reserved' => 1 // Since payment was successful, this seat is now reserved!
                        ];
                    }
                }
            }

            /**
             * Next update the bus seats in the database to ensure that someone else
             * who wants a seat reservation will see the already reserved seats.
             */
            $update_counter = 0;
            
            foreach($update_bus_seats as $seat_id => $value){
                $update = $this->buses_m->update_reserved_seats($invoice_record->bus_id, $seat_id, 
                    [
                        'is_reserved' => $value['is_reserved'],
                        'reserved_time' => date('Y-m-d H:i:s')
                    ]
                );

                if($update)
                    $update_counter++;
            }

            /**
             * Redirect to the ticketing controller to generate bus reservation ticket
             */
            redirect(base_url('ticketing/ticket/' . $order_id));
        }else{
            $this->session->set_flashdata('error', 'No Order ID found, ensure this is a valid invoice!');
            redirect(base_url('invoicing'));
        }
    }

    public function reschedule_reservation(){
        if($_POST){
            $order_id = $this->input->post('orderID');

            $customer_id = $this->input->post('customerID');
            $payer_name = $this->input->post('payer');
            $payer_phone = $this->input->post('payerPhone');
            $payer_email = $this->input->post('payerEmail');
            $payment_desc = $this->input->post('paymentDesc');

            /**
             * The following should be handled after payment gateway has confirmed customer's payment.
             * 
             * 1.) Update the payment status in the invoice table to 'PAID' for successful payment
             * 2.) Update the selected seat(s) to 1 to signify the seat has been reserved. Currently the status
             *      is 2 for "Seat Selected."
             * 3.) Redirect to Ticketing Controller for the user's ticket
             */
            $invoice_record = $this->invoicing_m->get_invoice($order_id);

            if(empty($invoice_record)){
                $this->session->set_flashdata('error', 'No invoice record found for the given Order ID `'. $order_id . '`');
                redirect(base_url('invoicing/reschedule_fee_invoice/' . $order_id));
            }

            $reschedule_record = $this->bookings_m->get_reschedule_record(['booking_id' => $invoice_record->booking_id]);

            if($reschedule_record){
                $update_schedule = [
                    'departure_date' => $reschedule_record->reschedule_to_date,
                    'departure_time' => $reschedule_record->reschedule_to_time
                ];

                $update_booking = $this->bookings_m->update($invoice_record->booking_id, $update_schedule);

                if($update_booking){
                    $this->session->set_flashdata('success','Bus Reservation rescheduled to: ' . 
                    date('F jS, Y', strtotime($reschedule_record->reschedule_to_date)) . ' @' . $reschedule_record->reschedule_to_time);

                    $this->bookings_m->delete_reschedule_record(['order_id' => $order_id]);
                    
                    redirect(base_url('ticketing/ticket/' . $order_id));
                }
            }else{
                $this->session->set_flashdata('error', 'No reschedule record found for the selected booking');
                redirect(base_url('bookings/view/' . $invoice_record->booking_id));
            }
        }else{
            $this->session->set_flashdata('error','Invalid request!');
            redirect(base_url('bookings'));
        }
	}

    public function booking_rules(){
        return [
            [
                'field' => 'last_name',
                'label' => 'Last Name',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'first_name',
                'label' => 'First Name',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'email',
                'label' => 'Email Address',
                'rules' => 'trim|required|valid_email'
            ],
            [
                'field' => 'phone',
                'label' => 'Phone Number',
                'rules' => 'trim|required|min_length[10]'
            ]
        ];
    }
}