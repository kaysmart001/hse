<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<?php if ($_SESSION['role'] == 1) { ?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1><i class="fa fa-home fa-fw"></i> Pengumuman</h1>
				<ol class="breadcrumb">
	                <li class="active">
	                    <a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
	                </li>
                    <li><a href="<?php echo base_url(); ?>pengumuman">Pengumuman</a></li>
                    <li><?php echo (isset($data['pengumuman'][0]['jenjang_nama']) ? $data['pengumuman'][0]['jenjang_nama'] : ''); ?></li>
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
				<h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Pengumuman</h2>
				<div class="divider-custom">
	                <div class="divider-custom-line"></div>
	                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
	                <div class="divider-custom-line"></div>
	            </div>
			</div>
			<div class="col-md-2"></div>
		</div>
<?php } ?>

		<div class="row">
			<div class="col-md-12"><?php Flash::flash_message(); ?></div>
		</div>
		<div class="row mb-2">
			<div class="col-md-3">
				<button id="ExportExcel" class="btn btn-sm btn-primary"><i class="fa fa-file-excel-o"></i>&nbsp;Excel</button>
				<button id="ExportPrint" class="btn btn-sm btn-primary"><i class="fa fa-print"></i>&nbsp;Print</button>
			</div>
			<?php if ($_SESSION['role'] == 1) : ?>
			<div class="col-md-9 text-right pull-right">
				<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus-circle"></i>&nbsp;Buat</button>
			</div>
			<?php endif; ?>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table id="tblPengumuman" class="table table-borered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Jenjang</th>
								<th>Isi Pengumuman</th>
								<th>Tanggal/Waktu</th>
								<?php if ($_SESSION['role'] == 1) : ?>
								<th>Actions</th>
								<?php endif; ?>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data['pengumuman'] as $key => $pengumuman) : ?>
								<tr>
									<td><?php echo $key + 1; ?></td>
									<td><?php echo $pengumuman['jenjang_nama']; ?></td>
									<td><?php echo $pengumuman['pengumuman_isi']; ?></td>
									<td><?php echo $pengumuman['pengumuman_waktu']; ?></td>
									<?php if ($_SESSION['role'] == 1) : ?>
									<td>
										<button class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalEdit" data-id="<?php echo $pengumuman['pengumuman_id'] ?>"><i class="fa fa-edit"></i></button>
										<button class="btn btn-default btn-xs"><i class="fa fa-trash"></i></button>
									</td>
									<?php endif; ?>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php if ($_SESSION['role'] == 1) { ?>
	<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Tambah Pengumuman</h4>
				</div>
				<form action="" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="">Pengumuman Jenjang</label>
							<select name="pengumuman_jenjang" class="form-control" id="pengumuman_jenjang" required="">
								<option value="">Pilih Jenjang</option>
								<option value="0">Semua</option>
								<?php foreach ($data['jenjang'] as $key => $jenjang) : ?>
									<option value="<?php echo $jenjang['jenjang_id']; ?>"><?php echo $jenjang['jenjang_nama']; ?></option>
								<?php endforeach; ?>
							</select>
							<input type="hidden" name="pengumuman_waktu" value="<?php echo date('Y-m-d H:i:s'); ?>">
						</div>
						<div class="form-group">
							<label for="">Pengumuman Isi</label>
							<textarea name="pengumuman_isi" class="form-control" rows="5" placeholder="Pengumuman Isi"></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
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
	    var table = $('#tblPengumuman').DataTable({
	        buttons: [
	            { 
	              "extend": 'print',
	              "title": 'Data Absensi'
	            },
	            { 
	              "extend": 'pdf',
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