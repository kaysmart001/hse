<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<?php if ($_SESSION['role'] == 1) { ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1><i class="fa fa-home fa-fw"></i> Data Topik (CBT)</h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                    <li>Data Topik (CBT)</li>
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
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Topik</h2>
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
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-id-card fa-5x"></i>
                            </div>
                            <div class="col-lg-9 <?php echo ($_SESSION['role'] == 1 ? 'text-right' : 'text-center'); ?>">
                                <div>Data Topik</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url(); ?>cbt">
                        <div class="panel-footer">
                            <span class="pull-left">Lihat Semua</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-id-card fa-5x"></i>
                            </div>
                            <div class="col-lg-9 <?php echo ($_SESSION['role'] == 1 ? 'text-right' : 'text-center'); ?>">
                                <div>Data Soal</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url(); ?>cbt/soal">
                        <div class="panel-footer">
                            <span class="pull-left">Lihat Semua</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-id-card fa-5x"></i>
                            </div>
                            <div class="col-lg-9 <?php echo ($_SESSION['role'] == 1 ? 'text-right' : 'text-center'); ?>">
                                <div>Data Ujian</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url(); ?>cbt/ujian">
                        <div class="panel-footer">
                            <span class="pull-left">Lihat Semua</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-id-card fa-5x"></i>
                            </div>
                            <div class="col-lg-9 <?php echo ($_SESSION['role'] == 1 ? 'text-right' : 'text-center'); ?>">
                                <div>Data Rekap</div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url(); ?>cbt/rekap">
                        <div class="panel-footer">
                            <span class="pull-left">Lihat Semua</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="row mb-2">
            <div class="col-md-6">
                <button id="ExportExcel" class="btn btn-sm btn-primary"><i class="fa fa-file-excel-o"></i>&nbsp;Excel</button>
                <button id="ExportPrint" class="btn btn-sm btn-primary"><i class="fa fa-print"></i>&nbsp;Print</button>
            </div>
            <?php if ($_SESSION['role'] != 3) : ?>
            <div class="col-md-6 text-right">
                <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus-circle"></i>&nbsp;Tambah Topik</a>
            </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php Flash::flash_message(); ?>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="tblTopik" class="table table-borered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Topik</th>
                                <th>Deksripsi</th>
                                <th>Soal</th>
                                <th>Status</th>
                                <?php if ($_SESSION['role'] != 3) : ?>
                                <th style="max-width: 8vw;">Actions</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['topik'] as $key => $topik) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $topik['topik_judul']; ?></td>
                                    <td><?php echo $topik['topik_deskripsi']; ?></td>
                                    <td></td>
                                    <td><?php echo ($topik['topik_status'] == 0 ? '<span class="badge bg-default">Tidak Aktif</span>' : '<span class="badge bg-success">Aktif</span>'); ?></td>
                                    <td>
                                        <?php if ($_SESSION['id'] == $topik['topik_pembuat']) { ?>
                                        <button 
                                            class="btn btn-default btn-xs" 
                                            data-id="<?php echo $topik['topik_id']; ?>" 
                                            data-judul="<?php echo $topik['topik_judul']; ?>" 
                                            data-deskripsi="<?php echo $topik['topik_deskripsi']; ?>" 
                                            data-status="<?php echo $topik['topik_status']; ?>" 
                                            onclick="edit(this)">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-default btn-xs" data-id="<?php echo $topik['topik_id']; ?>" onclick="hapus(this)"><i class="fa fa-trash"></i></button>
                                        <?php } else { ?>
                                            <span class="badge bg-default">Dibuat oleh user lain</span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php if ($_SESSION['role'] != 3) { ?>
    <!-- Modal Add -->
    <div class="modal fade" id="modalAdd" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Tambah Topik</h4>
          </div>
          <form action="<?php echo base_url(); ?>cbt/cud_topik" method="post">
          <div class="modal-body">
            <div class="form-group">
                <label for="">Judul</label>
                <input type="text" class="form-control" name="topik_judul" placeholder="Judul Topik" required="">
            </div>
            <div class="form-group">
                <label for="">Deskripsi</label>
                <textarea name="topik_deskripsi" class="form-control" rows="5" placeholder="Deskripsi"></textarea>
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <select name="topik_status" id="" class="form-control" required="">
                    <option value="">Pilih Status</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
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

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Topik</h4>
          </div>
          <form action="<?php echo base_url(); ?>cbt/cud_topik" method="post">
          <div class="modal-body">
            <div class="form-group">
                <label for="">Judul</label>
                <input type="text" class="form-control" name="topik_judul" placeholder="Judul Topik" required="">
                <input type="hidden" name="topik_id">
            </div>
            <div class="form-group">
                <label for="">Deskripsi</label>
                <textarea name="topik_deskripsi" class="form-control" rows="5" placeholder="Deskripsi"></textarea>
            </div>
            <div class="form-group">
                <label for="">Status</label>
                <select name="topik_status" id="" class="form-control" required="">
                    <option value="">Pilih Status</option>
                    <option value="1">Aktif</option>
                    <option value="0">Tidak Aktif</option>
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

    <!-- Modal Delete -->
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Delete Topik</h4>
          </div>
          <form action="<?php echo base_url(); ?>cbt/cud_topik" method="post">
          <div class="modal-body">
            <div class="form-group">
                <h4 class="text-center">Anda yakin akan menghapus topik ini?</h4>
                <input type="hidden" name="topik_id_delete">
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
<?php } ?>

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
        var table = $('#tblTopik').DataTable({
            buttons: [
                { 
                  "extend": 'print',
                  "title": 'Data Rapor'
                },
                { 
                  "extend": 'excel',
                  "title": 'Data Rapor'
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

    function edit(obj) {
        const { id, judul, deskripsi, status } = obj.dataset
        const modal = $('#modalEdit').modal('show');

        modal.find('input[name=topik_id]').val(id);
        modal.find('input[name=topik_judul]').val(judul);
        modal.find('textarea[name=topik_deskripsi]').text(judul);
        modal.find(`select[name=topik_status] option[value=${status}]`).attr('selected', 'selected');
    }

    function hapus(obj) {
        const modal = $('#modalDelete').modal('show');

        modal.find('input[name=topik_id_delete]').val(obj.dataset.id);
    }
</script>