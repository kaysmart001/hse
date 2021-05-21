	<section class="section-login">
		<div class="container-login">
			<div class="col-login logo text-center">
				<img src="<?php echo base_url(); ?>assets/img/usera.PNG" class="img-logo" alt="">
			</div>
			<div class="col-login form">
				<form action="<?php echo base_url(); ?>auth/login" method="post">
					<div class="form-group">
						<?php Flash::flash_message(); ?>
					</div>
					<div class="form-group">
						<label for="yourName">Your name</label>
						<input type="text" class="form-control" name="username" id="username" placeholder="Your name">
					</div>
					<div class="form-group">
						<label for="yourPassword">Your password</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Your password">
					</div>
					<br />
					<button type="submit" class="btn btn-primary btn-block">SIGN IN</button>
				</form>
			</div>
		</div>
	</section>