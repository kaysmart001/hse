<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<?php if ($_SESSION['role'] == 1) { ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1><i class="fa fa-home fa-fw"></i> Data Siswa</h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                    <li>Data Siswa</li>
                </ol>
            </div>
        </div>

        <div class="row mb-3">
            <?php foreach($data['jenjang'] as $key => $jenjang) : ?>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-id-card fa-5x"></i>
                            </div>
                            <div class="col-lg-9 text-right">
                                <div>Data Siswa <?php echo $jenjang['jenjang_nama']; ?></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url(); ?>siswa/<?php echo $jenjang['jenjang_id']; ?>">
                        <div class="panel-footer">
                            <span class="pull-left">Lihat Semua</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
<?php } else { ?>
<section class="page-section portfolio mt-4" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="<?php echo base_url(); ?>"><i class="fa fa-angle-left"></i>&nbsp;Kembali</a>
            </div>
            <div class="col-md-8">
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Data Siswa</h2>
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
<?php } ?>

        <div class="row mb-2">
            <div class="col-md-6">
                <button id="ExportExcel" class="btn btn-sm btn-primary"><i class="fa fa-file-excel-o"></i>&nbsp;Excel</button>
                <button id="ExportPrint" class="btn btn-sm btn-primary"><i class="fa fa-print"></i>&nbsp;Print</button>
            </div>
            <div class="col-md-6 text-right">
                <a href="<?php echo base_url(); ?>siswa/add" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i>&nbsp;Tambah Siswa</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php Flash::flash_message(); ?>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="tblSiswa" class="table table-borered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Jenis Kelamin</th>
                                <th>Jenjang Penididkan</th>
                                <th>Kelas</th>
                                <th>Semester</th>
                                <th style="max-width: 8vw;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['siswa'] as $key => $siswa) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $siswa['siswa_nis']; ?></td>
                                    <td><?php echo $siswa['siswa_nama']; ?></td>
                                    <td><?php echo ($siswa['siswa_jenis_kelamin'] == 1 ? 'Laki-Laki' : ($siswa['siswa_jenis_kelamin'] == 2 ? 'Wanita' : '')); ?></td>
                                    <td><?php echo $siswa['jenjang_nama']; ?></td>
                                    <td><?php echo $siswa['kelas_nama']; ?></td>
                                    <td><?php echo $siswa['siswa_semester']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>siswa/detail/<?php echo $siswa['siswa_id']; ?>" class="btn btn-default btn-xs"><i class="fa fa-eye"></i></a>
                                        <a href="<?php echo base_url(); ?>siswa/detail/<?php echo $siswa['siswa_id']; ?>" class="btn btn-default btn-xs"><i class="fa fa-edit"></i></a>
                                        <button class="btn btn-default btn-xs" data-id="<?php echo $siswa['siswa_id']; ?>" data-uid="<?php echo $siswa['siswa_uid']; ?>" data-jenjang="<?php echo $siswa['siswa_jenjang']; ?>" onclick="hapus(this)"><i class="fa fa-trash"></i></button>
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

<!-- Modal Delete -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete Siswa</h4>
      </div>
      <form action="<?php echo base_url(); ?>siswa/delete" method="post">
      <div class="modal-body">
        <div class="form-group">
            <h4 class="text-center">Anda yakin akan menghapus siswa ini?</h4>
            <input type="hidden" id="siswa_id_delete" name="siswa_id_delete" class="form-control">
            <input type="hidden" id="siswa_uid_delete" name="siswa_uid_delete" class="form-control">
            <input type="hidden" id="siswa_jenjang" name="siswa_jenjang" class="form-control">
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
        var table = $('#tblSiswa').DataTable({
            buttons: [
                { 
                  "extend": 'print',
                  "title": 'Data Siswa'
                },
                { 
                  "extend": 'excel',
                  "title": 'Data Siswa'
                },
            ]
        });
        $("#ExportPrint").on("click", function() {
            table.button( '.buttons-print' ).trigger();
        });
        $("#ExportExcel").on("click", function() {
            table.button( '.buttons-excel' ).trigger();
        });
    });
    function hapus(obj) {
        $('#modalDelete').modal('show');
        $('#siswa_id_delete').val(obj.dataset.id);
        $('#siswa_uid_delete').val(obj.dataset.uid);
        $('#siswa_jenjang').val(obj.dataset.jenjang);
    }
</script>