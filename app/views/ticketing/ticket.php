
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
//QR CODE =============

$PNG_TEMP_DIR = base_url().'uploads/temp/';
$PNG_WEB_DIR = 'temp/';

//include "QR/qrlib.php";
include_once APPPATH."libraries/qr/qrlib.php";

// print(include APPPATH."libraries/qr/qrlib.php");
//remember to sanitize user input in real-life solution !!!
$errorCorrectionLevel = 'L';

if(isset($_REQUEST['level']) && in_array($_REQUEST['level'], array('L','M','Q','H'))){
    $errorCorrectionLevel = $_REQUEST['level'];
}

$matrixPointSize = 4;

if (isset($_REQUEST['size'])){
    $matrixPointSize = min(max((int)$_REQUEST['size'], 1), 10);
}

$public_view_url = $this->settings_m->getOne(['skey'=>'app_privacy_link'])->value;
$link = $public_view_url . '/ticketing/' . $record->order_id;

// var_dump($link);
//$link = "http://ng.clouds/nekede/index.php?fee/qr_check/" . $_SESSION['putmeID'] . '/' . $_SESSION['payeeID'];

$filename = 'uploads/temp/'.md5($link.'|'.$errorCorrectionLevel.'|'.$matrixPointSize).'.png';
// $filename = base_url().'uploads/temp/'.'avatar_default'.'.jpg';
    // ob_start();
QRcode::png($link, $filename, $errorCorrectionLevel, $matrixPointSize, 2);
    // QRcode::png($link);

// === Adding image to qrcode
$imgname = $filename;
$logo = base_url('assets/images/light-logo.png');
$QR = imagecreatefrompng($imgname);
if($logo !== FALSE){
    $logopng = imagecreatefrompng($logo);
    $QR_width = imagesx($QR);
    $QR_height = imagesy($QR);
    $logo_width = imagesx($logopng);
    $logo_height = imagesy($logopng);

    list($newwidth, $newheight) = getimagesize($logo);
    $out = imagecreatetruecolor($QR_width, $QR_width);
    imagecopyresampled($out, $QR, 0, 0, 0, 0, $QR_width, $QR_height, $QR_width, $QR_height);
    imagecopyresampled($out, $logopng, $QR_width/2.65, $QR_height/2.65, 0, 0, $QR_width/4, $QR_height/4, $newwidth, $newheight);

}
imagepng($out,$imgname);
imagedestroy($out);

$selected_seats = $user_selected_seats;
$split = NULL;
$total_amount = 0;

