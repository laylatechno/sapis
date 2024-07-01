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
                    <h4 class="mb-0 font-size-18">Laporan Surat Keluar</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><?= $this->session->userdata('RoleName');?> / <?= ucwords($this->uri->segment(1));?></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row d-print-none">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4 mr-3">
                            <img class="rounded-circle avatar-sm" alt="" src="<?= base_url('uploads/app/logo/'.$this->db->get_where('appsetting', ['AppID' => '1'])->row()->AppSmallLogoBlack)?>">
                        </div>

                        <h5><?= $companydata['CompanyName']?></h5>
                        <p class="text-muted mb-1"><?= $companydata['CompanyEmail']?></p>
                    </div>

                    <div class="card-body border-top">
                        <div class="row">
                          <div class="container">
                            <form id="form" class="form-horizontal needs-validation my-2" action="javascript:void(0)" method="post" novalidate>

                              <div class="form-group">
                                <div class="row">
                                  <div class="col-md-6">
                                    <label>Dari Tanggal<code>*</code></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="input-DateStart" placeholder="mm/dd/yyyy" data-provide="datepicker" value="" data-autoclose="true" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="mdi mdi-calendar-month-outline"></i></span>
                                        </div>
                                    </div>
                                    <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                                  </div>
                                  <div class="col-md-6">
                                    <label>Sampai Tanggal<code>*</code></label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="input-DateEnd" placeholder="mm/dd/yyyy" data-provide="datepicker" value="" data-autoclose="true" required>
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="mdi mdi-calendar-month-outline"></i></span>
                                        </div>
                                    </div>
                                    <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                                  </div>
                                </div>
                              </div>

                              <div class="border-top mb-2"></div>

                              <div class="form-group">
                                <label>Unit Pengirim (Boleh dikosongkan) </label>
                                <select name="input-WorkunitID" class="form-control">
                                  <option value="">-- Pilih salah satu --</option>
                                  <?php $i = 1; ?>
                                  <?php foreach ($this->Report_model->get_dataoptionworkunit() as $di) : ?>
                                  <option value="<?= $di['WorkunitID'];?>"><?= $di['WorkunitName'];?></option>
                                  <?php $i++ ?>
                                  <?php endforeach; ?>
                                </select>
                              </div>

                            </form>
                          </div>

                        </div>
                    </div>

                    <div class="card-footer bg-transparent border-top">
                        <div class="text-center">
                            <button type="reset" id="resetmethod" onclick="reset_method()" class="btn btn-outline-light mr-2 w-md">Atur Ulang</button>
                            <button type="submit" id="submitmethod" onclick="action_method()" class="btn btn-primary mr-2 w-md">Tampilkan</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div>
                        <div class="row">
                            <div class="col-lg-9 col-sm-8">
                                <div  class="p-4">
                                    <h5 class="text-primary">Mencetak Laporan Surat Keluar</h5>
                                    <p class="text-justify">Halaman ini memungkinkan anda untuk mencetak Laporan Surat Keluar berdasarkan tanggal yang ditentukan. Laporan akan tampil setelah anda mengklik <strong>Tamplikan</strong>, pastikan data telah tampil sebelum Anda mencetak Laporan. Untuk melakukan merubah informasi Logo dan Instansi pada Laporan surat, Anda bisa mmengubahnya pada menu <strong>Pengaturan Aplikasi</strong>. Berikut adalah cara melakukan Cetak Laporan.</p>

                                    <div class="text-muted">
                                        <p class="mb-1"><i class="mdi mdi-circle-medium align-middle text-primary mr-1"></i> Tentukan Tanggal Awal dan Tanggal Akhir (Tanggal Surat) atau Unit Pengirim (Opsional)</p>
                                        <p class="mb-1"><i class="mdi mdi-circle-medium align-middle text-primary mr-1"></i> Klik <strong>Tampilkan</strong> dan Data akan tampil</p>
                                        <p class="mb-0"><i class="mdi mdi-circle-medium align-middle text-primary mr-1"></i> Klik <strong>Cetak</strong> dibagian bawah halaman</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-4 align-self-center">
                                <div>
                                    <img src="<?= base_url('assets/back-end/img/module/report-img.png')?>" alt="" class="img-fluid d-block">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- end row -->

        <div id="report" class="row justify-content-center" style="display: none;">
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
                            <h5>Laporan #Surat Keluar<br>
                                <small>
                                  <span name="view-DateStart"></span> <br>
                                  <span name="view-DateEnd"></span>
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
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-nowrap" width="100%">
                                    <thead>
                                      <th scope="col" class="text-center" width="5%">#</th>
                                      <th scope="col" class="text-center">Tujuan / No Surat</th>
                                      <th scope="col" class="text-center">Unit Penngirim</th>
                                      <th scope="col" class="text-center">Indeks</th>
                                      <th scope="col" class="text-center">Tanggal Surat</th>
                                      <th scope="col" class="text-center">Tanggal Dikirim</th>
                                    </thead>
                                    <tbody id="show_list">

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
                            <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i class="fa fa-print mr-2"></i> Cetak</a>
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

    <!-- ============================================================== -->
    <!-- Script Here -->
    <!-- ============================================================== -->

    <!-- scripts js -->
    <script src="<?= base_url();?>assets/back-end/js/pages/report/outgoing-report.init.js"></script>
