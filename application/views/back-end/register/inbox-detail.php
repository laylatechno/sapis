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
                    <h4 class="mb-0 font-size-18">Pengelolaan Surat Masuk</h4>

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
                        <p name="view-InMailTrait" class="text-muted"></p>
                      </div>

                      <div class="media">
                          <img src="<?= base_url('assets/back-end/img/module/inbox-detail-default.png')?>" alt="" class="avatar-sm mr-4">

                          <div class="media-body overflow-hidden">
                              <h5 name="view-InMailOrigin" class="text-truncate font-size-18"></h5>
                              <p name="view-InMailNumber" class="text-muted"></p>
                          </div>
                      </div>

                      <h5 class="font-size-15 mt-4">Isi Ringkas Surat :</h5>

                      <p name="view-InMailContent" class="text-muted text-justify"></p>

                      <div class="row task-dates">

                          <div class="col-sm-4 col-4">
                              <div class="text-center mt-4">
                                  <h5 class="font-size-14 mb-4"><i class="bx bx-calendar mr-1 text-primary"></i> Tanggal Surat</h5>
                                  <p name="view-InMailDate" class="text-muted mb-0"></p>
                              </div>
                          </div>

                          <div class="col-sm-4 col-4">
                              <div class="text-center mt-4">
                                  <h5 class="font-size-14 mb-4"><i class="bx bx-briefcase mr-1 text-primary"></i> Unit Penerima</h5>
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
                      <!-- end row -->

                  </div>
              </div>
          </div>
          <!-- end col -->

          <div class="col-lg-6 col-xl-4">
              <div class="card">
                  <div class="card-body">
                      <h4 class="card-title mb-4">Disposisi (<span name="view-TotalDisposition"></span>)</h4>

                      <div class="table-responsive" data-simplebar style="max-height: 300px;">
                          <table class="table table-centered table-nowrap table-hover">
                              <tbody class="show-disposition">

                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
          <div class="col-lg-6 col-xl-4">
              <div class="card">
                  <div class="card-body">
                    <div class="float-right">
                      <button type="button" class="btn btn-sm btn-rounded btn-info waves-effect waves-light" onclick="method_addattachment();"><i class="mdi mdi-upload mr-2"></i>Unggah Lampiran</button>
                    </div>
                    <h4 class="card-title mb-4">Lampiran Surat</h4>
                    <div class="table-responsive" data-simplebar style="max-height: 500px;">
                        <table class="table table-nowrap table-centered table-hover mb-0">
                            <tbody class="show-attachment">

                            </tbody>
                        </table>
                    </div>
                  </div>
              </div>
          </div>
          <!-- end col -->

          <div class="col-lg-6 col-xl-8">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title mb-4">Kotak Komentar</h4>
                <div class="w-100 user-chat">
                    <!-- <div class="card"> -->
                        <div class="chat-conversation p-3">
                            <ul class="list-unstyled" data-simplebar style="max-height: 500px; height: 500px">
                              <div class="show-commentar"></div>
                            </ul>
                        </div>

                        <div class="p-3 chat-input-section">
                            <div class="row">
                              <div class="col-lg-12">
                                <form id="form-commentar" class="form-horizontal needs-validation my-2" action="javascript:void(0)" method="post" novalidate>

                                  <div class="form-group">
                                    <textarea id="input-CommentarDesc" name="input-CommentarDesc" class="form-control chat-input" maxlength="500" rows="5" data-provide="maxlength" placeholder="Tuliskan komentar anda..." required></textarea>
                                    <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                                  </div>

                                  <div class="float-right">
                                    <button type="button" class="btn btn-info waves-effect waves-light submit-commentar mr-1">Kirim <i class="bx bx-send font-size-16 align-middle ml-2"></i></button>
                                  </div>

                                </form>
                              </div>
                            </div>
                            <!-- end row -->
                        </div>
                    <!-- </div> -->
                </div>
                <!-- end comment -->
              </div>
              <!-- end card body -->
            </div>
            <!-- end card -->
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

    <!--  Modal content for the above example -->
    <div id="modal_user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="modal_title_user" class="modal-title-user mt-0">Title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="bg-soft-primary">
                      <div class="row">
                        <div class="col-12">
                            <img src="" alt="" class="img-fluid user-cover">
                        </div>
                      </div>
                    </div>
                    <div class="card-body pt-0">
                      <div class="row">
                        <div class="col-12">
                          <div class="avatar-xl mx-auto mb-1" style="margin-left:auto; margin-right:auto; margin-top: -30px;">
                            <img src="" alt="" class="img-thumbnail user-profile">
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12">
                        <h3 class="text-center user-fullname mb-1"></h3>
                        <p class="text-muted text-center user-workunit"></p>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12">
                        <h4 class="card-title text-center mb-2 mt-4">Informasi Dasar</h4>
                        <table class="table mb-0" style="table-layout: fixed; width: 100%">
                          <tbody>
                            <tr>
                              <th scope="row" width="30%">Tempat/Tanggal Lahir</th>
                              <td class="user-birthday"></td>
                            </tr>
                            <tr>
                              <th scope="row" width="30%">Alamat</th>
                              <td class="text-justify user-address" style="word-wrap: break-word"></td>
                            </tr>
                            <tr>
                              <th scope="row" width="30%">Jenis Kelamin</th>
                              <td class="user-gender"></td>
                            </tr>
                            <tr>
                              <th scope="row" width="30%">Agama</th>
                              <td class="user-religion"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-lg-12">
                        <h4 class="card-title text-center mb-2 mt-4">Informasi Kontak</h4>
                        <table class="table mb-0" style="table-layout: fixed; width: 100%">
                          <tbody>
                            <tr>
                              <th scope="row" width="30%">Email</th>
                              <td class="user-email"></td>
                            </tr>
                            <tr>
                              <th scope="row" width="30%">No. Telepon</th>
                              <td class="user-phone"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>

                </div>
                <div class="modal-footer">
                  <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal" aria-label="Close">Tutup</button>
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

  <script src="<?= base_url();?>assets/back-end/js/pages/register/inbox-detail.init.js"></script>
