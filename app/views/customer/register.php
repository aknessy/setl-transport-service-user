<main class="h-screen" style="height:100vh;width:100%;background-image:url(<?=base_url()?>assets/img/breadcrumb/breadcrumb.jpg);background-size:cover;background-repeat:no-repeat">
    <div class="tg-login-area pt-130 pb-130">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-5 col-lg-4 col-md-4">
                    <div class="tg-login-wrapper rounded">
                        <div class="tg-login-top text-center mb-30">
                            <h2>Create User Account</h2>
                            <p>Complete the following simple form to create a user account.</p>
                        </div>
                        <div class="tg-login-form">
                            <div class="tg-tour-about-review-form">
                                <?=form_open(base_url('customer/register'), ['method' => 'POST'])?>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="last_name" placeholder="Last Name" name="last_name" required>
                                                <label for="last_name">Last name</label>
                                            </div>
                                            <span class="text-danger fs-6"><?=form_error('last_name')?></span>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="first_name" placeholder="First Name" name="first_name" required>
                                                <label for="first_name">First name</label>
                                            </div>
                                            <span class="text-danger fs-6"><?=form_error('first_name')?></span>
                                        </div>                                        
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="middle_name" placeholder="Middle Name" name="middlename">
                                                <label for="middle_name">Middle name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 mb-3">
                                            <div class="form-floating mb-0">
                                                <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email" required>
                                                <label for="email">Email address</label>
                                            </div>
                                            <span class="text-danger fs-6"><?=form_error('email')?></span>
                                        </div>
                                    </div>
                                    <div class="row mb-25">
                                        <div class="col-lg-12">
                                            <div class="form-floating">
                                                <input type="text" class="form-control" id="phone" placeholder="name@example.com" name="phone" required>
                                                <label for="email">Phone Number</label>
                                            </div>
                                            <span class="text-danger fs-6"><?=form_error('phone')?></span>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <!-- <div class="col-lg-12 mb-25">
                                            <input class="input" type="text" placeholder="Username or email">
                                        </div>
                                        <div class="col-lg-12 mb-25">
                                            <input class="input" type="email" placeholder="E-mail">
                                        </div> -->
                                        <div class="col-lg-12">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="tg-login-navigate mb-25">
                                                    Already have account? <a href="<?=base_url('login')?>">Login</a>
                                                </div>
                                            </div>
                                            <button type="submit" class="tg-btn w-100">Create Account</button>
                                        </div>
                                    </div>
                                <?=form_close()?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>