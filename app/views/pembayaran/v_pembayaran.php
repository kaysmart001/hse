<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1><i class="fa fa-home fa-fw"></i> Pembayaran</h1>
				<ol class="breadcrumb">
          <li class="active">
              <i class="fa fa-dashboard"></i> Dashboard
          </li>
            <li>Pembayaran Siswa</li>
        </ol>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<?php Flash::flash_message(); ?>
			</div>
			<div class="col-md-12">
				<div class="table-responsive">
					<table id="tblPembayaran" class="table table-borered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>NIS</th>
								<th>Nama</th>
								<th>Kelas</th>
								<th>Status</th>
								<th style="max-width: 8vw;">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data['pembayaran'] as $key => $pembayaran) : ?>
								<tr>
									<td><?php echo $key + 1; ?></td>
									<td><?php echo $pembayaran['siswa_nis']; ?></td>
									<td><?php echo $pembayaran['siswa_nama']; ?></td>
									<td>
										<?php echo $pembayaran['kelas_nama']; ?>
									</td>
									<td>
										<?php echo ($pembayaran['pembayaran_status'] == 1 ? '<span class="badge bg-success">Diverifikasi</span>' : ($pembayaran['pembayaran_status'] == 2 ? '<span class="badge bg-danger">Ditolak</span>' : '<span class="badge bg-default">Menunggu</span>')) ?>
									</td>
									<td>
										<a href="<?php echo base_url(); ?>pembayaran/accept/<?php echo $pembayaran['pembayaran_id']; ?>" class="btn btn-success btn-xs"><i class="fa fa-check-circle"></i> Verifikasi</a>
										<a href="<?php echo base_url(); ?>pembayaran/reject/<?php echo $pembayaran['pembayaran_id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-times"></i> Tolak</a>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
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
	    var table = $('#tblPembayaran').DataTable();
	});
</script>