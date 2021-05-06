<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1><i class="fa fa-home fa-fw"></i> Detail Guru</h1>
				<ol class="breadcrumb">
	                <li class="active">
	                    <i class="fa fa-dashboard"></i> Dashboard
	                </li>
                    <li><a href="<?php echo base_url(); ?>guru">Guru</a></li>
                    <li><?php echo $data['guru']->guru_nama; ?></li>
                </ol>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12"><?php Flash::flash_message(); ?></div>
		</div>
		<div class="row justify-content-center">
			<form action="<?php echo base_url(); ?>guru/add_update" method="post" enctype="multipart/form-data" style="width: 100%">
			<div class="col-md-3">
				<img src="<?php echo base_url(); ?>uploads/profile/<?php echo (isset($data['guru']->guru_foto) ? $data['guru']->guru_foto : 'user-default.png'); ?>" alt="" class="img-responsive thumbnail" width="100%">
				<input type="file" name="guru_foto" value="<?php echo (isset($data['guru']->guru_foto) ? (!is_null($data['guru']->guru_foto) ? $data['guru']->guru_foto : '') : ''); ?>">
				<p><small><i>Maks. ukuran foto: 10mb</i></small></p>
				<hr>
				<button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#changeUseremail">Change Username & Email</button>
				<button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#changePassword">Change Password</button>
			</div>
			<div class="col-md-9">
				<div class="form-group">
					<label>NIS</label>
					<input type="text" name="guru_nip" class="form-control" placeholder="NIS" value="<?php echo (isset($data['guru']->guru_nip) ?  $data['guru']->guru_nip : '' ); ?>" required>
					<input type="hidden" name="guru_id" value="<?php echo (isset($data['guru']->guru_id) ?  $data['guru']->guru_id : '' ); ?>">
					<input type="hidden" name="guru_uid" value="<?php echo $data['guru']->guru_uid; ?>">
				</div>
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="guru_nama" class="form-control" placeholder="Nama" value="<?php echo (isset($data['guru']->guru_nama) ? $data['guru']->guru_nama : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Tempat Lahir</label>
					<input type="text" name="guru_tmp_lahir" class="form-control" placeholder="Tempat Lahir" value="<?php echo (isset($data['guru']->guru_tmp_lahir) ? $data['guru']->guru_tmp_lahir : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Tanggal Lahir</label>
					<input type="date" name="guru_tgl_lahir" class="form-control" placeholder="Tanggal Lahir" value="<?php echo (isset($data['guru']->guru_tgl_lahir) ? $data['guru']->guru_tgl_lahir : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Jenis Kelamin</label>
					<select name="guru_jenis_kelamin" class="form-control" id="">
						<option value="">Pilih Jenis Kelamin</option>
						<option value="1" <?php echo (isset($data['guru']->guru_jenis_kelamin) ? ($data['guru']->guru_jenis_kelamin == 1 ?  'selected' : '') : '' ); ?>>Laki-Laki</option>
						<option value="2" <?php echo (isset($data['guru']->guru_jenis_kelamin) ? ($data['guru']->guru_jenis_kelamin == 2 ?  'selected' : '') : '' ); ?>>Perempuan</option>
					</select>
				</div>
				<div class="form-group">
					<label>Agama</label>
					<input type="text" name="guru_agama" class="form-control" placeholder="Agama" value="<?php echo (isset($data['guru']->guru_agama) ? $data['guru']->guru_agama : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<textarea name="guru_alamat" id="" cols="30" rows="3" class="form-control" placeholder="Alamat" required><?php echo (isset($data['guru']->guru_alamat) ? $data['guru']->guru_alamat : '' ); ?></textarea>
				</div>
				<div class="form-group">
					<label>No. Handphone</label>
					<input type="text" name="guru_nohp" class="form-control" placeholder="No. Handphone" value="<?php echo (isset($data['guru']->guru_nohp) ? $data['guru']->guru_nohp : '' ); ?>" required>
				</div>
				<div class="form-group">
					<label>Guru Jenjang</label>
					<select name="guru_jenjang" class="form-control" id="">
						<option value="">Pilih Jenjang</option>
						<?php foreach($data['jenjang'] as $key => $jenjang) : ?>
							<option value="<?php echo $jenjang['jenjang_id']; ?>" <?php echo (isset($data['guru']->guru_jenjang) ? ($data['guru']->guru_jenjang == $jenjang['jenjang_id'] ?  'selected' : '') : '' ); ?>><?php echo $jenjang['jenjang_nama']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label>Jenjang Pendidikan</label>
					<input type="text" name="guru_jenjang_pendidikan" class="form-control" placeholder="Jenjang Pendidikan" value="<?php echo (isset($data['guru']->guru_jenjang_pendidikan) ? $data['guru']->guru_jenjang_pendidikan : '' ); ?>" required>
				</div>
				<hr>
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
			</div>
			</form>
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
      <form action="<?php echo base_url(); ?>guru/change_useremail" method="post">
      <div class="modal-body">
        <div class="form-group">
			<label>Username</label>
			<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo $data['user']->username; ?>" required>
			<input type="hidden" name="id" value="<?php echo $data['user']->id; ?>">
			<input type="hidden" name="role" value="<?php echo $data['user']->role; ?>">
			<input type="hidden" name="guru_id" value="<?php echo $data['guru']->guru_id; ?>">
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
      <form action="<?php echo base_url(); ?>guru/change_password" method="post">
      <div class="modal-body">
        <div class="form-group">
        	<label for="">Password Baru</label>
        	<input type="password" class="form-control" required="">
        	<input type="hidden" name="password_user" class="form-control" value="<?php echo $data['user']->id; ?>">
        	<input type="hidden" name="password_siswa" class="form-control" value="<?php echo $data['guru']->guru_id; ?>">
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