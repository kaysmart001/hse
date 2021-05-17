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
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="siswa_nama" class="form-control" placeholder="Nama" required>
				</div>
				<div class="form-group">
					<label>Tempat Lahir</label>
					<input type="text" name="siswa_tmp_lahir" class="form-control" placeholder="Tempat Lahir" required>
				</div>
				<div class="form-group">
					<label>Tanggal Lahir</label>
					<input type="date" name="siswa_tgl_lahir" class="form-control" placeholder="Tanggal Lahir" required>
				</div>
				<div class="form-group">
					<label>Jenis Kelamin</label>
					<select name="siswa_jenis_kelamin" class="form-control" id="">
						<option value="">Pilih Jenis Kelamin</option>
						<option value="1">Laki-Laki</option>
						<option value="2">Perempuan</option>
					</select>
				</div>
				<div class="form-group">
					<label>Agama</label>
					<input type="text" name="siswa_agama" class="form-control" placeholder="Agama" required>
				</div>
				<div class="form-group">
					<label>Anak ke</label>
					<input type="text" name="siswa_anak_ke" class="form-control" placeholder="Anak ke" required>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<textarea name="siswa_alamat" id="" cols="30" rows="3" class="form-control" placeholder="Alamat" required></textarea>
				</div>
				<div class="form-group">
					<label>Nama Ayah</label>
					<input type="text" name="siswa_nama_ayah" class="form-control" placeholder="Nama Ayah" required>
				</div>
				<div class="form-group">
					<label>Nama Ibu</label>
					<input type="text" name="siswa_nama_ibu" class="form-control" placeholder="Nama Ibu" required>
				</div>
				<div class="form-group">
					<label>Alamat Ortu</label>
					<textarea name="siswa_alamat_ortu" id="" cols="30" rows="3" class="form-control" placeholder="Alamat Ortu" required></textarea>
				</div>
				<div class="form-group">
					<label>No. Handphone Ortu</label>
					<input type="text" name="siswa_nohp_ortu" class="form-control" placeholder="No. Handphone Ortu" required>
				</div>
				<div class="form-group">
					<label>Pekerjaan Ayah</label>
					<input type="text" name="siswa_pekerjaan_ayah" class="form-control" placeholder="Pekerjaan Ayah" required>
				</div>
				<div class="form-group">
					<label>Pekerjaan Ibu</label>
					<input type="text" name="siswa_pekerjaan_ibu" class="form-control" placeholder="Pekerjaan Ibu" required>
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
				<div class="form-group">
					<label>Siswa Jenjang</label>
					<select name="siswa_jenjang" class="form-control" id="">
						<option value="">Pilih Jenjang</option>
						<?php foreach($data['jenjang'] as $key => $jenjang) : ?>
							<option value="<?php echo $jenjang['jenjang_id']; ?>"><?php echo $jenjang['jenjang_nama']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label>Siswa Kelas</label>
					<select name="siswa_kelas" class="form-control" id="">
						<option value="">Pilih Kelas</option>
						<?php foreach($data['kelas'] as $key => $kelas) : ?>
							<option value="<?php echo $kelas['kelas_id']; ?>"><?php echo $kelas['tingkat_nama']. ' ' .$kelas['jenjang_nama']. ' ' .$kelas['kelas_nama']; ?></option>
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