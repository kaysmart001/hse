<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<?php if ($_SESSION['role'] == 1) { ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1><i class="fa fa-home fa-fw"></i> Result Ujian (CBT)</h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                    <li><a href="<?php echo base_url(); ?>cbt/ujian">Ujian</a></li>
                    <li><a href="<?php echo base_url(); ?>cbt/detail_ujian/<?php echo $data['ujian_id']; ?>">Ujian <?php echo $data['ujian_judul']; ?></a></li>
                    <li>Result Ujian</li>
                </ol>
            </div>
        </div>
<?php } else { ?>
<section class="page-section portfolio mt-4" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <?php if ($_SESSION['role'] != 3) { ?>
                    <a href="<?php echo base_url(); ?>cbt/detail_ujian/<?php echo $data['ujian_id']; ?>"><i class="fa fa-angle-left"></i>&nbsp;Kembali</a>
                <?php } else { ?>
                    <a href="<?php echo base_url(); ?>cbt/ujian"><i class="fa fa-angle-left"></i>&nbsp;Kembali</a>
                <?php } ?>
            </div>
            <div class="col-md-8">
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Result Ujian</h2>
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
            </div>
            <div class="col-md-2 text-right">
                <a href="<?php echo base_url(); ?>cbt/print_hasil_ujian/<?php echo $data['users_id']; ?>"><i class="fa fa-print"></i>&nbsp;Print</a>
            </div>
        </div>
<?php } ?>
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Detail Hasil Ujian - <?php echo $data['ujian_judul']; ?></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nama</label>
                                    <input type="text" class="form-control input-sm" value="<?php echo $data['siswa_nama']; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Judul Ujian</label>
                                    <input type="text" class="form-control input-sm" value="<?php echo $data['ujian_judul']; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Ujian Dikerjakan pada</label>
                                    <input type="text" class="form-control input-sm" value="<?php echo $data['ujian_dikerjakan']; ?>" disabled>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Nilai</label>
                                    <input type="text class" class="form-control input-sm" value="<?php echo $data['nilai']; ?>" disabled>
                                    <input type="hidden" id="users_id" name="users_id" value="<?php echo $data['users_id']; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="">Jawaban Benar</label>
                                    <input type="text class" class="form-control input-sm" value="<?php echo $data['benar']; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="">Nilai Akhir</label>
                                    <input type="text class" class="form-control input-sm" value="<?php echo $data['nilai_akhir']; ?>" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="panel-default">
                    <div class="panel-heading">Detail Jawaban</div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php Flash::flash_message(); ?>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="table-jawaban" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Soal Tipe</th>
                                        <th>Soal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Koreksi -->
<div class="modal fade" id="modalKoreksi" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Koreksi Jawban</h4>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <div class="form-group">
            <h4 class="text-center">Anda yakin jawaban ini benar?</h4>
            <input type="hidden" name="users_id">
            <input type="hidden" name="us_id">
            <input type="hidden" name="us_nilai" value="1">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Ya, benar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Salah -->
<div class="modal fade" id="modalSalah" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Koreksi Jawban</h4>
      </div>
      <form action="" method="post">
      <div class="modal-body">
        <div class="form-group">
            <h4 class="text-center">Anda yakin jawaban ini salah?</h4>
            <input type="hidden" name="users_id">
            <input type="hidden" name="us_id">
            <input type="hidden" name="us_nilai" value="0">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-danger">Ya, yakin</button>
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
    $(function() {
        $('#table-jawaban').DataTable({
            "paging": true,
              "displayLength":10,
              "brocessing": false,
              "serverSide": true, 
              "searching": true,
              "aoColumns": [
                    {"bSearchable": false, "bSortable": false, "sWidth":"20px"},
                    {"bSearchable": false, "bSortable": false, "sWidth":"80px"},
                    {"bSearchable": false, "bSortable": false}],
              "ajax": {
                url: "<?php echo base_url(); ?>cbt/get_result_list_jawaban/",
                method: "POST",
                data: { users_id: $('#users_id').val() } },
              "autoWidth": false,
              // "fnServerParams": function ( aoData ) {
              //   aoData.push( { "name": "users_id", "value": $('#users_id').val()} );
              // }
        })
    });

    function benar(obj) {
        const users_id = obj.dataset.users;
        const us_id = obj.dataset.soal;
        const modal = $('#modalKoreksi');

        modal.modal('show');
        modal.find('input[name=users_id]').val(users_id);
        modal.find('input[name=us_id]').val(us_id);
    }

    function salah(obj) {
        const users_id = obj.dataset.users;
        const us_id = obj.dataset.soal;
        const modal = $('#modalSalah');

        modal.modal('show');
        modal.find('input[name=users_id]').val(users_id);
        modal.find('input[name=us_id]').val(us_id);
    }
</script>