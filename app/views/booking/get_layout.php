<?php
    if($buses){
        $layouts = [
            'shuttle' => 'shuttle',
            'mini-bus' => 'mini_bus',
            'coach' => 'coach',
        ];

        $schedule_time = [
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
        ]

?>

<div class="col-lg-12 col-md-12 col-sm-12 mt-2">
    <div class="card card-body shadow-none">
        <div class="table-responive">
            <table id="busBookingTable" class="table table-striped table-bordered table-centered">
                <thead class="table-light">
                    <tr>
                        <th>S/N</th>
                        <th>BUS PHOTO</th>
                        <th>BUS DESCRIPTION</th>
                        <th>TRAVELING FROM</th>
                        <th>TRAVELING TO</th>
                        <th class="text-end">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $layout = NULL;
                    $placeholder = 'https://via.placeholder.com/200x200';
                    $img = '';

                    $index = 1;

                    foreach($buses as $bus)
                    {        
                        if(NULL != $bus->bus_photo || json_decode($bus->bus_photo)){
                            $bus_photo = json_decode($bus->bus_photo);
                            $single_photo = NULL != $bus_photo ? str_replace("\\", '', $bus_photo):'';                        
                            $img = "<img class='rounded-circle me-2' src='" . $single_photo . "' alt='" . $bus->bus_plate_number . "' style='width:40px;height:40px;' />";
                        }else{
                            $img = "<img class='rounded-circle me-2' src='" . $placeholder . "' alt='" . $bus->bus_plate_number . "' style='width:40px;height:40px;' />";
                        }

                        $bus_schedule = $this->buses_m->get_bus_schedule($bus->bus_id);
                        $bus_type = $bus->bus_type;
                        $layout = $layouts[strtolower($bus_type)];                        
                    ?>
                        <tr>
                            <td><?=$index?>.</td>
                            <td><?=$img?></td>
                            <td><?=$bus->bus_make . ' ' . $bus->bus_model?></td>
                            <td><?=$this->buses_terminal_m->get_terminal($origin)->terminal_name?></td>
                            <td><?=$this->buses_terminal_m->get_terminal($destination)->terminal_name?></td>
                            <td class="text-end">
                                <button class="busBookingDetails btn btn-dark" data-target="#content<?=$index?>">Expand</button>
                            </td>
                        </tr>
                        <tr id="content<?=$index?>">
                            <td colspan="6">
                                <div class="row px-3 pb-0">
                                    <div class="col-sm-12">
                                        <form id="seatsForm<?=$index?>" action="<?=base_url('bookings/process')?>" method="post">
                                            
                                            <input type="hidden" name="bus_id" value="<?=$bus->bus_id?>" />
                                            <input type="hidden" name="traveling_to" value="<?=$destination?>" />
                                            <input type="hidden" name="traveling_from" value="<?=$origin?>" />
                                            <!-- <input type="hidden" name="schedule_time" value="<?=$schedule_time[$departure_time]?>" /> -->
                                            <input type="hidden" name="schedule_date" value="<?=$departure_date?>" />

                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 py-2 px-2 rounded" style="background-color:whiteSmoke;1px solid #d1d1d1">
                                                    <div class="row mb-2">
                                                        <div class="col-lg-4 col-sm-6">
                                                            <label for="customer_sname<?=$index?>" class="form-label fw-semibold mb-0">Customer Surname</label>
                                                            <input type="text" name="customer_sname" id="customer_sname<?=$index?>" value="" placeholder="Customer Surname" class="form-control" required />
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6">
                                                            <label for="customer_fname<?=$index?>" class="form-label fw-semibold mb-0">Customer Firstname</label>
                                                            <input type="text" name="customer_fname" id="customer_fname<?=$index?>" value="" placeholder="Customer Firstname" class="form-control" required />
                                                        </div>
                                                        <div class="col-lg-4 col-sm-6">
                                                            <label for="customer_othername<?=$index?>" class="form-label fw-semibold mb-0">Other Name(s)</label>
                                                            <input type="text" name="other_names" id="customer_othername<?=$index?>" value="" placeholder="Othernames/Middlename" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-6">
                                                            <label for="customer_phone<?=$index?>" class="form-label fw-semibold mb-0">Phone Number</label>
                                                            <input type="text" name="customer_phone" id="customer_phone<?=$index?>" value="" placeholder="Phone Number" class="form-control" required />
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <label for="customer_email<?=$index?>" class="form-label fw-semibold mb-0">Email</label>
                                                            <input type="email" name="customer_email" id="customer_email<?=$index?>" value="" placeholder="Email Address" class="form-control" required />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-2">
                                                        <div class="col-sm-12 col-md-4 col-lg-4">
                                                            <label for="nok_name<?=$index?>" class="form-label fw-semibold mb-0">Next of Kin</label>
                                                            <input type="text" name="nok_name" id="nok_name<?=$index?>" value="" placeholder="Next of Kin Name" class="form-control" required />
                                                        </div>
                                                        <div class="col-sm-12 col-lg-4 col-md-4">
                                                            <label for="nok_phone<?=$index?>" class="form-label fw-semibold mb-0">Next of Kin Phone Number</label>
                                                            <input type="text" name="nok_phone" id="nok_phone<?=$index?>" value="" placeholder="Phone Number of Next of Kin" class="form-control" required />
                                                        </div>
                                                        <div class="col-sm-12 col-lg-4 col-md-4">
                                                            <label for="nok_email<?=$index?>" class="form-label fw-semibold mb-0">Next of Kin Email</label>
                                                            <input type="email" name="nok_email" id="nok_email<?=$index?>" value="" placeholder="Email Address of Next of Kin" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-lg-3">
                                                    <img src="<?=base_url('assets/images/products/01.png')?>" alt="" class="img-fluid" height="200px;" width="200px" />
                                                </div>
                                                <div class="col-lg-9">
                                                    <div class="d-flex flex-column">                                                
                                                        <div class="d-flex align-items-center justify-content-between w-100">
                                                        <?php

                                                            if($bus_schedule){
                                                                $schedule_time_counter = 1;

                                                                echo '<div class="d-flex flex-column align-items-start">';
                                                                echo '<h4 class="fs-14 fw-semibold">Schedule Time</h4>';
                                                                echo '<div class="d-flex align-items-center justify-content-start mb-2 pb-2">';
                                                                
                                                                foreach($bus_schedule as $obj){?>
                                                                    <div class="form-check form-switch form-switch-info me-2">
                                                                        <input class="form-check-input" type="radio" id="timeSwitch<?=$schedule_time_counter?>" name="schedule_time" value="<?=$schedule_time[$obj->schedule_time]?>" required>
                                                                        <label class="form-check-label" for="timeSwitch<?=$schedule_time_counter?>"><?=$schedule_time[$obj->schedule_time]?></label>
                                                                    </div>
                                                                <?php
                                                                    $schedule_time_counter++;
                                                                }
                                                                echo '</div>';
                                                                echo '</div>';
                                                            }
                                                            ?>
                                                            <!-- <div class="p-3 alert alert-info border-2 d-flex align-items-center py-2 px-2 flex-column">
                                                                <h5 class="mb-0 fw-semibold fs-12">Scheduled Departure Date</h5>
                                                                <p class="text-muted fs-12 mb-0"><?=date('F jS, Y', strtotime($bus->schedule_date))?></p>
                                                            </div> -->
                                                            <div class="p-3 alert alert-info border-2 d-flex align-items-center py-2 px-2 flex-column">
                                                                <h5 class="mb-0 fw-semibold fs-12">Bus Capacity</h5>
                                                                <p class="text-muted fs-12 mb-0"><?=$bus->bus_capacity?> Passengers Seat</p>
                                                            </div>
                                                            <div class="p-3 alert alert-info border-2 d-flex align-items-center py-2 px-2 flex-column">
                                                                <h5 class="mb-0 fw-semibold fs-12">Vehicle Make & Model</h5>
                                                                <p class="text-muted fs-12  mb-0"><?=$bus->bus_make . ' ' . $bus->bus_model?></p>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <?php 
                                                        $bus_seats = $this->buses_m->get_bus_seats($bus->bus_id);
                                                        
                                                        if($bus_seats)
                                                        {
                                                            $currentDateTime = date('Y-m-d H:i:s');
                                                            $currentTimestamp = strtotime($currentDateTime);

                                                            foreach($bus_seats as $seat){
                                                                // Avoid updating the driver's seat
                                                                if($seat->id != 1){
                                                                    // Ensure that there's a seat reserved time & the seat was not rescheduled
                                                                    if($seat->reserved_time && $seat->is_rescheduled == 0)
                                                                    {
                                                                        //Specify the target timestamp
                                                                        $targetDate = $seat->reserved_time;
                                                                        $targetTimestamp = strtotime($targetDate);

                                                                        //Calculate the difference in milliseconds
                                                                        $timeDiff = $currentTimestamp - $targetTimestamp;
                                                                        
                                                                        //Convert the time difference to minutes
                                                                        $minuteDiff = $timeDiff /  60;
                                                                        
                                                                        if($minuteDiff >= 30){
                                                                            $update = [
                                                                                'is_reserved' => 0,
                                                                                'reserved_time' => NULL
                                                                            ];

                                                                            $this->buses_m->update_reserved_seats($bus->bus_id, $seat->id, $update);
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }

                                                        $bus_seats = $this->buses_m->get_bus_seats($bus->bus_id);

                                                        $data['outerIndex'] = $index;
                                                        $data['travel_cost_per_seat'] = $cost_of_travel;
                                                        $data['number_of_seats'] = $bus->bus_capacity;
                                                        $data['bus_seats'] =   $bus_seats;                                                      
                                                        $data['bus_id'] = $bus->bus_id;
                                                        echo $this->load->view('buses/layouts/' . $layout, $data, TRUE);
                                                    ?>                                           
                                                    
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>                                
                            </td>
                        </tr>                            
                        <?php  
                        $index++;  
                        echo '</tr>';
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
} ?>
