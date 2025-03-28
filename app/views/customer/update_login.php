
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
                                        <span class="fs-7 text-muted fw-semibold">Hey <?=ucwords(strtolower($this->session->name))?> - Good <?=TimeOfDay(date('H'))?>!</span>
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
                                            <p class="text-muted fs-7"><?=date('F jS, Y', strtotime($customer->created_on))?></p>
                                        </div>
                                    </div>
                                    <div class="col-xl-9">
                                        <div class="card">
                                            <div class="w-100 bg-white border py-3 px-2">
                                                <h5 class="card-subtitle fs-6">Customer Login Information</h5>
                                                <p class="mb-0 text-muted fs-7"><small>You can update your password or add a username. The username field is optional.</small></p>
                                            </div>
                                            <div class="card-body">
                                                <?=form_open(base_url('customer/do_update_login'), ['method' => 'POST', 'id' => 'updateLoginForm'])?>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-12">
                                                            <div class="form-floating">
                                                                <input type="text" name="usn" class="form-control" id="usn" value="<?=(NULL!=$customer->username?$customer->username:set_value('usn'))?>" placeholder="Username">
                                                                <label for="usn">Username</label>
                                                            </div>
                                                            <span class="text-danger fs-6 fw-semibold"><?=form_error('usn')?></span>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-lg-6">
                                                            <div class="form-floating">
                                                                <input type="password" name="pwd" class="form-control" id="pwd" value="" placeholder="Password" required>
                                                                <label for="pwd">Password</label>
                                                            </div>                                                            
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="form-floating">
                                                                <input type="password" class="form-control" id="cnpwd" value="" placeholder="Confirm Password">
                                                                <label for="cnpwd">Confirm Password</label>
                                                            </div>                                                            
                                                        </div>
                                                    </div>
                                                <?=form_close()?>
                                            </div>
                                            <div class="card-footer">
                                                <div class="col-lg-12">
                                                    <div class="d-flex align-items-center justify-content-end">
                                                        <button type="reset" class="btn btn-outline-secondary mr-15">Reset</button>
                                                        <button id="submitUpdate" type="submit" class="btn btn-custom-indigo" disabled>Update Login</button>
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
        let passwordField = $('#pwd');
        let confPasswordField = $('#cnpwd');
        let usernameField = $('#usn');

        confPasswordField.change(function(){
            var cnfValue = $(this).val();
            var pwdValue = passwordField.val();

            if(cnfValue != '' && (pwdValue === cnfValue)){
                if(passwordField.hasClass('is-invalid')){
                    passwordField.removeClass('is-invalid').addClass('is-valid');
                    confPasswordField.removeClass('is-invalid').addClass('is-valid');
                }

                $('#submitUpdate').prop('disabled', false)
            }else{
                passwordField.addClass('is-invalid');
                confPasswordField.addClass('is-invalid');

                $('#submitUpdate').prop('disabled', true);
            }

        });

        usernameField.change(function(){
            var usnValue = $(this).val();

            if(usnValue != ''){
                $('#submitUpdate').prop('disabled', false)
            }else{
                $('#submitUpdate').prop('disabled', true);
            }
        })

        $('#submitUpdate').click(function(){
            $('#updateLoginForm').submit();
        })
    })
</script>