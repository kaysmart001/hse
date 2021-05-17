<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<?php if ($_SESSION['role'] == 1) { ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1><i class="fa fa-home fa-fw"></i> Data Export Soal (CBT)</h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                    <li><a href="<?php echo base_url(); ?>cbt/soal">Soal</a></li>
                    <li>Data Export Soal</li>
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
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Export Soal</h2>
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
                    <div class="panel-heading">Export Soal (Excel)</div>
                    <div class="panel-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="">Topik Ujian</label>
                                        <select name="topik_id" id="" class="form-control">
                                            <option value="">Pilih Topik</option>
                                            <?php foreach($data['topik'] as $key => $topik) : ?>
                                                <option value="<?php echo $topik['topik_id']; ?>"><?php echo $topik['topik_judul']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label for="">File Excel</label>
                                        <input type="file" name="excel_soal" class="form-control" style="border: none;">
                                    </div>
                                    <div class="form-group">
                                        <label for=""></label>
                                        <div class="alert alert-warning" role="alert">
                                            <strong>Informasi</strong>
                                            <p>File format : xls, xlsx</p>
                                            <p>Soal yang dapat diimport hanya soal bertipe pilihan ganda, karena memiliki relasi terhadap jawaban yang akan dicek otomatis. Tidak bisa import soal dalam bentuk gambar maupun audio.</p>
                                            <p>Silahkan gunakan contoh template di bawah berikut : </p>
                                            <strong><a href="<?php echo base_url(); ?>uploads/public/template_soal_hse.xls"><i class="fa fa-file"></i>&nbsp; Template File Soal</a></strong>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-default">Batal</button>
                                        <button type="submit" class="btn btn-primary">Upload</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if ($_SESSION['role'] == 1) { ?>
    </div>
<?php } else { ?>
</section>
<?php } ?>