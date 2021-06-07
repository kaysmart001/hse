<?php if ($_SESSION['role'] == 1) { ?>
<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1><i class="fa fa-home fa-fw"></i> Form Tambah Siswa</h1>
				<ol class="breadcrumb">
	                <li class="active">
	                    <i class="fa fa-dashboard"></i> Dashboard
	                </li>
                    <li><a href="<?php echo base_url(); ?>siswa">Siswa</a></li>
                    <li>Form Tambah</li>
                </ol>
			</div>
		</div>
<?php } else { ?>
<section class="page-section portfolio mt-4" id="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <a href="<?php echo base_url(); ?>siswa"><i class="fa fa-angle-left"></i>&nbsp;Kembali</a>
            </div>
            <div class="col-md-8">
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Tambah Siswa</h2>
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
			<div class="col-md-12"><?php Flash::flash_message(); ?></div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-3">
				<form action="<?php echo base_url(); ?>siswa/add_update" method="post" enctype="multipart/form-data" style="width: 100%">
				<img src="<?php echo base_url(); ?>uploads/profile/user-default.png" alt="" class="img-responsive thumbnail" width="100%">
				<input type="file" name="siswa_foto" value="">
				<p><small><i>Maks. ukuran foto: 10mb</i></small></p>
			</div>
			<div class="col-md-9">
				<div class="form-group">
					<label for="">Username</label>
					<input type="text" name="username" class="form-control" placeholder="Username" required>
				</div>
				<div class="form-group">
					<label for="">Email</label>
					<input type="email" name="email" class="form-control" placeholder="Email" required>
				</div>
				<div class="form-group">
					<label for="">Password</label>
					<input type="password" name="password" class="form-control" placeholder="Password" required>
				</div>
				<hr>
				<div class="form-group">
					<label>NIS</label>
					<input type="text" name="siswa_nis" class="form-control" placeholder="NIS" required>
				</div>
				<div class="row">
					<div class="col-md-8">
						<div class="form-group">
							<label>Nama Lengkap</label>
							<input type="text" name="siswa_nama" class="form-control" placeholder="Nama Lengkap" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Nama Panggilan</label>
							<input type="text" name="siswa_nama_panggilan" class="form-control" placeholder="Nama Panggilan" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Tempat Lahir</label>
							<input type="text" name="siswa_tmp_lahir" class="form-control" placeholder="Tempat Lahir" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Tanggal Lahir</label>
							<input type="date" name="siswa_tgl_lahir" class="form-control" placeholder="Tanggal Lahir" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Jenis Kelamin</label>
							<div class="radio">
							 	<label class="radio-inline" style="width: auto; margin-right: 20px;"><input type="radio" name="siswa_jenis_kelamin" id="laki" value="1">Laki-Laki</label>
								<label class="radio-inline" style="width: auto; margin-right: 20px;"><input type="radio" name="siswa_jenis_kelamin" id="perempuan" value="2">Perempuan</label>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Agama</label>
							<input type="text" name="siswa_agama" class="form-control" placeholder="Agama" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Anak ke</label>
							<input type="text" name="siswa_anak_ke" class="form-control" placeholder="Anak ke" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Jenjang Pendidikan Terakhir</label>
							<input type="text" name="siswa_jenjang_terakhir" class="form-control" placeholder="Jenjang Pendidikan Terakhir" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>No.Handphone</label>
							<input type="text" name="siswa_nohp" class="form-control" placeholder="No.Handphone" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Golongan Darah</label>
							<input type="text" name="siswa_gol_darah" class="form-control" placeholder="Golongan Darah" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Hobi/Minat</label>
							<input type="text" name="siswa_hobi" class="form-control" placeholder="Hobi Minat" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<textarea name="siswa_alamat" id="" cols="30" rows="3" class="form-control" placeholder="Alamat" required></textarea>
				</div>
				<br>
				<div class="form-group">
					<label>BIODATA ORANGTUA</label>
				</div>
				<div class="form-group">
					<label>Nama Ayah</label>
					<input type="text" name="siswa_nama_ayah" class="form-control" placeholder="Nama Ayah" required>
				</div>
				<div class="form-group">
					<label>Pekerjaan Ayah</label>
					<input type="text" name="siswa_pekerjaan_ayah" class="form-control" placeholder="Pekerjaan Ayah" required>
				</div>
				<div class="form-group">
					<label>Pendidikan Terakhir Ayah</label>
					<input type="text" name="siswa_pend_terakhir_ayah" class="form-control" placeholder="Pendidikan Terakhir Ayah" required>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>No.Handphone/Wa Ayah</label>
							<input type="text" name="siswa_nohp_ayah" class="form-control" placeholder="No.Handphone/Wa Ayah" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Email Ayah</label>
							<input type="text" name="siswa_email_ayah" class="form-control" placeholder="Email Ayah" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Penghasilan Ayah (/bulan)</label>
					<input type="text" name="siswa_penghasilan_ayah" class="form-control" placeholder="Penghasilan Ayah (/bulan)" required>
				</div>

				<br>
				<div class="form-group">
					<label>Nama Ibu</label>
					<input type="text" name="siswa_nama_ibu" class="form-control" placeholder="Nama Ibu" required>
				</div>
				<div class="form-group">
					<label>Pekerjaan Ibu</label>
					<input type="text" name="siswa_pekerjaan_ibu" class="form-control" placeholder="Pekerjaan Ibu" required>
				</div>
				<div class="form-group">
					<label>Pendidikan Terakhir Ibu</label>
					<input type="text" name="siswa_pend_terakhir_ibu" class="form-control" placeholder="Pendidikan Terakhir Ibu" required>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>No.Handphone/WA Ibu</label>
							<input type="text" name="siswa_nohp_ibu" class="form-control" placeholder="No.Handphone/WA Ibu" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Email Ibu</label>
							<input type="text" name="siswa_email_ibu" class="form-control" placeholder="Email Ibu" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Penghasilan Ibu (/bulan)</label>
					<input type="text" name="siswa_penghasilan_ibu" class="form-control" placeholder="Penghasilan Ibu (/bulan)" required>
				</div>
				<div class="form-group">
					<label>Alamat Ortu</label>
					<textarea name="siswa_alamat_ortu" id="" cols="30" rows="3" class="form-control" placeholder="Alamat Ortu" required></textarea>
				</div>
				
				<div class="form-group">
					<label>Nama Wali</label>
					<input type="text" name="siswa_nama_wali" class="form-control" placeholder="Nama Wali" required>
				</div>
				<div class="form-group">
					<label>No. Handphone Wali</label>
					<input type="text" name="siswa_nohp_wali" class="form-control" placeholder="No. Handphone Wali" required>
				</div>
				<div class="form-group">
					<label>Alamat Wali</label>
					<textarea name="siswa_alamat_wali" id="" cols="30" rows="3" class="form-control" placeholder="Alamat Wali" required></textarea>
				</div>
				<div class="form-group">
					<label>Pekerjaan Wali</label>
					<input type="text" name="siswa_pekerjaan_wali" class="form-control" placeholder="Pekerjaan Wali" required>
				</div>
				<hr>
				<div class="form-group">
					<label>Siswa Jenjang</label>
					<select name="siswa_jenjang" class="form-control" id="">
						<option value="">Pilih Jenjang</option>
						<?php foreach($data['jenjang'] as $key => $jenjang) : ?>
							<option value="<?php echo $jenjang['jenjang_id']; ?>" <?php echo (isset($data['siswa']->siswa_jenjang) ? ($data['siswa']->siswa_jenjang == $jenjang['jenjang_id'] ?  'selected' : '') : '' ); ?>><?php echo $jenjang['jenjang_nama']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label>Siswa Kelas</label>
					<select name="siswa_kelas" class="form-control" id="">
						<option value="">Pilih Kelas</option>
						<?php foreach($data['kelas'] as $key => $kelas) : ?>
							<option value="<?php echo $kelas['kelas_id']; ?>" <?php echo (isset($data['siswa']->siswa_kelas) ? ($data['siswa']->siswa_kelas == $kelas['kelas_id'] ?  'selected' : '') : '' ); ?>><?php echo $kelas['kelas_nama']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label>Semester</label>
					<input type="text" name="siswa_semester" class="form-control" placeholder="Semester" required>
				</div>
				<hr>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Simpan">
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