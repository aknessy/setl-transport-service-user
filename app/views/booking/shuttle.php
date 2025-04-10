<style>
    .btn.btn-link{
        font-size: 14px;
    }
    
    .btn.btn-link:hover{
        color: #560ce3!important;
        text-decoration: underline;
    }

    .seatsForm {
        display: flex;
        align-items: center;
        justify-content: center;
        max-width: 400px;
    }

    #seatLayoutContainer{
        display: contents;
    }

    #seatLayout{
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
        width: 100%;
        box-sizing: border-box;
    }

    #seatLayout .seat {
        cursor: pointer;
        text-align: center;
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

$aws_base_url = $this->settings_m->getOne(array('skey' => 'aws_base_url'))->value;
$placeholder = 'https://picsum.photos/200/300';

$bus_photos = $bus->bus_photo;

$available_seats = $this->buses_m->count_vacant_seats($bus->bus_id);
$rating = $this->rating_m->calculate_avg_rating($bus->bus_id);
$bus_reviews = $this->rating_m->get_bus_ratings($bus->bus_id);
$review_count = (NULL != $bus_reviews ? count($bus_reviews) : 0);

$full_stars = 0;
$half_star = 0;

$rating_avg = $rating->avg_rating;

if($rating_avg > 0){
    $full_stars = round($rating_avg);
    $half_star = $rating_avg % 1 >= 0.5;
}

$seats_count = (NULL != $bus->bus_capacity ? $bus->bus_capacity : 16);//Defauts to a 16 Seater
$columns = 5;
$rows = 0;

if ($seats_count % $columns == 0) $rows = $seats_count / $columns;
else $rows = ceil($seats_count / $columns); // Rounds up to ensure all seats are covered

?>

