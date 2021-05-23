<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<?php if ($_SESSION['role'] == 1) { ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1><i class="fa fa-home fa-fw"></i> Data Jawaban (CBT)</h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                    <li><a href="<?php echo base_url(); ?>cbt/soal">Soal</a></li>
                    <li>Data Jawaban (<?php echo (($data['soal']) ? $data['soal']->soal_detail : '-'); ?>)</li>
                </ol>
            </div>
        </div>
<?php } else { ?>
<section class="page-section portfolio mt-4" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="<?php echo base_url(); ?>cbt/soal"><i class="fa fa-angle-left"></i>&nbsp;Kembali</a>
            </div>
            <div class="col-md-8">
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Jawaban</h2>
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
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Manajemen Jawaban</div>
                    <div class="panel-body">
                        <form action="<?php echo base_url(); ?>cbt/cud_jawaban" method="post">
                            <div class="form-group well">
                                <label for="">Soal</label>
                                <?php if (!is_null($data['soal']->soal_gambar)) : ?>
                                    <div class="form-group"><img src="<?php echo base_url(); ?>uploads/soal/<?php echo $data['soal']->soal_gambar; ?>" alt="" style="width: auto;height: 430px;object-fit: cover;"></div>
                                <?php endif; ?>
                                <p><?php echo (($data['soal']) ? $data['soal']->soal_detail : '-'); ?></p>
                                <input type="hidden" name="jawaban_soal" value="<?php echo (($data['soal']) ? $data['soal']->soal_id : '-'); ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Detail Jawaban</label>
                                <textarea name="jawaban_detail" class="form-control" rows="3" placeholder="Detail Jawaban"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Benar / Salah</label>
                                <div class="radio">
                                    <label class="radio-inline">
                                        <input id="type" type="radio" class="true-false" name="jawaban_benar" value="1" required="">Benar
                                    </label>
                                    <label class="radio-inline">
                                        <input id="type" type="radio" class="true-false" name="jawaban_benar" value="0" required="">Salah
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-default">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php Flash::flash_message(); ?>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">List Jawaban Dari Soal - <?php echo (($data['soal']) ? $data['soal']->soal_detail : '-'); ?></div>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="tblJawaban" class="table table-borered table-hover">
                                <thead>
                                    <tr>
                                        <th style="max-width: 30px;">No</th>
                                        <th>Jawaban</th>
                                        <th>Benar/Salah</th>
                                        <?php if ($_SESSION['role'] != 3) : ?>
                                        <th>Actions</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($data['jawaban'] as $key => $jawaban) : ?>
                                        <tr>
                                            <td><?php echo $key + 1; ?></td>
                                            <td><?php echo $jawaban['jawaban_detail']; ?></td>
                                            <td><?php echo ($jawaban['jawaban_benar'] == 1 ? '<span class="badge bg-success">Benar</span>' : '<span class="badge bg-default">Salah</span>'); ?></td>
                                            <td>
                                                <button 
                                                    class="btn btn-default btn-xs" 
                                                    data-id="<?php echo $jawaban['jawaban_id']; ?>" 
                                                    data-detail="<?php echo $jawaban['jawaban_detail']; ?>" 
                                                    data-benar="<?php echo $jawaban['jawaban_benar']; ?>"
                                                    onclick="edit(this)">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button class="btn btn-default btn-xs" data-id="<?php echo $jawaban['jawaban_id']; ?>" onclick="hapus(this)"><i class="fa fa-trash"></i></button>
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

<?php if ($_SESSION['role'] != 3) { ?>
<!-- Modal Edit -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Edit Jawaban</h4>
      </div>
      <form action="<?php echo base_url(); ?>cbt/cud_jawaban" method="post">
      <div class="modal-body">
        <div class="form-group">
            <label for="">Jawaban</label>
            <textarea name="jawaban_detail" class="form-control" rows="4" placeholder="Contoh: 10 * 100 = ?"></textarea>
            <input type="hidden" name="jawaban_id">
            <input type="hidden" name="jawaban_soal" value="<?php echo (($data['soal']) ? $data['soal']->soal_id : '-'); ?>">
        </div>
        <div class="form-group">
            <label for="">Benar / Salah</label>
            <div class="radio">
                <label for="" class="radio-inline">
                    <input id="jawaban_true" type="radio" class="true-false" name="jawaban_benar" value="1" required="">Benar
                </label>
                <label for="" class="radio-inline">
                    <input id="jawaban_false" type="radio" class="true-false" name="jawaban_benar" value="0" required="">Salah
                </label>
            </div>
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
        <h4 class="modal-title">Delete Jawaban</h4>
      </div>
      <form action="<?php echo base_url(); ?>cbt/cud_jawaban" method="post">
      <div class="modal-body">
        <div class="form-group">
            <h4 class="text-center">Anda yakin akan menghapus jawaban ini?</h4>
            <input type="hidden" name="jawaban_id_delete">
            <input type="hidden" name="jawaban_soal" value="<?php echo (($data['soal']) ? $data['soal']->soal_id : '-'); ?>">
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
        $('#tblJawaban').DataTable();
        $('[data-toggle="tooltip"]').tooltip();
    });

    function edit(obj) {
        const { id, detail, benar } = obj.dataset
        const modal = $('#modalEdit').modal('show');

        modal.find('input[name=jawaban_id]').val(id);
        modal.find('textarea[name=jawaban_detail]').text(detail);
        modal.find('input:radio[name=jawaban_benar]').filter(`[value=${benar}]`).attr('checked', true);
    }

    function hapus(obj) {
        $('#modalDelete').modal('show');
        $('#modalDelete').find('input[name=jawaban_id_delete]').val(obj.dataset.id);
    }
</script>