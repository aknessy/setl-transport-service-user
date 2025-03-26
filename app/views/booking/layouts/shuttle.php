<style>
    .bus-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f5f5f5;
    }

    .seatsForm {
        display: grid;
        grid-template-columns: repeat(3, 1fr); /* 3 seats per row */
        gap: 10px;
        max-width: 400px;
        /*transform: rotate(-90deg);*/
    }

    #seatLayout{
        display: contents;
    }

    #seatLayout .seat {
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        font-size: 12px;
        background-color: #f4f6f9;
        border: 1px solid #e2e7f1;
        padding: .3rem;
    }

    #seatLayout .last-row{
        grid-column: span 2;
    }

    #seatLayout .seat.is_driver {
        pointer-events: none;
    }

    #seatLayout .seat.pre-reserved{
        pointer-events: none;
    }

    #seatLayout .seat.pre-reserved,
    #seatLayout .seat.pre-reserved:hover{
        background-color: #22c5ad;
        border: 1px solid #1fb19c;
        color: white;        
    }
    #seatLayout .seat.reserved,
    #seatLayout .seat.reserved:hover{
        background-color: #95a0c5;
        border: 1px solid rgb(140, 151, 185);
        color: white; 
    }

    #seatLayout .seat:hover {
        background: rgba(0,0,0,0.1);
    }

</style>

<?php 
    $travel_cost = $travel_cost_per_seat;
    $seats_count = (NULL != $number_of_seats ? $number_of_seats : 16);//Defauts to a 16 Seater
    $columns = 5;
    $rows = 0;
    
    if ($seats_count % $columns == 0) $rows = $seats_count / $columns;
    else $rows = ceil($seats_count / $columns); // Rounds up to ensure all seats are covered
?>

<div class="seating-container">
    <div class="row">
        <input type="hidden" name="total_cost" value="<?=$travel_cost?>" class="totalCost" />
        <input type="hidden" name="selected_seats" value="" class="selected_seats" />

        <div class="col-lg-9 col-md-9 col-sm-12">
            <div class="seatsForm">
                <div id="seatLayout"></div>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
            <div class="alert alert-info borer-2 py-2 px-2 rounded" role="alert">
                <div class="mb-3">
                    <h4 class="fw-semibold fs-14 mb-2">Total Seats</h4>
                    <p class="totalSeatsSelected card-subtitle text-muted fs-12 mb-0">0</p>
                </div>
                <div class="mb-0">
                    <h5 class="mb-2 fw-semibold fs-14">Total Amount</h5>
                    <p class="card-subtitle text-muted fs-12 mb-0"><?=CURRENCY?><span class="totalSeatsSelectedAmt">0</span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12 col-lg-12 col-md-12 py-2">
        <?php 
            $bus_features = $this->buses_m->get_bus_features($bus_id);
            
            if($bus_features){
                $decode_features = json_decode($bus_features->features);?>                                        
                
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <?php
                                foreach($decode_features as $feature => $value){
                                    if(NULL != $value){
                                        echo '<span class="badge rounded-pill bg-transparent border border-info text-info p-2 ms-2">' . $value . '</span>';
                                    }
                                }
                                ?>
                            </div>
                            <button id="submitBookingBtn<?=$outerIndex?>" data-target-form="#seatsForm<?=$outerIndex?>" type="button" class="continueBookingBtn btn btn-primary" disabled>
                                <i class="lab la-telegram-plane"></i> Continue
                            </button>
                        </div>
                    </div>
                </div>
            <?php
            }
        ?>
        </div> 
    </div>

</div>

