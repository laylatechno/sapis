    <!--=============== Toast ===============-->
    <?php if($this->session->flashdata('flash') && $this->session->flashdata('type')) : ?>
        <?php echo '<script>
        new Audio(baseURL+"uploads/app/audio/'.$this->session->flashdata('type').'.mp3").play();
        var notifier = new Notifier();
        var notification = notifier.notify("'.$this->session->flashdata('type').'", "'.$this->session->flashdata('flash').'");
        notification.push();
        </script>' ?>
    <?php endif; ?>

    <!--=============== Library Script ===============-->
    <script src="<?= base_url();?>assets/back-end/libs/jquery/jquery.min.js"></script>
    <script src="<?= base_url();?>assets/back-end/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url();?>assets/back-end/libs/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="<?= base_url();?>assets/back-end/libs/node-waves/waves.min.js"></script>
    <script src="<?= base_url();?>assets/back-end/libs/parsleyjs/parsley.min.js"></script>

    <!--=============== Application Script ===============-->
    <script src="<?= base_url();?>assets/login-page/js/popup.js"></script>
    <script src="<?= base_url();?>assets/login-page/js/scripts.min.js"></script>

  </body>

</html>
