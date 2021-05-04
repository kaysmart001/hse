<div id="page-wrapper">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h1><i class="fa fa-home fa-fw"></i> Profile</h1>
				<ol class="breadcrumb">
	                <li class="active">
	                    <i class="fa fa-dashboard"></i> Dashboard
	                </li>
                    <li>Profile</li>
                </ol>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12"><?php Flash::flash_message(); ?></div>
		</div>
		<div class="row">
			<div class="col-md-4">
				<form action="<?php echo base_url(); ?>profile/change_useremail" method="post">
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
					<hr>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Simpan</button>
						<button type="button" class="btn btn-default" data-toggle="modal" data-target="#changePassword">Change Password</button>
					</div>
				</form>
			</div>
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