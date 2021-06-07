<section class="page-section portfolio mt-4" id="portfolio">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Profile</h2>
				<div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12"><?php Flash::flash_message(); ?></div>
		</div>
		<div class="row justify-content-center">
			<div class="col-md-3">
				<form action="<?php echo base_url(); ?>profile/update_siswa" method="post" enctype="multipart/form-data" style="width: 100%">
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
					<input type="hidden" name="siswa_uid" value="<?php echo $_SESSION['id']; ?>">
				</div>
				<div class="row">
					<div class="col-md-8">
						<div class="form-group">
				<label>Nama Lengkap</label>
				<input type="text" name="siswa_nama" class="form-control" placeholder="Nama Lengkap" value="<?php echo (isset($data['siswa']->siswa_nama) ? $data['siswa']->siswa_nama : '' ); ?>" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Nama Panggilan</label>
							<input type="text" name="siswa_nama_panggilan" class="form-control" placeholder="Nama Panggilan" value="<?php echo (isset($data['siswa']->siswa_nama_panggilan) ? $data['siswa']->siswa_nama_panggilan : '' ); ?>" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Tempat Lahir</label>
							<input type="text" name="siswa_tmp_lahir" class="form-control" placeholder="Tempat Lahir" value="<?php echo (isset($data['siswa']->siswa_tmp_lahir) ? $data['siswa']->siswa_tmp_lahir : '' ); ?>" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Tanggal Lahir</label>
							<input type="date" name="siswa_tgl_lahir" class="form-control" placeholder="Tanggal Lahir" value="<?php echo (isset($data['siswa']->siswa_tgl_lahir) ? $data['siswa']->siswa_tgl_lahir : '' ); ?>" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Jenis Kelamin</label>
							<div class="radio">
							 	<label class="radio-inline" style="width: auto; margin-right: 20px;"><input type="radio" name="siswa_jenis_kelamin" id="laki" value="1" <?php echo (isset($data['siswa']->siswa_jenis_kelamin) ? ($data['siswa']->siswa_jenis_kelamin == 1 ?  'checked' : '') : '' ); ?>>Laki-Laki</label>
								<label class="radio-inline" style="width: auto; margin-right: 20px;"><input type="radio" name="siswa_jenis_kelamin" id="perempuan" value="2" <?php echo (isset($data['siswa']->siswa_jenis_kelamin) ? ($data['siswa']->siswa_jenis_kelamin == 2 ?  'checked' : '') : '' ); ?>>Perempuan</label>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Agama</label>
							<input type="text" name="siswa_agama" class="form-control" placeholder="Agama" value="<?php echo (isset($data['siswa']->siswa_agama) ? $data['siswa']->siswa_agama : '' ); ?>" required>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label>Anak ke</label>
							<input type="text" name="siswa_anak_ke" class="form-control" placeholder="Anak ke" value="<?php echo (isset($data['siswa']->siswa_anak_ke) ? $data['siswa']->siswa_anak_ke : '' ); ?>" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Jenjang Pendidikan Terakhir</label>
							<input type="text" name="siswa_jenjang_terakhir" class="form-control" placeholder="Jenjang Pendidikan Terakhir" value="<?php echo (isset($data['siswa']->siswa_jenjang_terakhir) ? $data['siswa']->siswa_jenjang_terakhir : '' ); ?>" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>No.Handphone</label>
							<input type="text" name="siswa_nohp" class="form-control" placeholder="No.Handphone" value="<?php echo (isset($data['siswa']->siswa_nohp) ? $data['siswa']->siswa_nohp : '' ); ?>" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<div class="form-group">
							<label>Golongan Darah</label>
							<input type="text" name="siswa_gol_darah" class="form-control" placeholder="Golongan Darah" value="<?php echo (isset($data['siswa']->siswa_gol_darah) ? $data['siswa']->siswa_gol_darah : '' ); ?>" required>
						</div>
					</div>
					<div class="col-md-8">
						<div class="form-group">
							<label>Hobi/Minat</label>
							<input type="text" name="siswa_hobi" class="form-control" placeholder="Hobi Minat" value="<?php echo (isset($data['siswa']->siswa_hobi) ? $data['siswa']->siswa_hobi : '' ); ?>" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<textarea name="siswa_alamat" id="" cols="30" rows="3" class="form-control" placeholder="Alamat" required><?php echo (isset($data['siswa']->siswa_alamat) ? $data['siswa']->siswa_alamat : '' ); ?></textarea>
				</div>
				<br>
				<div class="form-group">
					<label>BIODATA ORANGTUA</label>
				</div>
				<div class="form-group">
					<label>Nama Ayah</label>
					<input type="text" name="siswa_nama_ayah" class="form-control" placeholder="Nama Ayah" value="<?php echo (isset($data['siswa']->siswa_nama_ayah) ? $data['siswa']->siswa_nama_ayah : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Pekerjaan Ayah</label>
					<input type="text" name="siswa_pekerjaan_ayah" class="form-control" placeholder="Pekerjaan Ayah" value="<?php echo (isset($data['siswa']->siswa_pekerjaan_ayah) ? $data['siswa']->siswa_pekerjaan_ayah : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Pendidikan Terakhir Ayah</label>
					<input type="text" name="siswa_pend_terakhir_ayah" class="form-control" placeholder="Pendidikan Terakhir Ayah" value="<?php echo (isset($data['siswa']->siswa_pend_terakhir_ayah) ? $data['siswa']->siswa_pend_terakhir_ayah : '' ); ?>" required>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>No.Handphone/Wa Ayah</label>
							<input type="text" name="siswa_nohp_ayah" class="form-control" placeholder="No.Handphone/Wa Ayah" value="<?php echo (isset($data['siswa']->siswa_nohp_ayah) ? $data['siswa']->siswa_nohp_ayah : '' ); ?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Email Ayah</label>
							<input type="text" name="siswa_email_ayah" class="form-control" placeholder="Email Ayah" value="<?php echo (isset($data['siswa']->siswa_email_ayah) ? $data['siswa']->siswa_email_ayah : '' ); ?>" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Penghasilan Ayah (/bulan)</label>
					<input type="text" name="siswa_penghasilan_ayah" class="form-control" placeholder="Penghasilan Ayah (/bulan)" value="<?php echo (isset($data['siswa']->siswa_penghasilan_ayah) ? $data['siswa']->siswa_penghasilan_ayah : '' ); ?>" required>
				</div>

				<br>
				<div class="form-group">
					<label>Nama Ibu</label>
					<input type="text" name="siswa_nama_ibu" class="form-control" placeholder="Nama Ibu" value="<?php echo (isset($data['siswa']->siswa_nama_ibu) ? $data['siswa']->siswa_nama_ibu : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Pekerjaan Ibu</label>
					<input type="text" name="siswa_pekerjaan_ibu" class="form-control" placeholder="Pekerjaan Ibu" value="<?php echo (isset($data['siswa']->siswa_pekerjaan_ibu) ? $data['siswa']->siswa_pekerjaan_ibu : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Pendidikan Terakhir Ibu</label>
					<input type="text" name="siswa_pend_terakhir_ibu" class="form-control" placeholder="Pendidikan Terakhir Ibu" value="<?php echo (isset($data['siswa']->siswa_pend_terakhir_ibu) ? $data['siswa']->siswa_pend_terakhir_ibu : '' ); ?>" required>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label>No.Handphone/WA Ibu</label>
							<input type="text" name="siswa_nohp_ibu" class="form-control" placeholder="No.Handphone/WA Ibu" value="<?php echo (isset($data['siswa']->siswa_nohp_ibu) ? $data['siswa']->siswa_nohp_ibu : '' ); ?>" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Email Ibu</label>
							<input type="text" name="siswa_email_ibu" class="form-control" placeholder="Email Ibu" value="<?php echo (isset($data['siswa']->siswa_email_ibu) ? $data['siswa']->siswa_email_ibu : '' ); ?>" required>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Penghasilan Ibu (/bulan)</label>
					<input type="text" name="siswa_penghasilan_ibu" class="form-control" placeholder="Penghasilan Ibu (/bulan)" value="<?php echo (isset($data['siswa']->siswa_penghasilan_ibu) ? $data['siswa']->siswa_penghasilan_ibu : '' ); ?>" required>
				</div>

				<div class="form-group">
					<label>Alamat Ortu</label>
					<textarea name="siswa_alamat_ortu" id="" cols="30" rows="3" class="form-control" placeholder="Alamat Ortu" required><?php echo (isset($data['siswa']->siswa_alamat_ortu) ? $data['siswa']->siswa_alamat_ortu : '' ); ?></textarea>
				</div>
				<br>
				
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
				<?php if ($_SESSION['role'] != 3) { ?>
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
							<option value="<?php echo $kelas['kelas_id']; ?>" <?php echo (isset($data['siswa']->siswa_kelas) ? ($data['siswa']->siswa_kelas == $kelas['kelas_id'] ?  'selected' : '') : '' ); ?>><?php echo $kelas['tingkat_nama'] . ' ' . $kelas['jenjang_nama']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label>Semester</label>
					<input type="text" name="siswa_semester" class="form-control" placeholder="Semester" value="<?php echo (isset($data['siswa']->siswa_semester) ? $data['siswa']->siswa_semester : '' ); ?>" required>
				</div>
				<?php } else { ?>
					<input type="hidden" name="siswa_jenjang" value="<?php echo $data['siswa']->siswa_jenjang; ?>">
					<input type="hidden" name="siswa_kelas" value="<?php echo $data['siswa']->siswa_kelas; ?>">
					<input type="hidden" name="siswa_semester" value="<?php echo $data['siswa']->siswa_semester; ?>">
				<?php } ?>
				<hr>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
				</form>
			</div>
		</div>
	</div>
</section>

<!-- Modal Change Username & Email -->
<div class="modal fade" id="changeUseremail" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Ubah Username & Email</h4>
      </div>
      <form action="<?php echo base_url(); ?>profile/change_useremail" method="post">
      <div class="modal-body">
        <div class="form-group">
			<label>Username</label>
			<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $data['user']->username; ?>" required>
			<input type="hidden" name="id" value="<?php echo $data['user']->id; ?>">
			<input type="hidden" name="role" value="<?php echo $data['user']->role; ?>">
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
      <form action="<?php echo base_url(); ?>profile/change_password" method="post">
      <div class="modal-body">
        <div class="form-group">
        	<label for="">Password Baru</label>
        	<input type="password" class="form-control" required="">
        	<input type="hidden" name="password_user" class="form-control" value="<?php echo $data['user']->id; ?>">
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