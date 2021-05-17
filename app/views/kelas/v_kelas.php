<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<?php if ($_SESSION['role'] == 1) { ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1><i class="fa fa-home fa-fw"></i> Data Kelas</h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                    <li>Data Kelas</li>
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
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Data Kelas</h2>
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
<?php } ?>
		<div class="row mb-3">
			<div class="col-md-6">
				<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus-circle"></i>&nbsp;Tambah Kelas</button>
			</div>
			<?php if ($_SESSION['role'] == 1) : ?>
			<div class="col-md-6 text-right">
				<a href="<?php echo base_url(); ?>kelas/jenjang" class="btn btn-default">Tambah Jenjang</a>
				<a href="<?php echo base_url(); ?>kelas/tingkat" class="btn btn-default">Tambah Tingkat</a>
				<a href="<?php echo base_url(); ?>kelas/jurusan" class="btn btn-default">Tambah Jurusan</a>
			</div>
			<?php endif; ?>
		</div>
		<div class="row">
			<div class="col-md-12"><?php Flash::flash_message(); ?></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table id="tblKelas" class="table table-borered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Jenjang Kelas</th>
								<th>Tingkat Kelas</th>
								<th>Jurusan Kelas</th>
								<th>Nama Kelas</th>
								<th class="text-center">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data['kelas'] as $key => $kelas) : ?>
								<tr>
									<td><?php echo $key + 1; ?></td>
									<td><?php echo $kelas['jenjang_nama']; ?></td>
									<td><?php echo $kelas['tingkat_nama']; ?></td>
									<td><?php echo (isset($kelas['jurusan_nama']) ? $kelas['jurusan_nama'] : '-'); ?></td>
									<td><?php echo $kelas['kelas_nama']; ?></td>
									<td class="text-center">
										<button class="btn btn-xs btn-default" data-id="<?php echo $kelas['kelas_id']; ?>" onclick="edit(this)">
											<i class="fa fa-edit"></i>
										</button>
										<button class="btn btn-xs btn-default" data-id="<?php echo $kelas['kelas_id']; ?>" onclick="hapus(this)">
											<i class="fa fa-trash"></i>
										</button>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Add -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Kelas</h4>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <div class="form-group">
        	<label for="">Jenjang Kelas</label>
        	<select name="kelas_jenjang" id="kelas_jenjang" class="form-control">
        		<?php if ($_SESSION['role'] == 1) { ?>
        			<option value="">Pilih Jenjang</option>
	        		<?php foreach($data['jenjang'] as $key => $jenjang) : ?>
	        			<option value="<?php echo $jenjang['jenjang_id']; ?>"><?php echo $jenjang['jenjang_nama']; ?></option>
	        		<?php endforeach; ?>
	        	<?php } else { ?>
	        		<option value="<?php echo $data['guru']->guru_jenjang; ?>"><?php echo $data['guru']->jenjang_nama; ?></option>
	        	<?php } ?>
        	</select>
        </div>
        <div class="form-group">
        	<label for="">Tingkat Kelas</label>
        	<select name="kelas_tingkat" id="kelas_tingkat" class="form-control">
        		<option value="">Pilih Tingkat</option>
        		<?php foreach($data['tingkat'] as $key => $tingkat) : ?>
        			<option value="<?php echo $tingkat['tingkat_id']; ?>"><?php echo $tingkat['tingkat_nama']; ?></option>
        		<?php endforeach; ?>
        	</select>
        </div>
        <div id="kelas_jurusan" class="form-group">
        	
        </div>
        <div class="form-group">
        	<label for="">Nama Kelas</label>
        	<input type="text" name="kelas_nama" class="form-control" placeholder="Nama Kelas">
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

<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ubah Kelas</h4>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <div class="form-group">
        	<label for="">Jenjang Kelas</label>
        	<select name="kelas_jenjang" id="kelas_jenjang_edit" class="form-control">
        		<?php if ($_SESSION['role'] == 1) { ?>
        			<option value="">Pilih Jenjang</option>
	        		<?php foreach($data['jenjang'] as $key => $jenjang) : ?>
	        			<option value="<?php echo $jenjang['jenjang_id']; ?>"><?php echo $jenjang['jenjang_nama']; ?></option>
	        		<?php endforeach; ?>
	        	<?php } else { ?>
	        		<option value="<?php echo $data['guru']->guru_jenjang; ?>"><?php echo $data['guru']->jenjang_nama; ?></option>
	        	<?php } ?>
        	</select>
        	<input type="hidden" id="kelas_id_edit" name="kelas_id">
        </div>
        <div class="form-group">
        	<label for="">Tingkat Kelas</label>
        	<select name="kelas_tingkat" id="kelas_tingkat_edit" class="form-control">
        		<option value="">Pilih Tingkat</option>
        		<?php foreach($data['tingkat'] as $key => $tingkat) : ?>
        			<option value="<?php echo $tingkat['tingkat_id']; ?>"><?php echo $tingkat['tingkat_nama']; ?></option>
        		<?php endforeach; ?>
        	</select>
        </div>
        <div id="kelas_jurusan_edit" class="form-group">
        	
        </div>
        <div class="form-group">
        	<label for="">Nama Kelas</label>
        	<input type="text" id="kelas_nama_edit" name="kelas_nama" class="form-control" placeholder="Nama Kelas">
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

