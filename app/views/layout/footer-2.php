     
     <footer>
        <div class="tg-footer-area tg-footer-su-wrapper tg-footer-su-2-wrapper pt-130 include-bg" data-background="assets/img/footer/footer-3.jpg">
            <div class="tg-footer-copyright text-center">
                <div class="d-flex align-items-center justify-content-center">
                    <p class="mb-0 fw-normal fs-6 text-muted">Powered By</p>&nbsp;
                    <a class="text-primary fw-medium ms-2" target="_blank" href="https://nugitech.com/">Nugi Technologies</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>assets/js/isotope.pkgd.min.js"></script>
    <script src="<?=base_url()?>assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.magnific-popup.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.odometer.min.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.appear.js"></script>
    <script src="<?=base_url()?>assets/js/swiper-bundle.min.js"></script>
    <script src="<?=base_url()?>assets/js/flatpickr.js"></script>
    <script src="<?=base_url()?>assets/js/nice-select.js"></script>
    <script src="<?=base_url()?>assets/js/ajax-form.js"></script>
    <script src="<?=base_url()?>assets/js/wow.min.js"></script>
    <script src="<?=base_url()?>assets/js/main.js"></script>
    <script src="<?=base_url()?>assets/js/jquery.nice-select.min.js"></script>

    <script>
        $(function(){
            let travelDateOptions = {
                altInput: true,
                altFormat: 'F j, Y',
                dateFormat: 'Y-m-d',
                minDate: 'today',
                locale: {
                    'firstDayOfWeek': 0 // start week on Sunday
                }
            }

            $('.select2').niceSelect();
            $('.travelDate').flatpickr(travelDateOptions)
        })
    </script>

    </body>
</html>