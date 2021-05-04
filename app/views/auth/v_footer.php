	<script src="<?php echo base_url(); ?>assets/js/jquery-3.5.1.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
	<script type="text/javascript">
	function validasi() {
		var username = document.getElementById("username").value;
		var password = document.getElementById("password").value;        
		if (username != "" && password!="") {
			return true;
		}else{
			alert('Username dan Password harus di isi !');
			return false;
		}
	}
	</script>
	</body>
</html>