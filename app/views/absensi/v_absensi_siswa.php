<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<?php if ($_SESSION['role'] == 1) { ?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1><i class="fa fa-home fa-fw"></i> Absensi</h1>
				<ol class="breadcrumb">
	                <li class="active">
	                    <a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
	                </li>
                    <li><a href="<?php echo base_url(); ?>absensi">Absensi</a></li>
                    <li>Siswa</li>
                </ol>
			</div>
		</div>
<?php } else { ?>
<section class="page-section portfolio mt-4" id="portfolio">
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				<a href="<?php echo base_url(); ?>"><i class="fa fa-angle-left"></i>&nbsp;Kembali</a>
			</div>
			<div class="col-md-8">
				<h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Absensi</h2>
				<div class="divider-custom">
	                <div class="divider-custom-line"></div>
	                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
	                <div class="divider-custom-line"></div>
	            </div>
			</div>
			<div class="col-md-2"></div>
		</div>
<?php } ?>

		<div class="row mb-2">
			<div class="col-md-6">
				<?php if ($_SESSION['role'] == 1) { ?>
				<form action="" method="post" class="form-inline">
					<div class="form-group">
						<select name="by_kelas" id="" class="form-control input-sm">
							<option value="">Pilih Kelas</option>
							<?php foreach($data['kelas'] as $key => $kelas) : ?>
								<option value="<?php echo $kelas['kelas_id']; ?>"><?php echo $kelas['jenjang_nama'] . ' ' . $kelas['kelas_nama']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<button type="submit" class="btn btn-primary btn-sm">Cari</button>
				</form>
				<?php } else { ?>
				<form action="<?php echo base_url(); ?>absensi/post_absen" method="post" class="form-inline">
					<div class="form-group">
						<input type="hidden" name="absen_user" value="<?php echo $_SESSION['id']; ?>">
						<input type="hidden" name="absen_jenis" value="1">
						<input type="hidden" name="absen_waktu" value="<?php echo date('Y-m-d H:i:s'); ?>">
					</div>
					<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check-circle"></i>&nbsp;Absen</button>
				</form>
				<?php } ?>
			</div>
			<div class="col-md-6 text-right">
				<form action="" method="post" class="form-inline pull-right">
					<div class="form-group">
						<select name="by_bulan" id="" class="form-control input-sm">
							<option value="">Pilih Bulan</option>
							<option value="01">Januari</option>
							<option value="02">Februari</option>
							<option value="03">Maret</option>
							<option value="04">April</option>
							<option value="05">Mei</option>
							<option value="06">Juni</option>
							<option value="07">Juli</option>
							<option value="08">Agustus</option>
							<option value="09">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
						</select>
					</div>
					<div class="form-group">
						<select name="by_tahun" id="" class="form-control input-sm">
							<option value="">Pilih Tahun</option>
							<option value="2021">2021</option>
							<option value="2020">2020</option>
							<option value="2019">2019</option>
							<option value="2018">2018</option>
							<option value="2017">2017</option>
						</select>
					</div>
					<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-search"></i>&nbsp;Cari</button>
				</form>
			</div>
		</div>
		<div class="row mb-2">
			<div class="col-md-3">
				<button id="ExportExcel" class="btn btn-sm btn-primary"><i class="fa fa-file-excel"></i>&nbsp;Excel</button>
				<button id="ExportPrint" class="btn btn-sm btn-primary"><i class="fa fa-print"></i>&nbsp;Print</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table id="tblAbsensi" class="table table-borered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Jenjang</th>
								<th>Kelas</th>
								<th>Tanggal/Waktu</th>
								<th>Keterangan</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data['absensi'] as $key => $absensi) : ?>
								<tr>
									<td><?php echo $key + 1; ?></td>
									<td><?php echo $absensi['siswa_nama']; ?></td>
									<td><?php echo $absensi['jenjang_nama']; ?></td>
									<td><?php echo $absensi['jenjang_nama'] . ' - ' . $absensi['kelas_nama']; ?></td>
									<td><?php echo date('Y-m-d H:i:s', strtotime($absensi['absen_waktu'])); ?></td>
									<td><?php echo (isset($absensi['absen_keterangan']) ? $absensi['absen_keterangan'] : ($absensi['absen_jenis'] == 1 ? 'Hadir' : '-')) ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php if ($_SESSION['role'] == 1) { ?>
</div>
<?php } else { ?>
</section>
<?php } ?>

<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js//buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/buttons.html5.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
	    var table = $('#tblAbsensi').DataTable({
	        buttons: [
	            { 
	              "extend": 'print',
	              "title": 'Data Absensi'
	            },
	            { 
	              "extend": 'excel',
	              "title": 'Data Absensi'
	            },
	        ]
	    });
	    $("#ExportPrint").on("click", function() {
	        table.button( '.buttons-print' ).trigger();
	    });
	    $("#ExportExcel").on("click", function() {
	        table.button( '.buttons-excel' ).trigger();
	    });
	});
</script>