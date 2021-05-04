<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1><i class="fa fa-home fa-fw"></i> Dashboard Statistic</h1>
				<ol class="breadcrumb">
	                <li class="active">
	                    <i class="fa fa-dashboard"></i> Dashboard
	                </li>
                    <li>Home</li>
                </ol>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="alert alert-success alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden='true'>&times;</span>
					</button>
					<h4 class="alert-heading">Selamat Datang</h4>
					<p>Selamat datang di control panel admin dan guru.</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-id-card fa-5x"></i>
							</div>
							<div class="col-lg-9 text-right">
								<div>Jumlah User</div>
							</div>
						</div>
					</div>
					<a href="<?php echo base_url(); ?>user">
						<div class="panel-footer">
							<span class="pull-left">Lihat Semua User</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-success">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-folder-open fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div>Jadwal Pelajaran</div>
							</div>
						</div>
					</div>
					<a href="<?php echo base_url(); ?>jadwal">
						<div class="panel-footer">
							<span class="pull-left">Lihat Semua Jadwal</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-danger">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-cart-plus fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div>Jumlah Absen</div>
							</div>
						</div>
					</div>
					<a href="<?php echo base_url(); ?>absensi">
						<div class="panel-footer">
							<span class="pull-left">Lihat Semua Absen</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-md-6">
				<div class="panel panel-info">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-support fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">Jumlah Guru</div>
							</div>
						</div>
					</div>
					<a href="<?php echo base_url(); ?>guru">
						<div class="panel-footer">
							<span class="pull-left">Lihat Index Guru</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
</div>