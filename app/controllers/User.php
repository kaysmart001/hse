<?php

class User extends Controller {

	public function __construct() {
		if (!isset($_SESSION['login'])) { header('Location: ' . base_url()); }
		if ($_SESSION['role'] != 1) { header('Location: ' . base_url()); }

		$this->User_model = $this->model('User_model');
	}

	public function index() {
		$data['user'] = $this->User_model->get_all();

		if ($_POST) {
			if (isset($_POST['id'])) {
				if ($this->User_model->update($_POST) > 0) {
					Flash::flasher('Berhasil', 'User berhasil, diubah.', 'success');
					header('Location:' . base_url() . 'user');
					exit;
				} else {
					Flash::flasher('Gagal', 'User gagal, diubah.', 'danger');
					header('Location:' . base_url() . 'user');
					exit;
				}
			} else if (isset($_POST['id_delete'])) {
				if ($this->User_model->delete($_POST['id_delete']) > 0) {
					Flash::flasher('Berhasil', 'User berhasil dihapus', 'success');
					header('Location: ' . base_url() . 'user');
					exit;
				} else {
					Flash::flasher('Gagal', 'User gagal dihapus', 'danger');
					header('Location: ' . base_url() . 'user');
					exit;
				}
			} else {
				if ($this->User_model->add($_POST) > 0) {
					Flash::flasher('Berhasil', 'User berhasil, ditambahkan.', 'success');
					header('Location:' . base_url() . 'user');
					exit;
				} else {
					Flash::flasher('Gagal', 'User gagal, ditambahkan.', 'danger');
					header('Location:' . base_url() . 'user');
					exit;
				}
			}
		}

		$this->view('dashboard/v_header');
		$this->view('user/v_user', $data);
		$this->view('dashboard/v_footer');
	}

	public function ajax_get_ubah() {
		if ($_POST) {
			if ($_POST['id'] != '') {
				$query = $this->User_model->get_by(['id', $_POST['id']]);
				$data['status'] = 200;
				$data['message'] = 'Berhasil mengambil data';
				$data['data'] = $query;
			} else {
				$data['status'] = 404;
				$data['message'] = 'User ID kosong';
			}
		}

		echo json_encode($data);
	}
}