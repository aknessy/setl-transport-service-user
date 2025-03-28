
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
                                        <a href="<?=base_url('customer/travel_history')?>" class="d-flex align-items-center fs-10 <?=($this->uri->segment(1) == 'customer' && $this->uri->segment(2) == 'trvel_history') ? 'active' : ''?>">
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
                                    <div class="col-xl-3">
                                        <div class="d-flex flex-column align-items-center justify-content-center">
                                            <div class="text-center bg-light border-white position-relative" style="height:80px;width:80px">
                                                <div class="position-absolute top-50 start-100 translate-middle">
                                                    <button id="triggerField" type="button" class="btn btn-sm btn-info rounded-circle shadow">
                                                        <i class="fa-regular fa-images-user"></i>
                                                    </button>
                                                </div>
                                                
                                                <?php 
                                                    if(NULL != $customer->photo){?>
                                                      <img id="imagePreviewer" src="<?=$customer->photo?>" alt="<?=$customer->customer_id?>" class="img-fluid rounded-circle mx-auto d-block" style="height:80px;width:80px" />  
                                                <?php 
                                                }else{?>
                                                    <img id="imagePreviewer" src="<?=base_url()?>assets/images/users/avatar-1.jpg" alt="<?=$customer->customer_id?>" class="img-fluid rounded-circle mx-auto d-block" style="height:80px;width:80px" />
                                                <?php
                                                }?>
                                            </div>
                                            <h4 class="fs-6 fw-normal mt-5 mb-2"><?=(NULL != $customer->username ? '@'.$customer->username : '')?></h4>
                                            <p class="text-muted fs-6"><?=date('F jS, Y', strtotime($customer->created_on))?></p>
                                        </div>
                                    </div>
                                    <div class="col-xl-9">
                                        <div class="card">
                                            <div class="w-100 bg-white border py-3 px-2">
                                                <h5 class="card-subtitle fs-6">Customer Basic Information</h5>
                                                <p class="mb-0 text-muted fs-7"><small>The Following Basic information have been found. Please update/edit as appropriate.</small></p>
                                            </div>
                                            <div class="card-body">
                                                <?=form_open(base_url('customer/update_basic_information'), ['id' => 'basicInfoForm', 'method' => 'POST', 'enctype' => 'multipart/form-data'])?>
                                                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                                    <input type="file" id="imageField" name="customer_photo" style="visibility:hidden;width:0;height:0" />

                                                    <div class="row mb-3">
                                                        <div class="col-lg-4">
                                                            <div class="form-floating">
                                                                <input type="text" name="last_name" class="form-control" id="lastname" value="<?=$customer->surname?>" required>
                                                                <label for="lastname">Last name</label>
                                                            </div>
                                                            <span class="text-danger fs-6 fw-semibold"><?=form_error('last_name')?></span>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-floating">
                                                                <input type="text" name="first_name" class="form-control" id="firstname" value="<?=$customer->first_name?>" required>
                                                                <label for="firstname">First name</label>
                                                            </div>
                                                            <span class="text-danger fs-6 fw-semibold"><?=form_error('first_name')?></span>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-floating">
                                                                <input type="text" name="middle_name" class="form-control" id="middlename" value="<?=$customer->middle_name?>">
                                                                <label for="middlename">Middle name</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-6">
                                                            <div class="form-floating">
                                                                <input type="email" name="email" class="form-control" id="email" value="<?=$customer->email?>" required>
                                                                <label for="email">Email Address</label>
                                                            </div>
                                                            <span class="text-danger fs-6 fw-semibold"><?=form_error('email')?></span>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-floating">
                                                                <input type="text" name="phone" class="form-control" id="phone" value="<?=$customer->phone?>" required>
                                                                <label for="phone">Phone Number</label>
                                                            </div>
                                                            <span class="text-danger fs-6 fw-semibold"><?=form_error('phone')?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-12">
                                                            <div class="form-floating">
                                                                <textarea class="form-control" placeholder="Address" id="address" name="address" required><?=ucwords(strtolower($customer->address))?></textarea>
                                                                <label for="address">Address</label>
                                                            </div>
                                                            <span class="text-danger fs-6 fw-semibold"><?=form_error('address')?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-15">
                                                        <div class="col-lg-6">
                                                            <div class="form-floating">
                                                                <select class="form-select" id="stateOrigin" aria-label="Select State" name="state_of_origin">
                                                                    <option selected>Select Option</option>
                                                                    <?php 
                                                                        if($states){
                                                                            foreach($states as $obj){
                                                                                if($customer->state_of_origin == $obj->id){
                                                                                    echo '<option value="' . $obj->id . '" selected>' . $obj->name . '</option>';
                                                                                }else{
                                                                                    echo '<option value="' . $obj->id . '">' . $obj->name . '</option>';
                                                                                }
                                                                            }
                                                                        }
                                                                    ?>
                                                                </select>
                                                                <label for="floatingSelect">State of Origin</label>
                                                            </div>
                                                            <span class="text-danger fs-6 fw-semibold"><?=form_error('state_of_origin')?></span>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-floating">
                                                                <select class="form-select" id="lgaOrigin" aria-label="Select State" name="lga_of_origin">
                                                                    <option selected>Select Option</option>
                                                                </select>
                                                                <label for="floatingSelect">State of Origin</label>
                                                            </div>
                                                            <span class="text-danger fs-6 fw-semibold"><?=form_error('lga_of_origin')?></span>
                                                        </div>
                                                    </div>
                                                    <hr/>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-6">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" name="nok_name" id="nok_name" value="<?=$customer->nok_name?>">
                                                                <label for="nok_name">Nex of Kin Name</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-floating">
                                                                <input type="text" class="form-control" name="nok_phone" id="nok_phone" value="<?=$customer->nok_phone?>">
                                                                <label for="nok_phone">Nex of Kin Phone</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-12">
                                                            <div class="form-floating">
                                                                <textarea class="form-control" placeholder="Next of Kin Address" id="nok_address" name="nok_address"><?=ucwords(strtolower($customer->nok_address))?></textarea>
                                                                <label for="nok_address">Next of Kin Address</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?=form_close()?>
                                            </div>
                                            <div class="card-footer">
                                                <div class="col-lg-12">
                                                    <div class="d-flex align-items-center justify-content-end">
                                                        <button type="reset" class="btn btn-outline-secondary mr-15">Reset</button>
                                                        <button id="submitBasicInfoBtn" type="submit" class="btn btn-custom-indigo mr-15">Update Info</button>
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
        </div>
    </div>
