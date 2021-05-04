<?php

class Auth extends Controller {

	public function __construct() {
		$this->User_model = $this->model('User_model');
	}

	public function index() { header('Location: ' . base_url() . 'auth/login'); }

	public function login() {
		if (isset($_SESSION['login'])) { header('Location: ' . base_url()); }

		if ($_POST) {
			$data = $this->User_model->check_login($_POST);
			if ($data['status'] > 0) {
				$_SESSION['id'] = $data['data']['id'];
				$_SESSION['username'] = $data['data']['username'];
				$_SESSION['email'] = $data['data']['email'];
				$_SESSION['role'] = $data['data']['role'];
				$_SESSION['login'] = $data['data']['login'];

				Flash::flasher('Berhasil', 'login', 'success');
				if ($data['data']['role'] == 1 || $data['data']['role'] == 2) {
					header('Location: ' . base_url() . 'dashboard');
				} else if ($data['data']['role'] == 3) {
					header('Location: ' . base_url());
				}
			} else {
				Flash::flasher('Gagal', 'Anda gagal login', 'danger');
			}
		}

		$this->view('auth/v_header');
		$this->view('auth/v_login');
		$this->view('auth/v_footer');
	}

	public function register() {
		if ($_POST) {
			if ($this->User_model->add($_POST) > 0) {
				Flash::flasher('Berhasil', 'Registrasi berhasil, silahkan login.', 'success');
				header('Location:' . base_url() . 'auth');
			} else {
				Flash::flasher('Gagal', 'Registrasi gagal, silahkan ulangi.', 'danger');
				echo 'failed';
			}
		}
		$this->view('auth/v_header');
		$this->view('auth/v_register');
		$this->view('auth/v_footer');
	}

	public function logout() {
		session_destroy();
		header('Location: ' . base_url());
	}
}