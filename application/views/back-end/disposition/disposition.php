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
                    <h4 class="mb-0 font-size-18">Disposisi</h4>

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
                    <h3 class="mb-4">Disposisi Surat Masuk</h3>
                    <p class="text-muted">Disposisi Surat adalah catatan berupa tanggapan, saran, atau instruksi setelah surat tersebut dibaca oleh pimpinan. <br> Lakukan tindak lanjut dari penyelesaian surat apakah akan diteruskan ke <strong>Pengguna</strong> yang lain atau tidak.</p>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row">
            <div class="col-xl-4">
                <div class="card bg-soft-primary">
                    <div>
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-3">
                                    <h5 class="text-primary">Pendisposisian Surat Masuk</h5>
                                    <p class="text-justify"><strong>Pengguna</strong> yang terdisposisi akan menerima notifikasi dan dapat melihat Surat tersebut sebagai tindak lanjut dari <b>Pimpinan</b>.</p>
                                </div>
                            </div>
                            <div class="col-5 align-self-end">
                                <img src="<?= base_url('assets/back-end/img/module/disposition-img.png')?>" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                            <i class="bx bx-mail-send"></i>
                                        </span>
                                    </div>
                                    <h5 class="font-size-14 mb-0">Surat Masuk</h5>
                                </div>
                                <div class="text-muted mt-4">
                                    <h4 name="view-TotalInMail"><?= $this->db->get('inmail')->num_rows();?> Surat</h4>
                                    <div class="d-flex">
                                        <span class="text-truncate">Yang terhitung dari Database</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                            <i class="bx bx-error"></i>
                                        </span>
                                    </div>
                                    <h5 class="font-size-14 mb-0">Perlu Tindakan</h5>
                                </div>
                                <div class="text-muted mt-4">
                                    <h4><?= $this->db->get_where('inmail', ['InMailStatus' => 1])->num_rows();?> Surat</h4>
                                    <div class="d-flex">
                                        <span class="text-truncate">Yang terhitung dari Database</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="avatar-xs mr-3">
                                        <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                            <i class="bx bx-check"></i>
                                        </span>
                                    </div>
                                    <h5 class="font-size-14 mb-0">Sudah di Disposisikan</h5>
                                </div>
                                <div class="text-muted mt-4">
                                    <h4><?= $this->db->get_where('inmail', ['InMailStatus' => 2])->num_rows();?> Surat</h4>

                                    <div class="d-flex">
                                        <span class="text-truncate">Yang terhitung dari Database</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-6 col-xl-12">
              <div class="card">
                <div class="card-body">
                  <div class="clearfix mb-4">
                    <h4 class="card-title mb-4">Data Surat Masuk</h4>
                  </div>
                  <table id="tableon" class="table table-centered table-striped table-borderless dt-responsive nowrap mt-4" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead class="thead-navy">
                          <tr>
                              <th scope="col" class="text-center">#</th>
                              <th scope="col" class="text-center">Asal / No Surat</th>
                              <th scope="col" class="text-center">Tanggal Surat</th>
                              <th scope="col" class="text-center">Unit Penerima</th>
                              <th scope="col" class="text-center">Indeks / Sifat</th>
                              <th scope="col" class="text-center">Status</th>
                              <th scope="col" class="text-center">Didaftarkan oleh</th>
                              <th scope="col" class="text-center" width="5%">Aksi</th>
                          </tr>
                      </thead>
                  </table>
                </div>
              </div>
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->

      </div>
      <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <!-- ============================================================== -->
    <!-- Script Here -->
    <!-- ============================================================== -->

    <!-- scripts js -->
    <script src="<?= base_url();?>assets/back-end/js/pages/disposition/disposition.init.js"></script>
