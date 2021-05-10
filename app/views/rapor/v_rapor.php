<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<?php if ($_SESSION['role'] != 3) : ?>
<link href="<?php echo base_url(); ?>assets/plugins/select2/select2.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/select2/select2-bootstrap.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.min.js"></script>
<?php endif; ?>
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
<?php } else { ?>
<section class="page-section portfolio mt-4" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="<?php echo base_url(); ?>"><i class="fa fa-angle-left"></i>&nbsp;Kembali</a>
            </div>
            <div class="col-md-8">
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Rapor</h2>
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
            </div>
            <div class="col-md-2"></div>
        </div>
<?php } ?>
        <?php if ($_SESSION['role'] == 1) : ?>
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
                                <div>Data Rapor <?php echo $jenjang['jenjang_nama']; ?></div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url(); ?>rapor/<?php echo $jenjang['jenjang_id']; ?>">
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
        <?php endif; ?>
        <div class="row mb-2">
            <div class="col-md-6">
                <button id="ExportExcel" class="btn btn-sm btn-primary"><i class="fa fa-file-excel-o"></i>&nbsp;Excel</button>
                <button id="ExportPrint" class="btn btn-sm btn-primary"><i class="fa fa-print"></i>&nbsp;Print</button>
            </div>
            <?php if ($_SESSION['role'] != 3) : ?>
            <div class="col-md-6 text-right">
                <a href="" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modalAdd"><i class="fa fa-plus-circle"></i>&nbsp;Tambah Rapor</a>
            </div>
            <?php endif; ?>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php Flash::flash_message(); ?>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    <table id="tblRapor" class="table table-borered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Raport</th>
                                <?php if ($_SESSION['role'] != 3) : ?>
                                <th style="max-width: 8vw;">Actions</th>
                                <?php endif; ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data['rapor'] as $key => $rapor) : ?>
                                <tr>
                                    <td><?php echo $key + 1; ?></td>
                                    <td><?php echo $rapor['siswa_nis']; ?></td>
                                    <td><?php echo $rapor['siswa_nama']; ?></td>
                                    <td><?php echo $rapor['jenjang_nama'] . ' ' . $rapor['kelas_nama']; ?></td>
                                    <td><a href="<?php echo base_url(); ?>uploads/rapor/<?php echo $rapor['rapor_file']; ?>"><?php echo $rapor['rapor_file']; ?></a></td>
                                    <?php if ($_SESSION['role'] != 3) : ?>
                                    <td>
                                        <button class="btn btn-default btn-xs"><i class="fa fa-edit" data-id="<?php echo $rapor['rapor_id']; ?>" data-jenjang="<?php echo $rapor['jenjang_id']; ?>" data-siswa="<?php echo $rapor['siswa_id']; ?>" data-semester="<?php echo $rapor['rapor_semester']; ?>" data-file="<?php echo $rapor['rapor_file']; ?>" onclick="edit(this)"></i></button>
                                        <button class="btn btn-default btn-xs"><i class="fa fa-trash" data-id="<?php echo $rapor['rapor_id']; ?>" data-jenjang="<?php echo $rapor['jenjang_id']; ?>" onclick="hapus(this)"></i></button>
                                    </td>
                                    <?php endif; ?>
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
        <h4 class="modal-title">Tambah Rapor</h4>
      </div>
      <form action="<?php echo base_url(); ?>rapor/add_update" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="form-group">
            <label for="">Siswa</label>
            <select class="form-control select-search" name="siswa" onchange="selSiswa(this)" required="">
                <option value="">Pilih Siswa</option>
                <?php foreach($data['siswa'] as $key => $siswa) : ?>
                    <option value="<?php echo $siswa['siswa_id']; ?>" data-jenjang="<?php echo $siswa['siswa_jenjang']; ?>"><?php echo $siswa['siswa_nis'] . ' | ' . $siswa['siswa_nama']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="rapor_siswa">
            <input type="hidden" name="jenjang_id">
        </div>
        <div class="form-group">
            <label for="">Semester</label>
            <input type="text" name="rapor_semester" class="form-control" placeholder="Semester" required="">
        </div>
        <div class="form-group">
            <label for="">File Rapor</label>
            <input type="file" accept="image/png, image/jpg, image/jpeg, .pdf" name="rapor_file" required="">
            <p><small><i>Maks. ukuran file: 10mb</i></small></p>
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
        <h4 class="modal-title">Edit Rapor</h4>
      </div>
      <form action="<?php echo base_url(); ?>rapor/add_update" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <div class="form-group">
            <label for="">Siswa</label>
            <select class="form-control select-search" name="siswa" onchange="selSiswa(this)" required="">
                <option value="">Pilih Siswa</option>
                <?php foreach($data['siswa'] as $key => $siswa) : ?>
                    <option value="<?php echo $siswa['siswa_id']; ?>" data-jenjang="<?php echo $siswa['siswa_jenjang']; ?>"><?php echo $siswa['siswa_nis'] . ' | ' . $siswa['siswa_nama']; ?></option>
                <?php endforeach; ?>
            </select>
            <input type="hidden" name="rapor_siswa">
            <input type="hidden" name="jenjang_id">
            <input type="hidden" name="rapor_id">
        </div>
        <div class="form-group">
            <label for="">Semester</label>
            <input type="text" name="rapor_semester" class="form-control" placeholder="Semester" required="">
        </div>
        <div class="form-group">
            <label for="">File Rapor</label>
            <input type="file" accept="image/png, image/jpg, image/jpeg, .pdf" name="rapor_file">
            <p><small><i>Maks. ukuran file: 10mb</i></small></p>
        </div>
        <div class="form-group">
            <label for="">File Rapor Old</label>
            <input type="text" name="rapor_file_old" class="form-control" disabled="">
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
        <h4 class="modal-title">Delete Rapor</h4>
      </div>
      <form action="<?php echo base_url(); ?>rapor/delete" method="post">
      <div class="modal-body">
        <div class="form-group">
            <h4 class="text-center">Anda yakin akan menghapus rapor ini?</h4>
            <input type="hidden" id="rapor_id_delete" name="rapor_id_delete">
            <input type="hidden" id="jenjang_id" name="jenjang_id">
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
        var table = $('#tblRapor').DataTable({
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
        <?php if ($_SESSION['role'] != 3) : ?>
        $('.select-search').select2();
        <?php endif; ?>
    });
