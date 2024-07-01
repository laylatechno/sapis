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
                    <h4 class="mb-0 font-size-18">Pengguna & Hak Akses</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item active"><?= $this->session->userdata('RoleName');?> / <?= ucwords($this->uri->segment(1));?></li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row content-justify-center">
          <div class="col-md-6 col-xl-4">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Hak Akses</h4>
              </div>
              <div class="card-body">
                <div class="alert alert-warning text-center mt-0 mb-4" role="alert">
                  <i class="mdi mdi-alert-circle-outline mr-2"></i>Klik pada <strong>Nama Hak Akses</strong> untuk merubah informasi.
                </div>

                <div class="table-responsive mt-2" data-simplebar style="max-height: 400px;">
                    <table class="table table-centered table-nowrap table-hover">
                      <tbody id="show-access"></tbody>
                    </table>
                </div>
                <!-- end table -->
              </div>
              <!-- end card-body -->
            </div>
          </div>
          <div class="col-md-6 col-xl-8">
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                    <div>
                        <div class="row">
                            <div class="col-lg-9 col-sm-8">
                                <div  class="p-4">
                                    <h5 class="text-primary">Pengelolaan Hak Akses</h5>
                                    <p class="text-justify">Hak akses (access rights) adalah izin atau hak istimewa yang diberikan kepada pengguna didalam aplikasi, sebagaimana ditetapkan oleh aturan yang dibuat oleh pemilik data dan sesuai kebijakan keamanan informasi. Kami telah menentukan 4 Hak Akses.</p>

                                    <div class="text-muted">
                                        <p class="mb-1"><i class="mdi mdi-circle-medium align-middle text-primary mr-1"></i> Pengguna</p>
                                        <p class="mb-1"><i class="mdi mdi-circle-medium align-middle text-primary mr-1"></i> Operator / Petugas</p>
                                        <p class="mb-1"><i class="mdi mdi-circle-medium align-middle text-primary mr-1"></i> Pimpinan</p>
                                        <p class="mb-0"><i class="mdi mdi-circle-medium align-middle text-primary mr-1"></i> Admin / Administrator</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-4 align-self-center">
                                <div>
                                    <img src="<?= base_url('assets/back-end/img/module/users-img.png')?>" alt="" class="img-fluid d-block">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Total Satuan Kerja</h4>

                        <div class="text-center">
                            <div class="mb-4">
                                <i class="mdi mdi-bulletin-board text-primary display-4"></i>
                            </div>
                            <h3 name="view-TotalClassification"></h3>
                        </div>

                    </div>
                </div>
              </div>
              <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Total Hak Akses</h4>

                        <div class="text-center">
                            <div class="mb-4">
                                <i class="mdi mdi-account-key text-primary display-4"></i>
                            </div>
                            <h3 name="view-TotalRole"></h3>
                        </div>

                    </div>
                </div>
              </div>
              <div class="col-xl-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Total Pengguna</h4>

                        <div class="text-center">
                            <div class="mb-4">
                                <i class="mdi mdi-clipboard-account text-primary display-4"></i>
                            </div>
                            <h3 name="view-TotalUser"></h3>
                        </div>

                    </div>
                </div>
              </div>
            </div>
            <!-- end row -->
          </div>
        </div>

        <div class="row mb-3">
            <div class="col-xl-4 col-sm-6">
                <div class="mt-2">
                    <h5>Data Pengguna</h5>
                </div>
            </div>
            <div class="col-lg-8 col-sm-6">
                <form class="mt-4 mt-sm-0 float-sm-right form-inline">
                    <div class="search-box mr-2">
                        <div class="position-relative">
                            <input name="input-global-search" type="text" class="form-control border-0" placeholder="Cari pengguna..." oninput="SearchFunction(this)">
                            <i class="bx bx-search-alt search-icon"></i>
                        </div>
                    </div>
                    <button type="button" class="btn btn-rounded btn-primary waves-effect waves-light submit-add-user"><i class="mdi mdi-plus mr-2"></i>Tambah pengguna</button>

                </form>
            </div>
        </div>

        <div id="show_userlist" class="row mb-4"></div>
        <!-- end row -->

        <div class="row mb-4">
          <div class="col-md-12">
            <div class="text-center">
                <?php if ($this->db->get('accountuser')->num_rows() > 0): ?>
                  <a id="load_more" href="javascript:void(0);" class="text-success" data-val="0"><i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Muat lebih </a>
                <?php else: ?>
                  <p class="text-muted text-center">Tidak ada pengguna</p>
                <?php endif; ?>
            </div>
          </div>
        </div>

      </div>
      <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

    <!--  Modal content for the above example -->
      <div id="modal_form_eaccess" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
              <div class="modal-content">

                  <div class="modal-header">
                      <h5 id="modal_title_eaccess" class="modal-title-eaccess mt-0">Title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>

                  <div class="modal-body">
                      <form id="form-eaccess" class="form-horizontal needs-validation my-2" method="post" novalidate>

                          <div class="form-group">
                            <div class="avatar-md mx-auto mb-1">
                                <span id="input-RoleIcon" class="avatar-title rounded-circle text-center" style="font-size: 40px;">
                                    <i class="mdi mdi-account-star-outline"></i>
                                </span>
                            </div>
                          </div>

                          <h4 class="card-title text-center mb-4">Informasi Dasar</h4>

                          <div class="form-group">
                            <div class="row">
                              <div class="col-md-6">
                                <label>Nama Akses<code>*</code></label>
                                <input type="text" name="input-RoleName" class="form-control" placeholder="Masukkan nama hak akses" value="" autocomplete="off" required>
                                <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                              </div>
                              <div class="col-md-6">
                                <label>Warna<code>*</code></label>
                                <select name="input-RoleColor" class="form-control" onchange="change_color();" required>
                                  <option value="primary">Ungu</option>
                                  <option value="info">Biru</option>
                                  <option value="danger">Merah</option>
                                  <option value="warning">Kuning</option>
                                  <option value="success">Hijau</option>
                                  <option value="light">Perak</option>
                                  <option value="dark">Hitam</option>
                                </select>
                                <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                              </div>
                            </div>
                          </div>

                      </form>
                  </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal" aria-label="Close">Tutup</button>
                    <button type="submit" class="btn btn-success waves-effect waves-light submit-form-eaccess mr-1">Simpan</button>
                  </div>
              </div>
    					<!-- /.modal-content -->
          </div>
    			<!-- /.modal-dialog -->
      </div>
    	<!-- /.modal -->

    <!--  Modal content for the above example -->
      <div id="modal_form_gaccess" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
          <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
              <div class="modal-content">

                  <div class="modal-header">
                      <h5 id="modal_title_gaccess" class="modal-title-gaccess mt-0">Title</h5>
                      <a href="<?= base_url('users')?>" class="close">
                          <span aria-hidden="true">&times;</span>
                      </a>
                  </div>

                  <div class="modal-body" style="background-color: #F8F8FB;">
                    <div class="col-lg-12">

                        <div class="d-flex">
                          <div class="table-responsive">
                            <table class="table project-list-table table-nowrap table-centered table-borderless">
                              <thead>
                                  <tr>
                                      <th scope="col" class="text-center" width="5%">#</th>
                                      <th scope="col" class="text-center">Nama Grup Menu</th>
                                      <th scope="col" class="text-center">Status</th>
                                  </tr>
                              </thead>
                              <tbody>
                                <?php
                                  $i = 1;
                                  foreach ($this->db->get('menugroup')->result() as $gm) {
                                      echo '<tr>
                                              <td>'.$i.'.</td>
                                              <td><p class="text-muted mb-0"><strong>'.$gm->GroupTitle.'</strong></p></td>
                                              <td>
                                                <div class="custom-control custom-switch mb-0" dir="ltr">
                                                    <input type="checkbox" class="custom-control-input" id="customSwitch'.$i.'" '.checked_access($this->uri->segment(3), $gm->GroupID).' onClick="grant_access('.$gm->GroupID.')">
                                                    <label class="custom-control-label" for="customSwitch'.$i.'">Click to switch</label>
                                                </div>
                                              </td>
                                            </tr>';
                                    $i++;
                                    }
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div>

                      </div>
                  </div>
              </div>
    					<!-- /.modal-content -->
          </div>
    			<!-- /.modal-dialog -->
      </div>
    	<!-- /.modal -->

      <!--  Modal content for the above example -->
        <div id="modal_form_user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 id="modal_title_user" class="modal-title-user mt-0">Title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="avatar-xl mx-auto mb-4">
                          <img id="img-profile" src="" alt="" class="img-thumbnail rounded-circle" onerror="this.src = '<?= base_url('uploads/account/default/picprofile.jpg');?>'">
                        </div>

                        <form id="form-user" class="form-horizontal needs-validation my-2" method="post" novalidate>

                            <div id="group-account" class="form-group border-bottom">
                              <h5 class="text-center">Informasi Akun</h5>
                              <div class="row mb-2">
                                <div class="col-sm-6">
                                  <label>Username<code>*</code></label>
                                  <input type="text" class="form-control" name="input-Username" placeholder="Masukkan nama pengguna" maxlength="30" value="" autocomplete="off" required>
                                  <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                                </div>
                                <div class="col-sm-6">
                                  <div class="alert alert-info text-center" role="alert"><i>Password Default</i> adalah <strong>123456</strong></div>
                                </div>
                              </div>

                              <div id="error-id-message" class="alert alert-danger text-center" role="alert">
                                  <strong>Oh snap!</strong> Username tidak tersedia, silahkan gunakan yang lain.
                              </div>
                            </div>

                            <div class="form-group border-bottom">
                              <h5 class="text-center">Informasi Dasar</h5>

                              <div class="form-group">
                                <label>Nama Lengkap<code>*</code></label>
                                <input type="text" class="form-control" name="input-FullName" placeholder="Masukkan nama lengkap" value="" autocomplete="off" required>
                                <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                              </div>

                              <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="input-Email" placeholder="Masukkan alamat email" value="" autocomplete="off">
                              </div>

                              <div class="row mb-4">
                                <div class="col-md-12">
                                  <label>Unit Kerja<code>*</code></label>
                                  <select name="input-WorkunitID" class="form-control selectpicker" data-live-search="true" style="width: 100%;" aria-required="true" required>
                                    <option value="">-- Pilih salah satu --</option>
                                    <?php $i = 1; ?>
                                    <?php foreach ($this->Users_model->get_dataoptionworkunit()->result_array() as $dk) : ?>
                                    <option data-subtext="<?= $dk['WorkunitCode'];?>" value="<?= $dk['WorkunitID'];?>"><?= $dk['WorkunitName'];?></option>
                                    <?php $i++ ?>
                                    <?php endforeach; ?>
                                  </select>
                                  <div class="invalid-tooltip">Bagian ini tidak boleh kosong !</div>
                                </div>
                              </div>

                            </div>

                            <div class="form-group">
                              <h5 class="text-center">Kewenangan</h5>
                              <div class="row">
                                <div class="col-sm-6">
                                  <label>Hak Akses<code>*</code></label>
                                  <select name="input-user-RoleID" class="form-control" required>
                                      <option value="">-- Pilih salah satu --</option>
                                      <?php $role = $this->db->get('rolemaster')->result_array();
                                      foreach ($role as $rl):
                                      ?>
                                      <option value="<?= $rl['RoleID']?>"><?= $rl['RoleName']?></option>
                                      <?php endforeach;?>
                                  </select>
                                </div>
                                <div class="col-sm-6">
                                  <label>Status Akun<code>*</code></label>
                                  <select name="input-ActiveStatus" class="form-control" required>
                                      <option value="">-- Pilih salah satu --</option>
                                      <option value="yes">Aktif</option>
                                      <option value="no">Tidak Aktif</option>
                                  </select>
                                </div>
                              </div>
                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                      <button type="reset" class="btn btn-danger waves-effect" data-dismiss="modal" aria-label="Close">Batal</button>
                      <button type="submit" class="btn btn-success waves-effect waves-light submit-form-user mr-1">Simpan</button>
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
    <script src="<?= base_url();?>assets/back-end/js/pages/users.init.js"></script>

    <!-- ============================================================== -->
    <!-- Page Script -->
    <!-- ============================================================== -->

    <script type="text/javascript">
      var get_userlist = function(page){
          $.ajax({
              url : baseURL+'users/get_userlist/get',
              type:'GET',
              data: {page:page}
          }).done(function(response){
              $("#show_userlist").append(response);
              $('#load_more').data('val', ($('#load_more').data('val')+1));
          });
      };

      function SearchFunction(e) {
        var keyword = e.value;
        $.ajax({
            url : baseURL+'users/get_search/get',
            type:'GET',
            data: {keyword: keyword}
        }).done(function(response){
            if (keyword) {
              document.getElementById('load_more').style.display = 'none';
              $('#show_userlist').html('');
              $("#show_userlist").append(response);
            } else {
              document.getElementById('load_more').style.display = 'block';
              $('#show_userlist').html('');
              $('#load_more').data('val', ($('#load_more').data('val')*0));
              get_userlist(0);
            }
        });
      }
    </script>
