<div class="main-content">
    <div class="page-content">

        <!-- Start Content-->
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between">
                        <h4 class="mb-0 font-size-18">Profil Pengguna</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active"><?= $this->session->userdata('RoleName')?> / User Profile</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-12">
                  <div class="card overflow-hidden">
                      <div class="bg-soft-primary">
                          <div class="row">
                              <div class="col-12">
                                <button type="button" class="close change-cover ml-1 mt-1" aria-label="Close" data-toggle="tooltip" data-placement="left" title="" data-original-title="Ganti Latar Belakang" style="position: absolute!important;"> <i class="mdi mdi-pencil-box-outline text-white"></i> </button>
                                <img src="" class="img-fluid img-cover">
                              </div>
                          </div>
                      </div>
                      <div class="card-body pt-0">
                          <div class="row">
                              <div class="col-sm-12">
                                <div class="dropdown float-right mt-3">
                                    <a href="#" class="dropdown-toggle arrow-none" data-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical m-0 text-muted h5"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item remove-cover" href="javascript:void(0)">Hapus Latar Belakang</a>
                                        <a class="dropdown-item remove-profile" href="javascript:void(0)">Hapus Gambar Profil</a>
                                    </div>
                                </div>
                                 <!-- end dropdown -->

                                  <div class="avatar-xl profile-user-wid mb-4" style="margin-left:auto; margin-right:auto; margin-top: -30px;">
                                    <button type="button" class="close change-profile ml-1 mt-1" aria-label="Close" data-toggle="tooltip" data-placement="left" title="" data-original-title="Ganti Gambar Profil" style="position: absolute!important;"> <i class="mdi mdi-pencil-box-outline text-white"></i> </button>
                                    <img src="" class="img-thumbnail img-profile rounded mr-2">
                                  </div>
                                  <h5 name="user-header-FullName" class="font-size-22 text-truncate text-center"></h5>
                                  <p name="user-header-Badge" class="font-size-14 text-muted mb-0 text-truncate text-center"></p>

                                  <div class="pt-4">
                                      <div class="text-center mt-0">
                                          <button type="button" class="btn btn-sm btn-dark waves-effect waves-light btn-profile mr-1 mb-2"><i class="mdi mdi-pencil font-size-16 align-middle mr-2"></i>Ubah Profil</button>
                                          <button type="button" class="btn btn-sm btn-light waves-effect waves-light btn-cpassword ml-1 mb-2"><i class="mdi mdi-textbox-password font-size-16 align-middle mr-2"></i>Ganti Password</button>
                                      </div>
                                  </div>
                              </div>

                          </div>
                      </div>
                  </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
              <div class="col-md-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Informasi Dasar</h4>
                        <table class="table mb-0" style="width: 100%">
                            <tbody>
                                <tr>
                                    <td scope="row" width="30%">Alamat </td>
                                    <td><p name="user-data-Address"></td>
                                </tr>
                                 <tr>
                                    <td scope="row" width="30%">Tempat / Tanggal Lahir </td>
                                    <td><p name="user-data-Birthday"></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="30%">Jenis Kelamin </td>
                                    <td><p name="user-data-Gender"></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="30%">Agama </td>
                                    <td><p name="user-data-Religion"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- end card -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Informasi Kontak</h4>
                        <table class="table mb-0" style="width: 100%">
                            <tbody>
                                <tr>
                                    <td scope="row" width="30%">Email</td>
                                    <td><p name="user-data-Email"></td>
                                </tr>
                                <tr>
                                    <td scope="row" width="30%">No. Handphone</td>
                                    <td><p name="user-data-Phone"></td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
                <!-- end card -->
              </div>
              <div class="col-md-6 col-xl-6">
                <div class="card">
                    <div class="card-body">
                      <div class="float-right">
                        <a href="javascript:void(0);" class="delete-loginhistory">Hapus semua riwayat</a>
                      </div>
                      <h4 class="card-title mb-4">Aktivitas Masuk</h4>
                      <ul class="verti-timeline list-unstyled show-counter"></ul>
                    </div>
                </div>
              </div>
            </div>
            <!-- end row -->

            <!-- start row -->
            <div class="row" style="display: none;">
              <form id="form-img-cover" class="form-horizontal" action="javascript:void(0);" method="post">
                <div class="form-group">
                  <input id="img-input-cover" type="file" name="img-input-cover" accept="image/jpeg, image/png" onchange="upload_imgcover()"/>
                </div>
              </form>
              <form id="form-img-profile" class="form-horizontal" action="javascript:void(0);" method="post">
                <div class="form-group">
                  <input id="img-input-profile" type="file" name="img-input-profile" accept="image/jpeg, image/png" onchange="upload_imgprofile()"/>
                </div>
              </form>
            </div>
            <!-- end row -->

      </div>
       <!-- end container-fluid -->
  </div>
  <!-- end content -->

  <!--  Modal content for the above example -->
  <div id="modal_form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 id="modal_title" class="modal-title mt-0">Title</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">

                  <div class="bg-soft-primary">
                    <div class="row">
                      <div class="col-12">
                          <img src="" alt="" class="img-fluid edit-img-cover">
                      </div>
                    </div>
                  </div>
                  <div class="card-body pt-0">
                    <div class="row">
                      <div class="col-12">
                        <div class="avatar-xl mx-auto mb-1" style="margin-left:auto; margin-right:auto; margin-top: -30px;">
                          <img src="" alt="" class="img-thumbnail edit-img-profile">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="alert alert-warning mb-4 mt-0 text-center" role="alert"><strong>Attention!</strong> Sesuaikan informasi Anda untuk digunakan dalam aplikasi SIPAS.</div>

                  <form id="form" class="form-horizontal needs-validation my-2" action="javascript:void(0)" method="post" novalidate>

                      <h4 class="card-title text-center mb-2">Informasi Dasar</h4>
                      <div class="form-group">
                        <label>Nama Lengkap<code>*</code> </label>
                        <input type="text" class="form-control" name="input-FullName" maxlength="30" placeholder="Enter your fullname" value="" required>
                        <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                      </div>

                      <div class="form-group">
                        <label for="input-Alamat">Alamat<code>*</code> </label>
                        <input type="text" class="form-control" name="input-Alamat" placeholder="Enter your address" value="" required>
                        <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-6">
                            <label>Kelurahan</label>
                            <input type="text" class="form-control" name="input-Kelurahan" placeholder="Enter your village" value="">
                          </div>
                          <div class="col-sm-6">
                            <label>Kecamatan</label>
                            <input type="text" class="form-control" name="input-Kecamatan" placeholder="Enter your sub district" value="">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-6">
                            <label>Kota</label>
                            <input type="text" class="form-control" name="input-Kota" placeholder="Enter your district" value="">
                          </div>
                          <div class="col-sm-6">
                            <label>Provinsi</label>
                            <input type="text" class="form-control" name="input-Provinsi" placeholder="Enter your sub state" value="">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-6">
                            <label>Kode POS</label>
                            <input type="text" class="form-control" name="input-KodePOS" placeholder="Enter your zip code" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="">
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-6">
                            <label>Tempat Lahir</label>
                            <input type="text" class="form-control" name="input-TempatLahir" placeholder="Enter your place of birthday" value="">
                          </div>
                          <div class="col-sm-6">
                            <label>Tanggal Lahir</label>
                            <div class="input-group">
                              <input type="text" name="input-TanggalLahir" class="form-control" placeholder="mm/dd/yyyy" data-provide="datepicker" data-date-autoclose="true" readonly>
                              <div class="input-group-append">
                                  <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-6">
                            <label>Jenis Kelamin</label>
                            <select name="input-JenisKelamin" class="form-control">
                              <option value="">-- Pilih salah satu --</option>
                              <option value="Laki-laki">Laki-laki</option>
                              <option value="Perempuan">Perempuan</option>
                            </select>
                          </div>
                          <div class="col-sm-6">
                            <label>Agama </label>
                            <select name="input-Agama" class="form-control">
                              <option value="">-- Pilih salah satu --</option>
                              <option value="Islam">Islam</option>
                              <option value="Kristen">Kristen</option>
                              <option value="Hindu">Hindu</option>
                              <option value="Budha">Budha</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <h4 class="card-title text-center mb-2">Informasi Kontak</h4>
                      <div class="form-group">
                        <label>Email<code>*</code> </label>
                        <input type="text" class="form-control" name="input-Email" placeholder="Enter your email address" value="" maxlength="50" required>
                        <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                        <p class="text-muted mb-0 mt-1 "><code>ex.</code> <i>xxxxx@gmail.com</i></p>
                      </div>
                      <div class="form-group">
                        <label>No. Telepon<code>*</code> </label>
                        <input type="text" class="form-control" name="input-Telepon" placeholder="Enter your phone" value="" maxlength="13" onkeypress="return event.charCode >= 48 && event.charCode <= 57" data-provide="maxlength" required>
                        <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                        <p class="text-muted mb-0 mt-1"><code>ex.</code> <i>08XXXXXXXXXX</i></p>
                      </div>

                  </form>
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal" aria-label="Close">Batal</button>
                <button type="submit" class="btn btn-success submit-profile waves-effect waves-light mr-1">Simpan</button>
              </div>
          </div>
          <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <!--  Modal content for the above example -->
   <div id="modal_form_cpassword" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="mt-0">Ganti Kata Sandi</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <form id="form-cpassword" class="form-horizontal needs-validation my-2" action="javascript:void(0)" method="post" novalidate>

                       <div class="form-group">
                         <label>Kata Sandi Baru<code>*</code></label>
                         <input type="password" class="form-control" name="input-Password" placeholder="Masukkan kata sandi baru anda" value="" required>
                         <div class="invalid-feedback">Bagian ini tidak boleh kosong !</div>
                       </div>

                       <div class="form-group">
                         <label>Ketik Ulang Kata Sandi<code>*</code></label>
                         <input type="password" class="form-control" name="input-RePassword" placeholder="Ketik ulang kata sandi baru anda" value="" required>
                         <div class="invalid-feedback">Bagian ini tidak boleh kosong !</div>
                       </div>

                       <div class="form-group">
                         <div id="error-cpassword-message" class="alert alert-danger text-center mt-2" role="alert">
                             <strong>Oh snap!</strong> Kombinasi password tidak sama.
                         </div>
                       </div>

                   </form>
               </div>
               <div class="modal-footer">
                 <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal" aria-label="Close">Batal</button>
                 <button type="submit" class="btn btn-success submit-cpassword waves-effect waves-light mr-1">Simpan</button>
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

  <script src="<?= base_url();?>assets/back-end/js/pages/profile.init.js"></script>
