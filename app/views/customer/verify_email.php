<main class="h-screen" style="height:100vh;width:100%;background-image:url(<?=base_url()?>assets/img/breadcrumb/breadcrumb.jpg);background-size:cover;background-repeat:no-repeat">
    <div class="tg-login-area pt-130 pb-130">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-5 col-lg-4 col-md-4">
                    <div class="tg-login-wrapper rounded">
                        <div class="tg-login-top text-center mb-30">
                            <h2>Account Update</h2>
                            <p>Pease verify your email address below</p>
                        </div>
                        <div class="tg-login-form">
                            <div class="tg-tour-about-review-form">
                                <?=form_open(base_url('customer/confirm_email'),['method' => 'POST'])?>
                                    <div class="row mb-25">
                                        <div class="col-lg-12 mb-3">
                                            <div class="form-floating mb-0">
                                                <input type="text" class="form-control" id="verification_code" placeholder="Verification Code" name="verification_code" required>
                                                <label for="verification_code">Email Verification Code</label>
                                            </div>
                                            <span class="text-danger fs-6"><?=form_error('verification_code')?></span>
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
                                                    Email already verified? Please <a href="<?=base_url('login')?>">Login</a>
                                                </div>
                                            </div>
                                            <button type="submit" class="tg-btn w-100">Verify Email Address</button>
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