<script type="text/javascript">
    $(function(){
        // Sample seat objects
        //totalSeatsSelected
        // totalSeatsSelectedAmt

        const seatsDataString = `<?=json_encode($bus_seats)?>`;
        let seats = [];
        let selected = 0;

        try{
            seats = JSON.parse(seatsDataString);
        }catch(e){
            console.error("Error parsing JSON: ", e);
        }

        let containerDiv = $('#seatLayout')
        let travel_cost = parseInt('<?=$travel_cost?>');
        let selected_seats = [];
        let reserved_seats = 0;   
        let amt_reserved = 0   
        
        if (Array.isArray(seats) && seats.length > 0)
        {
            seats.forEach((seat, index) => {
                const $seat = $('<div data-cost="'+seat.seat_amt+'" data-seat="'+seat.id+':'+seat.seat_label+'" data-bs-toggle="tooltip" data-bs-placement="top" title="'+seat.seat_desc+'" data-bs-custom-class="custom-tooltip">')
                .addClass('seat rounded border')
                .text(seat.seat_label);
                
                if (index === 0) {
                    $seat.addClass('bg-danger is_driver').css('margin-right', '40px');
                }

                if (seat.is_reserved == 1 && seat.id != 0) {
                    $seat.addClass('pre-reserved').removeClass('bg-success');
                }

                const row = parseInt('<?=$rows?>');
                const col = parseInt('<?=$columns?>');

                $seat.css('grid-row', row + 1);
                $seat.css('grid-column', col + 1);

                if (index >= seatsDataString.length - 4) {
                    $seat.addClass('last-row');
                }

                containerDiv.append($seat);
            });

            // Handle seat reservation toggle
            containerDiv.on('click', '.seat', function() {
                const $seat = $(this);
                let seat_cost = parseInt($seat.data('cost'))

                if (!$seat.hasClass('reserved')) {
                    selected_seats.push($seat.data('seat'));
                    
                    if(seat_cost == 0) amt_reserved += travel_cost
                    else amt_reserved += seat_cost

                    reserved_seats += 1;

                    $seat.addClass('reserved');
                    $seat.removeClass('bg-light');

                    $('#seatsForm<?=$outerIndex?>').find('input[type="hidden"].selected_seats').val(selected_seats.join(','));
                    $('#seatsForm<?=$outerIndex?>').find('input[type="hidden"].totalCost').val(amt_reserved < 0 ? 0 : amt_reserved);
                    $('#seatsForm<?=$outerIndex?>').find('input[type="hidden"].totalSeats').val((reserved_seats > 0 ? reserved_seats : 0));
                    $('#seatsForm<?=$outerIndex?>').find('.totalSeatsSelectedAmt').text(amt_reserved < 0 ? 0 : amt_reserved);
                    $('#seatsForm<?=$outerIndex?>').find('.totalSeatsSelected').text((reserved_seats > 0 ? reserved_seats : 0));
                    
                } else {
                    selected_seats.pop();

                    if(travel_cost == 0) amt_reserved -= seat_cost
                    else amt_reserved -= travel_cost

                    reserved_seats -= 1;

                    $seat.removeClass('reserved');
                    $seat.addClass('bg-light');                    

                    $('#seatsForm<?=$outerIndex?>').find('input[type="hidden"].selected_seats').val(selected_seats.join(','));
                    $('#seatsForm<?=$outerIndex?>').find('input[type="hidden"].totalCost').val(amt_reserved < 0 ? 0 : amt_reserved);
                    $('#seatsForm<?=$outerIndex?>').find('input[type="hidden"].totalSeats').val((reserved_seats > 0 ? reserved_seats : 0));
                    $('#seatsForm<?=$outerIndex?>').find('.totalSeatsSelectedAmt').text(amt_reserved < 0 ? 0 : amt_reserved);
                    $('#seatsForm<?=$outerIndex?>').find('.totalSeatsSelected').text((reserved_seats > 0 ? reserved_seats : 0));                
                }

                if(reserved_seats > 0 && amt_reserved > 0)
                    $("#submitBookingBtn<?=$outerIndex?>").attr('disabled', false)
                else
                    $("#submitBookingBtn<?=$outerIndex?>").attr('disabled', true) 
            });
        
            

        } else {
            console.error("Parsed data is not an array");
        }
    });
    
</script>