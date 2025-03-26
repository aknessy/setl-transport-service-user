<?php
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
                        <!-- <div class="tg-breadcrumb-list">
                            <span><a href="index.html">Home</a></span>
                            <span class="dvdr"><i class="fa-sharp fa-solid fa-angle-right"></i></span>
                            <span>Tour Grid</span>
                        </div> -->
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
                    <div class="tg-booking-form-item tg-booking-form-grid shadow-lg mb-30 pt-30 pb-30">
                        <form id="bookingForm" method="POST">                                                    
                            <div class="row mb-1">
                                <div class="col-lg-3 col-md-3 col-sm-12 pl-0">
                                    <div class="mb-2 form-floating">                                        
                                        <select id="travelFrom" class="form-select form-select-lg mb-3 fs-6">
                                            <option value="">Select Option</option>
                                            <?php 
                                                if($destinations){
                                                    foreach($destinations as $obj){
                                                        echo '<option value="' . $obj->id . '">' . $obj->terminal_name . '</option>';                        
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <label for="travelFrom" class="form-label fs-10 mb-0 text-muted">Where are you traveling from?</label>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="mb-2 form-floating">
                                        <select id="destination" name="destination" class="form-select form-select-lg mb-3 fs-6">
                                            <option value="">Select Destination</option>
                                            <?php 
                                                if($destinations){
                                                    foreach($destinations as $obj){
                                                        echo '<option value="' . $obj->id . '">' . $obj->terminal_name . '</option>';                        
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <label for="destination" class="form-label fs-10 mb-0 text-muted">What's your destination?</label>                                        
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12">
                                    <div class="mb-2 form-floating">
                                        <input type="password" class="form-control form-control-sm fs-6 form-control-custom travelDate" name="travel_date" id="departureDate" placeholder="Travel Date">
                                        <label for="departureDate" class="form-label fs-10 mb-0 text-muted">What day are you traveling?</label>                                        
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-12 pr-0">
                                    <div class="mb-2 form-floating">
                                        <select id="departureTime" class="form-select form-select-lg mb-3 fs-6 outlne-none">
                                            <option value="">Pick Departure Time</option>
                                            <?php 
                                                if($schedules){
                                                    foreach($schedules as $obj){
                                                        echo '<option value="' . $obj->schedule_time . '">' . $schedule_time[$obj->schedule_time] . '</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                        <label for="departureTime" class="form-label fs-10 mb-0 text-muted">What time are you traveling?</label>                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <button id="checkAvailabiltyBtn" type="button" class="btn btn-custom-indigo">Let's See If we can find a bus for you</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="tg-listing-grid-area mb-85">
        <div class="container">
            <div class="row align-items-center justify-content-center">                
                <!-- <div class="col-xl-3 col-lg-4 order-last order-lg-first">
                    <div class="tg-filter-sidebar mb-40 top-sticky">
                        <div class="tg-filter-item">
                            <h4 class="tg-filter-title mb-15 fw-semibold">Destination</h4>
                            <div class="tg-filter-list">
                                <form id="filterDestinations">
                                    <ul>
                                        <?php 
                                            if($destinations){
                                                foreach($destinations as $obj){
                                                    echo '<li>
                                                        <div class="checkbox d-flex">
                                                            <input class="tg-checkbox terminalsCheckbox" type="checkbox" value="' . $obj->id . '" name="terminal_name">
                                                            <label for="australia" class="tg-label">' . ucwords(strtolower($obj->terminal_name)) . '</label>
                                                            </div>
                                                    </li>';
                                                }
                                            }
                                        ?>                                
                                    </ul>                                    
                                </form>
                            </div>
                            
                            <span class="tg-filter-border mt-25 mb-25"></span>
                            <div class="tg-filter-price-input">
                                <form id="priceFilter">
                                    <input type="hidden" name="filter" value="price" />

                                    <h4 class="tg-filter-title mb-20 fw-semibold">Price By Filter</h4>
                                    <div class="d-flex align-items-center">
                                        <input id="minAmount" class="form-control form-control-custom fs-10" type="number" min="<?=intval($cost_filter->min_amt)?>" name="min_amount" placeholder="Min Price">
                                        <span class="dvdr">
                                            <svg width="14" height="4" viewBox="0 0 14 4" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2 2H12" stroke="#353844" stroke-width="3" stroke-linecap="round" />
                                            </svg>
                                        </span>
                                        <input id="maxAmount" class="form-control form-control-custom fs-10" type="number" max="<?=intval($cost_filter->max_amt)?>" name="min_amount"  placeholder="Max Price" disabled>
                                    </div>
                                </form>
                            </div>
                            <span class="tg-filter-border mt-25 mb-25"></span>
                            <div class="tg-filter-item">
                                <h4 class="tg-filter-title mb-15 fw-semibold">Bus Models</h4>
                                <div class="tg-filter-list">
                                    <form id="vehicleManufacturerForm" action="<?=base_url('booking/available')?>" method="POST">
                                        <input type="hidden" name="filter" value="manufacturer"/>
                                        
                                        <ul>
                                        <?php 
                                            if($destinations){
                                                foreach($vehicle_manufacturers as $obj){
                                                    echo '<li>
                                                        <div class="checkbox d-flex">
                                                            <input class="tg-checkbox" type="checkbox" value="' . $obj->bus_make . '" name="bus_make">
                                                            <label for="australia" class="tg-label">' . ucwords(strtolower($obj->bus_make)) . '</label>
                                                            </div>
                                                    </li>';
                                                }
                                            }
                                        ?>                                
                                        </ul>
                                    </form>
                                </div>
                            </div>
                            <span class="tg-filter-border mt-25 mb-25"></span>
                            <div class="tg-filter-item">
                                <h4 class="tg-filter-title mb-15 fw-semibold">Bus Type</h4>
                                <div class="tg-filter-list">
                                    <form id="vehicleManufacturerForm" action="<?=base_url('booking/available')?>" method="POST">
                                        <input type="hidden" name="filter" value="bus_type"/>
                                        
                                        <ul>
                                        <?php 
                                            if($bus_type){
                                                foreach($bus_type as $obj){
                                                    echo '<li>
                                                        <div class="checkbox d-flex">
                                                            <input class="tg-checkbox" type="checkbox" value="' . $obj->bus_type . '" name="bus_type">
                                                            <label for="australia" class="tg-label">' . ucwords(strtolower($obj->bus_type)) . '</label>
                                                            </div>
                                                    </li>';
                                                }
                                            }
                                        ?>                                
                                        </ul>
                                    </form>
                                </div>
                            </div>                        
                             -->
                        <!-- </div>
                    </div>
                </div> -->
                <div class="col-xl-10 col-lg-10 col-sm-12">
                    <div class="tg-listing-item-box-wrap ml-10">
                        <div class="tg-listing-box-filter mb-15">
                            <div class="row align-items-center">
                                <div class="col-lg-5 col-md-5 mb-15 d-flex align-items-center justify-content-start">
                                    <div class="tg-listing-box-number-found mr-15">
                                        <button type="button" class="btn btn-light">Destinations <span class="badge text-bg-primary"><?=number_format($total_destinations)?></span></button>
                                    </div>
                                    <div class="tg-listing-box-number-found">
                                        <button type="button" class="btn btn-light">Comfort Buses <span class="badge text-bg-primary"><?=number_format($total_buses)?></span></button>                                        
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7 mb-15">                                    
                                    <div class="tg-listing-box-view-type d-flex justify-content-end align-items-center">
                                        <div class="tg-listing-sort">
                                            <span>Sort by:</span>
                                            <a href="#">
                                                <svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M8.46918 3.27934C8.6098 3.41979 8.80043 3.49868 8.99918 3.49868C9.19793 3.49868 9.38855 3.41979 9.52918 3.27934L10.2492 2.55934V12.7493C10.2492 12.9483 10.3282 13.139 10.4688 13.2797C10.6095 13.4203 10.8003 13.4993 10.9992 13.4993C11.1981 13.4993 11.3889 13.4203 11.5295 13.2797C11.6702 13.139 11.7492 12.9483 11.7492 12.7493V2.55934L12.4692 3.27934C12.5378 3.35303 12.6206 3.41213 12.7126 3.45312C12.8046 3.49411 12.904 3.51615 13.0047 3.51793C13.1054 3.51971 13.2054 3.50118 13.2988 3.46346C13.3922 3.42574 13.477 3.3696 13.5482 3.29838C13.6194 3.22716 13.6756 3.14233 13.7133 3.04894C13.751 2.95555 13.7695 2.85552 13.7678 2.75482C13.766 2.65411 13.7439 2.5548 13.703 2.4628C13.662 2.3708 13.6029 2.288 13.5292 2.21934L11.5292 0.21934C11.3886 0.0788894 11.1979 0 10.9992 0C10.8004 0 10.6098 0.0788894 10.4692 0.21934L8.46918 2.21934C8.32873 2.35997 8.24984 2.55059 8.24984 2.74934C8.24984 2.94809 8.32873 3.13871 8.46918 3.27934ZM3.74918 12.9393L4.46918 12.2193C4.53784 12.1457 4.62064 12.0866 4.71264 12.0456C4.80464 12.0046 4.90395 11.9825 5.00465 11.9807C5.10536 11.979 5.20539 11.9975 5.29877 12.0352C5.39216 12.0729 5.477 12.1291 5.54821 12.2003C5.61943 12.2715 5.67558 12.3564 5.7133 12.4497C5.75102 12.5431 5.76955 12.6432 5.76777 12.7439C5.76599 12.8446 5.74395 12.9439 5.70296 13.0359C5.66197 13.1279 5.60286 13.2107 5.52918 13.2793L3.52918 15.2793C3.38855 15.4198 3.19793 15.4987 2.99918 15.4987C2.80043 15.4987 2.6098 15.4198 2.46918 15.2793L0.469177 13.2793C0.39549 13.2107 0.336388 13.1279 0.295396 13.0359C0.254404 12.9439 0.232362 12.8446 0.230585 12.7439C0.228809 12.6432 0.247333 12.5431 0.285054 12.4497C0.322775 12.3564 0.37892 12.2715 0.450138 12.2003C0.521357 12.1291 0.606191 12.0729 0.699579 12.0352C0.792967 11.9975 0.892997 11.979 0.993699 11.9807C1.0944 11.9825 1.19372 12.0046 1.28571 12.0456C1.37771 12.0866 1.46052 12.1457 1.52918 12.2193L2.24918 12.9393V2.74934C2.24918 2.55043 2.32819 2.35966 2.46885 2.21901C2.6095 2.07836 2.80026 1.99934 2.99918 1.99934C3.19809 1.99934 3.38885 2.07836 3.52951 2.21901C3.67016 2.35966 3.74918 2.55043 3.74918 2.74934V12.9393Z" fill="currentColor" />
                                                </svg>
                                            </a>
                                        </div>
                                        <div class="tg-listing-select-price ml-10">
                                            <select class="select">
                                                    <option>Price Low</option>
                                                    <option>Price High</option>
                                                    <option>Default</option>
                                                    <option>Latest</option>
                                                    <option>Trending</option>
                                            </select>
                                        </div>
                                        <div class="d-none d-sm-block">
                                            <div class="tg-listing-box-view ml-10 d-flex">
                                                    <div class="list-switch-item">
                                                        <button class="grid-view active">
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M8 1H1V8H8V1Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M19 1H12V8H19V1Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M19 12H12V19H19V12Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                                                <path d="M8 12H1V19H8V12Z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="list-switch-item ml-5">
                                                        <button class="list-view">
                                                            <svg width="20" height="14" viewBox="0 0 20 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M6 1H19M6 7H19M6 13H19M1 1H1.01M1 7H1.01M1 13H1.01" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                            </svg>
                                                        </button>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tg-listing-grid-item">                            
                            <div id="searchContainer" class="row list-card">
                                <div class="col-sm-12">
                                    <div class="d-flex align-items-center justify-content-center mt-30">
                                        <div class="row d-flex flex-column align-items-center justify-content-center">
                                            <img src="<?=base_url()?>assets/img/svgs/empty-state-1.svg" class="img-fluid" alt="No record found" style="width:200px;height:200px;">
                                            <h4 class="fw-bold fs-16 mb-0 text-center">Pick a destination</h4>
                                            <p class="text-muted fs-14 text-center">To view available buses, please pick a destination using input fields above.</p>
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
        function updateDropdowns() {
            const selected1 = $('#travelFrom').val();
            const selected2 = $('#destination').val();

            $('#destination option').each(function () {
                if($(this).val() != ''){
                    $(this).prop('disabled', $(this).val() === selected1);
                }
            });

            $('#travelFrom option').each(function () {
                if($(this).val() != ''){
                    $(this).prop('disabled', $(this).val() === selected2);
                }
            });
        }

        $('#travelFrom').change(function () {
            updateDropdowns();
        });

        $('#destination').change(function () {
            updateDropdowns();
        })

        updateDropdowns();
    })
</script>
<script>
    $(function(){
        $("#bookingForm").on("submit", function(event) {
            let isFormValid = true;

            $(this).find("input[type=text], select").each(function() {
                if ($.trim($(this).val()) === "") {
                    isFormValid = false;
                    $(this).css("border", "1px solid red");
                } else {
                    $(this).css("border", "");
                }
            });

            if (!isFormValid) {
                event.preventDefault(); // Stop form submission
                //("Please fill in all the required fields!");
            }
        });
    })
</script>
<script>
    $(function(){
        let loader = $('#loading');
        let resultContainer = $('#searchContainer')

        $('#checkAvailabiltyBtn').click(function(e){
            e.preventDefault()

            resultContainer.empty();
            loader.addClass('d-flex');

            $.ajax({
                url: '<?=base_url('booking/available')?>',
                type: 'POST',
                data: {
                    'filter': '',
                    'destination' : $('#destination').val(),
                    'travel_from' : $('#travelFrom').val(),
                    'travel_date' : $('#departureDate').val(),
                    'travel_time': $('#departureTime').val()
                },
                success: function(res){
                    resultContainer.empty().html(res)
                    loader.removeClass('d-flex')
                },
                error: function(err){
                    console.log(err)
                    loader.removeClass('d-flex')
                }
            })
        });
    })
</script>