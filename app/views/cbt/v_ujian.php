<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<?php if ($_SESSION['role'] == 1) { ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1><i class="fa fa-home fa-fw"></i> Data Ujian (CBT)</h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                    <li>Data Ujian (CBT)</li>
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
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Ujian</h2>
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
            <?php if ($_SESSION['role'] != 3) : ?>
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
            <?php endif; ?>
        </div>
        
        <div class="row mb-2">
            <div class="col-md-6">
                <button id="ExportExcel" class="btn btn-sm btn-primary"><i class="fa fa-file-excel"></i>&nbsp;Excel</button>
                <button id="ExportPrint" class="btn btn-sm btn-primary"><i class="fa fa-print"></i>&nbsp;Print</button>
            </div>
            <?php if ($_SESSION['role'] != 3) : ?>
            <div class="col-md-6 text-right">
                <a href="<?php echo base_url(); ?>cbt/form_ujian" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i>&nbsp;Tambah Ujian</a>
            </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php Flash::flash_message(); ?>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="tblUjian" class="table table-borered table-hover">
                        <thead>
                            <tr>
                                <th style="max-width: 30px;">No</th>
                                <th>Nama Ujian</th>
                                <th>Deskripsi Ujian</th>
                                <?php if ($_SESSION['role'] != 3) : ?>
                                <th>Kelas</th>
                                <?php endif; ?>
                                <th>Maks.Nilai</th>
                                <th>Tanggal</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['ujian'] as $key => $ujian) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $ujian['ujian_judul']; ?></td>
                                    <td><?php echo $ujian['ujian_deskripsi']; ?></td>
                                    <?php if ($_SESSION['role'] != 3) : ?>
                                    <td><?php echo $ujian['kelas_nama']; ?></td>
                                    <?php endif; ?>
                                    <td><?php echo (($ujian['ujian_nilai_maks'] / $ujian['ujian_nilai_maks']) * 100); ?></td>
                                    <td style="font-size: 12px;"><?php echo $ujian['ujian_waktu_mulai'] . ' - ' . $ujian['ujian_waktu_akhir']; ?></td>
                                    <td>
                                        <?php if ($_SESSION['role'] != 3) { ?>
                                            <a href="<?php echo base_url(); ?>cbt/detail_ujian/<?php echo $ujian['ujian_id']; ?>" class="btn btn-default btn-xs"><i class="fa fa-eye"></i></a>
                                            <a href="<?php echo base_url(); ?>cbt/form_ujian/<?php echo $ujian['ujian_id']; ?>" class="btn btn-default btn-xs"><i class="fa fa-edit"></i></a>
                                            <button class="btn btn-default btn-xs" data-id="<?php echo $ujian['ujian_id']; ?>" onclick="hapus(this)"><i class="fa fa-trash"></i></button>
                                        <?php } else { ?>
                                            <?php if ($data['ujian_users']) { ?>
                                                <?php if (count($data['ujian_users']) > 0) { ?>
                                                    <?php 
                                                        $date = new DateTime();
                                                        $ujian_dikerjakan = new DateTime($data['ujian_users']->users_tgl_pengerjaan);
                                                        $ujian_dikerjakan->modify('+' . $ujian['ujian_durasi'] . ' minutes');
                                                    ?>
                                                    <?php if ($date >= $ujian_dikerjakan || $data['ujian_users']->users_status == 4) { ?>
                                                        <a href="<?php echo base_url(); ?>cbt/result/<?php echo $data['ujian_users']->users_id; ?>" class="btn btn-primary btn-xs">Detail</a>
                                                    <?php } else { ?>
                                                        <a href="<?php echo base_url(); ?>cbt/start/<?php echo $ujian['ujian_id']; ?>" class="btn btn-primary btn-xs">Lanjutkan</a>
                                                    <?php } ?>
                                                <?php } else { ?>
                                                    <button 
                                                        class="btn btn-primary btn-xs" 
                                                        data-id="<?php echo $ujian['ujian_id']; ?>" 
                                                        data-judul="<?php echo $ujian['ujian_judul']; ?>"
                                                        data-deskripsi="<?php echo $ujian['ujian_deskripsi']; ?>"
                                                        data-durasi="<?php echo $ujian['ujian_durasi']; ?>"
                                                        onclick="detail(this)">Kerjakan</button>
                                                <?php } ?>
                                            <?php } else { ?>
                                                <button 
                                                    class="btn btn-primary btn-xs" 
                                                    data-id="<?php echo $ujian['ujian_id']; ?>" 
                                                    data-judul="<?php echo $ujian['ujian_judul']; ?>"
                                                    data-deskripsi="<?php echo $ujian['ujian_deskripsi']; ?>"
                                                    data-durasi="<?php echo $ujian['ujian_durasi']; ?>"
                                                    onclick="detail(this)">Kerjakan</button>
                                            <?php } ?>
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
<!-- Modal Delete -->
<div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Delete Ujian</h4>
      </div>
      <form action="<?php echo base_url(); ?>cbt/delete_ujian" method="post">
      <div class="modal-body">
        <div class="form-group">
            <h4 class="text-center">Anda yakin akan menghapus ujian ini?</h4>
            <input type="hidden" name="ujian_id">
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

<!-- Modal Detail -->
<div class="modal fade" id="modalDetail" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Detail Ujian</h4>
      </div>
      <form id="form-detail" action="<?php echo base_url(); ?>cbt/confirm_ujian" method="post">
          <div class="modal-body">
            <div class="form-group">
                <h5 class="text-center">Anda yakin akan mengerjakan ujian ini?</h5>
                <input type="hidden" name="ujian_id">
            </div>
            <div class="form-group">
                <label for="">Nama Ujian</label>
                <input type="text" name="ujian_judul" class="form-control" disabled="">
            </div>
            <div class="form-group">
                <label for="">Deskripsi</label>
                <textarea name="ujian_deskripsi" class="form-control" rows="3" disabled=""></textarea>
            </div>
            <div class="form-group">
                <label for="">Durasi</label>
                <input type="text" name="ujian_durasi" class="form-control" disabled="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Ya, kerjakan.</button>
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
        var table = $('#tblUjian').DataTable({
            buttons: [
                { 
                  "extend": 'print',
                  "title": 'Data Ujian'
                },
                { 
                  "extend": 'excel',
                  "title": 'Data Ujian'
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
    });

    function detail(obj) {
        const modal = $('#modalDetail').modal('show');
        modal.find('input[name=ujian_id]').val(obj.dataset.id);
        modal.find('input[name=ujian_judul]').val(obj.dataset.judul);
        modal.find('textarea[name=ujian_deskripsi]').text(obj.dataset.deskripsi);
        modal.find('input[name=ujian_durasi]').val(`${obj.dataset.durasi} menit`);
    }

    function hapus(obj) {
        $('#modalDelete').modal('show');
        $('#modalDelete').find('input[name=ujian_id]').val(obj.dataset.id);
    }
</script>