</script>

<?php if($_SESSION['role'] != 3) { ?>
<script type="text/javascript">
    function selSiswa(obj) {
        $('input[name=rapor_siswa]').val(obj.value);
        const jenjang = $('select[name=siswa]').find(':selected').attr('data-jenjang');
        $('input[name=jenjang_id]').val(jenjang);
    }
    function edit(obj) {
        const rapor_id = obj.dataset.id;
        const jenjang_id = obj.dataset.jenjang;
        const siswa_id = obj.dataset.siswa;
        const rapor_semester = obj.dataset.semester;
        const rapor_file = obj.dataset.file;

        $('#modalEdit').modal('show');
        $('#modalEdit').find('input[name=rapor_siswa]').val(siswa_id);
        $('#modalEdit').find('input[name=jenjang_id]').val(jenjang_id);
        $('#modalEdit').find('input[name=rapor_id]').val(rapor_id);
        $('.select-search').select2("val", siswa_id);
        $('#modalEdit').find('input[name=rapor_semester]').val(rapor_semester);
        $('#modalEdit').find('input[name=rapor_file_old]').val(rapor_file);
    }
    function hapus(obj) {
        $('#modalDelete').modal('show');
        $('#rapor_id_delete').val(obj.dataset.id);
        $('#jenjang_id').val(obj.dataset.jenjang);
    }
</script>
<?php } ?>