<!DOCTYPE HTML>
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

  <!--=============== Datatable CSS  ===============-->
  <link type="text/css" rel="stylesheet" href="<?= base_url();?>assets/back-end/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
  <link type="text/css" rel="stylesheet" href="<?= base_url();?>assets/back-end/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css">
  <link type="text/css" rel="stylesheet" href="<?= base_url();?>assets/back-end/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">

  <!--=============== Favicons ===============-->
  <link rel="shortcut icon" href="<?= base_url();?>assets/favicon.ico">

  <!--=============== Started JS ===============-->
  <script src="<?= base_url();?>assets/back-end/libs/jquery-2.1.1/jquery-2.1.1.min.js"></script>
  <script src="<?= base_url();?>assets/back-end/libs/toast/Notifier.min.js"></script>

  <!--=============== Global Variable ===============-->
  <script type="text/javascript">
    var baseURL = "<?php echo base_url();?>";
    var userid = "<?php echo $this->session->userdata('Username');?>";
    var roleid = "<?php echo $this->session->userdata('RoleID');?>";
    var id = "<?php echo $this->uri->segment(3);?>";
    var countnotif = "<?php echo $this->session->userdata('CountNotif');?>";
    var countdispo = "<?php echo $this->session->userdata('CountDispo');?>";
  </script>

</head>

<body data-sidebar="dark">

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

    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="navbar-header">
                <div class="d-flex">
                    <!-- LOGO -->
                    <div class="navbar-brand-box">
                        <a href="javascript:void(0)" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="<?= base_url('uploads/app/logo/'.$this->db->get_where('appsetting', ['AppID' => '1'])->row()->AppSmallLogoWhite);?>" alt="" height="40">
                            </span>
                            <span class="logo-lg">
                                <img src="<?= base_url('uploads/app/logo/'.$this->db->get_where('appsetting', ['AppID' => '1'])->row()->AppLargeLogoWhite);?>" alt="" height="50">
                            </span>
                        </a>
                    </div>

                    <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                        <i class="fas fa-bars"></i>
                    </button>

                    <?php if($this->uri->segment(1) == 'inbox' && !$this->uri->segment(2)) : ?>
                    <?php echo '<form class="app-search d-none d-lg-block">
                                <div class="position-relative">
                                <input type="text" class="form-control" id="input-global-search" name="input-global-search" placeholder="Search '.$this->uri->segment(1).'..." oninput="SearchFunction(this);return false;">
                                <span class="bx bx-search-alt"></span>
                                </div>
                                </form>' ?>
                    <?php endif; ?>

                </div>

                <div class="d-flex">

                    <?php if($this->uri->segment(1) == 'inbox' && !$this->uri->segment(2)) : ?>
                    <?php echo '<div class="dropdown d-inline-block d-lg-none ml-2">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-magnify"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-search-dropdown">
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="input-global-msearch" placeholder="Search '.$this->uri->segment(1).'..." oninput="MSearchFunction(this)" aria-label="search">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>' ?>
                    <?php endif; ?>

                    <div class="dropdown d-none d-lg-inline-block ml-1">
                        <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                            <i class="bx bx-fullscreen"></i>
                        </button>
                    </div>

                    <?php if ($this->session->userdata('RoleID') >= 3): ?>
                      <div class="dropdown d-inline-block">
                          <button id="page-header-notifications-dropdown2" type="button" class="btn header-item noti-icon waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i id="dispo-icon" class="bx bx-bell"></i>
                            <span class="badge badge-danger badge-pill dispo-num"></span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                              aria-labelledby="page-header-notifications-dropdown">
                              <div class="p-3">
                                  <div class="row align-items-center">
                                      <div class="col">
                                          <h6 class="m-0"> Perlu Tindakan (<span class="text-muted dispo-count"></span>) </h6>
                                      </div>
                                  </div>
                              </div>
                              <div data-simplebar style="max-height: 230px;">
                                <div class="dispo-message">

                                </div>
                              </div>
                              <div class="p-2 border-top">
                                  <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="<?= base_url('disposition')?>">
                                      <i class="mdi mdi-arrow-right-circle mr-1"></i> Lihat lebih banyak..
                                  </a>
                              </div>
                          </div>
                      </div>
                    <?php else: ?>

                    <?php endif; ?>

                    <div class="dropdown d-inline-block">
                        <button id="page-header-notifications-dropdown" type="button" class="btn header-item noti-icon waves-effect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i id="notif-icon" class="bx bx-envelope"></i>
                          <span class="badge badge-danger badge-pill notif-num"></span>
                        </button>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0" aria-labelledby="page-header-notifications-dropdown">
                            <div class="p-3">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h6 class="m-0"> Kotak Masuk (<span class="text-muted notif-count"></span>) </h6>
                                    </div>
                                </div>
                            </div>
                            <div data-simplebar style="max-height: 230px;">
                              <div class="notif-message">

                              </div>
                            </div>
                            <div class="p-2 border-top">
                                <a class="btn btn-sm btn-link font-size-14 btn-block text-center" href="<?= base_url('inbox')?>">
                                    <i class="mdi mdi-arrow-right-circle mr-1"></i> Lihat lebih banyak..
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="dropdown d-inline-block">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            $imgprofile = $this->db->get_where('accountuser', ['Username' => $this->session->userdata('Username')])->row()->AccountProfile;
                            if (!$imgprofile) {
                              echo '<img src="'.base_url('uploads/account/default/picprofile.jpg').'" class="rounded-circle header-profile-user" alt="Header Avatar">';
                            } else {
                              echo '<img src="'.base_url('uploads/account/'.$this->session->userdata('Username').'/'.$userdata['AccountProfile']).'" class="rounded-circle header-profile-user" alt="Header Avatar">';
                            }
                            ?>
                            <span class="d-none d-xl-inline-block ml-1"><?= $this->session->userdata('Username');?></span>
                            <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">
                            <!-- item-->
                            <a class="dropdown-item" href="<?= base_url('profile')?>"><i class="bx bx-user font-size-16 align-middle mr-1"></i> Profil Pengguna</a>
                            <div class="dropdown-divider"></div>
                            <a class="btn-logout dropdown-item text-danger" href="javascript:void(0);"><i class="bx bx-power-off font-size-16 align-middle mr-1 text-danger"></i> Keluar</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
