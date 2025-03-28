<style>
    .bar {
        height: 10px;
        background-color: #4CAF50; /* Green color */
        margin: 5px 0;
    }
</style>

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
                        <div class="tg-breadcrumb-list"></div>
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
                <div class="col-xl-3 col-lg-4 order-last order-lg-first">
                    <div class="tg-filter-sidebar mb-40 top-sticky p-0">
                        <div class="tg-filter-item">
                            <h4 class="tg-filter-title mb-0 pl-25 pt-25 pr-25 pb-25 bg-dark text-white text-uppercase fs-11" style="border-radius: 12px 12px 0 0">Profile Navigation</h4>
                            <div class="tg-filter-list">
                                <ul class="profile-nav pl-15">
                                    <li>
                                        <a href="<?=base_url('customer/profile')?>" class="d-flex align-items-center fs-10 <?=($this->uri->segment(1) == 'customer' && $this->uri->segment(2) == 'profile') ? 'active' : ''?>">
                                            <span class="mr-15"><i class="fa-solid fa-person-to-door"></i></span>
                                            <span>Profile</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('customer/travel_history')?>" class="d-flex align-items-center fs-10 <?=($this->uri->segment(1) == 'customer' && $this->uri->segment(2) == 'travel_history') ? 'active' : ''?>">
                                            <span class="mr-15"><i class="fa-solid fa-timeline-arrow"></i></span>
                                            <span>History</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('customer/reviews')?>" class="d-flex align-items-center fs-10 <?=($this->uri->segment(1) == 'customer' && $this->uri->segment(2) == 'reviews') ? 'active' : ''?>">
                                            <span class="mr-15"><i class="fa-light fa-star-sharp-half-stroke"></i></span>
                                            <span>My Reviews</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('customer/update_login')?>" class="d-flex align-items-center fs-10 <?=($this->uri->segment(1) == 'customer' && $this->uri->segment(2) == 'update_login') ? 'active' : ''?>">
                                            <span class="mr-15"><i class="fa-solid fa-person-booth"></i></span>
                                            <span>Update Login</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?=base_url('login/logout')?>" class="d-flex align-items-center fs-10">
                                            <span class="mr-15"><i class="fa-light fa-left-from-bracket"></i></span>
                                            <span>Logout</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 pl-25 pr-25 pt-25 pb-50" style="background:linear-gradient(to bottom, #f1f1f1, #ffffff);border-radius: 12px; border: 1px solid #f1f1f1">
                        <div class="tg-listing-item-box-wrap ml-10 ">
                            <div class="tg-listing-box-filter mb-25">
                                <div class="row d-flex align-items-center">
                                    <div class="col-lg-5 col-md-5">
                                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="<?=base_url()?>">Home</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">Customer's Reviews</li>
                                            </ol>
                                        </nav>
                                    </div>
                                    <div class="col-lg-7 col-md-7 d-flex align-self-start justify-content-end">
                                        <span class="fs-6 text-muted fw-light">Hey <?=ucwords(strtolower($this->session->name))?> - Good <?=TimeOfDay(date('H'))?>!</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tg-listing-grid-item">
                                <div class="row list-card">
                                    
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="w-100 bg-white border py-3 px-2">
                                                <h5 class="card-subtitle fs-6">Customer's Bus/Driver Reviews</h5>
                                                <p class="mb-0 text-muted fs-7"><small>This is a record of your reviews activity</small></p>
                                            </div>
                                            <div class="card-body">
                                                <?php 
                                                if($reviews){
                                                    if($avg_customer_rating > 0){?>

                                                    <div class="row mb-35">
                                                        <div class="col-xl-12">
                                                            <div class="d-flex align-items-center justify-content-center rounded py-4 px-4" style="background-color:rgb(251, 251, 251); border: 1px solid #f0f0f0">
                                                                <div class="col-lg-4 col-sm-12">
                                                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                                                        <h3 class="fs-1 fw-bold text-dark"><?=round($avg_customer_rating)?></h3>
                                                                        <?php 
                                                                            if($avg_customer_rating > 0)
                                                                            {
                                                                                $f_stars = round($avg_customer_rating);
                                                                                $h_star = $avg_customer_rating % 1 >= 0.5;
                                                                                $total_stars = 5;

                                                                                echo '<span class="tg-tour-about-cus-review-star mb-10 d-inline-block">';

                                                                                for ($i = 0; $i < $avg_customer_rating; $i++) {
                                                                                    echo '<span><i class="fa-sharp fa-solid fa-star" aria-hidden="true"></i></span>';
                                                                                }

                                                                                if($h_star){
                                                                                    echo '<span><i class="fa-sharp fa-solid fa-star-half-stroke" aria-hidden="true"></i></span>';
                                                                                }
                                                                                
                                                                                $remaining_stars = $total_stars - ($f_stars + ($h_star ? 1 : 0));

                                                                                for ($i = 0; $i < $remaining_stars; $i++)  {
                                                                                    echo '<span><i class="fa-sharp fa-regular fa-star" aria-hidden="true"></i></span>';
                                                                                }
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
                                                                        <p class="fw-light fs-6 text-center"><?=count($reviews)?> ratings</p>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-sm-12">
                                                                <div class="d-flex flex-column">
                                                                    <h3 class="mb-15 fw-semibold">Ratings Summary</h3>
                                                                    <table>
                                                                        <tr>
                                                                            <td class="pr-15">Outstanding</td>
                                                                            <td>
                                                                                <div class="mb-10">
                                                                                    <div class="progress mt-5" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                                                        <div class="progress-bar bg-warning" style="width: 75%"></div>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="pr-15">Excellent</td>
                                                                            <td class="col-lg-10">
                                                                                <div class="mb-15">
                                                                                    <div class="progress mt-5" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                                                        <div class="progress-bar bg-warning" style="width: 75%"></div>
                                                                                    </div>
                                                                                </div>
                                                                            <td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="pr-15">Good</td>
                                                                            <td>
                                                                                <div class="mb-15">
                                                                                    <div class="progress mt-5" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                                                        <div class="progress-bar bg-warning" style="width: 75%"></div>
                                                                                    </div>
                                                                                </div> 
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="pr-15">Fair</td>
                                                                            <td>
                                                                                <div class="mb-15">
                                                                                    <div class="progress mt-5" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                                                        <div class="progress-bar bg-warning" style="width: 75%"></div>
                                                                                    </div>
                                                                                </div> 
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="col-xl-2 col-lg-2 pr-15">Poor</td>
                                                                            <td>
                                                                                <div class="mb-15">
                                                                                    <div class="progress mt-5" role="progressbar" aria-label="Warning example" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                                                                        <div class="progress-bar bg-warning" style="width: 75%"></div>
                                                                                    </div>
                                                                                </div> 
                                                                            </td>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>   
                                                        </div>
                                                    </div>

                                                    <?php }?>
                                                    <div class="row">
                                                        <ul class="mt-25">
                                                            <?php
                                                            foreach($reviews as $obj){
                                                                $customer = $this->rating_m->get_review_customer_info($obj->customer_id);   
                                                            ?>
                                                            <li>
                                                                <div class="tg-tour-about-cus-review d-flex py-4 px-4">
                                                                    <div class="tg-tour-about-cus-review-thumb">
                                                                        <?php
                                                                        if($customer->photo){?>
                                                                            <img src="<?=$aws_base_url . $customer->photo?>" alt="Customer Photo" class="img-fluid" style="width:40px;height:40px">
                                                                        <?php 
                                                                        }else{?>
                                                                            <img src="<?=base_url()?>assets/img/tour-details/thumb-3.jpg" alt="Customer Photo" class="img-fluid" style="width:40px;height:40px">
                                                                        <?php
                                                                        }?>
                                                                    </div>
                                                                    <div>
                                                                        <div class="tg-tour-about-cus-name d-flex align-items-center justify-content-between flex-wrap">
                                                                            <h6 class="mr-10 d-inline-block"><?=$customer->surname . ', ' . $customer->first_name?><span>- <?=date('F jS, Y', strtotime($obj->created_at))?></span></h6>

                                                                                <?php
                                                                                
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
                                                                            }?>
                                                                        </div>
                                                                        <p class="text-capitalize lh-28 mb-10"><?=ucwords(strtolower($obj->comment))?></p>
                                                                        <!-- <a class="tg-tour-about-cus-reply" href="#">Reply</a> -->
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <?php
                                                            }?>
                                                        </ul>
                                                    </div>
                                                <?php
                                                    }else{?>
                                                    <div class="row d-flex flex-column align-items-center justify-content-center">
                                                        <img src="<?=base_url()?>assets/images/svgs/empty-state-2.svg" class="img-fluid" alt="No record found" style="width: 200px; height: 200px;">
                                                        <h4 class="fw-semibold fs-5 mb-0 text-center">No review record found</h4>
                                                        <p class="text-muted fs-6 text-center fw-light">Previous reviews will appear here.</p>
                                                    </div>
                                                <?php
                                                    }
                                                ?>
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
    </div>
</main>

<script>
    $(function(){
        $('#travelHistoryTable').DataTable({
            destroy: true,
            processing: true, // show processing indicator
            serverSide: true, // enable server-side mode
            ajax: {
                    url: "<?php echo base_url('customer/travelDatatableAjax'); ?>",
                    type: "POST",
                    //data: {prefs:params},
                    beforeSend: function() {
                        // Show overlay before sending the request
                        //$('#table-overlay').fadeIn(200);
                    },
                    complete: function() {
                        //$('#tableContainer').removeClass('d-none')
                    },
                error: function(xhr, error, thrown) {
                    console.error("AJAX Error: ", xhr, error, thrown); // Log any AJAX errors
                }
            },
            columns: [
                { data: null }, // for S/N
                { data: "vehicle" },
                { data: "depart_from" },                
                { data: "arrived_at" },
                { data: 'travel_time' },
                { data: "travel_date" }
            ],
            order: [], // no initial order
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    render: function(data, type, row, meta) {
                            return meta.row + 1; // S/N
                    }
                },
                {
                    targets: [4],
                    orderable: false
                }
            ]
        });
    })
</script>

<script>
    // Example ratings data
    const ratings = <?=$rating_progress?> // Counts for 5 stars, 4 stars, etc.
    const total = ratings.reduce((sum, count) => sum + count, 0);
    const bars = document.querySelectorAll('.progress-bar');

    ratings.forEach((count, index) => {
        const percentage = (count / total) * 100; // Calculate width percentage
        bars[index].style.width = `${percentage}%`;
    });
</script>