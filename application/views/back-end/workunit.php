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
                    <h4 class="mb-0 font-size-18"><?= ucwords($this->uri->segment(1));?></h4>

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
                    <h3 class="mb-4">Klasifikasi Satuan Kerja</h3>
                    <p class="text-muted">Klasifikasi Satuan Kerja merupakan penyusunan bersistem dalam kelompok atau golongan menurut kaidah atau standar yang ditetapkan <br> yang bertujuan untuk pengelompokan struktur Jabatan / Divisi / Bagian pada Instansi.</p>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-lg-6 col-xl-3">
              <div class="card overflow-hidden">
                  <div class="bg-soft-primary">
                      <div class="row">
                          <div class="col-7">
                              <div class="text-primary p-2">
                                  <h5 class="text-primary">Satuan Kerja</h5>
                                  <p class="text-justify">Sebagai Master Data & Penyaringan / Filter dalam pengelompokan Satuan Kerja</p>
                              </div>
                          </div>
                          <div class="col-5 align-self-end">
                              <img src="<?= base_url('assets/back-end/img/module/indeks-img.png');?>" alt="" class="img-fluid">
                          </div>
                      </div>
                  </div>
                  <div class="card-body pt-0">
                      <div class="row">
                          <div class="col-sm-12">
                              <p class="text-muted text-justify font-size-12 mt-4 mb-0">Klasifikasi Satuan Kerja merupakan tulang punggung program kepegawaian. Bilamana suatu regu digolongkan, maka hal ini berarti bahwa regu itu ditempatkan dalam kategori-kategori atau kelas-kelas yang berbeda. Hal ini berguna dapam pengelompokan satuan kerja pada setiap Pengguna, Anda dapat menyesuaikannya dengan Struktur Instansi Anda.</p>
                          </div>
                      </div>
                  </div>
              </div>
            </div>
            <!-- end col -->

            <div class="col-lg-6 col-xl-9">
              <div class="card">
                <div class="card-header">
                  <div class="float-right">
                    <button type="button" class="btn btn-rounded btn-primary waves-effect waves-light submit-add"><i class="mdi mdi-plus mr-2"></i>Tambah satuan kerja</button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="clearfix mb-4">
                    <h4 class="card-title mb-4">Data Klasifikasi Satuan Kerja</h4>
                  </div>
                  <table id="tableon" class="table table-centered table-striped table-borderless dt-responsive nowrap mt-4" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead class="thead-navy">
                          <tr>
                              <th scope="col" class="text-center" width="5%">#</th>
                              <th scope="col" class="text-center" width="25%">Nama Klasifikasi</th>
                              <th scope="col" class="text-center" width="10%">Kode</th>
                              <th scope="col" class="text-center">Deskripsi</th>
                              <th scope="col" class="text-center" width="10%">Aksi</th>
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

    <!--  Modal content for the above example -->
      <div id="modal_form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
              <div class="modal-content">

                  <div class="modal-header">
                      <h5 id="modal_title" class="modal-title mt-0">Title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>

                  <div class="modal-body">
                      <form id="form" class="form-horizontal needs-validation my-2" method="post" novalidate>

                          <h4 class="card-title text-center mb-4">Informasi Dasar</h4>

                          <div class="form-group">
                            <label>Kode Satuan Kerja<code>*</code></label>
                            <input type="text" name="input-WorkunitCode" class="form-control" placeholder="Masukkan kode satuan kerja" value="" maxlength="7" data-provide="maxlength" autocomplete="off" required>
                            <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                            <div id="info-message" class="alert alert-info text-center mt-3" role="alert"><strong>Info!</strong> Kode Satuan Kerja bisa menggunakan Nomor, Inisial atau Singkatan.</div>
                            <div id="error-id-message" class="alert alert-danger text-center mt-2" role="alert"><strong>Oh snap!</strong> Kode Satuan Kerja tidak tersedia, silahkan gunakan yang lain.</div>
                          </div>

                          <div class="form-group">
                            <label>Nama Satuan Kerja<code>*</code></label>
                            <input type="text" name="input-WorkunitName" class="form-control" placeholder="Masukkan nama satuan kerja" value="" maxlength="100" data-provide="maxlength" autocomplete="off" required>
                            <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                          </div>

                          <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea id="input-WorkunitDesc" name="input-WorkunitDesc" class="form-control" maxlength="500" rows="5" data-provide="maxlength" placeholder="Tuliskan deskripsi..."></textarea>
                          </div>

                      </form>
                  </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal" aria-label="Close">Batal</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light submit-form mr-1">Simpan</button>
                  </div>
              </div>
    					<!-- /.modal-content -->
          </div>
    			<!-- /.modal-dialog -->
      </div>
    	<!-- /.modal -->

    <!-- ============================================================== -->
    <!-- Script Here -->
    <!-- ============================================================== -->

    <!-- scripts js -->
    <script src="<?= base_url();?>assets/back-end/js/pages/workunit.init.js"></script>
