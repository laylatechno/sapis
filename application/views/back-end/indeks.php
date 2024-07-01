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
            <div class="col-8">
                <div class="text-center">
                    <h3 class="mb-4">Indeks / Kategori / Perihal Surat</h3>
                    <p class="text-muted">Mengindeks yaitu memberi kode atau kategori pada surat untuk kepentingan penyimpanan. Dalam hal ini, Pengelola / Operator harus dapat menentukan kategori surat tersebut dengan melihat pada <b>Perihal Surat</b> agar penentuan kategori tersebut tidak salah.</p>
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
                              <div class="text-primary p-3">
                                  <h5 class="text-primary">Indeks Surat</h5>
                                  <p class="text-justify">Sebagai Master Data & Penyaringan / Filter dalam pengelompokan Surat.</p>
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
                              <p class="text-muted text-justify font-size-12 mt-4 mb-0">Kegunaan indeks dalam dunia administrasi surat adalah untuk mengelompokkan atau menyatukan arsip / dokumen yang memiliki kode dan kegiatan yang sama kemudian disatukan ke dalam satu berkas dan juga sebagai media penemuan kembali dokumen. Hal ini berlaku sama seperti Indeks Surat pada umumnya, kami telah menyediakan contoh Indeks Surat yang bisa Anda download dibawah ini.</p>
                          </div>

                          <div class="col-sm-12 mt-4">
                            <div class="alert alert-warning mb-0 text-center" role="alert"><i class="mdi mdi-arrow-down-bold mr-2"></i>Download contoh <strong>indeks</strong> surat <a href="<?= base_url('downloads/file/indeks.docx')?>" target="_blank">disini</a> </div>
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
                    <button type="button" class="btn btn-rounded btn-primary waves-effect waves-light" onclick="method_add();"><i class="mdi mdi-plus mr-2"></i>Tambah indeks baru</button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="clearfix mb-4">
                    <h4 class="card-title mb-4">Data Indeks</h4>
                  </div>
                  <table id="tableon" class="table table-centered table-striped table-borderless dt-responsive nowrap mt-4" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead class="thead-navy">
                          <tr>
                              <th scope="col" class="text-center" width="5%">#</th>
                              <th scope="col" class="text-center" width="25%">Nama Indeks</th>
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

                          <input type="hidden" class="form-control" name="input-IndeksID" placeholder="" value="" readonly disabled>

                          <h4 class="card-title text-center mb-2">Informasi Dasar</h4>

                          <div class="form-group">
                            <label>Kode Indeks<code>*</code></label>
                            <input id="input-IndeksCode" type="text" class="form-control" name="input-IndeksCode" placeholder="Masukkan kode Indeks" value="" maxlength="7" data-provide="maxlength" required>
                            <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                          </div>

                          <div id="info-message" class="alert alert-info text-center mt-3" role="alert"><strong>Info!</strong> Kode Indeks bisa menggunakan Nomor, Inisial atau Singkatan.</div>
                          <div id="error-id-message" class="alert alert-danger text-center mt-2" role="alert"><strong>Oh snap!</strong> Kode Indeks tidak tersedia, silahkan gunakan yang lain.</div>

                          <div class="form-group">
                            <label>Nama Indeks<code>*</code></label>
                            <input type="text" class="form-control" name="input-IndeksName" placeholder="Masukkan nama indeks" value="" maxlength="100" data-provide="maxlength" required>
                            <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                          </div>

                          <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea id="input-IndeksDesc" class="form-control" name="input-IndeksDesc" maxlength="500" rows="5" data-provide="maxlength" placeholder="Tuliskan deskripsi..."></textarea>
                          </div>

                      </form>
                  </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal" aria-label="Close">Batal</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light submit-form mr-1">Tambah</button>
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

    <script src="<?= base_url();?>assets/back-end/js/pages/indeks.init.js"></script>
