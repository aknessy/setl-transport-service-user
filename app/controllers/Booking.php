<?php

/**
* @package CrossRiver Pay
* @author Nugi Technologies Development Team
* @copyright 2016
**/

class Booking extends CI_Controller {

    const page_title = 'Bus Booking | ';

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

	function __construct(){
		parent::__construct();
       
		$this->load->model(
            [
                'buses_m', 
                'buses_terminal_m', 
                'booking_m', 
                'tfare_m', 
                'customer_m', 
                'rating_m',
                'invoicing_m'
            ]);
		$this->load->helper(['random_uuid', 'random_string']);
        $this->load->library('pagination');
	}

    public function index(){
        $destinations = $this->buses_terminal_m->get_terminals();
        $cost_filter = $this->tfare_m->filter_tfare();
        $vehicle_manufacturer = $this->buses_m->filter_bus_manufacturer();
        $bus_type = $this->buses_m->filter_bus_type();
        $schedule_times = $this->buses_m->filter_schedules();

        $count_destinations = $this->buses_terminal_m->count_all();
        $count_buses = $this->buses_m->count_all();

        $this->data['title'] = self::page_title . 'Index';
        $this->data['subview'] = 'booking/index';
        $this->data['destinations'] = $destinations;
        $this->data['cost_filter'] = $cost_filter;
        $this->data['vehicle_manufacturers'] = $vehicle_manufacturer;
        $this->data['bus_type'] = $bus_type;
        $this->data['total_destinations'] = $count_destinations;
        $this->data['total_buses'] = $count_buses;
        $this->data['schedules'] = $schedule_times;
        
        $this->load->view('_layout', $this->data);
    }

    public function available(){
        if($_POST){            
            $filter = $this->input->post('filter');
    
            $aws_base_url = $this->settings_m->getOne(array('skey' => 'aws_base_url'))->value;
            
            $destinations = $this->buses_terminal_m->get_terminals();
            $cost_filter = $this->tfare_m->filter_tfare();
            $vehicle_manufacturer = $this->buses_m->filter_bus_manufacturer();
            $bus_type = $this->buses_m->filter_bus_type();
            $schedule_times = $this->buses_m->filter_schedules();

            $count_destinations = $this->buses_terminal_m->count_all();
            $count_buses = $this->buses_m->count_all();                                
            
            $this->data['destinations'] = $destinations;
            $this->data['cost_filter'] = $cost_filter;
            $this->data['vehicle_manufacturers'] = $vehicle_manufacturer;
            $this->data['bus_type'] = $bus_type;
            $this->data['total_destinations'] = $count_destinations;
            $this->data['total_buses'] = $count_buses;
            $this->data['schedules'] = $schedule_times;
            $this->data['aws_base_url'] = $aws_base_url;

            $records = [];

            switch($filter){
                // case 'terminals':
                //     $terminal = $this->input->post('terminal');

                //     break;
                // case 'price':
                //     break;
                // case 'manufacturer':
                //     break;
                // case 'bus_type':
                //     break;
                default:
                    $from_terminal = $this->input->post('travel_from');
                    $destination = $this->input->post('destination');
                    $travel_time = $this->input->post('travel_time');
                    $travel_date = $this->input->post('travel_date');

                    $cost = $this->tfare_m->traveling_cost($from_terminal, $destination);
                    $this->data['cost_of_travel'] = (!empty($cost) ? $cost->amount : 0);
                    
                    $this->data['travel_to'] = $destination;
                    $this->data['travel_from'] = $from_terminal;
                    $this->data['travel_date'] = $travel_date;
                    $this->data['travel_time'] = $travel_time;
            
                    $filter_params = [
                        'b.end_terminal' => $destination,
                        'b.start_terminal' => $from_terminal
                    ];
                    
			        $records = $this->booking_m->get_available($filter_params);
                    
                break;
            }
            
            $this->data['buses'] = $records;

            $config['base_url'] = base_url('booking/available');
            $config['full_tag_open'] = '<ul>';
            $config['full_tag_open'] = '</ul>';
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            
            $config['uri_segment'] = 3;
            $config['total_rows'] = count($records);
            $config['per_page'] = 20;            

            $this->pagination->initialize($config);
            $this->data['page_links'] = $this->pagination->create_links();

            echo $this->load->view('booking/buses_list', $this->data, TRUE);
        }
    }

