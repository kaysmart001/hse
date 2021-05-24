<?php if ($_SESSION['role'] == 1) { ?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
			<div class="col-md-12">
				<h1><i class="fa fa-home fa-fw"></i> Detail Siswa</h1>
				<ol class="breadcrumb">
	                <li class="active">
	                    <i class="fa fa-dashboard"></i> Dashboard
	                </li>
                    <li><a href="<?php echo base_url(); ?>siswa">Siswa</a></li>
                    <li><?php echo $data['siswa']->siswa_nama; ?></li>
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
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Data Siswa</h2>
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
				<img src="<?php echo base_url(); ?>uploads/profile/<?php echo (isset($data['siswa']->siswa_foto) ? $data['siswa']->siswa_foto : 'user-default.png'); ?>" alt="" class="img-responsive thumbnail" width="100%">
				<input type="file" name="siswa_foto" value="<?php echo (isset($data['siswa']->siswa_foto) ? (!is_null($data['siswa']->siswa_foto) ? $data['siswa']->siswa_foto : '') : ''); ?>">
				<p><small><i>Maks. ukuran foto: 10mb</i></small></p>
				<hr>
				<button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#changeUseremail">Change Username & Email</button>
				<button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#changePassword">Change Password</button>
			</div>
			<div class="col-md-9">
				<div class="form-group">
					<label>NIS</label>
					<input type="text" name="siswa_nis" class="form-control" placeholder="NIS" value="<?php echo (isset($data['siswa']->siswa_nis) ?  $data['siswa']->siswa_nis : '' ); ?>" required>
					<input type="hidden" name="siswa_id" value="<?php echo (isset($data['siswa']->siswa_id) ?  $data['siswa']->siswa_id : '' ); ?>">
					<input type="hidden" name="siswa_uid" value="<?php echo $data['siswa']->siswa_uid; ?>">
				</div>
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="siswa_nama" class="form-control" placeholder="Nama" value="<?php echo (isset($data['siswa']->siswa_nama) ? $data['siswa']->siswa_nama : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Tempat Lahir</label>
					<input type="text" name="siswa_tmp_lahir" class="form-control" placeholder="Tempat Lahir" value="<?php echo (isset($data['siswa']->siswa_tmp_lahir) ? $data['siswa']->siswa_tmp_lahir : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Tanggal Lahir</label>
					<input type="date" name="siswa_tgl_lahir" class="form-control" placeholder="Tanggal Lahir" value="<?php echo (isset($data['siswa']->siswa_tgl_lahir) ? $data['siswa']->siswa_tgl_lahir : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Jenis Kelamin</label>
					<select name="siswa_jenis_kelamin" class="form-control" id="">
						<option value="">Pilih Jenis Kelamin</option>
						<option value="1" <?php echo (isset($data['siswa']->siswa_jenis_kelamin) ? ($data['siswa']->siswa_jenis_kelamin == 1 ?  'selected' : '') : '' ); ?>>Laki-Laki</option>
						<option value="2" <?php echo (isset($data['siswa']->siswa_jenis_kelamin) ? ($data['siswa']->siswa_jenis_kelamin == 2 ?  'selected' : '') : '' ); ?>>Perempuan</option>
					</select>
				</div>
				<div class="form-group">
					<label>Agama</label>
					<input type="text" name="siswa_agama" class="form-control" placeholder="Agama" value="<?php echo (isset($data['siswa']->siswa_agama) ? $data['siswa']->siswa_agama : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Anak ke</label>
					<input type="text" name="siswa_anak_ke" class="form-control" placeholder="Anak ke" value="<?php echo (isset($data['siswa']->siswa_anak_ke) ? $data['siswa']->siswa_anak_ke : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<textarea name="siswa_alamat" id="" cols="30" rows="3" class="form-control" placeholder="Alamat" required><?php echo (isset($data['siswa']->siswa_alamat) ? $data['siswa']->siswa_alamat : '' ); ?></textarea>
				</div>
				<div class="form-group">
					<label>Nama Ayah</label>
					<input type="text" name="siswa_nama_ayah" class="form-control" placeholder="Nama Ayah" value="<?php echo (isset($data['siswa']->siswa_nama_ayah) ? $data['siswa']->siswa_nama_ayah : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Nama Ibu</label>
					<input type="text" name="siswa_nama_ibu" class="form-control" placeholder="Nama Ibu" value="<?php echo (isset($data['siswa']->siswa_nama_ibu) ? $data['siswa']->siswa_nama_ibu : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Alamat Ortu</label>
					<textarea name="siswa_alamat_ortu" id="" cols="30" rows="3" class="form-control" placeholder="Alamat Ortu" required><?php echo (isset($data['siswa']->siswa_alamat_ortu) ? $data['siswa']->siswa_alamat_ortu : '' ); ?></textarea>
				</div>
				<div class="form-group">
					<label>No. Handphone Ortu</label>
					<input type="text" name="siswa_nohp_ortu" class="form-control" placeholder="No. Handphone Ortu" value="<?php echo (isset($data['siswa']->siswa_nohp_ortu) ? $data['siswa']->siswa_nohp_ortu : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Pekerjaan Ayah</label>
					<input type="text" name="siswa_pekerjaan_ayah" class="form-control" placeholder="Pekerjaan Ayah" value="<?php echo (isset($data['siswa']->siswa_pekerjaan_ayah) ? $data['siswa']->siswa_pekerjaan_ayah : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Pekerjaan Ibu</label>
					<input type="text" name="siswa_pekerjaan_ibu" class="form-control" placeholder="Pekerjaan Ibu" value="<?php echo (isset($data['siswa']->siswa_pekerjaan_ibu) ? $data['siswa']->siswa_pekerjaan_ibu : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Nama Wali</label>
					<input type="text" name="siswa_nama_wali" class="form-control" placeholder="Nama Wali" value="<?php echo (isset($data['siswa']->siswa_nama_wali) ? $data['siswa']->siswa_nama_wali : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>No. Handphone Wali</label>
					<input type="text" name="siswa_nohp_wali" class="form-control" placeholder="No. Handphone Wali" value="<?php echo (isset($data['siswa']->siswa_nohp_wali) ? $data['siswa']->siswa_nohp_wali : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Alamat Wali</label>
					<textarea name="siswa_alamat_wali" id="" cols="30" rows="3" class="form-control" placeholder="Alamat Wali" required><?php echo (isset($data['siswa']->siswa_alamat_wali) ? $data['siswa']->siswa_alamat_wali : '' ); ?></textarea>
				</div>
				<div class="form-group">
					<label>Pekerjaan Wali</label>
					<input type="text" name="siswa_pekerjaan_wali" class="form-control" placeholder="Pekerjaan Wali" value="<?php echo (isset($data['siswa']->siswa_pekerjaan_wali) ? $data['siswa']->siswa_pekerjaan_wali : '' ); ?>" required>
				</div>
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
					<input type="text" name="siswa_semester" class="form-control" placeholder="Semester" value="<?php echo (isset($data['siswa']->siswa_semester) ? $data['siswa']->siswa_semester : '' ); ?>" required>
				</div>
				<hr>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
				</form>
			</div>
		</div>
	</div>

<!-- Modal Change Username & Email -->
<div class="modal fade" id="changeUseremail" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ubah Username & Email</h4>
      </div>
      <form action="<?php echo base_url(); ?>siswa/change_useremail" method="post">
      <div class="modal-body">
        <div class="form-group">
			<label>Username</label>
			<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $data['user']->username; ?>" required>
			<input type="hidden" name="id" value="<?php echo $data['user']->id; ?>">
			<input type="hidden" name="role" value="<?php echo $data['user']->role; ?>">
			<input type="hidden" name="siswa_id" value="<?php echo $data['siswa']->siswa_id; ?>">
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo $data['user']->email; ?>" required>
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
<!-- Modal Change Password -->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ubah Password</h4>
      </div>
      <form action="<?php echo base_url(); ?>siswa/change_password" method="post">
      <div class="modal-body">
        <div class="form-group">
        	<label for="">Password Baru</label>
        	<input type="password" class="form-control" required="">
        	<input type="hidden" name="password_user" class="form-control" value="<?php echo $data['user']->id; ?>">
        	<input type="hidden" name="password_siswa" class="form-control" value="<?php echo $data['siswa']->siswa_id; ?>">
        </div>
        <div class="form-group">
        	<label for="">Ulangi Password Baru</label>
        	<input type="password" name="password" class="form-control" required="">
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

<?php if ($_SESSION['role'] == 1) { ?>
    </div>
<?php } else { ?>
</section>
<?php } ?>