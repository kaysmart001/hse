<link rel="icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon.png" />
<script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
<link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/css/styles.css" rel="stylesheet" />
<style type="text/css">
    .line-print { visibility: hidden; }
    @media print {
        .form-control { border: none; }
        .divider-custom { display: none; }
        .line-print { visibility: visible; }
    }
</style>
<div id="page-wrapper">
    <div class="container-fluid">
        <section class="page-section portfolio" id="portfolio">
            <div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Hasil Ujian</h2>
                        <div class="divider-custom">
                            <div class="divider-custom-line"></div>
                            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                            <div class="divider-custom-line"></div>
                        </div>
                        <hr class="line-print">
                    </div>
                    <div class="col-md-2 text-right"></div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">Detail Hasil Ujian - <?php echo $data['ujian_judul']; ?></div>
                            <div class="panel-body">
                                <table width="100%" cellpadding="10">
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label for="">Nama</label>
                                                <input type="text" class="form-control input-sm" value="<?php echo $data['siswa_nama']; ?>" disabled>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label for="">Nilai</label>
                                                <input type="text class" class="form-control input-sm" value="<?php echo $data['nilai']; ?>" disabled>
                                                <input type="hidden" id="users_id" name="users_id" value="<?php echo $data['users_id']; ?>">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label for="">Judul Ujian</label>
                                                <input type="text" class="form-control input-sm" value="<?php echo $data['ujian_judul']; ?>" disabled>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label for="">Jawaban Benar</label>
                                                <input type="text class" class="form-control input-sm" value="<?php echo $data['benar']; ?>" disabled>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label for="">Ujian Dikerjakan pada</label>
                                                <input type="text" class="form-control input-sm" value="<?php echo $data['ujian_dikerjakan']; ?>" disabled>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-group">
                                                <label for="">Nilai Akhir</label>
                                                <input type="text class" class="form-control input-sm" value="<?php echo $data['nilai_akhir']; ?>" disabled>
                                            </div>
                                        </td>
                                    </tr>
                                </table>

                            </div>
                        </div>
                        <div class="panel-default">
                            <div class="panel-heading">Detail Jawaban</div>
                            <div class="panel-body">
                                <?php foreach($data['aaData'] as $key => $hasil) {
                                    foreach ($hasil as $key => $value) {
                                        echo $value;
                                    }
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<script>window.print();</script>