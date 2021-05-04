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
                    <li class="active">Jurusan</li>
                </ol>
			</div>
		</div>

		<div class="row mb-2">
			<div class="col-md-12">
				<button class="btn btn-primary" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus-circle"></i>&nbsp;Tambah Jurusan</button>
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
								<th>Nama Jurusan</th>
                <th>Jenjang</th>
								<th style="max-width: 80px;">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data['jurusan'] as $key => $jurusan) : ?>
								<tr>
									<td><?php echo $key + 1; ?></td>
									<td><?php echo $jurusan['jurusan_nama']; ?></td>
                  <td><?php echo $jurusan['jenjang_nama']; ?></td>
									<td>
										<button 
											data-id="<?php echo $jurusan['jurusan_id']; ?>" 
											data-nama="<?php echo $jurusan['jurusan_nama']; ?>"
                      data-jenjang="<?php echo $jurusan['jurusan_jenjang']; ?>"
											class="btn btn-xs btn-default"
											onclick="edit(this)"
										>
												<i class="fa fa-edit"></i>
										</button>
										<button 
											data-id="<?php echo $jurusan['jurusan_id']; ?>" 
											class="btn btn-xs btn-default"
											onclick="remove(this)"
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
        <h4 class="modal-title">Tambah Jurusan</h4>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <div class="form-group">
        	<label for="">Nama Jurusan</label>
        	<input type="text" name="jurusan_nama" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Jenjang</label>
          <select name="jurusan_jenjang" id="jurusan_jenjang" class="form-control">
            <option>Pilih Jenjang</option>
            <?php foreach($data['jenjang'] as $key => $jenjang) : ?>
              <option value="<?php echo $jenjang['jenjang_id']; ?>"><?php echo $jenjang['jenjang_nama']; ?></option>
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
        <h4 class="modal-title">Edit Jurusan</h4>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <div class="form-group">
        	<label for="">Nama Jurusan</label>
        	<input type="text" id="jurusan_nama" name="jurusan_nama" class="form-control">
        	<input type="hidden" id="jurusan_id" name="jurusan_id" class="form-control">
        </div>
        <div class="form-group">
          <label for="">Jenjang</label>
          <select name="jurusan_jenjang" id="jurusan_jenjang_edit" class="form-control">
            <option>Pilih Jenjang</option>
            <?php foreach($data['jenjang'] as $key => $jenjang) : ?>
              <option value="<?php echo $jenjang['jenjang_id']; ?>"><?php echo $jenjang['jenjang_nama']; ?></option>
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
        <h4 class="modal-title">Delete Jurusan</h4>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <div class="form-group">
        	<h4 class="text-center">Anda yakin akan menghapus jurusan ini?</h4>
        	<input type="hidden" id="jurusan_id_delete" name="jurusan_id_delete" class="form-control">
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
	});
	// Edit click
    function edit(obj) {
    	$('#modalEdit').modal('show');
    	$('#jurusan_nama').val(obj.dataset.nama);
    	$('#jurusan_id').val(obj.dataset.id);
      $(`#jurusan_jenjang_edit option[value=${obj.dataset.jenjang}]`).attr('selected', 'selected');
    };
    // Delete click
    function remove(obj) {
    	$('#modalDelete').modal('show');
    	$('#jurusan_id_delete').val(obj.dataset.id);
    };
</script>