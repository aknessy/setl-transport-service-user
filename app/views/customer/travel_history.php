
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
                                        <a href="<?=base_url('login/logout')?>" class="d-flex align-items-center fs-10 <?=($this->uri->segment(1) == 'customer' && $this->uri->segment(2) == 'updatepwd') ? 'active' : ''?>">
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
                                                <li class="breadcrumb-item active" aria-current="page">Customer Profile</li>
                                            </ol>
                                        </nav>
                                    </div>
                                    <div class="col-lg-7 col-md-7 d-flex align-self-start justify-content-end">
                                        <span class="fs-7 text-muted fw-light">Hey <?=ucwords(strtolower($this->session->name))?> - Good <?=TimeOfDay(date('H'))?>!</span>
                                    </div>
                                </div>
                            </div>
                            <div class="tg-listing-grid-item">
                                <div class="row list-card">
                                    
                                    <div class="col-xl-12">
                                        <div class="card">
                                            <div class="w-100 bg-white border py-3 px-2">
                                                <h5 class="card-subtitle fs-6">Customer's Travel Destinations</h5>
                                                <p class="mb-0 text-muted fs-7"><small>The Following are records of your travel history</small></p>
                                            </div>
                                            <div class="card-body">
                                            <?php
                                                if($travel_record){ $i = 1; ?>
                                                <div class="table-responsive" style="overflow-x: auto;">
                                                    <table class="table datatable table-bordered table-hover table-actions" id="travelHistoryTable">
                                                        <thead>
                                                            <tr>
                                                                <th>S/No</th>
                                                                <th>Departed From</th>                                    
                                                                <th>Arrived At</th>
                                                                <th>Vehicle</th>
                                                                <th>Date</th>                                    
                                                            </tr>
                                                        </thead>
                                                        
                                                    </table>
                                                </div>
                                                <?php }else{ ?>
                                                    <div class="row d-flex flex-column align-items-center justify-content-center">
                                                        <img src="<?=base_url()?>assets/images/svgs/empty-state-2.svg" class="img-fluid" alt="No record found" style="width: 200px; height: 200px;">
                                                        <h4 class="fw-bold fs-16 mb-0 text-center">No record found</h4>
                                                        <p class="text-muted fs-14 text-center">You have not made any travels yet!</p>
                                                    </div>
                                                <?php
                                                } ?>
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