<!-- Modal Delete -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete Kelas</h4>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <div class="form-group">
        	<h4 class="text-center">Anda yakin akan menghapus kelas ini?</h4>
        	<input type="hidden" id="kelas_id_delete" name="kelas_id_delete" class="form-control">
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
	    var table = $('#tblKelas').DataTable();
	    
	    $('#kelas_jenjang').on('click', function(e) {
	    	$('#kelas_jurusan').html('');
	    	const val = $(this).val();
	    	const val_name = $(this).text();

	    	var label = '<label>Jurusan Kelas</label>';
	    	var select = label + '<select name="kelas_jurusan" class="form-control"><option>Pilih Jurusan</option>';
	    	$.ajax({
	    		url: '<?php echo base_url(); ?>kelas/ajax_get_jurusan',
				data: { jenjang: val, jenjang_nama: val_name},
				method: 'post',
				dataType: 'json',
				success: function(data) {
					for (var a = 0; a < data.length; a++) {
						select += `<option value="${data[a].jurusan_id}">${data[a].jurusan_nama}</option>`
					}
					$('#kelas_jurusan').html(select);
				}
	    	});
	    });

	    $('#kelas_jenjang_edit').on('click', function(e) {
	    	$('#kelas_jurusan_edit').html('');
	    	const val = $(this).val();
	    	const val_name = $(this).text();

	    	var label = '<label>Jurusan Kelas</label>';
	    	var select = label + '<select name="kelas_jurusan" class="form-control"><option>Pilih Jurusan</option>';
	    	$.ajax({
	    		url: '<?php echo base_url(); ?>kelas/ajax_get_jurusan',
				data: { jenjang: val, jenjang_nama: val_name},
				method: 'post',
				dataType: 'json',
				success: function(data) {
					for (var a = 0; a < data.length; a++) {
						select += `<option value="${data[a].jurusan_id}">${data[a].jurusan_nama}</option>`
					}
					$('#kelas_jurusan_edit').html(select);
				}
	    	});
	    });
	});

	function edit(obj) {
		$('#kelas_jurusan_edit').html('');
		const id = obj.dataset.id
		var label = '<label>Jurusan Kelas</label>';
    	var select = label + '<select name="kelas_jurusan" class="form-control"><option>Pilih Jurusan</option>';

		$.ajax({
			url: '<?php echo base_url(); ?>kelas/ajax_get_ubah',
			data: { kelas_id : id },
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$('#modalEdit').modal('show');
				const { 
					kelas_id, 
					kelas_jenjang, 
					kelas_tingkat, 
					kelas_jurusan, 
					kelas_nama 
				} = data.data
				$(`#kelas_jenjang_edit option[value=${kelas_jenjang}]`).attr('selected', 'selected');
				$(`#kelas_tingkat_edit option[value=${kelas_tingkat}]`).attr('selected', 'selected');
				if (kelas_jurusan) {
					var label = '<label>Jurusan Kelas</label>';
			    	var select = label + '<select name="kelas_jurusan" class="form-control"><option>Pilih Jurusan</option>';
			    	$.ajax({
			    		url: '<?php echo base_url(); ?>kelas/ajax_get_jurusan',
						data: { jenjang: data.data.jenjang_id, jenjang_nama: data.data.jenjang_nama},
						method: 'post',
						dataType: 'json',
						success: function(data) {
							for (var a = 0; a < data.length; a++) {
								select += `<option value="${data[a].jurusan_id}" ${data[a].jurusan_id == kelas_jurusan ? 'selected' : ''}>${data[a].jurusan_nama}</option>`
							}
							$('#kelas_jurusan_edit').html(select);
						}
			    	});
				}
				$('#kelas_nama_edit').val(kelas_nama);
				$('#kelas_id_edit').val(kelas_id);
			}
		});
	}

	function hapus(obj) {
		$('#modalDelete').modal('show');
		$('#kelas_id_delete').val(obj.dataset.id);
	}
</script>