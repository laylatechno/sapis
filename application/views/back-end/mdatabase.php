<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
      <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Backup Database</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><?= $this->session->userdata('RoleName');?> / <?= ucwords($this->uri->segment(1));?></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center mb-2">
            <div class="col-10">
                <div class="text-center">
                    <h3 class="mb-4">Backup Database</h3>
                    <p class="text-muted">Pada halaman ini anda dapat membackup database aplikasi. <br> Lakukan hal ini secara rutin agar dapat meminimalisir / mencegah kehilangan data.</p>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">

            <div class="col-lg-6 col-md-12">
                <div class="demo-box">
                    <img src="<?= base_url('assets/back-end/img/module/mdb-export.jpg')?>" alt="demo-img" class="img-responsive">
                    <div class="demo-overlay">
                        <div class="demo-btn">
                            <a href="javascript:void(0)" class="btn btn-danger" onclick="database_backup();">Download SQL File</a>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <h4 class="demo-box-title">Backup <span class="sub-title">(Database)</span></h4>
                </div>
            </div>

        </div>


      </div>
      <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <!-- ============================================================== -->
    <!-- Script Here -->
    <!-- ============================================================== -->

    <!-- scripts js -->
    <script src="<?= base_url();?>assets/back-end/js/pages/mdatabase.init.js"></script>
