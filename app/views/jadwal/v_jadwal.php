<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<?php if ($_SESSION['role'] == 1) { ?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1><i class="fa fa-home fa-fw"></i> Jadwal</h1>
				<ol class="breadcrumb">
	                <li class="active">
	                    <a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
	                </li>
                    <li>Jadwal</li>
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
				<h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Jadwal</h2>
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
				<a href="<?php echo base_url(); ?>jadwal/mapel" class="btn btn-sm btn-default">Mata Pelajaran</a>
				<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus-circle"></i>&nbsp;Buat</button>
			</div>
			<?php endif; ?>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table id="tblJadwal" class="table table-borered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Hari</th>
								<th>Mata Pelajaran</th>
								<th>Waktu</th>
								<th>Kelas</th>
								<?php if ($_SESSION['role'] == 1) : ?>
								<th>Actions</th>
								<?php endif; ?>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data['jadwal'] as $key => $jadwal) : ?>
								<tr>
									<td><?php echo $key + 1; ?></td>
									<td><?php echo get_hari($jadwal['jadwal_hari']); ?></td>
									<td><?php echo $jadwal['mapel_nama']; ?></td>
									<td><?php echo $jadwal['jadwal_mulai'].' - '.$jadwal['jadwal_akhir']; ?></td>
									<td><?php echo $jadwal['jenjang_nama'].' - '.$jadwal['kelas_nama']; ?></td>
									<?php if ($_SESSION['role'] == 1) : ?>
									<td>
										<button class="btn btn-default btn-xs btn-edit" data-id="<?php echo $jadwal['jadwal_id']; ?>"><i class="fa fa-edit"></i></button>
										<button class="btn btn-default btn-xs btn-delete" data-id="<?php echo $jadwal['jadwal_id']; ?>"><i class="fa fa-trash"></i></button>
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
					<h4 class="modal-title">Tambah Jadwal</h4>
				</div>
				<form action="<?php echo base_url(); ?>jadwal/process" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="">Jadwal Hari</label>
							<select name="jadwal_hari" id="" class="form-control">
								<option value="">Pilih Hari</option>
								<?php $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; ?>
								<?php foreach($hari as $k => $h) : ?>
									<?php if ($k > 0) : ?>
									<option value="<?php echo $k; ?>"><?php echo $h; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="">Jadwal Mulai</label>
								<input type="time" name="jadwal_mulai" class="form-control">
							</div>
							<div class="form-group col-md-6">
								<label for="">Jadwal Akhir</label>
								<input type="time" name="jadwal_akhir" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="">Jadwal Kelas</label>
							<select name="jadwal_kelas" id="" class="form-control">
								<option value="">Pilih Kelas</option>
								<?php foreach($data['kelas'] as $key => $kelas) : ?>
									<option value="<?php echo $kelas['kelas_id']; ?>"><?php echo $kelas['tingkat_nama'] ?> - <?php echo $kelas['kelas_nama']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label for="">Jadwal Mapel</label>
							<select name="jadwal_mapel" id="" class="form-control">
								<option value="">Pilih Mapel</option>
								<?php foreach($data['mapel'] as $key => $mapel) : ?>
									<option value="<?php echo $mapel['mapel_id']; ?>"><?php echo $mapel['mapel_nama']; ?></option>
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
					<h4 class="modal-title">Edit Jadwal</h4>
				</div>
				<form action="<?php echo base_url(); ?>jadwal/process" method="post">
					<div class="modal-body">
						<div class="form-group">
							<label for="">Jadwal Hari</label>
							<select name="jadwal_hari" id="" class="form-control">
								<option value="">Pilih Hari</option>
								<?php $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']; ?>
								<?php foreach($hari as $k => $h) : ?>
									<?php if ($k > 0) : ?>
									<option value="<?php echo $k; ?>"><?php echo $h; ?></option>
									<?php endif; ?>
								<?php endforeach; ?>
							</select>
							<input type="hidden" name="jadwal_id">
						</div>
						<div class="row">
							<div class="form-group col-md-6">
								<label for="">Jadwal Mulai</label>
								<input type="time" name="jadwal_mulai" class="form-control">
							</div>
							<div class="form-group col-md-6">
								<label for="">Jadwal Akhir</label>
								<input type="time" name="jadwal_akhir" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label for="">Jadwal Kelas</label>
							<select name="jadwal_kelas" id="" class="form-control">
								<option value="">Pilih Kelas</option>
								<?php foreach($data['kelas'] as $key => $kelas) : ?>
									<option value="<?php echo $kelas['kelas_id']; ?>"><?php echo $kelas['kelas_nama']; ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label for="">Jadwal Mapel</label>
							<select name="jadwal_mapel" id="" class="form-control">
								<option value="">Pilih Mapel</option>
								<?php foreach($data['mapel'] as $key => $mapel) : ?>
									<option value="<?php echo $mapel['mapel_id']; ?>"><?php echo $mapel['mapel_nama']; ?></option>
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
	        <h4 class="modal-title">Delete Jadwal</h4>
	      </div>
	      <form action="<?php echo base_url(); ?>jadwal/process" method="post">
	      <div class="modal-body">
	        <div class="form-group">
	        	<h4 class="text-center">Anda yakin akan menghapus jadwal ini?</h4>
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
	    var table = $('#tblJadwal').DataTable({
	        buttons: [
	            { 
	              "extend": 'print',
	              "title": 'Data Jadwal',
	              <?php if ($_SESSION['role'] == 1) : ?>
	              "exportOptions": {
	              	"columns": [ 5, ':visible' ]
	              }
		          <?php endif; ?>
	            },
	            { 
	              "extend": 'excel',
	              "title": 'Data Jadwal',
	              <?php if ($_SESSION['role'] == 1) : ?>
	              "exportOptions": {
	              	"columns": [ 5, ':visible' ]
	              }
		          <?php endif; ?>
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

	    	if (id) {
	    		$.ajax({
		    		url: '<?php echo base_url(); ?>jadwal/ajax_get_ubah',
		    		data: { id: id },
		    		method: 'post',
		    		dataType: 'json',
		    		success: function(data) {
		    			$('#modalEdit').modal('show');
				    	const { 
				    		jadwal_id, 
				    		jadwal_hari, 
				    		jadwal_mulai, 
				    		jadwal_akhir, 
				    		jadwal_mapel, 
				    		jadwal_kelas } = data.data
				    	$('#modalEdit').find('input[name=jadwal_id]').val(jadwal_id);
				    	$('#modalEdit').find(`select[name=jadwal_hari] option[value=${jadwal_hari}]`).attr('selected', 'selected');
				    	$('#modalEdit').find('input[name=jadwal_mulai]').val(jadwal_mulai);
				    	$('#modalEdit').find('input[name=jadwal_akhir]').val(jadwal_akhir);
				    	$('#modalEdit').find(`select[name=jadwal_kelas] option[value=${jadwal_kelas}]`).attr('selected', 'selected');
				    	$('#modalEdit').find(`select[name=jadwal_mapel] option[value=${jadwal_mapel}]`).attr('selected', 'selected');
		    		}
		    	});
	    	}
	    });

	    $('.btn-delete').on('click', function() {
	    	const id = $(this).data('id');

	    	$('#modalDelete').modal('show');
	    	$('#modalDelete').find('input[name=id]').val(id);
	    	$('#modalDelete').find('input[name=delete_type]').val('true');
	    });
	});
</script>