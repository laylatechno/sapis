<body>
	<div class="page">

		<!-- preloader -->
		<div class="preloader">
			<div class="centrize full-width">
				<div class="vertical-center">
					<div class="spinner">
						<div class="double-bounce1"></div>
						<div class="double-bounce2"></div>
					</div>
				</div>
			</div>
		</div>

		<!-- Container -->
		<div class="container opened" data-animation-in="fadeInLeft" data-animation-out="fadeOutLeft">

			<!-- Header -->
			<header class="header">

				<!-- Menu -->
				<div class="top-menu">
					<ul>
						<li class="active">
							<a href="#login-card">
								<span class="icon mdi mdi-login"></span>
								<span class="link">Sign In</span>
							</a>
						</li>
					</ul>
				</div>

			</header>

			<!--
				Card - Started
			-->
			<div class="card-started" id="home-card">
				<div class="profile">

					<!-- profile image -->
					<div class="slide" style="background-image: url(<?= base_url('uploads/app/logo/'.$this->db->get_where('appsetting', ['AppID' => '1'])->row()->AppLoginHeader)?>);"></div>

					<!-- profile photo -->
					<div class="image">
						<img src="<?= base_url('uploads/app/logo/'.$this->db->get_where('appsetting', ['AppID' => '1'])->row()->AppSmallLogoBlack);?>"style="background-color: #fff">
					</div>

					<!-- profile titles -->
					<div class="title"><b><?= $companydata['CompanyName']?></b> </div>
					<div class="badge-primary mb-4"><b><?= $companydata['CompanyType'];?></b></div>
					<div class="subtitle mt-4"><?= $companydata['CompanyAddress']?>, Kel. <?= $companydata['CompanyVillage']?>, Kec. <?= $companydata['CompanySubDistrict']?>, <?= $companydata['CompanyDistrict']?>, <?= $companydata['CompanyState']?>, <?= $companydata['CompanyZIPCode']?>. - Telp. <?= $companydata['CompanyPhone']?></div>

				</div>
			</div>

			<!--
				Card - Login
			-->
			<div class="card-inner animated active" id="login-card">
				<div class="card-wrap">

					<div class="content login">

						<!-- title -->
						<div class="title">Sign In</div>

						<!-- content -->
						<div class="row">
							<div class="col-d-12 col-t-12 col-m-12 border-line-v">

                <div class="bg-soft-primary mb-2">
                    <div class="row">
                        <div class="col-7">
                            <div class="text-primary p-4">
                                <h5 class="text-primary">Selamat datang!</h5>
                                <p class="text-justify">Gunakan Akun Anda untuk melanjutkan ke dalam Aplikasi.</p>
                            </div>
                        </div>
                        <div class="col-5 align-self-end">
                            <img src="<?= base_url('assets/login-page/img/module/login-img.png');?>" alt="Small Logo" class="img-fluid">
                        </div>
                    </div>
                </div>

                <div class="card-body pt-2">
                    <div class="p-1 mr-2 ml-2">
                        <form id="form" class="form-horizontal needs-validation" action="javascript:void(0);" onsubmit="return validation_auth(this);" method="post" novalidate>

                            <div class="form-group">
                                <label>Username</label>
                                <input name="input-Username" type="text" class="form-control" placeholder="Masukkan username anda" required>
																<div class="invalid-tooltip">Bagian ini tidak boleh kosong!</div>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input name="input-Password" type="password" class="form-control" placeholder="Masukkan kata sandi" required>
																<div class="invalid-tooltip">Bagian ini tidak boleh kosong!</div>
                            </div>

                            <div class="mt-4">
                                <button class="btn btn-primary btn-block btn-login waves-effect waves-light" type="submit" style="height: 20%">Masuk</button>
                            </div>

														<div class="mt-4 mb-0">
															<p class="text-muted text-center font-size-12">SIPAS Premium &copy; 2020 <a href="https://www.ionixeternal.co.id/" target="_blank" class="text-primary">Ionix Eternal Studio</a>. All right reserved.</p>
														</div>

                        </form>
                    </div>
                </div>

							</div>
							<div class="clear"></div>
						</div>

					</div>

				</div>
			</div>

		</div>
		<!-- end of container -->
	</div>
	<!-- end of page -->

	<!-- ============================================================== -->
	<!-- Page Script -->
	<!-- ============================================================== -->

	<script src="<?= base_url();?>assets/login-page/js/pages/auth.init.js"></script>
