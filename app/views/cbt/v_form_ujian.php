<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/daterangepicker.css">
<?php if ($_SESSION['role'] == 1) { ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h1><i class="fa fa-home fa-fw"></i> Form Ujian (CBT)</h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Dashboard
                    </li>
                    <li><a href="<?php echo base_url(); ?>cbt/ujian">Ujian</a></li>
                    <li>Form Ujian</li>
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
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Form Ujian</h2>
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
                    <div class="panel-heading">Form Pembuatan Ujian</div>
                    <div class="panel-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Judul Ujian</label>
                                        <input type="text" name="ujian_judul" class="form-control" value="<?php echo (isset($data['ujian']->ujian_judul) ? $data['ujian']->ujian_judul : ''); ?>" placeholder="Judul Ujian" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Deksripsi</label>
                                        <textarea name="ujian_deskripsi" rows="4" class="form-control" placeholder="Deskripsi Ujian" required=""><?php echo (isset($data['ujian']->ujian_deskripsi) ? $data['ujian']->ujian_deskripsi : ''); ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Kelas</label>
                                        <select name="group_kelas" class="form-control" required="">
                                            <option value="">Pilih Kelas</option>
                                            <?php foreach($data['kelas'] as $key => $kelas) : ?>
                                                <option value="<?php echo $kelas['kelas_id']; ?>" <?php echo (isset($data['ujian']->group_kelas) ? ($data['ujian']->group_kelas == $kelas['kelas_id'] ? 'selected' : '') : ''); ?>><?php echo $kelas['kelas_nama']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Soal Ujian</label>
                                        <select name="ut_topik" id="ut_topik" class="form-control" required="">
                                            <option value="">Pilih Soal</option>
                                            <?php foreach($data['topik'] as $key => $topik) : ?>
                                                <option value="<?php echo $topik['topik_id']; ?>" data-tsoal="<?php echo $topik['total_soal']; ?>" <?php echo (isset($data['ujian']->ut_topik) ? ($data['ujian']->ut_topik == $topik['topik_id'] ? 'selected' : '') : ''); ?>><?php echo $topik['topik_judul']; ?> (<?php echo $topik['total_soal'] . ' soal'; ?>)</option>
                                            <?php endforeach; ?>
                                        </select>
                                        <input type="hidden" name="ut_total_soal" value="<?php echo (isset($data['ujian']->ut_total_soal) ? $data['ujian']->ut_total_soal : ''); ?>">
                                        <input type="hidden" name="ut_total_jawaban" value="<?php echo (isset($data['ujian']->ut_total_jawaban) ? $data['ujian']->ut_total_jawaban : ''); ?>">
                                        <input type="hidden" name="ut_soal_acak" value="1">
                                        <input type="hidden" name="ut_jawaban_acak" value="1">

                                        <?php if (isset($data['ujian'])) : ?>
                                        <input type="hidden" name="ujian_id" value="<?php echo (isset($data['ujian']->ujian_id) ? $data['ujian']->ujian_id : ''); ?>">
                                        <input type="hidden" name="group_ujian" value="<?php echo (isset($data['ujian']->group_ujian) ? $data['ujian']->group_ujian : ''); ?>">
                                        <input type="hidden" name="ut_id" value="<?php echo (isset($data['ujian']->ut_id) ? $data['ujian']->ut_id : ''); ?>">
                                        <input type="hidden" name="ut_ujian" value="<?php echo (isset($data['ujian']->ut_ujian) ? $data['ujian']->ut_ujian : ''); ?>">
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Range Tanggal & Waktu Ujian</label>
                                        <input type="text" name="ujian_startend_date" class="form-control datepicker" placeholder="Range Tanggal & Waktu" required="">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Durasi Ujian</label>
                                        <input type="text" name="ujian_durasi" class="form-control" value="<?php echo (isset($data['ujian']->ujian_durasi) ? $data['ujian']->ujian_durasi : ''); ?>" placeholder="Durasi Ujian" required="">
                                        <span><small>Hanya angka saja</small></span>

                                        <input type="hidden" name="ujian_nilai_benar" id="ujian_nilai_benar" class="form-control" value="1.00">
                                        <input type="hidden" name="ujian_nilai_salah" id="ujian_nilai_salah" class="form-control" value="0.00">
                                        <input type="hidden" name="ujian_nilai_kosong" id="ujian_nilai_kosong" class="form-control" value="0.00">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Status Ujian</label>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="ujian_status" id="ujian_status_active" value="1" <?php echo (isset($data['ujian']->ujian_status) ? ($data['ujian']->ujian_status > 0 ? 'checked' : '') : ''); ?>>
                                                Aktif
                                            </label>
                                            &nbsp;
                                            <label>
                                                <input type="radio" name="ujian_status" id="ujian_status_deactive" value="0" <?php echo (isset($data['ujian']->ujian_status) ? ($data['ujian']->ujian_status == 0 ? 'checked' : '') : ''); ?>>
                                                Non Aktif
                                            </label>
                                        </div>
                                    </div>
                                    <?php if ($_SESSION['role'] == 1) : ?>
                                        <div class="form-group">
                                            <label for="">Pilih Guru</label>
                                            <select name="ujian_pembuat" id="" class="form-control" required="">
                                                <option value="">Pilih Guru Jenjang</option>
                                                <?php foreach($data['guru'] as $key => $guru) : ?>
                                                    <option value="<?php echo $guru['id']; ?>" <?php echo (isset($data['ujian']->ujian_pembuat) ? ($data['ujian']->ujian_pembuat == $guru['guru_uid'] ? 'selected' : '') : ''); ?>><?php echo $guru['guru_nama']; ?> (<?php echo $guru['jenjang_nama']; ?>)</option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                </div>
                                <div class="col-md-12">
                                    <button type="button" class="btn btn-default">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
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

<?php if ($_SESSION['role'] != 3) : ?>
<script src="<?php echo base_url(); ?>assets/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/daterangepicker.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.datepicker').daterangepicker({
            timePicker: true,
            <?php if (isset($data["ujian"]->ujian_waktu_mulai)) { ?>
                startDate: '<?php echo $data['ujian']->ujian_waktu_mulai; ?>',
            <?php } else { ?>
                startDate: moment().startOf('hour'),
            <?php } ?>

            <?php if (isset($data["ujian"]->ujian_waktu_mulai)) { ?>
                endDate: '<?php echo $data['ujian']->ujian_waktu_akhir; ?>',
            <?php } else { ?>
                endDate: moment().startOf('hour').add(32, 'hour'),
            <?php } ?>
            timePicker24Hour: true,
            locale: {
              format: 'YYYY-MM-DD H:mm:ss'
            }
        });

        $('#ut_topik').on('change', function() {
            const topik_id = $(this).val();
            const total_soal = $(this).find(':selected').data('tsoal');

            $.ajax({
                url: '<?php echo base_url(); ?>cbt/get_total_jawaban',
                method: 'post',
                data: { topik_id: topik_id },
                dataType: 'json',
                success: function(d) {
                    $('input[name=ut_total_soal]').val(total_soal);
                    $('input[name=ut_total_jawaban]').val(d.total);
                }
            });
        });
    })
</script>
<?php endif; ?>