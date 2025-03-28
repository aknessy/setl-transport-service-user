
<style>
    @media print {
        body * {
            position: relative;
        }
        #print-section {
            visibility: visible;
            position: absolute;
            top: 0;
            left: 0;
        }
    }
</style>

<?php 
    $selected_seats = $user_selected_seats;
    
    $split = NULL;
    $total_amount = 0;

    if(strpos($selected_seats, ',') == TRUE) $split = explode(',', $selected_seats);
    else $split = $selected_seats;
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
                            <span>Payment Invoice</span>
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
            <?=form_open(base_url('payment'), ['id' => 'payInvoiceForm', 'method' => 'POST', 'class' => 'row'])?>
                <div id="print-section" class="<?=$this->session->loggedIn == TRUE ? 'col-lg-12':'col-lg-7 col-xl-8 col-sm-12'?>">
                    <div class="card">
                        <div class="card-body bg-light"> 
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="align-self-center">                                                
                                    <img src="<?=base_url()?>assets/img/logo/logo-green.png" alt="logo-small" class="logo-sm me-1" height="40"> 
                                </div>   
                                <div class="text-left align-self-center">                                                
                                    <h6 class="mb-1"><span class="text-muted">Order ID</span> <span class="fs-10"><?=$invoice->order_id?></span></h6> 
                                    <h6 class="mb-0"><span class="text-muted">Order Date</span> <span class="fs-10"><?=date('F jS, Y',strtotime($invoice->created_at))?></span></h6> 
                                </div>   
                            </div>     
                        </div>
                        <div class="card-body">                    
                            <div class="row row-cols-3 d-flex align-items-center justify-content-between mb-25">
                            <?php 
                                if($this->session->loggedIn == TRUE){
                                    $customer = $this->customer_m->get_customer($this->session->loggedInUserID);
                                ?>
                                    <div class="col-md-4 col-lg-4 d-print-flex align-self-center">
                                        <div class="">
                                            <span class="badge rounded text-dark bg-light">Invoice to</span>
                                            <h5 class="mb-0 fw-semibold fs-10"><?=ucwords($customer->surname . ', ' . $customer->first_name . ' ' . $customer->middle_name)?></h5>
                                            <p class="text-muted mb-0"><?=$customer->email?> | <?=$customer->phone?></p>
                                        </div>
                                    </div>
                                    <?php 
                                    }
                                ?>
                                <div class="col-md-4 col-lg-4 d-print-flex align-self-center">                                            
                                    <div class="">
                                        <address class="fs-10 mb-0">
                                            <strong class="fs-10">Departing From</strong><br/>
                                            <span class="text-muted"><?=$this->buses_terminal_m->get_terminal($traveling_from)->terminal_name?></span><br>
                                        </address>
                                    </div>
                                </div> 
                                <div class="col-lg-4 col-md-4 d-print-flex align-self-center">
                                    <div class="">
                                        <address class="fs-10 mb-0">
                                            <strong class="fs-10">Arriving At</strong><br>
                                            <span class="text-muted"><?=$this->buses_terminal_m->get_terminal($traveling_to)->terminal_name?></span>
                                        </address>
                                    </div>
                                </div>                       
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="table-responsive project-invoice">                                                                    
                                        <table class="table table-bordered mb-0">
                                            <thead class="table-light">
                                                <tr>
                                                    <th class="text-uppercase fw-normal">S/No</th>
                                                    <th class="text-uppercase fw-normal">Reservation Breakdown</th>
                                                    <th class="text-uppercase fw-normal">Seat</th>
                                                    <th class="text-uppercase fw-normal">Seat Type</th>
                                                    <th class="text-uppercase fw-normal">Amount</th>
                                                </tr><!--end tr-->
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    if(is_array($split)){
                                                        $index = 1;
                                                        $amount_payable = 0;

                                                        foreach($split as $key => $value){
                                                            $seat_id = explode(':', $value)[0];
                                                            $seat_label = explode(':', $value)[1];
                                                            $get_seat = $this->buses_m->get_seat_info($seat_id);
                                                            
                                                            if($get_seat && ($get_seat->seat_amt != 0)){
                                                                $total_amount += $get_seat->seat_amt;
                                                                $amount_payable = $get_seat->seat_amt;
                                                            }else{
                                                                $total_amount += $invoice->amount;
                                                                $amount_payable = $invoice->amount;
                                                            }                
                                                        ?>
                                                            <tr>
                                                                <td><?=$index?>. </td>
                                                                <td>
                                                                    <h5 class="mt-0 mb-1 fs-10"><strong><?=ucwords(strtolower($invoice->invoice_for))?></strong></h5>
                                                                    <p class="mb-0 text-muted fs-8"><?=ucwords(strtolower($get_seat->seat_desc))?></p>
                                                                </td>
                                                                <td><?=$seat_label?></td>
                                                                <td><?=strtoupper($get_seat->seat_type)?></td>
                                                                <td><?=CURRENCY . number_format($amount_payable,2)?></td>
                                                            </tr>
                                                        <?php
                                                            $index++;
                                                        }
                                                    }else{   
                                                        $desc = '';
                                                        $seat_label = '';
                                                        $seat_type = '';                                                    

                                                        $amount_payable = 0;

                                                        if(strpos($split, ':') == TRUE){
                                                            $seat_id = explode(':', $split)[0];
                                                            $seat_label = explode(':', $split)[1];
                                                            $get_seat = $this->buses_m->get_seat_info($seat_id);
                                                            
                                                            $desc = $get_seat->seat_desc;
                                                            $seat_type = $get_seat->seat_type;
                                                            
                                                            if($get_seat && ($get_seat->seat_amt != 0)){
                                                                $total_amount += $get_seat->seat_amt;
                                                                $amount_payable = $get_seat->seat_amt;
                                                            }else{
                                                                $total_amount += $invoice->amount;
                                                                $amount_payable = $invoice->amount;
                                                            } 
                                                        }else{                                                        
                                                            $seat_label = $split;
                                                            $seat_type = '';

                                                            $total_amount += $invoice->amount;
                                                            $amount_payable = $invoice->amount;
                                                        }                                
                                                                                                                
                                                        ?>

                                                        <tr>
                                                            <td>1. </td>
                                                            <td>
                                                                <h5 class="mt-0 mb-1 fs-10"><strong><?=ucwords(strtolower($invoice->invoice_for))?></strong></h5>
                                                                <p class="mb-0 text-muted fs-8"><?=ucwords(strtolower($desc))?></p>
                                                            </td>
                                                            <td><?=$seat_label?></td>
                                                            <td><?=strtoupper($seat_type)?></td>
                                                            <td><?=CURRENCY . number_format($amount_payable,2)?></td>
                                                        </tr>
                                                    <?php
                                                    } ?>
                                                    <tr>
                                                        <td colspan="2"></td>
                                                        <td colspan="2" class="fs-12 fw-semibold">Total Seats</td>
                                                        <td colspan="1" class="fs-12 fw-semibold"><?=number_format($booking->total_seats)?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <?php
                                                            if($this->session->loggedIn == TRUE):?>
                                                            <div class="d-flex align-items-center">
                                                                <div class="d-flex flex-column px-2">
                                                                    <div>
                                                                        <p class="fw-normal text-muted mb-0">Do you have a discount code?</p>
                                                                        <div class="form-floating mb-0">
                                                                            <input type="text" class="form-control form-control-sm text-muted fs-6" id="discountCode" value="" placeholder="Voucher/Discount Code" name="voucher">
                                                                            <label for="discountCode" class="text-dark fs-6">Voucher/Discount Code</label>
                                                                        </div>
                                                                    </div>
                                                                    <p id="discountCalcMsg" class="text-warning text-sm d-block mb-2"><p>
                                                                </div>
                                                                <button id="applyDiscountCode" type="button" class="btn btn-dark mt-3" disabled>Apply</button>
                                                            </div>
                                                            <?php 
                                                            endif;?>
                                                        </td>
                                                        <td colspan="2" class="fs-12 fw-semibold">
                                                            Total Amount Payable</td>
                                                        <td colspan="1" class="fs-12 fw-semibold"><span><?=CURRENCY?></span><span id="amountPayable"><?=number_format($total_amount, 2)?></span></td>
                                                    </tr>
                                            </tbody>

                                            <input id="amountToPay" type="hidden" value="<?=$total_amount?>" name="amount" />
                                            <input type="hidden" value="<?=$invoice->invoice_for?>" name="paymentDesc" />
                                            <input type="hidden" value="<?=$invoice->order_id?>" name="orderID" /> 
                                        
                                        </table>
                                    </div>                                          
                                </div>                                      
                            </div>

                            <div class="row">
                                <div class="col-lg-8">
                                    <h5 class="mt-4">Terms And Condition</h5>
                                    <ol class="ordered-list ps-3">
                                        <li><small class="fs-10">1.) All accounts are to be paid within 7 days from receipt of invoice. </small></li>
                                        <li><small class="fs-10">2.) To be paid by cheque or credit card or direct payment online.</small></li>                                                                           
                                    </ol>
                                </div>                                       
                                <div class="col-lg-4 align-items-center justify-content-center mt-25">
                                    <div class="float-none float-md-end">
                                        <small>Account Manager</small><br/>
                                        <img src="<?=base_url()?>assets/images/extra/signature.png" alt="" class="mt-2 mb-1" height="24">
                                        <p class="border-top">Signature</p>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-35">
                                <div class="col-xl-12 align-self-center justify-content-center">
                                    <div class="text-center text-muted"><small>Thank you very much for doing business with us.</small></div>
                                </div>
                            </div>          
                        </div>
                    </div>
                </div>
                <div class="<?=$this->session->loggedIn == TRUE ? 'd-none':'col-lg-5 col-xl-4 col-sm-12'?>">
                    <div class="card shadow-none">
                        <div class="card-body px-4">
                            <div class="mb-25">
                                <h4 class="card-title fw-semibold mb-5">Billing Information</h4>
                                <p class="card-text">Fill the following information to be used when completing payment</p>
                            </div>
                            <div class="row mb-5">                                
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control text-muted fs-6" id="surname" placeholder="Last Name" name="last_name">
                                        <label for="surname" class="fw-semibold fs-6">Last Name</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control text-muted fs-6" id="firstname" placeholder="First name" name="first_name">
                                        <label for="firstname" class="fw-semibold fs-6">First name</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control text-muted fs-6" id="email" placeholder="Email" name="email">
                                        <label for="email" class="fw-semibold fs-6">Email</label>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control text-muted fs-6" id="phone" placeholder="Phone Number" name="phone">
                                        <label for="phone" class="fw-semibold fs-6">Phone Number</label>
                                    </div>
                                </div>
                            </div>
                            <hr/>
                            <div class="row mb-5">
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control text-muted fs-6" id="nok_name" placeholder="Next of Kin" name="nok_name">
                                        <label for="nok_name" class="fw-semibold fs-6">Next of Kin</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-5">
                                <div class="col-lg-12">
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control text-muted fs-6" id="nok_phone" placeholder="Next of Kin Contact" name="nok_phone">
                                        <label for="nok_phone" class="fw-semibold fs-6">Next of Phone</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="1" id="flexCheckDefault" name="save_info">
                                    <label class="form-check-label fs-6" for="flexCheckDefault">
                                        <small>Save this information for the future. You never have to do this ever again. With this, you will utilise other functions of our website like <em>discounts</em>, <em>reviews</em>, etc.</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row mt-35">
                    <div class="col-lg-12">
                        <div class="row d-flex justify-content-end">                        
                            <div class="col-lg-12 col-xl-4">
                                <div class="float-end d-print-none mt-2 mt-md-0">
                                    <a href="javascript:window.print()" class="btn btn-lg btn-outline-dark"><span><i class="fa-solid fa-print"></i></span>&nbsp;Print</a>
                                    <button type="submit" class="btn btn-lg btn-custom-indigo">Continue to Payment</button>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?=form_close()?>
        </div>
    <div>