<main>
    <div class="tg-breadcrumb-area tg-breadcrumb-spacing fix p-relative z-index-1 include-bg" data-background="<?=base_url()?>assets/img/breadcrumb/breadcrumb.jpg">
        <div class="tg-hero-top-shadow"></div>
        <div class="tg-breadcrumb-shadow"></div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tg-breadcrumb-content text-center">
                        <h2 class="tg-breadcrumb-title mb-10">Travel In Comfort & Safety</h2>
                        <p class="tg-breadcrumb-subtitle mb-30 text-white">Travel to your favorite destinations in the comfort that we provide.</p>                        
                        <div class="tg-breadcrumb-list">
                            <span><a href="<?=base_url()?>">Home</a></span>
                            <span><a href="<?=base_url('booking')?>">Booking</a></span>
                            <span class="dvdr"><i class="fa-sharp fa-solid fa-angle-right"></i></span>
                            <span>Seat Reservation</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tg-hero-bottom-shape d-none d-md-block">
            <span>
                <svg width="432" height="290" viewBox="0 0 432 290" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="line-1" opacity="0.4" d="M39.6042 428.345C4.41235 355.065 -24.3018 203.867 142.377 185.309C350.725 162.111 488.893 393.541 289.169 313.515C129.389 249.494 458.202 85.4772 642.58 11.4713" stroke="white" stroke-width="24" />
                </svg>
            </span>
        </div>
        <div class="tg-hero-bottom-shape-2 d-none d-md-block">
            <span>
                <svg width="154" height="243" viewBox="0 0 154 243" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path class="line-1" opacity="0.4" d="M144.616 328.905C116.117 300.508 62.5986 230.961 76.5162 179.949C93.9131 116.184 275.231 7.44494 -65.0181 12.8762" stroke="white" stroke-width="24" />
                </svg>
            </span>
        </div>
    </div>
    <div class="tg-booking-form-area tg-booking-form-grid-space pb-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row tg-booking-form-item tg-booking-form-grid shadow-lg mb-30 pt-30 pb-30">
                        <div class="col-xl-5 col-lg-6">
                            <div class="tg-product-modal-thumb-wrapper mb-40">
                                <div class="tg-product-details-thumb-tab">
                                    <div class="tg-product-details-thumb mb-10">
                                        <div class="tab-content" id="nav-tabContents">
                                            <?php                                            
                                                if(json_decode($bus_photos)){
                                                    $photos = json_decode($bus_photos);

                                                    foreach($photos as $k => $v){
                                                        if($k == 0){?>
                                                            <div class="tab-pane fade show active" id="image-lg<?=$k?>" role="tabpanel" aria-labelledby="Bus Photo <?=$k?>" style="width:100%;height:auto">
                                                                <img src="<?=$aws_base_url . $v?>" alt="">
                                                            </div>
                                                        <?php
                                                        }else{?>
                                                            <div class="tab-pane fade" id="image-lg<?$k?>" role="tabpanel" aria-labelledby="Bus Photo <?=$k?>" style="width:100%;height:auto">
                                                                <img src="<?=$aws_base_url . $v?>" alt="Placeholder Image <?=$k + 1?>">
                                                            </div>
                                                        <?php
                                                        }
                                                    } 
                                                }else{?>
                                                    <div class="tab-pane fade show active" id="nav-one-two" role="tabpanel" aria-labelledby="Bus Photo (Placeholder)" style="width:100%;height:auto">
                                                        <img src="<?=$placeholder?>" alt="Placeholder Image">
                                                    </div>
                                                <?php
                                                }
                                            ?>
                                        </div>                            
                                    </div>
                                    <div class="tg-product-details-thumb-nav cm-tab mb-10">
                                        <div class="nav nav-tabs d-block" id="nav-tab-two" role="tablist">
                                            <div class="row gx-10">
                                                <?php                                            
                                                    if(json_decode($bus_photos)){
                                                        $photos = json_decode($bus_photos);

                                                        foreach($photos as $k => $v){
                                                            if($k == 0){?>
                                                                <div class="col-3">
                                                                    <button class="nav-link active" id="thumb<?=$k?>" data-bs-toggle="tab" data-bs-target="#image-lg<?=$k?>" type="button" role="tab" aria-controls="thumb<?=$k?>" aria-selected="true">
                                                                        <img src="<?=$aws_base_url . $v?>" alt="Thumbnail <?=$k+1?>">
                                                                    </button>
                                                                </div>
                                                            <?php
                                                            }else{?>
                                                                <div class="col-3">
                                                                    <button class="nav-link" id="thumb<?=$k?>" data-bs-toggle="tab" data-bs-target="#image-lg<?=$k?>" type="button" role="tab" aria-controls="thumb<?=$k?>" aria-selected="false">
                                                                        <img src="<?=$aws_base_url . $v?>" alt="Thumbnail <?=$k+1?>">
                                                                    </button>
                                                                </div>
                                                            <?php
                                                            }
                                                        }
                                                    }
                                                ?>                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-6">
                            <div class="tg-product-details-wrapper ml-55 mb-40">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h3 class="tg-product-details-title mb-5"><?=ucwords(strtolower($bus->bus_make . ' ' . $bus->bus_model))?></h3>
                                    <div class="mb-0">
                                        <span class="availability">Total Available Seats:</span>
                                        <span class="stock"><strong><?=$available_seats > 0 ? number_format($available_seats) : 0?></strong></span>
                                    </div>
                                </div>
                                <div class="tg-product-details-rating mb-20 d-flex align-items-center">
                                    <div class="d-flex">                                    
                                    <?php 
                                        if($review_count > 0){
                                            echo '<div class="tg-product-rating d-flex">';

                                            for ($i = 0; $i < $full_stars; $i++) {
                                                echo '<span><i class="fa-sharp fa-solid fa-star"></i></span>';
                                            }

                                            if($half_star){
                                                echo '<span><i class="fa fa-sharp fa-star-half-o"></i></span>';
                                            }

                                            for ($i = $full_stars + ($half_star ? 1 : 0); $i < 5; $i++) {
                                                echo '<span><i class="fa fa-star fa-star-o"></i></span>';
                                            }

                                            echo '</div>';
                                        }else{?>
                                            <div class="d-flex">
                                                <span><i class="fa fa-star fa-star-o"></i></span>
                                                <span><i class="fa fa-star fa-star-o"></i></span>
                                                <span><i class="fa fa-star fa-star-o"></i></span>
                                                <span><i class="fa fa-star fa-star-o"></i></span>
                                                <span><i class="fa fa-star fa-star-o"></i></span>
                                            </div>
                                        <?php
                                        }
                                    ?>
                                    </div>
                                    <div class="tg-product-details-rating-count">
                                        <span>(<?=$review_count ? number_format($review_count) : 0?> review)</span>
                                        <a href="#leaveReview" style="text-decoration: underline">Write a Review</a>
                                    </div>
                                </div>
                                <!-- <div class="tg-product-details-price">
                                    <h6 class="mb-10"><?=CURRENCY . number_format($cost_of_travel)?></h6>
                                </div> -->
                                <div class="row mb-30 mt-30">
                                    <div class="col-lg-12 col-md-12">
                                        <h5 class="fw-normal fs-7">Pick your preferred seat</h5>
                                        <?=form_open(base_url('booking/reserve/' . $bus->bus_id . '/' . $travel_to . '/' . $travel_from . '/' . $travel_time . '/' . $travel_date), ['id' => 'seatsForm', 'method' => 'POST'])?>                                        
                                            <div class="bg-light mb-15 rounded py-4 px-4">
                                                <div class="row">
                                                    <input type="hidden" name="total_cost" value="<?=$cost_of_travel?>" class="totalCost" />
                                                    <input type="hidden" name="selected_seats" value="" class="selected_seats" />

                                                    <div class="col-sm-12 mb-15">
                                                        <div id="seatLayoutContainer">                                                      
                                                            <div id="seatLayout"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="d-flex align-items-center justify-content-between mb-3">                                                      
                                                            <div>
                                                                <span class="fw-semibold fs-14 mb-2">Number of Selected Seats</span>
                                                                <span class="totalSeatsSelected card-subtitle text-muted fs-12">0</span>
                                                            </div>
                                                            <div>
                                                                <span class="mb-2 fw-semibold fs-14">Amount</span>
                                                                <span class="card-subtitle text-muted fs-12 mb-0"><?=CURRENCY?></span><span class="totalSeatsSelectedAmt">0</span>
                                                            </div> 
                                                        </div>                                                       
                                                    </div>
                                                </div>
                                                <div class="row">                                                
                                                <?php 
                                                    $bus_features = $this->buses_m->get_bus_features($bus->bus_id);
                                                    
                                                    if($bus_features){
                                                        echo '<div class="d-flex align-items-center justify-content-start flex-wrap">';

                                                        $decode_features = json_decode($bus_features->features);                                                                                                                                                                                                  
                                                    
                                                        foreach($decode_features as $feature => $value)
                                                        {                                                    
                                                            if(NULL != $value){
                                                                echo '<span class="badge rounded-pill text-bg-secondary p-2 ms-2 mb-2">' . $value . '</span>';
                                                            }                                                        
                                                        }

                                                        echo '</div>';
                                                    } 
                                                ?>
                                                </div>
                                            </div>
                                        <?=form_close()?>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center justify-content-end mb-25">                                    
                                    <a class="btn btn-lg btn-link text-dark mb-10 mr-3" href="<?=base_url('booking')?>">
                                        Select a different Bus
                                    </a>
                                    <button id="submitBookingBtn" type="button" class="tg-btn mb-10" disabled>                                        
                                        <span>Generate Invoice<span>
                                        <span><i class="fa fa-arrow-circle-right" aria-hidden="true"></i></span>
                                    </button>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div>
    <section class="tg-product-details-tab-area pb-120">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-9 bg-light rounded py-4 px-4" style="border: 1px solid #eee">
                    <div class="tg-product-details-tab-nav mb-25">
                        <div class="tg-product-details-tab-nav-inner nav cm-tab-menu d-flex c-relative flex-wrap" id="nav-tab-info" role="tablist">                            
                            <button class="nav-link active" id="nav-review-tab" data-bs-toggle="tab" data-bs-target="#nav-review" type="button" role="tab" aria-controls="nav-review" aria-selected="true"><span>(<?=$review_count ? number_format($review_count) : 0?> Customer Reviews)</span></button>
                        </div>
                    </div>
                    <div class="product__details-tab-content">
                        <div class="tab-content" id="nav-tabContent-info">                            
                            <div class="tab-pane fade active show" id="nav-review" role="tabpanel" aria-labelledby="nav-review-tab">
                                <div class="tg-product-details-review">
                                    <div class="row">
                                        <div class="col-xl-12">
                                            <div class="tg-product-details-inner">
                                                <div class="tg-tour-about-cus-review-wrap mb-25">
                                                    <?php
                                                    if($review_count > 0){?>
                                                    <ul>
                                                        <?php
                                                        foreach($bus_reviews as $obj){
                                                            $customer = $this->rating_m->get_review_customer_info($obj->customer_id);   
                                                        ?>
                                                        <li>
                                                            <div class="tg-tour-about-cus-review d-flex mb-40">
                                                                <div class="tg-tour-about-cus-review-thumb">
                                                                    <?php
                                                                    if($customer && $customer->photo){?>
                                                                        <img src="<?=$aws_base_url . $customer->photo?>" alt="Customer Photo">
                                                                    <?php 
                                                                    }else{?>
                                                                        <img src="<?=base_url()?>assets/img/tour-details/thumb-2.jpg" alt="Customer Photo">
                                                                    <?php
                                                                    }?>
                                                                </div>
                                                                <div>
                                                                    <div class="tg-tour-about-cus-name mb-5 d-flex align-items-center justify-content-between flex-wrap">
                                                                        <?php 
                                                                            if($customer){?>
                                                                                <h6 class="mr-10 mb-10 d-inline-block"><?=$customer->surname . ', ' . $customer->first_name?><span>- <?=date('F jS, Y', strtotime($obj->created_at))?></span></h6>
                                                                            <?php
                                                                            }else{?>
                                                                                <h6 class="mr-10 mb-10 d-inline-block">Anonymous<span>- <?=date('F jS, Y', strtotime($obj->created_at))?></span></h6>
                                                                            <?php
                                                                            }
                                                                            
                                                                            if($obj->rating > 0)
                                                                            {
                                                                                $f_stars = round($obj->rating);
                                                                                $h_star = $obj->rating % 1 >= 0.5;
                                                                                $total_stars = 5;

                                                                                echo '<span class="tg-tour-about-cus-review-star mb-10 d-inline-block">';

                                                                                for ($i = 0; $i < $obj->rating; $i++) {
                                                                                    echo '<span><i class="fa-sharp fa-solid fa-star" aria-hidden="true"></i></span>';
                                                                                }

                                                                                if($h_star){
                                                                                    echo '<span><i class="fa-sharp fa-solid fa-star-half-stroke" aria-hidden="true"></i></span>';
                                                                                }
                                                                                
                                                                                $remaining_stars = $total_stars - ($f_stars + ($h_star ? 1 : 0));

                                                                                for ($i = 0; $i < $remaining_stars; $i++)  {
                                                                                    echo '<span><i class="fa-sharp fa-regular fa-star" aria-hidden="true"></i></span>';
                                                                                }

                                                                                echo '(' . $obj->rating_desc . ')' . '</span>';
                                                                            }else{?>
                                                                                <div class="d-flex">
                                                                                    <span><i class="fa-sharp fa-regular fa-star" aria-hidden="true"></i></span>
                                                                                    <span><i class="fa-sharp fa-regular fa-star" aria-hidden="true"></i></span>
                                                                                    <span><i class="fa-sharp fa-regular fa-star" aria-hidden="true"></i></span>
                                                                                    <span><i class="fa-sharp fa-regular fa-star" aria-hidden="true"></i></span>
                                                                                    <span><i class="fa-sharp fa-regular fa-star" aria-hidden="true"></i></span>
                                                                                </div>
                                                                            <?php
                                                                            }
                                                                        ?>
                                                                    </div>
                                                                    <p class="text-capitalize lh-28 mb-10"><?=ucwords(strtolower($obj->comment))?></p>
                                                                    <!-- <a class="tg-tour-about-cus-reply" href="#">Reply</a> -->
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php
                                                        }?>
                                                    </ul>
                                                    <?php 
                                                    }else{?>
                                                        <div class="row list-card">
                                                            <div id="searchContainer" class="col-sm-12">
                                                                <div class="d-flex align-items-center justify-content-center mt-30">
                                                                    <div class="row d-flex flex-column align-items-center justify-content-center">
                                                                        <img src="<?=base_url()?>assets/img/svgs/empty-state-1.svg" class="img-fluid" alt="No record found" style="width:200px;height:200px;">
                                                                        <h4 class="fw-bold fs-16 mb-0 text-center">No Reviews Found!</h4>
                                                                        <p class="text-muted fs-10 text-center"><small><em>Be the first to leave a review</em></small></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    }?>
                                                </div>
                                                
                                                <?php
                                                if($this->session->loggedIn == TRUE || NULL != $this->session->loggedInUserID){?>
                                                <div id="leaveReview" class="tg-tour-about-review-form-wrap py-5 px-5 rounded bg-white" style="border: 1px solid rgb(243, 243, 243)">
                                                    <h4 class="tg-tour-about-title mb-15">Leave a review</h4>
                                                    <div class="mb-20">
                                                        <ul>
                                                            <li class="d-flex align-items-center justify-content-start">
                                                                <label class="form-label fw-semibold fs-8 mr-10">Ratings</label>
                                                                <div id="rating" class="rating mr-10">
                                                                    <i class="fas fa-star" data-value="1"></i>
                                                                    <i class="fas fa-star" data-value="2"></i>
                                                                    <i class="fas fa-star" data-value="3"></i>
                                                                    <i class="fas fa-star" data-value="4"></i>
                                                                    <i class="fas fa-star" data-value="5"></i>
                                                                </div>
                                                                <p id="rating-indicator" class="mt-2">Your rating (<span class="fw-normal">None</span>)</p>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="tg-tour-about-review-form">
                                                        <?=form_open(base_url('review/bus'), ['method' => 'POST'])?>
                                                            <input type="hidden" name="bus_id" value="<?=$this->uri->segment(3)?>" />
                                                            <input type="hidden" name="origin" value="<?=$travel_from?>" />
                                                            <input type="hidden" name="destination" value="<?=$travel_to?>" />
                                                            <input type="hidden" name="time" value="<?=$travel_time?>" />
                                                            <input type="hidden" name="date" value="<?=$travel_date?>" />
                                                            <input id="ratingField" type="hidden" name="rating" value="" />
                                                            <input id="ratingText" type="hidden" name="rating_text" value="" />

                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="mb-15">
                                                                        <div class="form-floating">
                                                                            <input type="text" class="form-control" id="reviewTitle" placeholder="Review Title" name="review_title" required>
                                                                            <label for="reviewTitle" class="form-label fw-normal fs-6 mb-3">Review Title</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">                                                                
                                                                <div class="col-lg-12">
                                                                    <div class="mb-15">   
                                                                        <div class="form-floating">
                                                                            <textarea class="form-control" name="review_comment" placeholder="Leave a comment here" id="commentBox" required></textarea>
                                                                            <label for="commentBox" class="form-label fw-normal fs-6 mb-3">Comments</label>
                                                                        </div>                                                                   
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="d-flex align-items-center justify-content-end">
                                                                        <button type="submit" class="tg-btn tg-btn-switch-animation">Submit Review</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?=form_close()?>
                                                    </div>
                                                </div>
                                                <?php
                                                }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

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
            console.log(seats);
        }catch(e){
            console.error("Error parsing JSON: ", e);
        }

        let containerDiv = $('#seatLayout')
        let travel_cost = parseInt('<?=$cost_of_travel?>');
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

                    $('#seatsForm').find('input[type="hidden"].selected_seats').val(selected_seats.join(','));
                    $('#seatsForm').find('input[type="hidden"].totalCost').val(amt_reserved < 0 ? 0 : amt_reserved);
                    $('#seatsForm').find('input[type="hidden"].totalSeats').val((reserved_seats > 0 ? reserved_seats : 0));
                    $('#seatsForm').find('.totalSeatsSelectedAmt').text(amt_reserved < 0 ? 0 : amt_reserved);
                    $('#seatsForm').find('.totalSeatsSelected').text((reserved_seats > 0 ? reserved_seats : 0));
                    
                } else {
                    selected_seats.pop();

                    if(seat_cost == 0) amt_reserved -= travel_cost
                    else amt_reserved -= seat_cost

                    reserved_seats -= 1;

                    $seat.removeClass('reserved');
                    $seat.addClass('bg-light');                    

                    $('#seatsForm').find('input[type="hidden"].selected_seats').val(selected_seats.join(','));
                    $('#seatsForm').find('input[type="hidden"].totalCost').val(amt_reserved < 0 ? 0 : amt_reserved);
                    $('#seatsForm').find('input[type="hidden"].totalSeats').val((reserved_seats > 0 ? reserved_seats : 0));
                    $('#seatsForm').find('.totalSeatsSelectedAmt').text(amt_reserved < 0 ? 0 : amt_reserved);
                    $('#seatsForm').find('.totalSeatsSelected').text((reserved_seats > 0 ? reserved_seats : 0));                
                }

                if(reserved_seats > 0 && amt_reserved > 0)
                    $("#submitBookingBtn").attr('disabled', false)
                else
                    $("#submitBookingBtn").attr('disabled', true) 
            });
        } else {
            console.error("Parsed data is not an array");
        }

        $('#submitBookingBtn').click(function(){
            $('#seatsForm').submit();
        })
    });
    
</script>

<script>
    $(document).ready(function () {
        let currentRating = 0;
        let ratingText = '';

        // Hover effect for stars
        $('#rating i').hover(
            function () {
            const index = $(this).data('value');
            highlightStars(index);
            },
            function () {
            resetStars();
            }
        );

        $('#rating i').click(function () {
            currentRating = $(this).data('value');
            setStars(currentRating);
            updateIndicator(currentRating);
        });

        function highlightStars(index) {
            $('#rating i').each(function () {
            $(this).toggleClass('hover', $(this).data('value') <= index);
            });
        }

        function resetStars() {
            $('#rating i').removeClass('hover');
        }

        function setStars(index) {
            $('#rating i').each(function () {
            $(this).toggleClass('active', $(this).data('value') <= index);
            });
        }

        function updateIndicator(rating) {
            let text = '';
            if (rating === 1) text = 'Good';
            else if (rating === 2) text = 'Fair';
            else if (rating === 3) text = 'Very Good';
            else if (rating === 4) text = 'Excellent';
            else if (rating === 5) text = 'Outstanding';

            $('#rating-indicator span').text(text);
            $('#ratingField').val(rating)
            $('#ratingText').val(text);
        }
    });
</script>