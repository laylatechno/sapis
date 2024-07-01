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
                    <h4 class="mb-0 font-size-18">Beranda</h4>

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
          <div class="col-xl-4 col-sm-6">
            <div class="card bg-soft-primary">
              <div class="row">
                <div class="col-7">
                  <div class="text-primary p-3">
                    <h5 class="text-primary">Selamat Datang !</h5>
                    <p>di <span class="badge badge-pill badge-soft-primary font-size-12"><?= $companydata['CompanyType'];?></span> <strong><?= $companydata['CompanyName']?></strong></p>
                    <p class="text-justify mt-2 mb-0"><?= $companydata['CompanyAddress']?>, Kel. <?= $companydata['CompanyVillage']?>, Kec. <?= $companydata['CompanySubDistrict']?>, <?= $companydata['CompanyDistrict']?>, <?= $companydata['CompanyState']?>, <?= $companydata['CompanyZIPCode']?>. - Telp. <?= $companydata['CompanyPhone']?> </p>
                  </div>
                </div>
                <div class="col-5 align-self-end">
                  <img src="<?= base_url();?>assets/back-end/img/module/welcome-img.png" alt="Welcome Back" class="img-fluid">
                </div>
              </div>
              <!-- end row -->
            </div>
            <!-- end card -->
          </div>
          <!-- end col -->

          <div class="col-xl-8 col-sm-6">
            <div class="row">
              <div class="col-sm-4">
                  <div class="card">
                      <div class="card-body">
                          <div class="d-flex align-items-center mb-3">
                              <div class="avatar-xs mr-3">
                                  <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                      <i class="mdi mdi-inbox-arrow-down-outline"></i>
                                  </span>
                              </div>
                              <h5 class="font-size-14 mb-0">Surat Masuk</h5>
                          </div>
                          <div class="text-muted mt-4">
                              <h3 class="total-inmail"></h3>
                              <div class="d-flex">
                                  <span class="text-truncate">Yang terhitung dari Database</span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-sm-4">
                  <div class="card">
                      <div class="card-body">
                          <div class="d-flex align-items-center mb-3">
                              <div class="avatar-xs mr-3">
                                  <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                      <i class="mdi mdi-inbox-arrow-up-outline"></i>
                                  </span>
                              </div>
                              <h5 class="font-size-14 mb-0">Surat Keluar</h5>
                          </div>
                          <div class="text-muted mt-4">
                              <h3 class="total-outmail"></h3>
                              <div class="d-flex">
                                  <span class="text-truncate">Yang terhitung dari Database</span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-sm-4">
                  <div class="card">
                      <div class="card-body">
                          <div class="d-flex align-items-center mb-3">
                              <div class="avatar-xs mr-3">
                                  <span class="avatar-title rounded-circle bg-soft-primary text-primary font-size-18">
                                      <i class="mdi mdi-account-arrow-right"></i>
                                  </span>
                              </div>
                              <h5 class="font-size-14 mb-0">Total Disposisi</h5>
                          </div>
                          <div class="text-muted mt-4">
                              <h3 class="total-disposition"></h3>
                              <div class="d-flex">
                                  <span class="text-truncate">Yang terhitung dari Database</span>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>

            </div>
            <!-- end row -->
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
          <div class="col-xl-8 col-sm-6">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title float-sm-left mb-4">Grafik</h4>
                    <div class="float-sm-right">
                        <div class="input-group input-group-sm">
                            <select id="graph-year" name="graph-year" class="custom-select custom-select-sm">
                              <?php if (!$this->Dashboard_model->get_allyear()): ?>
                                <option value="<?= date('Y');?>"><?= date('Y');?></option>
                              <?php else: ?>
                                <?php $i = 1; ?>
                                <?php foreach ($this->Dashboard_model->get_allyear() as $ay) : ?>
                                  <option value="<?= $ay->year;?>"><?= $ay->year;?></option>
                                <?php $i++ ?>
                                <?php endforeach; ?>
                              <?php endif; ?>
                            </select>
                            <div class="input-group-append">
                                <label class="input-group-text">Tahun</label>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div id="column_chart" class="apex-charts" dir="ltr" data-parent="#column_chart"></div>
                </div>
            </div>
          </div>
          <!-- end col -->
          <div class="col-xl-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title float-sm-left mb-4">Persentase</h4>
                    <div class="float-sm-right">
                        <div class="input-group input-group-sm">
                            <select id="percentace-year" name="percentace-year" class="custom-select custom-select-sm">
                              <?php if (!$this->Dashboard_model->get_allyear()): ?>
                                <option value="<?= date('Y');?>"><?= date('Y');?></option>
                              <?php else: ?>
                                <?php $i = 1; ?>
                                <?php foreach ($this->Dashboard_model->get_allyear() as $ay) : ?>
                                  <option value="<?= $ay->year;?>"><?= $ay->year;?></option>
                                <?php $i++ ?>
                                <?php endforeach; ?>
                              <?php endif; ?>
                            </select>
                            <div class="input-group-append">
                                <label class="input-group-text">Tahun</label>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div id="donut_chart" class="apex-charts"></div>

                    <div class="text-center text-muted">
                        <div class="row">
                            <div class="col-6">
                                <div class="mt-4">
                                    <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-primary mr-1"></i> Surat Masuk</p>
                                    <h5 class="percent-inmail"></h5>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-4">
                                    <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-success mr-1"></i> Surat Keluar</p>
                                    <h5 class="percent-outmail"></h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-12">
                            <div class="alert alert-warning text-center mt-4 mb-0" role="alert">
                              <i class="mdi mdi-alert-circle-outline mr-2"></i>Klik pada <strong>Tahun</strong> untuk merubah informasi Grafik.
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <!-- end col -->
        </div>
        <!-- end row -->

        <div class="row">
          <div class="col-xl-8 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-4">Surat masuk yang belum dibaca</h4>

                    <ul class="list-group" data-simplebar style="max-height: 360px;">
                      <div class="show-unread"></div>
                    </ul>
                </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                  <h4 class="card-title mb-4">Aktivitas Masuk</h4>
                  <ul class="verti-timeline list-unstyled show-counter"></ul>
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
    <script src="<?= base_url();?>assets/back-end/js/pages/dashboard.init.js"></script>
    <!-- Apex chart -->
    <script src="<?= base_url();?>assets/back-end/libs/apexcharts/apexcharts.min.js"></script>

    <!-- ============================================================== -->
    <!-- Page Script -->
    <!-- ============================================================== -->

    <script type="text/javascript">
      // ====================================================== COLUMN CHART
      var options = {
            chart: {
            height: 350,
            type: "area"
        },
        dataLabels: {
            enabled: !1
        },
        stroke: {
            curve: "smooth",
            width: 3
        },
        series: [{
          name: "Surat Masuk",
          data: []
        }, {
          name: "Surat Keluar",
          data: []
        }],
        fill: {
          type: "gradient",
          gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.7,
            opacityTo: 0.9,
            stops: [0, 90, 100]
          }
        },
        colors: ["#556ee6", "#34c38f"],
        xaxis: {
            categories: ["Jan","Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct","Nov","Dec"]
        },
        yaxis: {
            floating: false,
        },
        grid: {
            borderColor: "#f1f1f1"
        }
      };
      var gchart = new ApexCharts(document.querySelector("#column_chart"),options);
      gchart.render();

      function graph_render(year) {
        $.ajax({
            url: baseURL+'dashboard/get_graphdata/'+year,
            type: "GET",
            cache: false,
            async: true,
            dataType: "JSON",
            success: function(data){
              gchart.updateSeries([{
                data: [data.InMail_Jan, data.InMail_Feb, data.InMail_Mar, data.InMail_Apr, data.InMail_May, data.InMail_Jun, data.InMail_Jul, data.InMail_Aug, data.InMail_Sep, data.InMail_Oct, data.InMail_Nov, data.InMail_Dec]
              }, {
                data: [data.OutMail_Jan, data.OutMail_Feb, data.OutMail_Mar, data.OutMail_Apr, data.OutMail_May, data.OutMail_Jun, data.OutMail_Jul, data.OutMail_Aug, data.OutMail_Sep, data.OutMail_Oct, data.OutMail_Nov, data.OutMail_Dec]
              }])
            },
        });
       }

      // ====================================================== DONUT CHART
      var options = {
        series: [],
        chart: {
          type: "donut",
          height: 240
        },
        labels: ["Surat Masuk", "Surat Keluar"],
        colors: ["#556ee6", "#34c38f"],
        legend: {
          show: !1
        },
        plotOptions: {
          pie: {
            donut: {
              size: "50%"
            }
          }
        }
      };
      var dchart = new ApexCharts(document.querySelector("#donut_chart"),options);
      dchart.render();

      function percentace_render(year) {
       $.ajax({
           url: baseURL+'dashboard/get_percentdata/'+year,
           type: "GET",
           cache: false,
           async: true,
           dataType: "JSON",
           success: function(data){
             $('.percent-inmail').html(data.InMail+' Surat');
             $('.percent-outmail').html(data.OutMail+' Surat');
             dchart.updateOptions({
               series: [data.InMail, data.OutMail],
             })
           },
         });
       }
    </script>
