<?php
    if($buses){
        $index = 1;
        $placeholder = 'https://imageplaceholder.net/600';
        $img = '';

        echo '<div class="row list-card">';

        foreach($buses as $obj){
            $newPeriod = 30;

            $dateAddedTimestamp = strtotime($obj->created_on);
            $todayTimestamp = strtotime(date('Y-m-d'));
            
            $productAgeInDays = ($todayTimestamp - $dateAddedTimestamp) / (60 * 60 * 24);

            $bus_reviews = $this->rating_m->get_bus_ratings($obj->bus_id);
            $review_count = (NULL != $bus_reviews ? count($bus_reviews) : 0);

            if(!empty($obj->bus_photo) && json_decode($obj->bus_photo)){
                $photo = json_decode($obj->bus_photo)[0];
                $single_photo = str_replace("\\", '', $photo);

                $img = $aws_base_url . $single_photo;
            }else{
                $img = $placeholder;
            }                                    
        ?>

        <div class="col-xxl-4 col-xl-6 col-lg-6 col-md-6 tg-grid-full">
            <div class="tg-listing-card-item mb-30">
                <div class="tg-listing-card-thumb fix mb-15 p-relative">
                    <a href="<?=base_url('booking/reserve/' . $obj->bus_id . '/' . $travel_to . '/' . $travel_from . '/' . $travel_time . '/' . str_replace('-',':',$travel_date))?>">
                        <img class="tg-card-border w-100" src="<?=$img?>" alt="<?=$obj->bus_plate_number?>">
                        <?php
                            if($productAgeInDays <= $newPeriod){?>
                                <span class="tg-listing-item-price-discount shape">New</span>
                        <?php
                            }
                        ?>
                    </a>
                    <div class="tg-listing-item-wishlist">
                        <a href="#">
                            <svg width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.5167 16.3416C10.2334 16.4416 9.76675 16.4416 9.48341 16.3416C7.06675 15.5166 1.66675 12.075 1.66675 6.24165C1.66675 3.66665 3.74175 1.58331 6.30008 1.58331C7.81675 1.58331 9.15841 2.31665 10.0001 3.44998C10.8417 2.31665 12.1917 1.58331 13.7001 1.58331C16.2584 1.58331 18.3334 3.66665 18.3334 6.24165C18.3334 12.075 12.9334 15.5166 10.5167 16.3416Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="tg-listing-main-content">
                    <div class="tg-listing-card-content">
                        <h4 class="tg-listing-card-title"><?=$obj->bus_make . ' ' . $obj->bus_model?></h4>
                        <div class="tg-listing-card-duration-tour">
                            <span class="tg-listing-card-duration-map mb-5">
                                <svg width="13" height="16" viewBox="0 0 13 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.3329 6.7071C12.3329 11.2324 6.55512 15.1111 6.55512 15.1111C6.55512 15.1111 0.777344 11.2324 0.777344 6.7071C0.777344 5.16402 1.38607 3.68414 2.46962 2.59302C3.55316 1.5019 5.02276 0.888916 6.55512 0.888916C8.08748 0.888916 9.55708 1.5019 10.6406 2.59302C11.7242 3.68414 12.3329 5.16402 12.3329 6.7071Z" stroke="currentColor" stroke-width="1.15556" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path d="M6.55512 8.64649C7.61878 8.64649 8.48105 7.7782 8.48105 6.7071C8.48105 5.636 7.61878 4.7677 6.55512 4.7677C5.49146 4.7677 4.6292 5.636 4.6292 6.7071C4.6292 7.7782 5.49146 8.64649 6.55512 8.64649Z" stroke="currentColor" stroke-width="1.15556" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <?=$obj->bus_type?>
                            </span>
                            <span class="tg-listing-card-duration-time">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.00175 3.73329V7.99996L10.8462 9.42218M15.1128 8.00003C15.1128 11.9274 11.9291 15.1111 8.00174 15.1111C4.07438 15.1111 0.890625 11.9274 0.890625 8.00003C0.890625 4.07267 4.07438 0.888916 8.00174 0.888916C11.9291 0.888916 15.1128 4.07267 15.1128 8.00003Z" stroke="currentColor" stroke-width="1.06667" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                                <?=$obj->bus_capacity?> Passenger Seats
                            </span>
                        </div>
                    </div>
                    <div class="tg-listing-card-price d-flex align-items-end justify-content-between">
                        <?php 
                            if($cost_of_travel != 0){
                        ?>
                        <div class="tg-listing-card-price-wrap price-bg d-flex align-items-center">
                            <span class="tg-listing-card-currency-amount mr-5">
                                <span class="currency-symbol"><?=CURRENCY?></span><?=number_format($cost_of_travel)?>
                            </span>
                            <span class="tg-listing-card-activity-person">/Person</span>
                        </div>
                        <?php }?>
                        <div class="tg-listing-card-review space">
                            <span class="tg-listing-rating-icon"><i class="fa-sharp fa-solid fa-star"></i></span>
                            <span class="tg-listing-rating-percent">(<?=$review_count > 0 ? number_format($review_count) : 0 ?> Reviews)</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }

        echo '</div>';?>


        <div class="tg-pagenation-wrap text-center mt-50 mb-30">
            <nav>
                <?=$this->pagination->create_links()?>
            </nav>
        </div>

    <?php
    }else{?>

    <div class="row list-card">
        <div id="searchContainer" class="col-sm-12">
            <div class="d-flex align-items-center justify-content-center mt-30">
                <div class="row d-flex flex-column align-items-center justify-content-center">
                    <img src="<?=base_url()?>assets/img/svgs/empty-state-1.svg" class="img-fluid" alt="No record found" style="width:200px;height:200px;">
                    <h4 class="fw-bold fs-16 mb-0 text-center">No Bus Found!</h4>
                    <p class="text-muted fs-10 text-center">Sorry! We were unable to get a bus departing on the selected day or to the selected destination.</p>
                </div>
            </div>
        </div>
    </div>

    <?php 
        }
    ?>