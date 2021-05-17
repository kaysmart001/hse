<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1><i class="fa fa-home fa-fw"></i> Pengumuman</h1>
				<ol class="breadcrumb">
	                <li class="active">
	                    <i class="fa fa-dashboard"></i> Dashboard
	                </li>
                    <li>Pengumuman</li>
                </ol>
			</div>
		</div>

		<div class="row">
			<?php foreach($data['jenjang'] as $key => $jenjang) : ?>
			<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-fw fa-5x"></i>
							</div>
							<div class="col-lg-9 text-right">
								<label><?php echo $jenjang['jenjang_nama']; ?></label>
							</div>
						</div>
					</div>
					<div class="panel-footer">
						<a href="<?php echo base_url(); ?>pengumuman/jenjang/<?php echo $jenjang['jenjang_id']; ?>"><input type="button" class="btn btn-default"  value="Lihat Pengumuman"></a>
					</div>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>