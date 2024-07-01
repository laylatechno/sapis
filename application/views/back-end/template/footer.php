        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        SIPAS Premium &#169; 2020 <a href="https://www.ionixeternal.co.id/" target="_blank" class="text-primary">Ionix Eternal Studio</a>. All rights reserved.
                    </div>
                    <div class="col-sm-6">
                      <div class="text-sm-right d-none d-sm-block">
                        App Ver. 1.3
                      </div>
                    </div>
                </div>
            </div>
        </footer>

      </div>
      <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!--=============== Toast JS ===============-->
    <?php if($this->session->flashdata('flash') && $this->session->flashdata('type')) : ?>
        <?php echo '<script>
        new Audio(baseURL+"uploads/app/audio/'.$this->session->flashdata('type').'.mp3").play();
        var notifier = new Notifier();
        var notification = notifier.notify("'.$this->session->flashdata('type').'", "'.$this->session->flashdata('flash').'");
        notification.push();
        </script>' ?>
    <?php endif; ?>

    <!--=============== Library Script  ===============-->
    <script src="<?= base_url();?>assets/back-end/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url();?>assets/back-end/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url();?>assets/back-end/libs/metismenu/metisMenu.min.js"></script>
    <script src="<?= base_url();?>assets/back-end/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= base_url();?>assets/back-end/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url();?>assets/back-end/libs/sweetalert2/sweetalert2.min.js"></script>
    <script src="<?= base_url();?>assets/back-end/libs/parsleyjs/parsley.min.js"></script>
    <script src="<?= base_url();?>assets/back-end/libs/moment/min/moment.min.js"></script>
    <script src="<?= base_url();?>assets/back-end/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    <script src="<?= base_url();?>assets/back-end/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="<?= base_url();?>assets/back-end/libs/dropify/dropify.min.js"></script>
    <script src="<?= base_url();?>assets/back-end/libs/owl.carousel/owl.carousel.min.js"></script>
    <script src="<?= base_url();?>assets/back-end/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

    <!--=============== Datatable Script ===============-->
    <script src="<?= base_url();?>assets/back-end/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url();?>assets/back-end/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?= base_url();?>assets/back-end/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?= base_url();?>assets/back-end/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!--=============== Application Script ===============-->
    <script src="<?= base_url();?>assets/back-end/js/app.js"></script>
    <script src="<?= base_url();?>assets/back-end/js/notify.js"></script>

</body>

</html>
