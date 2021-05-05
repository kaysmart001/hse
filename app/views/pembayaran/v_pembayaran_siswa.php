<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<section class="page-section portfolio mt-4" id="portfolio">
	<div class="container">
		<div class="row">
			<div class="col-md-2">
				<a href="<?php echo base_url(); ?>"><i class="fa fa-angle-left"></i>&nbsp;Kembali</a>
			</div>
			<div class="col-md-8">
				<h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Pembayaran</h2>
				<div class="divider-custom">
	                <div class="divider-custom-line"></div>
	                <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
	                <div class="divider-custom-line"></div>
	            </div>
			</div>
			<div class="col-md-2"></div>
		</div>

		<div class="row">
			<div class="col-md-12"><?php Flash::flash_message(); ?></div>
		</div>
		<div class="row mb-2">
			<div class="col-md-6">
				<button id="ExportExcel" class="btn btn-sm btn-primary"><i class="fa fa-file-excel"></i>&nbsp;Excel</button>
				<button id="ExportPrint" class="btn btn-sm btn-primary"><i class="fa fa-print"></i>&nbsp;Print</button>
			</div>
			<div class="col-md-6 text-right">
				<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalPembayaran">Buat Pembayaran</buton>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table id="tblPembayaran" class="table table-borered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Pembayaran Jenis</th>
								<th>Pembayaran Keterangan</th>
								<th>Pembayaran Bukti</th>
								<th>Pembayaran Status</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach($data['pembayaran'] as $key => $pembayaran) : ?>
								<tr>
									<td><?php echo $key + 1; ?></td>
									<td>
										<?php 
											if ($pembayaran['pembayaran_jenis'] == 1) {
												echo 'Pendaftaran';
											} else if ($pembayaran['pembayaran_jenis'] == 2) {
												echo 'Semester';
											} else if ($pembayaran['pembayaran_jenis'] == 3) {
												echo 'Biaya Lain-lain.';
											}
										?>
									</td>
									<td><?php echo $pembayaran['pembayaran_keterangan']; ?></td>
									<td>
										<a href="<?php echo base_url(); ?>uploads/bukti/<?php echo $pembayaran['pembayaran_bukti']; ?>"><i class="fa fa-file"></i>&nbsp; <?php echo $pembayaran['pembayaran_bukti']; ?></a>
									</td>
									<td><?php echo ($pembayaran['pembayaran_status'] == 1 ? '<span class="badge bg-primary">Diverifikasi</span>' : '<span class="badge bg-default">Menunggu</span>') ?></td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="modalPembayaran" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">Buat Pembayaran</h4>
      </div>
      <form action="<?php echo base_url(); ?>pembayaran/process" method="post" enctype="multipart/form-data">
      		<div class="modal-body">
      			<div class="form-group">
      				<label for="">Jenis Pembayaran</label>
      				<select name="pembayaran_jenis" id="pembayaran_jenis" class="form-control">
      					<option value="">Pilih Jenis</option>
      					<option value="1">Pendaftaran</option>
      					<option value="2">Semester</option>
      					<option value="3">Biaya Lain</option>
      				</select>
      				<input type="hidden" name="pembayaran_id">
      				<input type="hidden" name="pembayaran_keterangan">
      			</div>
      			<div class="form-group">
      				<label for="">Upload Bukti</label>
      				<input accept="image/png, image/jpeg, image/jpg, .pdf" type="file" name="pembayaran_bukti" class="form-control">
      				<span id="helpBlock" class="help-block"><small><i>Tipe file: pdf, png, jpg, jpeg.</i></small></span> <br>
      				<span id="helpBlock" class="help-block"><small><i>Maks. size: 10mb</i></small></span>
      			</div>
      		</div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
	        <button type="submit" class="btn btn-primary">Submit</button>
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
	    var table = $('#tblPembayaran').DataTable({
	        buttons: [
	            { 
	              "extend": 'print',
	              "title": 'Data Pembayaran',
	            },
	            { 
	              "extend": 'excel',
	              "title": 'Data Pembayaran',
	            },
	        ]
	    });
	    $("#ExportPrint").on("click", function() {
	        table.button( '.buttons-print' ).trigger();
	    });
	    $("#ExportExcel").on("click", function() {
	        table.button( '.buttons-excel' ).trigger();
	    });
	    $('#pembayaran_jenis').change(function() {
	    	const val = $(this).val();
	    	if (val == 1) {
	    		$('#modalPembayaran').find('input[name=pembayaran_keterangan]').val('Biaya untuk pendaftaran.');
	    	} else if (val == 2) {
	    		$('#modalPembayaran').find('input[name=pembayaran_keterangan]').val('Biaya untuk semester.');
	    	} else if (val == 3) {
	    		$('#modalPembayaran').find('input[name=pembayaran_keterangan]').val('Biaya untuk dana yang lainnya.');
	    	} else {
	    		$('#modalPembayaran').find('input[name=pembayaran_keterangan]').val('');
	    	}
	    });
	});
</script>