    public function reserve($bus_id, $destination, $origin, $time, $date){
        $bus = $this->buses_m->get_bus_by_id($bus_id);
        $saved_seats = $this->buses_m->get_bus_seats($bus_id);
        $cost = $this->tfare_m->traveling_cost($origin, $destination);
        $cost_of_travel = (!empty($cost) ? $cost->amount : 0);

        $this->data['title'] = self::page_title . 'Seat Picker';
        $this->data['bus'] = $bus;
        $this->data['bus_seats'] = $saved_seats;
        
        $this->data['travel_from'] = $origin;
        $this->data['travel_to'] = $destination;
        $this->data['travel_time'] = $time;
        $this->data['travel_date'] = $date;

        $this->data['subview'] = 'booking/' . $bus->bus_type;        
        $this->data['cost_of_travel'] = $cost_of_travel;
        
        if($_POST)
        {
            $order_id = date('Y').strtoupper(getToken(11));
            $selected_seats = $this->input->post('selected_seats');
            $created_on = date('Y-m-d H:i:s');

            $update_bus_seats = [];
            $reserved_seats = NULL;
            $count_seats = 0;

            if(strpos($selected_seats, ',') == TRUE)
			{
                $reserved_seats = explode(',', $selected_seats);
                $count_seats = count($reserved_seats);
                
                foreach($saved_seats as $seat) {
                    foreach($reserved_seats as $rseat){		
                        $seat_id = explode(':',$rseat)[0];
                        $seat_label = explode(':', $rseat)[1];

                        if ($seat->id == $seat_id && $seat->seat_label == $seat_label && $seat->is_reserved != 1) {
                            $update_bus_seats [$seat_id] = [
                                'is_reserved' => 2// Seat is selected for payment
                            ];
                        }
                    }
                }
            }else if($selected_seats !== ''){
                $count_seats = 1;
                // echo $selected_seats;
                $seat_id = explode(':',$selected_seats)[0];
                $seat_label = explode(':', $selected_seats)[1];
                
                foreach($saved_seats as $seat)
                {
                    if($seat->id == $seat_id && $seat->seat_label == $seat_label && $seat->is_reserved != 1){
                        $update_bus_seats [$seat_id] = [
                            'is_reserved' => 2// Seat is selected for payment
                        ];
                    }
                }
            }else{
                $this->session->set_flashdata('error', 'Please pick a preferred seat or seats!');
                redirect(base_url('booking/reserve/' . $bus_id . '/' . $detination . '/' . $origin . '/' . $time . '/' . $date));
            }
            
            $update_counter = 0;

            foreach($update_bus_seats as $seat_id => $value)
            {
                $update = $this->buses_m->update_reserved_seats($bus_id, $seat_id, 
                    [
                        'is_reserved' => $value['is_reserved']
                    ]
                );

                if($update)
                    $update_counter++;
            }

            if($update_counter > 0)
            {
                if($this->session->loggedIn == TRUE || NULL != $this->session->loggedInUserID)
                {
                    $customer_id = $this->session->loggedInUserID;

                    $customer = $this->customer_m->get_customer($customer_id);                    
                    
                    $booking_data = [
                        'customer_id' => $customer_id,
                        'bus_id' => $bus_id,
                        'traveling_from' => $origin,
                        'arriving_at' => $destination,
                        'seats' => $selected_seats,
                        'total_seats' => $count_seats,
                        'departure_time' => SCHEDULE_TIME[$time],
                        'departure_date' => $date,
                        'active' => 1,
                        'created_at' => $created_on
                    ];

                    $insert = $this->booking_m->insert_booking_record($booking_data);

                    if($insert)
                    {
                        $order_id = date('Y').strtoupper(getToken(11));

                        $invoice_data = [
                            'invoice_id' => generateUuid(),
                            'bus_id' => $bus_id,
                            'order_id' => $order_id,
                            'customer_id' => $customer_id,
                            'booking_id' => $insert,
                            'invoice_for' => 'Seat Reservation for (' . $count_seats . ') seat(s)',
                            'amount' => $cost_of_travel,
                            'created_at' => $created_on,
                            'status' => 'UNPAID'
                        ];

                        $invoice_insert = $this->invoicing_m->insert_record($invoice_data);

                        if($invoice_insert){
                            $this->session->set_flashdata('success', 'Invoice Generated!');
                            redirect(base_url('invoicing/invoice/' . $order_id));
                        }else{
                            $this->session->set_flashdata('error', 'Unable to generate payment invoice, please try again!');
                            redirect(base_url('booking/reserve/'  . $bus_id . '/' . $destination . '/' . $origin . '/' . $time . '/' . $date));
                        }
						
                    }else{
                        $this->session->set_flashdata('error','Booking records not saved!');
						redirect(base_url('booking/reserve/'  . $bus_id . '/' . $destination . '/' . $origin . '/' . $time . '/' . $date));
                    }
                }else{
                    $booking_data = [
                        'bus_id' => $bus_id,
                        'traveling_from' => $origin,
                        'arriving_at' => $destination,
                        'seats' => $selected_seats,
                        'total_seats' => $count_seats,
                        'departure_time' => $time,
                        'departure_date' => $date,
                        'active' => 1,
                        'created_at' => $created_on
                    ]; 
                    
                    $insert = $this->booking_m->insert_booking_record($booking_data);

                    if($insert)
                    {
                        $order_id = date('Y').strtoupper(getToken(11));

                        $invoice_data = [
                            'invoice_id' => generateUuid(),
                            'bus_id' => $bus_id,
                            'order_id' => $order_id,
                            'booking_id' => $insert,
                            'invoice_for' => 'Seat Reservation for (' . $count_seats . ') seat(s)',
                            'amount' => $cost_of_travel,
                            'created_at' => $created_on,
                            'status' => 'UNPAID'
                        ];
                        
                        $invoice_insert = $this->invoicing_m->insert_record($invoice_data);

                        if($invoice_insert){
                            $this->session->set_flashdata('success', 'Invoice Generated!');
                            redirect(base_url('invoicing/invoice/' . $order_id));
                        }else{
                            $this->session->set_flashdata('error', 'Unable to generate payment invoice, please try again!');
                            redirect(base_url('booking/reserve/'  . $bus_id . '/' . $destination . '/' . $origin . '/' . $time . '/' . $date));
                        }
						
                    }else{                        
                        $this->session->set_flashdata('error','Booking records not saved!');
						redirect(base_url('booking/reserve/'  . $bus_id . '/' . $destination . '/' . $origin . '/' . $time . '/' . $date));
                    }
                }
            }else{
                $this->session->set_flashdata('error','Booking records not saved!');
                redirect(base_url('booking/reserve/'  . $bus_id . '/' . $destination . '/' . $origin . '/' . $time . '/' . $date));
            }

            redirect(base_url('invoicing/invoice/'));

        }else{
            $this->load->view('_layout', $this->data);
        }
    }

}