</main>

<script type="text/javascript">
    $(function(){
        let loader = $('#loading');
        let travelFrom = parseInt('<?=$traveling_from?>')
        let travelTo = parseInt('<?=$traveling_to?>')

        $('#submitInvoiceForPayment').click(function(){
            $('#payInvoiceForm').submit();
        });

        $('#discountCode').on('change', function(){
            if($(this).val() != ''){
                $('#applyDiscountCode').prop('disabled', false)
            }
        });

        $('#applyDiscountCode').click(function(){
            loader.addClass('d-flex');

            $.ajax({
                url: '<?=base_url('tfare/calculate_discount_price')?>',
                method: 'POST',
                data: {
                    discountCode: $('#discountCode').val(),
                    origin: travelFrom,
                    destination: travelTo
                },
                success: function(res){
                    let response = JSON.parse(res);

                    if(response.applicable_discount > 0){
                        let discountRate = parseInt(response.applicable_discount);
                        let amtToDiscount = parseInt($('#amountToPay').val());

                        let calcDiscount = (amtToDiscount * discountRate) / 100;
                        let finalAmt = (amtToDiscount - calcDiscount);

                        $('#amountPayable').text(numberFormat(finalAmt));
                        $('#amountToPay').val(finalAmt);
                        
                        Swal.fire({
                            title: "Success Message",
                            text: "Discount Calculated & Applied",
                            icon: "success",
                            confirmButtonText: 'OK'
                        });
                    }else{
                        Swal.fire({
                            title: "Error Message",
                            text: "Either You're not qualified for the discount or the discount is expired!",
                            icon: "error",
                            confirmButtonText: 'OK'
                        });
                    }

                    loader.removeClass('d-flex');
                },
                error: function(err){
                    console.log(err)
                }
            })
        });
    });
</script>