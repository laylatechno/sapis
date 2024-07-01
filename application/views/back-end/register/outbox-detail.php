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
                    <h4 class="mb-0 font-size-18">Pengelolaan Surat Keluar</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><?= $this->session->userdata('RoleName');?> / <?= ucwords($this->uri->segment(1));?> / <?= ucwords($this->uri->segment(2));?></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center mb-4">
          <div class="col-md-4">
            <button type="button" class="btn btn-sm btn-block btn-danger waves-effect waves-light" onclick="history.back();"><i class="mdi mdi-arrow-left mr-2"></i>Kembali</button>
          </div>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-6 col-xl-8">
              <div class="card">
                  <div class="card-body">
                      <div class="float-right">
                        <p name="view-OutMailTrait" class="text-muted"></p>
                      </div>

                      <div class="media">
                          <img src="<?= base_url('assets/back-end/img/module/inbox-detail-default.png')?>" alt="" class="avatar-sm mr-4">

                          <div class="media-body overflow-hidden">
                              <h5 name="view-OutMailDestination" class="text-truncate font-size-15"></h5>
                              <p name="view-OutMailNumber" class="text-muted"></p>
                          </div>
                      </div>

                      <h5 class="font-size-15 mt-4">Isi Ringkas Surat :</h5>

                      <p name="view-OutMailContent" class="text-muted text-justify"></p>

                      <div class="row task-dates">

                        <div class="col-sm-4 col-4">
                            <div class="text-center mt-4">
                                <h5 class="font-size-14 mb-4"><i class="bx bx-calendar mr-1 text-primary"></i> Tanggal Surat</h5>
                                <p name="view-OutMailDate" class="text-muted mb-0"></p>
                            </div>
                        </div>

                        <div class="col-sm-4 col-4">
                            <div class="text-center mt-4">
                                <h5 class="font-size-14 mb-4"><i class="bx bx-briefcase mr-1 text-primary"></i> Unit Pengirim</h5>
                                <h5 name="view-WorkunitName" class="text-muted font-size-15 mb-0"></h5>
                            </div>
                        </div>

                        <div class="col-sm-4 col-4">
                            <div class="text-center mt-4">
                                <h5 class="font-size-14 mb-2"><i class="bx bx-check-square mr-1 text-primary"></i> Didaftarkan oleh</h5>
                                <div class="media text-left mb-4">
                                    <div class="mr-3">
                                        <img id="view-register-AccountProfile" src="" class="media-object rounded-circle avatar-sm" alt="" onerror="this.src = '<?= base_url('uploads/account/default/picprofile.jpg');?>'">
                                    </div>
                                    <div class="media-body">
                                        <h5 name="view-register-FullName" class="font-size-13 mb-1"></h5>
                                        <p name="view-register-WorkunitName" class="text-muted mb-0"></p>
                                    </div>
                                </div>
                            </div>
                        </div>

                      </div>

                  </div>
              </div>
          </div>
          <!-- end col -->

          <div class="col-lg-6 col-xl-4">
              <div class="card">
                  <div class="card-body">
                    <div class="float-right">
                      <button type="button" class="btn btn-sm btn-rounded btn-info waves-effect waves-light" onclick="method_addattachment();"><i class="mdi mdi-upload mr-2"></i>Unggah Lampiran</button>
                    </div>
                    <h4 class="card-title mb-4">Lampiran Surat</h4>
                    <div class="table-responsive">
                        <table class="table table-nowrap table-centered table-hover mb-0">
                            <tbody class="show-attachment">

                            </tbody>
                        </table>
                    </div>
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
    <div id="modal_form_attachment" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modal_title_attachment" class="modal-title-attachment mt-0">Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-attachment" class="form-horizontal needs-validation my-2" method="post" enctype="multipart/form-data" novalidate>

                        <h5 class="text-center mb-4">Informasi Lampiran</h5>

                        <div class="form-group">
                          <label>Nama Lampiran<code>*</code></label>
                          <input type="text" class="form-control" name="input-AttachmentName" placeholder="Masukkan nama lampiran" value="" maxlength="30" data-provide="maxlength" required>
                          <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                          <div id="error-filename-message" class="alert alert-danger text-center mt-2" role="alert"><strong>Oh snap!</strong> Nama Lampiran tidak boleh sama.</div>
                        </div>

                        <div class="form-group">
                          <label>Unggah file disini <code>(Max. 5Mb)</code> </label>
                          <input id="file-input-Attachment" type="file" name="file-input-Attachment" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" class="dropify" data-max-file-size="5M" data-show-errors="true" data-allowed-file-extensions="pdf doc docx jpg jpeg png" required>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                  <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal" aria-label="Close">Batal</button>
                  <button type="submit" class="btn btn-success waves-effect waves-light submit-attachment mr-1">Upload</button>
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

  <script src="<?= base_url();?>assets/back-end/js/pages/register/outbox-detail.init.js"></script>