if(strpos($selected_seats, ',') == TRUE) $split = explode(',', $selected_seats);
else $split = $selected_seats;
?>

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
    $customer = NULL;

    if(strpos($selected_seats, ',') == TRUE) $split = explode(',', $selected_seats);
    else $split = $selected_seats;

    if($this->session->loggedIn == TRUE || $this->session->loggedInUserID != NULL){
        $customer = $this->customer_m->get_customer($this->session->loggedInUserID); 
    }
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
                            <span class="dvdr"><i class="fa-sharp fa-solid fa-angle-right"></i></span>
                            <span>Customer Ticket</span>
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
            <div class="row justify-content-center mt-2">
                <div class="col-sm-12 col-lg-10 col-md-10">
                    <div id="print-section" class="card">
                        <div class="card-header d-flex align-items-center justify-content-start bg-success-subtle py-4 px-4">
                            <div class="bg-white text-center text-success py-4 px-4 rounded me-3">
                                <span class="fw-semibold fs-22">
                                    <i class="fa-solid fa-check-double"></i>
                                </span>
                            </div>
                            <div class="col-auto">
                                <h4 class="fw-semibold text-dark mb-2 fs-18">Bus Reservation Ticket</h4>
                                <p class="fw-normal mb-0 fs-16">Seat Reservation on <span><?=(ucwords(strtolower($record->bus_make . ' ' . $record->bus_model)))?></span> <span><?='(' . $record->bus_plate_number . ')'?> is complete. Please see the details of your journey as follows</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="table-sm-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>                                                        
                                                        <div class="d-flex flex-column align-items-start justify-content-start">
                                                            <h5 class="fw-semibold fs-18 mb-1"><?=(NULL != $customer ? ucwords($customer->surname . ', ' . $customer->first_name . ' ' . $customer->middle_name) : '')?></h5>
                                                            <p class="text-muted fs-14 mb-0"><?=(NULL != $customer ? $customer->phone : '')?></p>
                                                        </div>
                                                    </td>                                                
                                                    <td>
                                                        <div class="d-flex flex-column align-items-start justify-content-start">
                                                            <h5 class="fw-semibold fs-18 mb-1">Traveling From</h5>
                                                            <p class="text-muted fs-14 mb-0"><?=$this->buses_terminal_m->get_terminal($traveling_from)->terminal_name?></p>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column align-items-start justify-content-start">
                                                            <h5 class="fw-semibold fs-18 mb-1">Traveling To</h5>
                                                            <p class="text-muted fs-14 mb-0"><?=$this->buses_terminal_m->get_terminal($traveling_to)->terminal_name?></p>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center justify-content-between py-2 px-2 rounded bg-light">                                                    
                                                            <div class="d-flex flex-column align-items-start justify-content-start">
                                                                <h5 class="fw-semibold fs-18 mb-1">Departure Time</h5>
                                                                <p class="text-muted fs-14 mb-0"><?=$booking->departure_time?></p>
                                                            </div>                                                    
                                                        </div>
                                                    </td>
                                                    <td colspan="2">                                    
                                                        <h6 class="fw-semibold mb-2 fs-14">Sitting Arrangment</h6>
                                                        <div class="d-flex align-items-center justify-content-between py-2 px-2 rounded bg-light">
                                                        <?php 
                                                            if(is_array($split)){
                                                                $index = 0;

                                                                foreach($split as $key => $value){
                                                                    $seat_id = explode(':', $value)[0];
                                                                    $seat_label = explode(':', $value)[1];
                                                                    $get_seat = $this->buses_m->get_seat_info($seat_id);

                                                                    #$total_amount += $get_seat->seat_amt;
                                                                ?>
                                                                    <div class="d-flex flex-column align-items-start justify-content-start <?=$index != count($split) ? 'me-2':''?>">
                                                                        <h5 class="fw-semibold fs-18 mb-1"><?=$seat_label?></h5>
                                                                        <p class="text-muted fs-14 mb-0"><?=strtoupper($get_seat->seat_type)?></p>
                                                                        <p class="text-muted fs-14 mb-0"><?=ucwords(strtolower($get_seat->seat_desc))?></p>
                                                                    </div>
                                                                    
                                                                <?php
                                                                    $index++;
                                                                }
                                                            }else{
                                                                $desc = '';
                                                                $seat_label = '';
                                                                $seat_type = '';                                                    

                                                                if(strpos($split, ':') == TRUE){
                                                                    $seat_id = explode(':', $split)[0];
                                                                    $seat_label = explode(':', $split)[1];
                                                                    $get_seat = $this->buses_m->get_seat_info($seat_id);
                                                                    
                                                                    $desc = $get_seat->seat_desc;
                                                                    $seat_type = $get_seat->seat_type;
                                                                    
                                                                    #$total_amount += $get_seat->seat_amt;
                                                                }else{                                                        
                                                                    $seat_label = $split;
                                                                    $seat_type = '';

                                                                    #$total_amount += $invoice->amount;
                                                                }?>

                                                                <div class="d-flex flex-column align-items-start justify-content-start me-2">
                                                                    <h5 class="fw-semibold fs-18 mb-1"><?=$seat_label?></h5>
                                                                    <p class="text-muted fs-14 mb-0"><?=strtoupper($seat_type)?></p>
                                                                    <p class="text-muted fs-14 mb-0"><?=ucwords(strtolower($desc))?></p>
                                                                </div>
                                                            <?php
                                                            } 
                                                        ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex flex-column align-items-start justify-content-start py-2 px-2 bg-secondary-subtle rounded mb-2">
                                                            <h5 class="fw-semibold fs-18 mb-1">Departure Date</h5>
                                                            <p class="text-muted fs-14 mb-0"><?=(NULL != $booking->departure_date ? date('F jS, Y', strtotime($booking->departure_date)) : 'Not Specified')?></p>
                                                        </div> 
                                                        <div class="d-flex flex-column align-items-start py-2 px-2 bg-secondary-subtle rounded">
                                                            <h5 class="fw-semibold fs-16 mb-1">Next of Kin Information</h5>
                                                            <p class="fs-12 mb-0"><?=(NULL != $customer ? ucwords(strtolower($customer->nok_name)) : '')?></p>
                                                            <p class="fs-12 mb-0"><?=(NULL != $customer ? $customer->nok_phone : '')?></p>
                                                        </div>
                                                    </td>
                                                    <td colspan="2">
                                                        <div class="d-flex flex-column align-items-start justify-content-end">
                                                            <h6 class="fw-semibold mb-2">Terms & Conditions</h6>
                                                            <ol>
                                                                <li><span class="mr-15">1.</span>By completing your payment for the reservation of a bus seat for this Journey you have agreed to our the terms and conditions.</li>
                                                                <li><span class="mr-15">2.</span>You're to come to the departing terminal at most 30 minutes before the schedule departure time.</li>
                                                                <li><span class="mr-15">3.</span>Any breach of this agreement will result in you forfeiting any payment associated with this journey.</li>
                                                            </ol>
                                                        </div>
                                                    </td>
                                                </tr>                                        
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12 align-self-center">                                        
                                                <img src="<?=base_url().$filename?>" width="80px" height="80px" />                                        
                                            </div>
                                            <div class="col-lg-6 align-self-center">
                                                <div class="float-none float-md-end" style="width: 30%;">
                                                    <small>Managing Director</small>
                                                    <img src="<?=base_url()?>assets/images/extra/signature.png" alt="" class="mt-2 mb-1" height="24">
                                                    <p class="border-top">Signature</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="row mt-25">
                        <div class="row d-flex justify-content-center">
                            <div class="col-lg-12 col-xl-4 ms-auto align-self-center">
                                <div class="text-center text-muted"><small>Thank you very much for doing business with us.</small></div>
                            </div>
                            <div class="col-lg-12 col-xl-4">
                                <div class="float-end d-print-none mt-2 mt-md-0">
                                    <button type="button" onclick="printDiv()" class="btn btn-lg btn-custom-indigo"><span><i class="fa-solid fa-print"></i></span>&nbsp;Print</button>                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
     function printDiv() {
          const div = document.getElementById("printSection"); // Target div

          html2canvas(div, { scale: 2 }).then(canvas => {
               const imgData = canvas.toDataURL("image/png"); // Convert to image URL
               const printWindow = window.open("", "_blank"); // Open a new tab

               printWindow.document.write(`
                    <html>
                    <head>
                         <title>Print</title>
                         <style>
                              @page { size: A4 landscape; margin: 0; }
                              body { display: flex; justify-content: center; align-items: center; height: 100vh; }
                              img { max-width: 100%; max-height: 100vh; }
                         </style>
                    </head>
                    <body>
                         <img src="${imgData}" onload="window.print(); window.close();" />
                    </body>
                    </html>
               `);
          });
     }
</script>