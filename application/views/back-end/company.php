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
                    <h4 class="mb-0 font-size-18">Instansi / Badan Usaha</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><?= $this->session->userdata('RoleName');?> / <?= ucwords($this->uri->segment(1));?></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
          <div class="col-md-6 col-xl-4">

            <div class="card overflow-hidden">
                <div class="bg-soft-primary">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-3">
                                <h5 class="text-primary">Personalisasi</h5>
                                <p>Informasi yang digunakan pada Aplikasi</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="<?= base_url();?>assets/back-end/img/module/company-img.png" alt="" class="img-fluid">
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="dropdown float-right pt-4">
                                <a href="#" class="dropdown-toggle arrow-none" data-toggle="dropdown" aria-expanded="false">
                                    <i class="mdi mdi-dots-vertical m-0 text-muted h5"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="javascript:void(0)" onclick="method_edit()"><i class="bx bx-edit-alt font-size-16 align-middle mr-2"></i> Ubah Informasi</a>
                                </div>
                            </div>
                            <div class="avatar-md profile-user-wid mb-4">
                                <img id="view-AppSmallLogoBlack" src="" alt="" class="img-thumbnail rounded-circle">
                            </div>
                            <h5 name="view-CompanyName" class="font-size-15 text-truncate"></h5>
                            <p name="view-CompanyEmail" class="text-muted font-size-12 mb-0"></p>
                        </div>

                        <div class="col-sm-12 mt-4">
                          <div class="alert alert-warning mb-0 text-center" role="alert"><i class="mdi mdi-alert-circle-outline mr-2"></i>Informasi identitas Instansi / Badan Usaha Anda.</div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Informasi Dasar</h4>
                    <p class="text-muted text-justify mb-4">Informasi akan ditampilkan di Halaman Login, Dashboard dan Laporan. Sesuaikan Informasi ini dengan Instansi / Badan Usaha Anda.</p>
                    <table class="table mb-0" style="table-layout: fixed; width: 100%">
                        <tbody>
                            <tr>
                                <th scope="row" width="30%">Alamat :</th>
                                <td style="word-wrap: break-word"><p name="view-CompanyAddress" class="text-muted text-justify"></p></td>
                            </tr>
                            <tr>
                                <th scope="row" width="30%">No Telepon :</th>
                                <td><p name="view-CompanyPhone" class="text-muted"></p></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- end card -->

          </div>
          <div class="col-md-6 col-xl-8">

            <div class="row">
              <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Logo Kecil (Kotak - Putih)</h4>
                        <div class="text-center">
                            <a href="javascript:void(0)" onclick="method_logo('smsqw')"><img id="AppSmallLogoWhite" class="img-thumbnail mb-2" width="200" src="" style="background-color: #000!important"></a>
                            <p class="text-muted text-justify">Logo ini digunakan pada Small Sidebar dan dikarnakan berwarna Navy, kami sarankan untuk menggunakan Logo warna Putih. Sebaiknya ukuran pixelnya adalah 1:1 atau kotak dan format PNG. Klik pada gambar untuk merubah Logo.</p>
                        </div>

                    </div>
                </div>
              </div>
              <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Logo Kecil (Kotak - Warna)</h4>
                        <div class="text-center">
                            <a href="javascript:void(0)" onclick="method_logo('smsqb')"><img id="AppSmallLogoBlack" class="img-thumbnail mb-2" width="200" src=""></a>
                            <p class="text-muted text-justify">Logo ini digunakan pada Halaman Login dan Laporan. Bertolak belakan dengan warna yang putih, logo ini tidak di gunakan pada Sidebar. Sebaiknya ukuran pixelnya adalah 1:1 atau kotak dan format PNG. Klik pada gambar untuk merubah Logo.</p>
                        </div>

                    </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Logo Panjang (Landscape - Putih)</h4>
                        <div class="text-center">
                            <a href="javascript:void(0)" onclick="method_logo('lgldw')"><img id="AppLargeLogoWhite" class="img-thumbnail mb-2" width="300" src="" style="background-color: #000!important"></a>
                            <p class="text-muted text-justify">Logo ini digunakan pada Sidebar dan dikarnakan berwarna Navy, kami sarankan untuk menggunakan Logo warna Putih. Sebaiknya ukuran pixelnya adalah 20:7 atau landscape dan format PNG. Klik pada gambar untuk merubah Logo.</p>
                        </div>

                    </div>
                </div>
              </div>
              <div class="col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Logo Panjang (Landscape - Warna)</h4>
                        <div class="text-center">
                            <a href="javascript:void(0)" onclick="method_logo('lgldb')"><img id="AppLargeLogoBlack" class="img-thumbnail mb-2" width="300" src=""></a>
                            <p class="text-muted text-justify">Logo ini digunakan pada Halaman Laporan dan Cetak Laporan. Sebaiknya ukuran pixelnya adalah 20:7 atau landscape dan format PNG. Klik pada gambar untuk merubah Logo.</p>
                        </div>

                    </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Login Header</h4>
                        <div class="text-center">
                            <a href="javascript:void(0)" onclick="method_logo('lghd')"><img id="AppLoginHeader" class="img-thumbnail mb-2" width="500" src=""></a>
                            <div class="row justify-content-center">
                              <div class="col-sm-8">
                                <p class="text-muted">Gambar ini digunakan sebagai Cover pada halaman Login, Anda dapat merubah background sesuai keinginan Anda. Sebaiknya ukuran pixelnya adalah 16:9 atau landscape dan format PNG/JPG/JPEG. Klik pada gambar untuk merubah Cover.</p>
                              </div>
                            </div>

                        </div>

                    </div>
                </div>
              </div>
            </div>

          </div>
        </div>

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
                      <form id="form" class="form-horizontal needs-validation my-2" method="post" enctype="multipart/form-data" novalidate>
                        <h4 class="card-title text-center mb-4">Informasi Dasar</h4>

                        <div class="form-group">
                          <label>Nama Instansi / Badan Usaha<code>*</code> </label>
                          <input type="text" class="form-control" name="input-CompanyName" placeholder="Masukkan nama instansi / badan usaha" value="" required>
                          <div class="invalid-tooltip">Bagian ini tidak boleh kosong!</div>
                        </div>

                        <div class="form-group">
                          <label>Email<code>*</code> </label>
                          <input type="text" class="form-control" name="input-CompanyEmail" placeholder="Masukkan email" value="" required>
                          <div class="invalid-tooltip">Bagian ini tidak boleh kosong!</div>
                          <p class="text-muted mb-0 mt-1 "><code>ex.</code> <i>xxxxx@gmail.com</i></p>
                        </div>

                        <div class="form-group">
                          <label>Jenis Usaha<code>*</code> </label>
                          <input type="text" class="form-control" name="input-CompanyType" placeholder="Masukkan jenis usaha" value="" required>
                          <div class="invalid-tooltip">Bagian ini tidak boleh kosong!</div>
                        </div>

                        <div class="form-group">
                          <label>Alamat<code>*</code> </label>
                          <input type="text" class="form-control" name="input-CompanyAddress" placeholder="Masukkan alamat" value="" required>
                          <div class="invalid-tooltip">Bagian ini tidak boleh kosong!</div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <div class="col-sm-6">
                              <label>Kelurahan<code>*</code> </label>
                              <input type="text" class="form-control" name="input-CompanyVillage" placeholder="Masukkan kelurahan" value="">
                              <div class="invalid-tooltip">Bagian ini tidak boleh kosong!</div>
                            </div>
                            <div class="col-sm-6">
                              <label>Kecamatan<code>*</code> </label>
                              <input type="text" class="form-control" name="input-CompanySubDistrict" placeholder="Masukkan kecamatan" value="">
                              <div class="invalid-tooltip">Bagian ini tidak boleh kosong!</div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <div class="col-sm-6">
                              <label>Kota <code>*</code> </label>
                              <input type="text" class="form-control" name="input-CompanyDistrict" placeholder="Masukkan kota" value="">
                              <div class="invalid-tooltip">Bagian ini tidak boleh kosong!</div>
                            </div>
                            <div class="col-sm-6">
                              <label>Provinsi<code>*</code> </label>
                              <input type="text" class="form-control" name="input-CompanyState" placeholder="Masukkan provinsi" value="">
                              <div class="invalid-tooltip">Bagian ini tidak boleh kosong!</div>
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <div class="row">
                            <div class="col-sm-6">
                              <label>Kode POS</label>
                              <input type="text" class="form-control" name="input-CompanyZIPCode" placeholder="Masukkan kode pos" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="">
                            </div>
                          </div>
                        </div>

                        <div class="form-group">
                          <label>No. Telepon<code>*</code> </label>
                          <input type="text" class="form-control" name="input-CompanyPhone" placeholder="Masukkan no telepon" value="" onkeypress="return isNumberKey(event);" required>
                          <div class="invalid-tooltip">Bagian ini tidak boleh kosong!</div>
                          <p class="text-muted mb-0 mt-1 "><code>ex.</code> <i>08XXXXXXXXXX</i> <code>or</code><i>0254-XXXXXXX</i></p>
                        </div>

                      </form>
                  </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal" aria-label="Close">Batal</button>
                    <button type="submit" id="submitmethod" onclick="action_method()" class="btn btn-success waves-effect submit-button waves-light mr-1">Simpan</button>
                  </div>
              </div>
              <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    <!--  Modal content for the above example -->
      <div id="modal_form_logo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
              <div class="modal-content">
                  <div class="modal-header">
                      <h5 id="modal_title_logo" class="modal-title-logo mt-0">Title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
                  <div class="modal-body">
                      <form id="form-logo" class="form-horizontal needs-validation my-2" method="post" enctype="multipart/form-data" novalidate>

                          <div class="form-group">
                            <div class="alert alert-warning mb-0 text-center" role="alert"><i class="mdi mdi-alert-circle-outline mr-2"></i><b>Peringatan !</b> Kami menyarankan Anda untuk menggunakan gambar berformat <b>PNG</b> kecuali <b>Login Header</b>.</div>
                          </div>

                          <div class="form-group">
                            <label>Unggah file disini <code>(Max. 5Mb)</code> </label>
                            <input id="file-input-Logo" type="file" name="file-input-Logo" accept="image/png,image/jpeg,image/jpg" class="dropify" data-max-file-size="5M" required>
                          </div>

                      </form>
                  </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal" aria-label="Close">Batal</button>
                    <button type="submit" id="submitmethod-logo" onclick="action_method_logo()" class="btn btn-success waves-effect waves-light mr-1">Upload</button>
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
    <script src="<?= base_url();?>assets/back-end/js/pages/company.init.js"></script>
