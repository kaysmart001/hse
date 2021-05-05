<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1><i class="fa fa-home fa-fw"></i> User</h1>
				<ol class="breadcrumb">
          <li class="active">
              <i class="fa fa-dashboard"></i> Dashboard
          </li>
            <li>User</li>
        </ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<?php Flash::flash_message(); ?>
			</div>
			<div class="col-md-12">
				<div class="table-responsive">
					<table id="tblUser" class="table table-borered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama</th>
								<th>Username</th>
								<th>Email</th>
								<th>Level</th>
								<th>Kelas</th>
								<th class="text-center">
									<button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus-circle"></i></button>
								</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data['user'] as $key => $user) : ?>
								<tr>
									<td><?php echo $key + 1; ?></td>
									<td class="<?php echo (isset($user['nama']) ? '' : 'text-muted'); ?>">
										<?php echo (isset($user['nama']) ? $user['nama'] : 'Belum dilengkapi'); ?>
									</td>
									<td><?php echo $user['username']; ?></td>
									<td><?php echo $user['email']; ?></td>
									<td><?php echo $user['level']; ?></td>
									<td class="<?php echo (isset($user['kelas']) ? '' : 'text-muted'); ?>">
										<?php echo (isset($user['kelas']) ? $user['kelas'] : 'Belum dilengkapi'); ?>
									</td>
									<td class="text-center">
										<button class="btn btn-xs btn-default" data-id="<?php echo $user['id']; ?>" onclick="edit(this)"><i class="fa fa-edit"></i></button>
										<button class="btn btn-xs btn-default" data-id="<?php echo $user['id']; ?>" onclick="hapus(this)"><i class="fa fa-trash"></i></button>
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
        <h4 class="modal-title">Tambah User</h4>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <div class="form-group">
        	<label for="">Username</label>
        	<input type="text" name="username" class="form-control" placeholder="Username" required="">
        </div>
        <div class="form-group">
        	<label for="">Email</label>
        	<input type="text" name="email" class="form-control" placeholder="Email" required="">
        </div>
        <div class="form-group">
        	<label for="">Password</label>
        	<input type="password" name="password" class="form-control" placeholder="Password" required="">
        </div>
        <div class="form-group">
        	<label for="">Level/Role</label>
        	<select name="role" id="" class="form-control">
        		<option value="">Pilih Level</option>
        		<option value="1">Admin</option>
        		<option value="2">Guru</option>
        		<option value="3">Siswa</option>
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
        <h4 class="modal-title">Edit User</h4>
      </div>
      <form id="formEdit" action="" method="post">
      <div class="modal-body">
        <div class="form-group">
        	<label for="">Username</label>
        	<input type="text" name="username" id="username" class="form-control" placeholder="Username" required="">
        	<input type="hidden" name="id" id="id">
        </div>
        <div class="form-group">
        	<label for="">Email</label>
        	<input type="text" name="email" id="email" class="form-control" placeholder="Email" required="">
        </div>
        <div class="form-group">
        	<label for="">Level/Role</label>
        	<select name="role" id="role" class="form-control">
        		<option value="">Pilih Level</option>
        		<option value="1">Admin</option>
        		<option value="2">Guru</option>
        		<option value="3">Siswa</option>
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
        <h4 class="modal-title">Delete User</h4>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <div class="form-group">
        	<h4 class="text-center">Anda yakin akan menghapus user ini?</h4>
        	<input type="hidden" id="id_delete" name="id_delete" class="form-control">
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
	    var table = $('#tblUser').DataTable();
	});

	function edit(obj) {
		const id = obj.dataset.id

		$.ajax({
			url: '<?php echo base_url(); ?>user/ajax_get_ubah',
			data: { id: id },
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$('#modalEdit').modal('show');
				const { id, username, email, role } = data.data
				$('#id').val(id);
				$('#username').val(username);
				$('#email').val(email);
				$('#role').prop('selectedIndex', role);
			}
		});
	}

	function hapus(obj) {
		$('#modalDelete').modal('show');
		$('#id_delete').val(obj.dataset.id);
	}
</script>