</main>

<script>
    $(function(){
        $('#stateOrigin').change(function(){
            var stateId = $(this).val();
            
            const csrfName = '<?= $this->security->get_csrf_token_name(); ?>';
            const csrfHash = '<?= $this->security->get_csrf_hash(); ?>';

            if(stateId != '' || stateId != 0){
                $.ajax({
                    url: "<?=base_url('customer/get_lgas')?>",
                    method: 'POST',
                    data: {
                        csrf_name: csrfName,
                        csrf_token: csrfHash,
                        state:stateId
                    },
                    success: function(res){
                        let response = JSON.parse(res);
                        let len = response.data.length;
                        let data = response.data;

                        if(len > 0){
                            $('#lgaOrigin').empty().append('<option value="0">Select Option</option>');

                            for(var i = 0; i < len; i++){
                                $('#lgaOrigin').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
                            }
                        }
                    },
                    error: function(err){
                        console.log(err)
                    }
                })
            }
        });

        $('#triggerField').click(function(){
            $('#imageField').trigger('click')
        })

        $('#imageField').change(function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagePreviewer').attr('src', e.target.result).show();
                };
            reader.readAsDataURL(file);
            }
        });

        $('#submitBasicInfoBtn').click(function(){
            $('#basicInfoForm').submit()
        })

    })
</script>