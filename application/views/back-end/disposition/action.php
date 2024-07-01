<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
      <div class="container-fluid">

        <!-- start page title -->
        <div class="row d-print-none">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0 font-size-18">Disposisi Surat Masuk</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><?= $this->session->userdata('RoleName');?> / <?= ucwords($this->uri->segment(1));?> / <?= ucwords($this->uri->segment(2));?></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row justify-content-center mb-4 d-print-none">
          <div class="col-md-4">
            <button type="button" class="btn btn-sm btn-block btn-danger waves-effect waves-light" onclick="history.back();"><i class="mdi mdi-arrow-left mr-2"></i>Kembali</button>
          </div>
        </div>

        <div class="row justify-content-center d-print-none">
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
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
          <div class="col-lg-12 col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-sm-left">
                          <div class="logo-box">
                              <span class="logo-lg"><img src="<?= base_url('uploads/app/logo/'.$this->db->get_where('appsetting', ['AppID' => '1'])->row()->AppLargeLogoBlack);?>" height="70"></span>
                          </div>
                        </div>
                        <div class="float-sm-right mt-4 mt-sm-0">
                            <h5>Disposisi #Surat Masuk<br>
                                <small>
                                  <span class="text-truncate font-size-20"> <strong name="view-InMailOrigin"></strong> </span> <br>
                                  <span name="view-InMailNumber"></span> <br>
                                  <span name="get-InboxTanggalAwal"><strong>Total Disposisi: </strong> <span name="count-disposisi"></span> </span>
                                </small>
                            </h5>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="float-sm-left mt-4">
                                <h5><strong><?= $companydata['CompanyName'];?></strong></h5>
                                <address>
                                    <?= $companydata['CompanyAddress']?>, Kel. <?= $companydata['CompanyVillage']?>, Kec. <?= $companydata['CompanySubDistrict']?><br>
                                    <?= $companydata['CompanyDistrict']?>, <?= $companydata['CompanyState']?>, <?= $companydata['CompanyZIPCode']?>.<br>
                                    Telp. <?= $companydata['CompanyPhone']?> | Email : <?= $companydata['CompanyEmail'];?>
                                </address>
                            </div>
                            <div class="mt-4 text-sm-right">
                                <p class="mb-0">Unit Penerima:</p>
                                <h5><strong name="view-WorkunitName"></strong></h5>
                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-nowrap">
                                    <thead>
                                      <th scope="col" class="text-center" width="5%">#</th>
                                      <th scope="col" class="text-center" width="25%">Nama Pengguna</th>
                                      <th scope="col" class="text-center">Catatan</th>
                                      <th scope="col" class="text-center" width="10%">Batas Waktu</th>
                                      <th scope="col" class="text-center d-print-none" width="10%">Aksi</th>
                                    </thead>
                                    <tbody class="show-list">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-8">
                            <div class="clearfix mt-5"></div>
                        </div>
                        <div class="col-sm-4">
                            <div class="text-center mt-4">
                                <p><?= format_shortdateindo(date('Y-m-d'));?></p>
                                <p style="margin-top: 2rem!important; margin-bottom: 2rem!important;">ttd</p>
                                <h5><?= $this->session->userdata('FullName')?></h5>
                                <hr style="margin-top: 0.1rem!important; margin-bottom: 0.2rem!important;">
                                <p><?= $this->db->where('Username', $this->session->userdata('Username'))->join('workunit', 'workunit.WorkunitID = accountinfo.WorkunitID')->get('accountinfo')->row()->WorkunitName;?></p>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="d-print-none">
                        <div class="float-right">
                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i class="fa fa-print"></i></a>
                            <a href="javascript:void(0)" class="btn btn-info waves-effect waves-light" onclick="method_add()"><i class="fa fa-plus mr-2"></i> Tambah Disposisi</a>
                        </div>
                        <div class="clearfix"></div>
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
      <div id="modal_form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 class="mt-0">Tambah Disposisi</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form id="form" class="form-horizontal needs-validation my-2" method="post" novalidate>

                        <h5 class="text-center">Informasi Kontak</h5>

                        <div class="form-group">
                          <label>Pengguna<code>*</code></label>
                          <select id="input-Username" name="input-Username" class="form-control selectpicker" data-live-search="true" style="width: 100%;" required>
                            <option value="">-- Pilih salah satu --</option>
                            <?php $i = 1; ?>
                            <?php foreach ($this->Disposition_model->get_dataoptionuser() as $du) : ?>
                            <option data-subtext="<?= $du['WorkunitName'];?>" value="<?= $du['Username'];?>"><?= $du['FullName'];?></option>
                            <?php $i++ ?>
                            <?php endforeach; ?>
                          </select>
                          <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                        </div>

                        <h5 class="text-center">Informasi Disposisi</h5>

                        <div class="form-group">
                          <label>Batas Waktu<code>*</code></label>
                          <div class="input-group">
                              <input type="text" class="form-control" name="input-DispositionDeadline" placeholder="mm/dd/yyyy" data-provide="datepicker" value="" data-autoclose="true" required>
                              <div class="input-group-append">
                                  <span class="input-group-text"><i class="mdi mdi-calendar-month-outline"></i></span>
                              </div>
                          </div>
                          <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                        </div>

                        <div class="form-group">
                          <label>Catatan</label>
                          <textarea id="input-DispositionNote" class="form-control" name="input-DispositionNote" maxlength="500" data-provide="maxlength" rows="5" placeholder="Tuliskan catatan anda..."></textarea>
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

  <script src="<?= base_url();?>assets/back-end/js/pages/disposition/action.init.js"></script>
