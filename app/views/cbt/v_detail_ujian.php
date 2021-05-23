<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<style>table p { margin-bottom: 0 }</style>
<?php if ($_SESSION['role'] == 1) { ?>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/daterangepicker.css">
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1><i class="fa fa-home fa-fw"></i> Detail Ujian (CBT)</h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                    <li><a href="<?php echo base_url(); ?>cbt/ujian">Ujian</a></li>
                    <li><?php echo (isset($data['ujian']->ujian_judul) ? $data['ujian']->ujian_judul : ''); ?></li>
                </ol>
            </div>
        </div>
<?php } else { ?>
<section class="page-section portfolio mt-4" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="<?php echo base_url(); ?>cbt/ujian"><i class="fa fa-angle-left"></i>&nbsp;Kembali</a>
            </div>
            <div class="col-md-8">
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0"><?php echo (isset($data['ujian']->ujian_judul) ? $data['ujian']->ujian_judul : ''); ?></h2>
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
<?php } ?>
        <div class="row">
            <div class="col-md-12">
                <table width="100%" cellpadding="15">
                    <tbody>
                        <tr>
                            <td>
                                <b>Judul Ujian:</b>
                                <p><?php echo (isset($data['ujian']->ujian_judul) ? $data['ujian']->ujian_judul : ''); ?></p>
                            </td>
                            <td>
                                <b>Kelas:</b>
                                <p><?php echo (isset($data['ujian']->jenjang_nama) ? $data['ujian']->tingkat_nama . ' ' . $data['ujian']->jenjang_nama : ''); ?></p>
                            </td>
                            <td style="max-width: 12vw;">
                                <b>Range Tanggal & Waktu:</b>
                                <p><?php echo $data['ujian']->ujian_waktu_mulai . ' - ' . $data['ujian']->ujian_waktu_akhir; ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>Soal:</b>
                                <p><?php echo $data['ujian']->ujian_judul .' ' . $data['ujian']->ut_total_soal .' Soal'; ?></p>
                            </td>
                            <td>
                                <b>Durasi:</b>
                                <p><?php echo (isset($data['ujian']->ujian_durasi) ? $data['ujian']->ujian_durasi : ''); ?> menit</p>
                            </td>
                            <td>
                                <b>Status:</b>
                                <p><?php echo ($data['ujian']->ujian_status > 0 ? 'Aktif' : 'Tidak Aktif') ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php Flash::flash_message(); ?>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Daftar Siswa Ujian</div>
                    <div class="panel-body">
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <button id="ExportExcel" class="btn btn-sm btn-primary"><i class="fa fa-file-excel-o"></i>&nbsp;Excel</button>
                                <button id="ExportPrint" class="btn btn-sm btn-primary"><i class="fa fa-print"></i>&nbsp;Print</button>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="table-siswa" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="max-width: 30px;">#</th>
                                        <th>Nama</th>
                                        <th>Nilai</th>
                                        <th>Status</th>
                                        <th style="max-width: 120px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data['list_siswa'] as $key => $user) : ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td><?php echo $user['siswa_nama']; ?></td>
                                            <td>
                                                <?php echo number_format(floatval(($user['nilai'] / $user['soal']) * 10), 2); ?>
                                                <?php if ($user['belum_dikoreksi'] > 0) {
                                                    echo ' <small>( ' . $user['nilai'] . ' terjawab, ' . $user['belum_dikoreksi'] . ' belum dikoreksi )</small>';
                                                } else {
                                                    echo '<small>( sudah terjawab semua )';
                                                } ?>
                                            </td>
                                            <td>
                                                <?php echo ($user['users_status'] > 1 ? '<span class="badge bg-success">Selesai</span>' : '<span class="badge bg-default">Tidak Selesai</span>') ?>    
                                            </td>
                                            <td>
                                                <?php if ($user['belum_dikoreksi'] > 0) {
                                                    echo '<a href="'.base_url() . 'cbt/result/'. $user['users_id'].'" class="btn btn-info btn-xs"><i class="fa fa-check-circle"></i>&nbsp; Koreksi</a>';
                                                } else {
                                                    echo '<a href="'.base_url() . 'cbt/result/'. $user['users_id'].'" class="btn btn-info btn-xs"><i class="fa fa-eye"></i></a>&nbsp;';
                                                    echo '<a href="'.base_url() . 'cbt/print_hasil_ujian/'. $user['users_id'].'" class="btn btn-info btn-xs"><i class="fa fa-print"></i></a>';
                                                } ?>
                                                <button class="btn btn-danger btn-xs" data-ujian="<?php echo $user['ujian_id']; ?>" data-id="<?php echo $user['users_id']; ?>" onclick="hapus(this)"><i class="fa fa-trash"></i>&nbsp; Hapus</button>
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
    </div>
</div>

<?php if ($_SESSION['role'] != 3) : ?>
    <div class="modal fade" id="modalDelete" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header bg-primary">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Delete Ujian</h4>
          </div>
          <form action="<?php echo base_url(); ?>cbt/delete_ujian_siswa" method="post">
          <div class="modal-body">
            <div class="form-group">
                <h4 class="text-center">Anda yakin akan menghapus ujian siswa ini?</h4>
                <input type="hidden" name="ujian_id">
                <input type="hidden" name="users_id">
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
<?php endif; ?>

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
        var table = $('#table-siswa').DataTable({
            buttons: [
                { 
                  "extend": 'print',
                  "title": 'Data Siswa Ujian'
                },
                { 
                  "extend": 'excel',
                  "title": 'Data Siswa Ujian'
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

    function hapus(obj) {
        $('#modalDelete').modal('show');
        $('#modalDelete').find('input[name=ujian_id]').val(obj.dataset.ujian);
        $('#modalDelete').find('input[name=users_id]').val(obj.dataset.id);
    }
</script>