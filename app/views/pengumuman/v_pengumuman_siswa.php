<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
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
									<td><?php echo (strlen($pengumuman['pengumuman_isi']) > 140 ? strip_tags(substr($pengumuman['pengumuman_isi'], 0, 80)) . '...' : strip_tags($pengumuman['pengumuman_isi'])); ?></td>
									<td><?php echo date('Y-m-d', strtotime($pengumuman['pengumuman_waktu'])); ?></td>
									<?php if ($_SESSION['role'] == 1) : ?>
									<td>
										<button class="btn btn-default btn-xs btn-detail" data-id="<?php echo $pengumuman['pengumuman_id'] ?>"><i class="fa fa-eye"></i></button>
										<button class="btn btn-default btn-xs btn-edit" data-id="<?php echo $pengumuman['pengumuman_id'] ?>"><i class="fa fa-edit"></i></button>
										<button class="btn btn-default btn-xs btn-delete" data-id="<?php echo $pengumuman['pengumuman_id']; ?>" data-jenjang="<?php echo $pengumuman['jenjang_id']; ?>"><i class="fa fa-trash"></i></button>
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
							<textarea name="pengumuman_isi" class="form-control pengumuman_isi" rows="5" placeholder="Pengumuman Isi"></textarea>
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
					<h4 class="modal-title">Edit Pengumuman</h4>
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
							<input type="hidden" name="pengumuman_id">
						</div>
						<div class="form-group">
							<label for="">Pengumuman Isi</label>
							<textarea id="pengumuman_isi_edit" name="pengumuman_isi" class="form-control pengumuman_isi_edit" rows="5" placeholder="Pengumuman Isi"></textarea>
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
	        <h4 class="modal-title">Delete Pengumuman</h4>
	      </div>
	      <form action="" method="post">
	      <div class="modal-body">
	        <div class="form-group">
	        	<h4 class="text-center">Anda yakin akan menghapus pengumuman ini?</h4>
	        	<input type="hidden" name="id" class="form-control">
	        	<input type="hidden" name="pengumuman_jenjang" class="form-control">
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

<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header bg-primary">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Detail Pengumuman</h4>
			</div>
			<div class="modal-body">
				<div id="pengumuman_isi_detail"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js//buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		CKEDITOR.replace('pengumuman_isi');
		CKEDITOR.replace('pengumuman_isi_edit');

	    var table = $('#tblPengumuman').DataTable({
	        buttons: [
	            { 
	              "extend": 'print',
	              "title": 'Data Pengumuman',
	              "exportOptions": {
	              	"columns": [ 4, ':visible' ]
	              }
	            },
	            { 
	              "extend": 'excel',
	              "title": 'Data Pengumuman',
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

	    $('.btn-detail').on('click', function() {
	    	const id = $(this).data('id');
	    	$.ajax({
	    		url: '<?php echo base_url(); ?>pengumuman/ajax_get_ubah',
	    		method: 'POST',
	    		data: { pengumuman_id: id },
	    		dataType: 'json',
	    		success: function(response) {
	    			const { pengumuman_id, pengumuman_jenjang, pengumuman_isi } = response.data[0]
	    			$('#modalDetail').modal('show');
	    			$('#modalDetail').find('div#pengumuman_isi_detail').html(pengumuman_isi)
	    		}
	    	});
	    });
	    $('.btn-edit').on('click', function() {
	    	const id = $(this).data('id');
	    	$.ajax({
	    		url: '<?php echo base_url(); ?>pengumuman/ajax_get_ubah',
	    		method: 'POST',
	    		data: { pengumuman_id: id },
	    		dataType: 'json',
	    		success: function(response) {
	    			const { pengumuman_id, pengumuman_jenjang, pengumuman_isi } = response.data[0]
	    			$('#modalEdit').modal('show');
			    	$('#modalEdit').find('input[name=pengumuman_id]').val(id);
			    	$('#modalEdit').find(`select[name=pengumuman_jenjang] option[value=${pengumuman_jenjang}]`).attr('selected', 'selected');
			    	CKEDITOR.instances['pengumuman_isi_edit'].setData(pengumuman_isi);
	    		}
	    	});
	    });

	    $('.btn-delete').on('click', function() {
	    	const id = $(this).data('id');
	    	const jenjang = $(this).data('jenjang');

	    	$('#modalDelete').modal('show');
	    	$('#modalDelete').find('input[name=id]').val(id);
	    	$('#modalDelete').find('input[name=pengumuman_jenjang]').val(jenjang);
	    	$('#modalDelete').find('input[name=delete_type]').val('true');
	    });
	});
</script>