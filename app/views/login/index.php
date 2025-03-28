<main class="h-screen" style="height:100vh;width:100%;background-image:url(<?=base_url()?>assets/img/breadcrumb/breadcrumb.jpg);background-size:cover;background-repeat:no-repeat">
    <div class="tg-login-area pt-130 pb-130">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-xl-5 col-lg-4 col-md-4">
                    <div class="tg-login-wrapper rounded">
                        <div class="tg-login-top text-center mb-30">
                            <h2>Sign in to your account</h2>
                            <p>Enter your credentials to acces your account.</p>
                        </div>
                        <div class="tg-login-form">
                            <div class="tg-tour-about-review-form">
                                <?=form_open(base_url('login'), ['method' => 'POST'])?>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-floating mb-3">
                                                <input type="email" class="form-control" id="email" placeholder="Email" name="email" required>
                                                <label for="email">Email</label>
                                            </div>
                                            <span class="text-danger fs-6"><?=form_error('email')?></span>
                                        </div>
                                        <div class="col-lg-12 mb-25">
                                            <div class="form-floating">
                                                <input type="password" class="form-control" id="password" placeholder="Password" name="password" required>
                                                <label for="password">Password</label>
                                            </div>
                                            <span class="text-danger fw-semibold fs-6"><?=form_error('password')?></span>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="review-checkbox d-flex align-items-center mb-25">
                                                    <input class="tg-checkbox" type="checkbox" id="australia">
                                                    <label for="australia" class="tg-label">Remember me</label>
                                                </div>
                                                <div class="tg-login-navigate mb-25">
                                                    Not yet registered? <a href="<?=base_url('customer/register')?>">Register Now</a>
                                                </div>
                                            </div>
                                            <button type="submit" class="tg-btn w-100">Sign In</button>
                                        </div>
                                    </div>
                                <?=form_close()?>
                            </div>
                        </div>
                    </div><!--3EGm5wQwLOZu-->
                </div>
            </div>
        </div>
    </div>
</main>