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
                    <h4 class="mb-0 font-size-18">Kotak Masuk</h4>

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
            <div class="col-lg-12">
                <div class="">
                    <div class="table-responsive">
                        <table class="table project-list-table table-nowrap table-centered table-borderless">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center" style="width: 100px">#</th>
                                    <th scope="col" class="text-center">Surat Masuk</th>
                                    <th scope="col" class="text-center">Indeks</th>
                                    <th scope="col" class="text-center">Sifat</th>
                                    <th scope="col" class="text-center">Tanggal Surat</th>
                                    <th scope="col" class="text-center">Batas Waktu</th>
                                </tr>
                            </thead>
                            <tbody id="show_list">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->

        <div class="row mt-2 mb-2">
          <div class="col-md-12">
            <div class="text-center">
                <?php if ($this->db->get_where('disposition', ['Username' => $this->session->userdata('Username')])->num_rows() > 0): ?>
                  <a id="load-more" href="javascript:void(0);" class="text-success" data-val="0"><i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Muat lebih </a>
                <?php else: ?>
                  <p class="text-muted text-center">Tidak ada surat masuk</p>
                <?php endif; ?>
            </div>
          </div>
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
    <script src="<?= base_url();?>assets/back-end/js/pages/inbox/inbox.init.js"></script>

    <!-- ============================================================== -->
    <!-- Page Script -->
    <!-- ============================================================== -->

    <script type="text/javascript">
      var get_datadisposition = function(page){
        $.ajax({
            url : baseURL+'inbox/get_datadisposition/get',
            type:'GET',
            data: {page:page}
        }).done(function(response){
            $("#show_list").append(response);
            $('#load-more').data('val', ($('#load-more').data('val')+1));
        });
      };
      function SearchFunction() {
        var keyword = $('[name="input-global-search"]').val();
        $.ajax({
            url : baseURL+'inbox/search_datadisposition/get',
            type:'GET',
            data: {keyword: keyword}
        }).done(function(response){
          if (keyword) {
            document.getElementById('load-more').style.display = 'none';
            $('#show_list').html('');
            $("#show_list").append(response);
          } else {
            document.getElementById('load-more').style.display = 'block';
            $('#show_list').html('');
            $('#load-more').data('val', ($('#load-more').data('val')*0));
            get_datadisposition(0);
          }
        });
      }

      function MSearchFunction() {
        var keyword = $('[name="input-global-msearch"]').val();
        $.ajax({
            url : baseURL+'inbox/search_datadisposition/get',
            type:'GET',
            data: {keyword: keyword}
        }).done(function(response){
            if (keyword) {
              document.getElementById('load-more').style.display = 'none';
              $('#show_list').html('');
              $("#show_list").append(response);
            } else {
              document.getElementById('load-more').style.display = 'block';
              $('#show_list').html('');
              $('#load-more').data('val', ($('#load-more').data('val')*0));
              get_datadisposition(0);
            }
        });
      }
    </script>
