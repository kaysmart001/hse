<style>
    .hide { display: none }
    /* The snackbar - position it at the bottom and in the middle of the screen */
    #snackbar {
      visibility: hidden; /* Hidden by default. Visible on click */
      min-width: 250px; /* Set a default minimum width */
      margin-left: -125px; /* Divide value of min-width by 2 */
      background-color: #333; /* Black background color */
      color: #fff; /* White text color */
      text-align: center; /* Centered text */
      border-radius: 2px; /* Rounded borders */
      padding: 16px; /* Padding */
      position: fixed; /* Sit on top of the screen */
      z-index: 1100; /* Add a z-index if needed */
      left: 50%; /* Center the snackbar */
      bottom: 30px; /* 30px from the bottom */
    }

    /* Show the snackbar when clicking on a button (class added with JavaScript) */
    #snackbar.show {
      visibility: visible; /* Show the snackbar */
      /* Add animation: Take 0.5 seconds to fade in and out the snackbar.
      However, delay the fade out process for 2.5 seconds */
      -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
      animation: fadein 0.5s, fadeout 0.5s 2.5s;
    }
    .show.success { background-color: #48b1bf !important; }
    .show.error { background-color: #bf4848 !important; }

    /* Animations to fade the snackbar in and out */
    @-webkit-keyframes fadein {
      from {bottom: 0; opacity: 0;}
      to {bottom: 30px; opacity: 1;}
    }

    @keyframes fadein {
      from {bottom: 0; opacity: 0;}
      to {bottom: 30px; opacity: 1;}
    }

    @-webkit-keyframes fadeout {
      from {bottom: 30px; opacity: 1;}
      to {bottom: 0; opacity: 0;}
    }

    @keyframes fadeout {
      from {bottom: 30px; opacity: 1;}
      to {bottom: 0; opacity: 0;}
    }
</style>
<section class="page-section portfolio mt-4" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="<?php echo base_url(); ?>cbt/ujian"><i class="fa fa-angle-left"></i>&nbsp;Kembali</a>
            </div>
            <div class="col-md-8">
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0"><?php echo $data['ujian_judul']; ?></h2>
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
            </div>
            <div class="col-md-2">
                <div id="sisa-waktu" class="pull-right label label-warning" style="font-size: 14px;"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <?php Flash::flash_message(); ?>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Soal No <span id="soal_ke"><?php echo $data['us_order']; ?></span></h3>
                    </div>
                    <div class="panel-body">
                        <form id="form-ujian">
                            <div id="body-soal"><?php echo $data['data_soal']; ?></div>
                            <input 
                                type="hidden" 
                                name="ujian_id" 
                                id="ujian_id" 
                                value="<?php if(!empty($data['ujian_id'])) { echo $data['ujian_id']; } ?>" />
                            <input 
                                type="hidden" 
                                name="users_id" 
                                id="users_id" 
                                value="<?php if(!empty($data['users_id'])) { echo $data['users_id']; } ?>" />
                            <input 
                                type="hidden" 
                                name="us_id" 
                                id="us_id" 
                                value="<?php if(!empty($data['us_id'])) { echo $data['us_id']; } ?>" />
                            <input 
                                type="hidden" 
                                name="us_ragu" 
                                id="us_ragu" 
                                value="<?php if(!empty($data['us_ragu'])) { echo $data['us_ragu']; } ?>" />
                            <input 
                                type="hidden" 
                                name="us_order" 
                                id="us_order" 
                                value="<?php if(!empty($data['us_order'])) { echo $data['us_order']; } ?>" />
                            <input 
                                type="hidden" 
                                name="ujian_total_soal" 
                                id="ujian_total_soal" 
                                value="<?php if(!empty($data['total_soal'])) { echo $data['total_soal']; } ?>" />

                            <hr>
                        </form>
                        <div class="form-group mb-3">
                            <button type="button" class="btn btn-default btn-outline hide br-30" id="btn-before"><i class="fa fa-angle-left"></i>&nbsp; Back</button>
                            <?php if($data['total_soal'] > 1) { ?>
                                <button type="button" class="btn btn-default btn-outline br-30" id="btn-next">Next Questions &nbsp;<i class="fa fa-angle-right"></i></button>
                            <?php } else { ?>
                                <button class="btn btn-default btn-outline br-30">Stop Exam</button>
                            <?php } ?>
                            <button class="btn btn-default btn-outline br-30 hide" id="btn-stop">Stop Ujian</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="form-group mt-4">
                            <?php echo $data['list_soal']; ?>
                            <p class="text-muted"><small>Soal yang sudah dijawab akan berwarna hijau.</small></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="modalProses" data-backdrop="static">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-body">
                    <div style="text-align: center;">
                        <i class="fa fa-spinner fa-spin fa-3x"></i> <br />Loading...
                    </div>
                    <br />
                    <p class="text-center">Notes : Refresh page if wait too long.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal" id="modal-stop">
    <form id="form-finish">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Selesai</h4>
                </div>
                <div class="modal-body" >
                    <div class="row-fluid">
                        <div class="box-body">
                            <div id="form-pesan"></div>
                            <div class="alert alert-warning">
                                <p><strong>Anda yakin akan mengakhiri ujian ini ?</strong>
                                    <br />Semua jawaban ujian tidak dapat dirubah kembali.
                                </p>
                            </div>
                            <div class="form-group">
                                <label>Judul Ujian</label>
                                <input type="hidden" name="ujian_id" id="ujian_id" >
                                <input type="hidden" name="users_id" id="users_id" >
                                <input type="hidden" name="group_kelas" id="group_kelas">
                                <input type="text" class="form-control" id="ujian_judul" name="ujian_judul" readonly>
                            </div>

                            <div class="form-group">
                                <label>Info Soal</label>
                                <input type="text" class="form-control" id="stop-dijawab" name="stop-dijawab" readonly>
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label style="width: 100%">
                                        <input type="checkbox" id="checkbox-stop" name="checkbox-stop" value="1"> Ya, saya yakin.
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Tidak</a>
                    <button type="submit" id="tambah-simpan" class="btn btn-primary">Ya, berhenti.</button>
                </div>
            </div>
        </div>
    </form>
</div>

<div id="snackbar"></div>
<script type="text/javascript">
    $(function () {
        // Countdown
        let secondRemaining = <?php if(!empty($data['second_remaining'])) { echo $data['second_remaining']; } ?>;
        const countdownEl = document.getElementById('sisa-waktu');
        setInterval(updateCountdown, 1000);
        function updateCountdown() {
            let minutes = Math.floor(secondRemaining / 60);
            let seconds = secondRemaining % 60;

            seconds = seconds < 10 ? '0' + seconds : seconds;
            minutes = minutes < 10 ? '0' + minutes : minutes;
            countdownEl.innerHTML = `<i class="fa fa-clock"></i> ${minutes}:${seconds} `;
            if (minutes < 1 && seconds < 1) {
                update_ujian_waktuhabis();
            }
            secondRemaining--;
        }

        // Next
        $('#btn-next').click(function() {
            next_soal(1);
        });
        // Back
        $('#btn-before').click(function() {
            next_soal(-1);
        });
        // Stop
        $('#btn-stop').click(function() {
            stop_ujian();
        });

        // Form Save
        $('#form-ujian').submit(function() {
            $("#modalProses").modal('show');
            $.ajax({
                    url:"<?php echo base_url(); ?>cbt/simpan_jawaban",
                    type:"POST",
                    data:$('#form-ujian').serialize(),
                    cache: false,
                    timeout: 10000,
                    success:function(response) {
                        var obj = $.parseJSON(response);
                        if(obj.status == 200) {
                            $("#modalProses").modal('hide');
                            notify_success(obj.message);
                            $('#btn-soal-'+obj.us_order).removeClass('btn-default');
                            $('#btn-soal-'+obj.us_order).addClass('btn-primary');
                        }else if(obj.status == 500) {
                            window.location.reload();
                        }else{
                            $("#modalProses").modal('hide');
                            notify_error(obj.message);
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        if(textstatus==="timeout") {
                            $("#modalProses").modal('hide');
                            notify_error("Failed to saved answer, please refresh this page");
                        }else{
                            $("#modalProses").modal('hide');
                            notify_error(textstatus);
                        }
                    }
            });
            return false;
        });

        // Form Finish
        $('#form-finish').submit(function() {
            $("#modalProses").modal('show');
            $.ajax({
                    url:"<?php echo base_url(); ?>cbt/finish",
                    type:"POST",
                    data:$('#form-finish').serialize(),
                    timeout: 10000,
                    success:function(response) {
                        var obj = $.parseJSON(response);
                        if (obj.status == 200) {
                            window.location.href = '<?php echo base_url(); ?>cbt/ujian';
                        } else {
                            $("#modalProses").modal('hide');
                            notify_error(obj.message);
                        }
                    },
                    error: function(xmlhttprequest, textstatus, message) {
                        if (textstatus === "timeout") {
                            $("#modalProses").modal('hide');
                            notify_error("Gagal menyimpan ujian ini, silahkan refresh kembali halaman.");
                        } else {
                            $("#modalProses").modal('hide');
                            notify_error(textstatus);
                        }
                    }
            });

            return false;
        });
    });

    function soal(id) {
        $('#modalProses').modal('show');
        $.ajax({
            url:'<?php echo base_url(); ?>cbt/get_soal_by/'+id+'/'+$('#users_id').val(),
            type:"POST",
            cache: false,
            timeout: 10000,
            success:function(response) {
                var data = $.parseJSON(response)
                if(data.data==1) {
                    $('#us_id').val(data.us_soal);
                    $('#us_order').val(data.soal_no);
                    $('#soal_ke').html(data.soal_no);
                    $('#body-soal').html(data.ujian_soal);
                    $('#us_ragu').val(data.us_ragu);

                    // menghilangkan tombol sebelum jika soal di nomor1
                    // dan menghilangkan tombol selanjutnya jika disoal terakhir
                    var soal_no = parseInt($('#us_order').val());
                    var total_soal = parseInt($('#ujian_total_soal').val());
                    var soal_selanjutnya = data.soal_no;
                    if(soal_selanjutnya==1) {
                        $('#btn-before').addClass('hide');
                        $('#btn-next').removeClass('hide');
                    }else if(soal_selanjutnya==total_soal) {
                        $('#btn-before').removeClass('hide');
                        $('#btn-next').addClass('hide');
                        $('#btn-stop').removeClass('hide');
                    }else{
                        $('#btn-before').removeClass('hide');
                        $('#btn-next').removeClass('hide');
                    }
                }else if(data.data==2) {
                    update_ujian_waktuhabis();
                }
                $("#modalProses").modal('hide');
            }
        });
    }

    function jawaban() {
        $('#form-ujian').submit();
    }

    function next_soal(navigasi) {
        var us_order = parseInt($('#us_order').val());
        var ujian_total_soal = parseInt($('#ujian_total_soal').val());
        var us_next = us_order + navigasi;

        if((us_next >= 1 && us_next <= ujian_total_soal)) {
            $('#btn-soal-'+us_next).trigger('click');
        }
    }

    function stop_ujian() {
        $("#modalProses").modal('show');
        $('#checkbox-stop').prop("checked", false);
        $.ajax({
            url: '<?php echo base_url(); ?>cbt/get_info_ujian/',
            method: 'post',
            data: { ujian_id: $('#ujian_id').val() },
            dataType: 'json', 
            success: function(data) {
                if (data.data == 1) {
                    const modal = $("#modal-stop");
                    modal.modal('show');
                    modal.find('input[name=ujian_id]').val(data.ujian_id);
                    modal.find('input[name=users_id]').val(data.users_id);
                    $('#ujian_judul').val(data.ujian_judul);
                    $('#stop-dijawab').val(data.soal_terjawab+" terjawab. "+data.soal_tidakterjawab+" tidak terjawab.");
                    $('#group_kelas').val(data.ujian_kelas);
                } else {
                    notify_error('data tidak didapat');
                }
                $("#modalProses").modal('hide');
            }
        });
    }

    function update_ujian_waktuhabis() {
        const users_id = $('#users_id').val()

        $.ajax({
            url: '<?php echo base_url(); ?>cbt/simpan_jawaban_waktuhabis',
            method: 'POST',
            data: { users_id: users_id },
            dataType: 'json',
            success: function(data) {
                if (data.status == 200) {
                    window.location.reload()
                } else {
                    notify_error('Ada masalah saat update.');
                }
            }
        });
    }

    function notify_error(message) {
        let el = document.getElementById('snackbar');
        el.innerHTML = `<h4><i class="fa fa-warning"></i> Error!</h4><p>${message}</p>`;
        el.className = 'show error';
        setTimeout(function() { el.className = el.className.replace('show', ''); }, 3000);
        return el;
    }
    function notify_success(message) {
        let el = document.getElementById('snackbar');
        el.innerHTML = `<h4><i class="fa fa-check-square"></i> Success!</h4><p>${message}</p>`;
        el.className = 'show success';
        setTimeout(function() { el.className = el.className.replace('show', ''); }, 3000);
        return el;
    }
</script>