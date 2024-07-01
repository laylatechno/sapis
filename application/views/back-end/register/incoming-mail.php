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
            <div class="col-8">
                <div class="text-center">
                    <h3 class="mb-4">Registrasi Surat Masuk</h3>
                    <p class="text-muted">Surat masuk wajib dilakukan registrasi. Registrasi surat dilakukan dengan sistem dalam melakukan kearsipan Surat. Pengelola / Operator melakukan input dan penerusan ke <b>Pimpinan</b> agar dapat menindaklanjutkan Surat tersebut.</p>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
            <div class="col-lg-6 col-xl-12">
              <div class="card">
                <div class="card-header">
                  <div class="float-right">
                    <button type="button" class="btn btn-rounded btn-primary waves-effect waves-light submit-add"><i class="mdi mdi-plus mr-2"></i>Registrasi surat masuk</button>
                  </div>
                </div>
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
                                <input type="text" class="form-control" name="input-InMailNumber" placeholder="Masukkan no surat" value="" maxlength="30" data-provide="maxlength" autocomplete="off" required>
                                <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                              </div>
                              <div class="col-md-6">
                                <label>Indeks<code>*</code></label>
                                <select name="input-IndeksID" class="form-control selectpicker" data-live-search="true" style="width: 100%;" required>
                                  <option data-divider="true" value="">-- Pilih salah satu --</option>
                                  <?php $i = 1; ?>
                                  <?php foreach ($this->Incomingmail_model->get_dataoptionindeks() as $di) : ?>
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
                                <label>Asal Surat<code>*</code></label>
                                <input type="text" class="form-control" name="input-InMailOrigin" placeholder="Masukkan asal surat" maxlength="100" value="" data-provide="maxlength" autocomplete="off" required>
                                <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                              </div>
                              <div class="col-md-6">
                                <label>Unit Penerima<code>*</code></label>
                                <select name="input-WorkunitID" class="form-control selectpicker" data-live-search="true" style="width: 100%;" required>
                                  <option data-divider="true" value="">-- Pilih salah satu --</option>
                                  <?php $i = 1; ?>
                                  <?php foreach ($this->Incomingmail_model->get_dataoptionworkunit() as $di) : ?>
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
                                <select name="input-InMailTrait" class="form-control" required>
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
                                    <input type="text" name="input-InMailDate" class="form-control" placeholder="mm/dd/yyyy" data-provide="datepicker" data-date-autoclose="true" readonly required>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="mdi mdi-calendar-month-outline"></i></span>
                                    </div>
                                </div>
                                <div class="invalid-feedback">Bagian ini tidak boleh kosong !</div>
                              </div>
                            </div>
                          </div>

                          <h5 class="text-center mt-4 mb-4">Ringkasan Surat</h5>

                          <div class="form-group">
                            <label>Isi Surat</label>
                            <textarea id="input-InMailContent" class="form-control" name="input-InMailContent" maxlength="500" data-provide="maxlength" rows="5" placeholder="Tuliskan ringkasan isi surat..."></textarea>
                          </div>

                      </form>
                  </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal" aria-label="Close">Batal</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light submit-button mr-1" onclick="action_method()"></button>
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

    <script src="<?= base_url();?>assets/back-end/js/pages/register/incoming-mail.init.js"></script>
