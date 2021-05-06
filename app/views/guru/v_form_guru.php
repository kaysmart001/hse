<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1><i class="fa fa-home fa-fw"></i> Form Tambah Guru</h1>
				<ol class="breadcrumb">
	                <li class="active">
	                    <i class="fa fa-dashboard"></i> Dashboard
	                </li>
                    <li><a href="<?php echo base_url(); ?>guru">Guru</a></li>
                    <li>Form Tambah</li>
                </ol>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12"><?php Flash::flash_message(); ?></div>
		</div>
		<div class="row justify-content-center">
			<form action="<?php echo base_url(); ?>guru/add_update" method="post" enctype="multipart/form-data" style="width: 100%">
			<div class="col-md-3">
				<img src="<?php echo base_url(); ?>uploads/profile/user-default.png" alt="" class="img-responsive thumbnail" width="100%">
				<input type="file" name="guru_foto" value="">
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
					<label>NIP</label>
					<input type="text" name="guru_nip" class="form-control" placeholder="NIP" required>
				</div>
				<div class="form-group">
					<label>Nama</label>
					<input type="text" name="guru_nama" class="form-control" placeholder="Nama" required>
				</div>
				<div class="form-group">
					<label>Tempat Lahir</label>
					<input type="text" name="guru_tmp_lahir" class="form-control" placeholder="Tempat Lahir" required>
				</div>
				<div class="form-group">
					<label>Tanggal Lahir</label>
					<input type="date" name="guru_tgl_lahir" class="form-control" placeholder="Tanggal Lahir" required>
				</div>
				<div class="form-group">
					<label>Jenis Kelamin</label>
					<select name="guru_jenis_kelamin" class="form-control" id="">
						<option value="">Pilih Jenis Kelamin</option>
						<option value="1">Laki-Laki</option>
						<option value="2">Perempuan</option>
					</select>
				</div>
				<div class="form-group">
					<label>Agama</label>
					<input type="text" name="guru_agama" class="form-control" placeholder="Agama" required>
				</div>
				<div class="form-group">
					<label>Alamat</label>
					<textarea name="guru_alamat" id="" cols="30" rows="3" class="form-control" placeholder="Alamat" required></textarea>
				</div>
				<div class="form-group">
					<label>No. Handphone</label>
					<input type="text" name="guru_nohp" class="form-control" placeholder="No. Handphone" required>
				</div>
				<div class="form-group">
					<label>Guru Jenjang</label>
					<select name="guru_jenjang" class="form-control" id="">
						<option value="">Pilih Jenjang</option>
						<?php foreach($data['jenjang'] as $key => $jenjang) : ?>
							<option value="<?php echo $jenjang['jenjang_id']; ?>"><?php echo $jenjang['jenjang_nama']; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				<div class="form-group">
					<label>Jenjang Pendidikan</label>
					<input type="text" name="guru_jenjang_pendidikan" class="form-control" placeholder="Jenjang Pendidikan" required>
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