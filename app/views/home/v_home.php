<section class="page-section portfolio mt-4" id="portfolio">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Akademik HSE</h2>
				<div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
			</div>
		</div>
<?php if (isset($_SESSION['login'])) { ?>
		<div class="row justify-content-center">
	        <!-- Panel Pengumuman -->
	        <div class="col-md-6 col-lg-4 mb-5">
	        	<a href="<?php echo base_url(); ?>pengumuman">
		    		<div class="portfolio-item mx-auto">
		                <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
		                    <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
		                </div>
		                <img class="img-fluid" src="<?php echo base_url(); ?>assets/img/portfolio/pengumumanhse.png" alt="" />
		            </div>
		        </a>
	        </div>

	        <!-- Panel Absensi -->
	        <div class="col-md-6 col-lg-4 mb-5">
            	<a href="<?php echo base_url(); ?>absensi">
            		<div class="portfolio-item mx-auto" data-toggle="modal" data-target="#modalAbsensi">
	                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
	                		<div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
	                    </div>
	                    <img class="img-fluid" src="<?php echo base_url(); ?>assets/img/portfolio/absenhse.png" alt="" />
	                </div>
	            </a>
            </div>

            <!-- Panel Data Guru -->
            <div class="col-md-6 col-lg-4 mb-5">
                <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#modalDataGuru">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <img class="img-fluid" src="<?php echo base_url(); ?>assets/img/portfolio/dataguruhse.png" alt="" />
                </div>
            </div>

            <!-- GANTI GAMBAR DI MENU BERANDA-->
            <div class="col-md-6 col-lg-4 mb-5 mb-lg-0">
                <div class="portfolio-item mx-auto" data-toggle="modal" data-target="#modalRuangKelas">
                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                    <img class="img-fluid" src="<?php echo base_url(); ?>assets/img/portfolio/ruangkelashse.png" alt="" />
                </div>
            </div>

            <!-- Portfolio Item 5-->
            <div class="col-md-6 col-lg-4 mb-5 mb-md-0">
            	<a href="<?php echo base_url(); ?>jadwal">
	                <div class="portfolio-item mx-auto">
	                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
	                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
	                    </div>
	                    <img class="img-fluid" src="<?php echo base_url(); ?>assets/img/portfolio/jadwalhse.png" alt="" />
	                </div>
	            </a>
            </div>
            <!-- Portfolio Item 6-->
            <div class="col-md-6 col-lg-4">
            	<a href="<?php echo base_url(); ?>rapor">
	                <div class="portfolio-item mx-auto">
	                    <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
	                        <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
	                    </div>
	                    <img class="img-fluid" src="<?php echo base_url(); ?>assets/img/portfolio/rapothse.png" alt="" />
	                </div>
	            </a>
            </div>
		</div>

		<!-- Data Guru Modal -->
		<div class="portfolio-modal modal fade" id="modalDataGuru" tabindex="-1" role="dialog" aria-labelledby="modalDataGuru" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><i class="fas fa-times"></i></span>
					</button>
					<div class="modal-body text-center">
						<div class="container">
							<div class="row justify-content-center">
								<div class="col-lg-8">
								<!-- Data Guru Modal - Title-->
								<h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="modalDataGuru">Data Guru</h2>
								<!-- Icon Divider-->
								<div class="divider-custom">
									<div class="divider-custom-line"></div>
									<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
									<div class="divider-custom-line"></div>
								</div>
								<!-- Data Guru Modal - Image-->

								<!-- Data Guru Modal - Text-->
								<p class="mb-5">Isi disini form nya</p>
								<button class="btn btn-primary" data-dismiss="modal"><i class="fas fa-times fa-fw"></i>Close Window</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Ruang Kelas Modal -->
		<div class="portfolio-modal modal fade" id="modalRuangKelas" tabindex="-1" role="dialog" aria-labelledby="modalRuangKelasLabel" aria-hidden="true">
			<div class="modal-dialog modal-xl" role="document">
				<div class="modal-content">
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true"><i class="fas fa-times"></i></span>
					</button>
					<div class="modal-body text-center">
						<div class="container">
							<div class="row justify-content-center">
								<div class="col-lg-8">
									<!-- Ruang Kelas Modal - Title-->
									<h2 class="portfolio-modal-title text-secondary text-uppercase mb-0" id="modalRuangKelasLabel">Ruang Kelas</h2>
									<!-- Icon Divider-->
									<div class="divider-custom">
										<div class="divider-custom-line"></div>
										<div class="divider-custom-icon"><i class="fas fa-star"></i></div>
										<div class="divider-custom-line"></div>
									</div>
									<!-- Ruang Kelas Modal - Image-->
									<!-- Ruang Kelas Modal - Text-->
									<p class="mb-5">
										<a href="https://classroom.google.com/c/MTgwODI2MTYwMDkz" class="btn btn-info btn-md">Classroom SD 1</a><br><br>
										<a href="https://classroom.google.com/c/MTgzMDU1MjY3MjMw" class="btn btn-info btn-md">Classroom SD 2</a><br><br>
										<a href="https://classroom.google.com/c/MTgzMDU1NTI4NTUy" class="btn btn-info btn-md">Classroom SD 3</a><br><br>
										<a href="https://classroom.google.com/c/MTgzMDU1NTI4NTY4" class="btn btn-info btn-md">Classroom SD 4</a><br><br>
										<a href="https://classroom.google.com/c/MTgzMDU1NTI4NTg3" class="btn btn-info btn-md">Classroom SD 5</a><br><br>
										<a href="https://classroom.google.com/c/MTgzMDU5ODQ3MTUz" class="btn btn-info btn-md">Classroom SD 6</a>
									</p>
									<button class="btn btn-primary" data-dismiss="modal"><i class="fas fa-times fa-fw"></i>Close Window</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<?php } else { ?>
		<div class="row">
			<div class="col">
				<div class="jumbotron mt-5">
					<h1 class="display-4">Selamat Datang, di Akademik HSE</h1>
					<p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
				</div>
			</div>
		</div>
<?php } ?>
	</div>
</section>