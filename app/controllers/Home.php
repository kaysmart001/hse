<?php

class Home extends Controller {

	public function __construct() {
		// Check session login
		if (isset($_SESSION['login'])) {
			// Check user role siswa & profile complete or not
			if ($_SESSION['role'] == 3) {
				// Load model
				$this->Siswa_model = $this->model('Siswa_model');
				// Check if profile guru is not complete redirect to profile page
				if ( ! $this->Siswa_model->check_profile($_SESSION['id']) ) {
					header('Location: ' . base_url() . 'profile');
				}
			}
			// Check user role guru & profile complete or not
			else if ($_SESSION['role'] == 2) {
				// Load model
				$this->Guru_model = $this->model('Guru_model');
				// Check if profile guru is not complete redirect to profile page
				if ( ! $this->Guru_model->check_profile($_SESSION['id']) ) {
					header('Location: ' . base_url() . 'profile');
				}
			}
		} else {
			header('Location: ' . base_url() . 'auth');
		}
	}

	public function index() {
		$this->view('home/v_header');
		$this->view('home/v_home');
		$this->view('home/v_footer');
	}
}