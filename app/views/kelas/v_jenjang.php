<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1><i class="fa fa-home fa-fw"></i> Kelas</h1>
				<ol class="breadcrumb">
	                <li>
	                    <a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
	                </li>
                    <li><a href="<?php echo base_url(); ?>kelas">Kelas</a></li>
                    <li class="active">Jenjang</li>
                </ol>
			</div>
		</div>

		<div class="row mb-2">
			<div class="col-md-12">
				<button class="btn btn-primary" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus-circle"></i>&nbsp;Tambah Jenjang</button>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12"><?php Flash::flash_message(); ?></div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table id="tblJenjang" class="table table-borered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Jenjang</th>
								<th style="max-width: 80px;">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data['jenjang'] as $key => $jenjang) : ?>
								<tr>
									<td><?php echo $key + 1; ?></td>
									<td><?php echo $jenjang['jenjang_nama']; ?></td>
									<td>
										<button 
											id="btnEdit" 
											data-id="<?php echo $jenjang['jenjang_id']; ?>" 
											data-nama="<?php echo $jenjang['jenjang_nama']; ?>"
											class="btn btn-xs btn-default"
											onclick="edit(this)"
										>
												<i class="fa fa-edit"></i>
										</button>
										<button 
											data-id="<?php echo $jenjang['jenjang_id']; ?>" 
											class="btn btn-xs btn-default"
											onclick="hapus(this)"
										>
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

<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Jenjang</h4>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <div class="form-group">
        	<label for="">Jenjang Jenjang</label>
        	<input type="text" name="jenjang_nama" class="form-control">
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
        <h4 class="modal-title">Edit Jenjang</h4>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <div class="form-group">
        	<label for="">Jenjang Jenjang</label>
        	<input type="text" id="jenjang_nama" name="jenjang_nama" class="form-control">
        	<input type="hidden" id="jenjang_id" name="jenjang_id" class="form-control">
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
        <h4 class="modal-title">Delete Jenjang</h4>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <div class="form-group">
        	<h4 class="text-center">Anda yakin akan menghapus jenjang ini?</h4>
        	<input type="hidden" id="jenjang_id_delete" name="jenjang_id_delete" class="form-control">
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

<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js//buttons.print.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/jszip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/js/buttons.html5.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
	    var table = $('#tblJenjang').DataTable();
	    // Edit click
	    $('#btnEdit').on('click', function(e) {
	    	$('#modalEdit').modal('show');
	    	$('#jenjang_nama').val($(this).attr('data-nama'));
	    	$('#jenjang_id').val($(this).attr('data-id'));
	    });
	});

	function edit(obj) {
		$('#modalEdit').modal('show');
		$('#jenjang_nama').val(obj.dataset.nama);
    	$('#jenjang_id').val(obj.dataset.id);
	}

	function hapus(obj) {
		$('#modalDelete').modal('show');
		$('#jenjang_id_delete').val(obj.dataset.id);
	}
</script>