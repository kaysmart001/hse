<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<?php if ($_SESSION['role'] == 1) { ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1><i class="fa fa-home fa-fw"></i> Data Soal (CBT)</h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                    <li>Data Soal (CBT)</li>
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
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Soal</h2>
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
        </div>
        
        <div class="row mb-2">
            <div class="col-md-6">
                <button id="ExportExcel" class="btn btn-sm btn-primary"><i class="fa fa-file-excel"></i>&nbsp;Excel</button>
                <button id="ExportPrint" class="btn btn-sm btn-primary"><i class="fa fa-print"></i>&nbsp;Print</button>
            </div>
            <?php if ($_SESSION['role'] != 3) : ?>
            <div class="col-md-6 text-right">
                <a href="<?php echo base_url(); ?>cbt/export_soal" class="btn btn-sm btn-info"><i class="fa fa-download"></i>&nbsp;Import Soal</a>
                <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus-circle"></i>&nbsp;Tambah Soal</a>
            </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php Flash::flash_message(); ?>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="tblSoal" class="table table-borered table-hover">
                        <thead>
                            <tr>
                                <th style="max-width: 30px;">No</th>
                                <th>Topik</th>
                                <th>Soal</th>
                                <th>Tipe</th>
                                <th>Total Jawaban</th>
                                <?php if ($_SESSION['role'] != 3) : ?>
                                <th>Actions</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['soal'] as $key => $soal) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $soal['topik_judul']; ?></td>
                                    <td><?php echo $soal['soal_detail']; ?></td>
                                    <td><?php echo ($soal['soal_tipe'] == 1 ? 'Pilihan Ganda' : 'Essai'); ?></td>
                                    <td><?php echo ($soal['soal_tipe'] == 1 ? $soal['total_jawaban'] : 'Dikoreksi manual'); ?></td>
                                    <td>
                                        <?php if ($_SESSION['id'] == $soal['soal_pembuat'] || $_SESSION['role'] == 1) { ?>
                                            <?php if ($soal['soal_tipe'] == 1) : ?>
                                            <a href="<?php echo base_url(); ?>cbt/jawaban/<?php echo $soal['soal_id']; ?>" class="btn btn-primary btn-xs" title="Tambah Jawaban" data-toggle="tooltip" data-placement="top" title="Tambah Jawaban"><i class="fa fa-plus-circle"></i></a>
                                            <?php endif; ?>
                                        <button 
                                            class="btn btn-default btn-xs" 
                                            data-id="<?php echo $soal['soal_id']; ?>" 
                                            data-topik="<?php echo $soal['soal_topik']; ?>" 
                                            data-detail="<?php echo $soal['soal_detail']; ?>" 
                                            data-tipe="<?php echo $soal['soal_tipe']; ?>"
                                            <?php echo (isset($soal['soal_gambar']) ? "data-gambar=".$soal['soal_gambar'] : ""); ?>
                                            title="Edit"
                                            onclick="edit(this)">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <button class="btn btn-default btn-xs" data-id="<?php echo $soal['soal_id']; ?>" title="Hapus" onclick="hapus(this)"><i class="fa fa-trash"></i></button>
                                        <?php } else { ?>
                                            <span class="badge bg-default">Dibuat oleh user lain/admin</span>
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
</div>

<?php if ($_SESSION['role'] != 3) { ?>
<!-- Modal Add -->
<div class="modal fade" id="modalAdd" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Tambah Soal</h4>
      </div>
      <form action="<?php echo base_url(); ?>cbt/cud_soal" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="form-group">
            <label for="">Topik</label>
            <select name="soal_topik" id="" class="form-control">
                <?php if (count($data['topik']) == 0) { ?>
                    <option value="">Buat topik terlebih dahulu</option>
                <?php } else { ?>
                    <option value="">Pilih Topik</option>
                    <?php foreach($data['topik'] as $key => $topik) : ?>
                        <option value="<?php echo $topik['topik_id']; ?>"><?php echo $topik['topik_judul']; ?></option>
                    <?php endforeach; ?>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Soal</label>
            <textarea name="soal_detail" class="form-control" rows="4" placeholder="Contoh: 10 * 100 = ?"></textarea>
        </div>
        <div class="form-group">
            <label for="">Tipe Soal</label>
            <select name="soal_tipe" class="form-control" id="">
                <option value="">Pilih Tipe</option>
                <option value="1">Pilihan Ganda</option>
                <option value="2">Essai</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Soal Gambar</label>
            <input type="file" name="soal_gambar" class="form-control">
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
        <h4 class="modal-title">Edit Soal</h4>
      </div>
      <form action="<?php echo base_url(); ?>cbt/cud_soal" method="post" enctype="multipart/form-data">
      <div class="modal-body" style="padding-bottom: 0">
        <div class="form-group">
            <label for="">Topik</label>
            <select name="soal_topik" id="" class="form-control">
                <option value="">Pilih Topik</option>
                <?php foreach($data['topik'] as $key => $topik) : ?>
                    <option value="<?php echo $topik['topik_id']; ?>"><?php echo $topik['topik_judul']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="soal_id">
        </div>
        <div class="form-group">
            <label for="">Soal</label>
            <textarea name="soal_detail" class="form-control" rows="4" placeholder="Contoh: 10 * 100 = ?"></textarea>
        </div>
        <div class="form-group">
            <label for="">Tipe Soal</label>
            <select name="soal_tipe" class="form-control" id="">
                <option value="">Pilih Tipe</option>
                <option value="1">Pilihan Ganda</option>
                <option value="2">Essai</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Soal Gambar</label>
            <input type="file" name="soal_gambar" class="form-control">
        </div>
        <div class="form-group">
            <input type="hidden" name="soal_gambar_old">
            <div id="oldImg"></div>
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
        <h4 class="modal-title">Delete Soal</h4>
      </div>
      <form action="<?php echo base_url(); ?>cbt/cud_soal" method="post">
      <div class="modal-body">
        <div class="form-group">
            <h4 class="text-center">Anda yakin akan menghapus soal ini?</h4>
            <input type="hidden" name="soal_id_delete">
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
        var table = $('#tblSoal').DataTable({
            buttons: [
                { 
                  "extend": 'print',
                  "title": 'Data Soal'
                },
                { 
                  "extend": 'excel',
                  "title": 'Data Soal'
                },
            ]
        });
        $("#ExportPrint").on("click", function() {
            table.button( '.buttons-print' ).trigger();
        });
        $("#ExportExcel").on("click", function() {
            table.button( '.buttons-excel' ).trigger();
        });

        $('[data-toggle="tooltip"]').tooltip();
        $('#modalEdit').on('hidden.bs.modal', function(){
          $(this).find('form')[0].reset();
          $('#imgPlace').append('');
      });
    });

    function edit(obj) {
        const { id, topik, detail, tipe, gambar } = obj.dataset
        const modal = $('#modalEdit').modal('show');

        modal.find('input[name=soal_id]').val(id);
        modal.find(`select[name=soal_topik] option[value=${topik}]`).attr('selected', 'selected');
        modal.find('textarea[name=soal_detail]').text(detail);
        modal.find(`select[name=soal_tipe] option[value=${tipe}]`).attr('selected', 'selected');
        var soal_gbr = `<?php echo base_url(); ?>uploads/soal/${gambar}`
        if (gambar == undefined) {
            $('#oldImg').html('');
        } else {
            modal.find('input[name=soal_gambar_old]').val(gambar);
            $('#oldImg').html(`<a href="${soal_gbr}">${gambar}</a>`);
        }
    }

    function hapus(obj) {
        $('#modalDelete').modal('show');
        $('#modalDelete').find('input[name=soal_id_delete]').val(obj.dataset.id);
    }
</script>