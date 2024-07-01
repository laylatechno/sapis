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
                    <h4 class="mb-0 font-size-18">Registrasi</h4>

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
                    <h3 class="mb-4">Registrasi Surat Keluar</h3>
                    <p class="text-muted">Surat keluar juga wajib dilakukan registrasi. Registrasi surat dilakukan dengan sistem dalam melakukan kearsipan Surat dan tidak ada Disposisi. <br> Pengelola / Operator melakukan input informasi surat dan mengunggah file untuk melakukan Arsip saja.</p>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-lg-6 col-xl-12">
              <div class="card">
                <div class="card-header">
                  <div class="float-right">
                    <button type="button" class="btn btn-rounded btn-primary waves-effect waves-light submit-add"><i class="mdi mdi-plus mr-2"></i>Registrasi surat keluar</button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="clearfix mb-4">
                    <h4 class="card-title mb-4">Data Surat Keluar</h4>
                  </div>
                  <table id="tableon" class="table table-centered table-striped table-borderless dt-responsive nowrap mt-4" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                      <thead class="thead-navy">
                          <tr>
                              <th scope="col" class="text-center">#</th>
                              <th scope="col" class="text-center">Tujuan / No Surat</th>
                              <th scope="col" class="text-center">Tanggal Surat</th>
                              <th scope="col" class="text-center">Unit Pengirim</th>
                              <th scope="col" class="text-center">Indeks / Sifat</th>
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

    <!--  Modal content for the above example -->
      <div id="modal_form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 id="modal_title" class="modal-title mt-0">Title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form id="form" class="form-horizontal needs-validation my-2" method="post" novalidate>

                          <h5 class="text-center mb-4">Informasi Surat</h5>

                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-6">
                                <label>No Surat<code>*</code></label>
                                <input type="text" class="form-control" name="input-OutMailNumber" placeholder="Masukkan no surat" value="" maxlength="30" autocomplete="off" required>
                                <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                              </div>
                              <div class="col-md-6">
                                <label>Indeks<code>*</code></label>
                                <select name="input-IndeksID" class="form-control selectpicker" data-live-search="true" style="width: 100%;" required>
                                  <option value="">-- Pilih salah satu --</option>
                                  <?php $i = 1; ?>
                                  <?php foreach ($this->Outgoingmail_model->get_dataoptionindeks() as $di) : ?>
                                  <option data-subtext="<?= $di['IndeksCode'];?>" value="<?= $di['IndeksID'];?>"><?= $di['IndeksName'];?></option>
                                  <?php $i++ ?>
                                  <?php endforeach; ?>
                                </select>
                                <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-6">
                                <label>Tujuan Surat<code>*</code></label>
                                <input type="text" class="form-control" name="input-OutMailDestination" placeholder="Masukkan tujuan surat" value="" autocomplete="off" required>
                                <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                              </div>
                              <div class="col-md-6">
                                <label>Unit Pengirim<code>*</code></label>
                                <select name="input-WorkunitID" class="form-control selectpicker" data-live-search="true" style="width: 100%;" required>
                                  <option data-divider="true" value="">-- Pilih salah satu --</option>
                                  <?php $i = 1; ?>
                                  <?php foreach ($this->Outgoingmail_model->get_dataoptionworkunit() as $di) : ?>
                                  <option data-subtext="<?= $di['WorkunitCode'];?>" value="<?= $di['WorkunitID'];?>"><?= $di['WorkunitName'];?></option>
                                  <?php $i++ ?>
                                  <?php endforeach; ?>
                                </select>
                                <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                              </div>
                            </div>
                          </div>

                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-6">
                                <label>Sifat<code>*</code></label>
                                <select name="input-OutMailTrait" class="form-control" required>
                                  <option value="">-- Pilih salah satu --</option>
                                  <option value="Biasa">Biasa</option>
                                  <option value="Penting">Penting</option>
                                  <option value="Rahasia">Rahasia</option>
                                </select>
                                <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                              </div>
                              <div class="col-md-6">
                                <label>Tanggal Surat<code>*</code></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="input-OutMailDate" placeholder="mm/dd/yyyy" data-provide="datepicker" value="" data-autoclose="true" required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar-month-outline"></i></span>
                                    </div>
                                </div>
                                <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                              </div>
                            </div>
                          </div>

                          <h5 class="text-center mt-4 mb-4">Ringkasan Surat</h5>

                          <div class="form-group">
                            <label>Isi Surat</label>
                            <textarea id="input-OutMailContent" class="form-control" name="input-OutMailContent" maxlength="500" data-provide="maxlength" rows="5" placeholder="Tuliskan ringkasan isi surat..."></textarea>
                          </div>

                      </form>
                  </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal" aria-label="Close">Batal</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light submit-button mr-1" onclick="action_method()">Simpan</button>
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
    <script src="<?= base_url();?>assets/back-end/js/pages/register/outgoing-mail.init.js"></script>
