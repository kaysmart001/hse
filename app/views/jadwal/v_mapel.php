<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<?php if ($_SESSION['role'] == 1) { ?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1><i class="fa fa-home fa-fw"></i> Mapel <small>(Mata Pelajaran)</small></h1>
				<ol class="breadcrumb">
	                <li class="active">
	                    <a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
	                </li>
                    <li><a href="<?php echo base_url(); ?>jadwal">Jadwal</a></li>
                    <li>Mapel</li>
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
				<h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Mapel</h2>
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
					<table id="tblMapel" class="table table-borered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode</th>
								<th>Nama/Pelajaran</th>
								<th>Guru</th>
								<?php if ($_SESSION['role'] == 1) : ?>
								<th>Actions</th>
								<?php endif; ?>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data['mapel'] as $key => $mapel) : ?>
								<tr>
									<td><?php echo $key + 1; ?></td>
									<td><?php echo $mapel['mapel_kode']; ?></td>
									<td><?php echo $mapel['mapel_nama']; ?></td>
									<td><?php echo $mapel['guru_nama']; ?></td>
									<td>
										<button 
											class="btn btn-default btn-xs btn-edit" 
											data-id="<?php echo $mapel['mapel_id']; ?>"
											data-kode="<?php echo $mapel['mapel_kode']; ?>"
											data-nama="<?php echo $mapel['mapel_nama']; ?>"
											data-guru="<?php echo $mapel['mapel_guru']; ?>">
											<i class="fa fa-edit"></i>
										</button>
										<button class="btn btn-default btn-xs btn-delete" data-id="<?php echo $mapel['mapel_id']; ?>"><i class="fa fa-trash"></i></button>
									</td>
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
					<h4 class="modal-title">Tambah Mapel</h4>
				</div>
				<form action="" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="">Mapel Kode</label>
							<?php $n = 'K00' . rand(10, 30); ?>
							<input type="text" name="mapel_kode" class="form-control" placeholder="Mapel Kode" value="<?php echo $n; ?>" required="">
						</div>
						<div class="form-group">
							<label for="">Mapel Nama</label>
							<input type="text" name="mapel_nama" class="form-control" placeholder="Mapel Nama" required="">
						</div>
						<div class="form-group">
							<label for="">Mapel Guru</label>
							<select name="mapel_guru" id="" class="form-control">
								<option value="">Pilih Guru</option>
								<?php foreach($data['guru'] as $key => $guru) : ?>
									<option value="<?php echo $guru['guru_id']; ?>"><?php echo $guru['guru_nama']; ?></option>
								<?php endforeach; ?>
							</select>
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

	<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header bg-primary">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Edit Mapel</h4>
				</div>
				<form action="" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="">Mapel Kode</label>
							<?php $n = 'K00' . rand(10, 30); ?>
							<input type="text" name="mapel_kode" class="form-control" placeholder="Mapel Kode" value="<?php echo $n; ?>" required="">
							<input type="hidden" name="mapel_id">
						</div>
						<div class="form-group">
							<label for="">Mapel Nama</label>
							<input type="text" name="mapel_nama" class="form-control" placeholder="Mapel Nama" required="">
						</div>
						<div class="form-group">
							<label for="">Mapel Guru</label>
							<select name="mapel_guru" id="" class="form-control">
								<option value="">Pilih Guru</option>
								<?php foreach($data['guru'] as $key => $guru) : ?>
									<option value="<?php echo $guru['guru_id']; ?>"><?php echo $guru['guru_nama']; ?></option>
								<?php endforeach; ?>
							</select>
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

	<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
	  <div class="modal-dialog modal-sm" role="document">
	    <div class="modal-content">
	      <div class="modal-header bg-primary">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title">Delete Mapel</h4>
	      </div>
	      <form action="" method="post">
	      <div class="modal-body">
	        <div class="form-group">
	        	<h4 class="text-center">Anda yakin akan menghapus mapel ini?</h4>
	        	<input type="hidden" name="id" class="form-control">
	        	<input type="hidden" name="delete_type" class="form-control">
	        </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	        <button type="submit" class="btn btn-danger">Ya, hapus</button>
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
	    var table = $('#tblMapel').DataTable({
	        buttons: [
	            { 
	              "extend": 'print',
	              "title": 'Data Jadwal',
	              "exportOptions": {
	              	"columns": [ 4, ':visible' ]
	              }
	            },
	            { 
	              "extend": 'excel',
	              "title": 'Data Jadwal',
	              "exportOptions": {
	              	"columns": [ 4, ':visible' ]
	              }
	            },
	        ]
	    });
	    $("#ExportPrint").on("click", function() {
	        table.button( '.buttons-print' ).trigger();
	    });
	    $("#ExportExcel").on("click", function() {
	        table.button( '.buttons-excel' ).trigger();
	    });

	    $('.btn-edit').on('click', function() {
	    	const id = $(this).data('id');
	    	const kode = $(this).data('kode');
	    	const nama = $(this).data('nama');
	    	const guru = $(this).data('guru');

	    	$('#modalEdit').modal('show');
	    	$('#modalEdit').find('input[name=mapel_id]').val(id);
	    	$('#modalEdit').find('input[name=mapel_kode]').val(kode);
	    	$('#modalEdit').find('input[name=mapel_nama]').val(nama);
	    	$('#modalEdit').find(`select[name=mapel_guru] option[value=${guru}]`).attr('selected', 'selected');
	    });

	    $('.btn-delete').on('click', function() {
	    	const id = $(this).data('id');

	    	$('#modalDelete').modal('show');
	    	$('#modalDelete').find('input[name=id]').val(id);
	    	$('#modalDelete').find('input[name=delete_type]').val('true');
	    })
	});
</script>