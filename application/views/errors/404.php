<!doctype html>
<html lang="en">

<head>
  <!--=============== Basic  ===============-->
  <meta charset="UTF-8">
  <title><?= $title;?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta name="robots" content="index, follow"/>
  <meta name="keywords" content=""/>
  <meta name="description" content=""/>

  <!--=============== Main CSS  ===============-->
  <link type="text/css" rel="stylesheet" href="<?= base_url();?>assets/back-end/css/app.min.css">
  <link type="text/css" rel="stylesheet" href="<?= base_url();?>assets/back-end/css/icons.min.css">
  <link type="text/css" rel="stylesheet" href="<?= base_url();?>assets/back-end/css/bootstrap.min.css">

  <!--=============== Library CSS  ===============-->
  <link type="text/css" rel="stylesheet" href="<?= base_url();?>assets/back-end/libs/toast/Notifier.min.css">
  <link type="text/css" rel="stylesheet" href="<?= base_url();?>assets/back-end/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
  <link type="text/css" rel="stylesheet" href="<?= base_url();?>assets/back-end/libs/sweetalert2/sweetalert2.min.css">
  <link type="text/css" rel="stylesheet" href="<?= base_url();?>assets/back-end/libs/owl.carousel/assets/owl.carousel.min.css">
  <link type="text/css" rel="stylesheet" href="<?= base_url();?>assets/back-end/libs/owl.carousel/assets/owl.theme.default.min.css">
  <link type="text/css" rel="stylesheet" href="<?= base_url();?>assets/back-end/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css">
  <link type="text/css" rel="stylesheet" href="<?= base_url();?>assets/back-end/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css">
  <link type="text/css" rel="stylesheet" href="<?= base_url();?>assets/back-end/libs/dropify/dropify.min.css">

  <!--=============== Favicons ===============-->
  <link rel="shortcut icon" href="<?= base_url();?>assets/favicon.ico">

</head>

<body>

    <!-- Loader -->
    <div id="preloader">
        <div id="status">
            <div class="spinner-chase">
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
                <div class="chase-dot"></div>
            </div>
        </div>
    </div>

    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mb-5">
                        <h1 class="display-2 font-weight-medium">4<i class="bx bx-buoy bx-spin text-primary display-3"></i>4</h1>
                        <h4 class="text-uppercase">Maaf, halaman yang anda minta tidak ditemukan.</h4>
                    </div>
                    <div class="mt-5 text-center">
                        <a class="btn btn-primary waves-effect waves-light" href="javascript:void(0)" onclick="history.back();">Kembali</a>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-8 col-xl-6">
                    <div>
                        <img src="<?= base_url('assets/login-page/img/error/error-img.png')?>" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>

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

    <!--=============== app js ===============-->
    <script type="text/javascript" src="<?= base_url();?>assets/back-end/js/app.js"></script>

</body>

</html>
