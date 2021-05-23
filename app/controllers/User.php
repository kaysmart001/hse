<?php

class User extends Controller {

	public function __construct() {
		if (!isset($_SESSION['login'])) { header('Location: ' . base_url()); }
		if ($_SESSION['role'] != 1) { header('Location: ' . base_url()); }

		$this->User_model = $this->model('User_model');
		$this->Guru_model = $this->model('Guru_model');
		$this->Siswa_model = $this->model('Siswa_model');
		$this->Kelas_model = $this->model('Kelas_model');
		$this->Jenjang_model = $this->model('Jenjang_model');
	}

	public function index() {
		$data['user'] = $this->User_model->get_all();
		$data['kelas'] = $this->Kelas_model->get();
		$data['jenjang'] = $this->Jenjang_model->get();

		if ($_POST) {
			if (isset($_POST['id'])) {
				if ($_POST['kelas'] != '') {
					$u = $this->User_model->update($_POST);
					$_POST['siswa_uid'] = $_POST['id'];
					$_POST['siswa_kelas'] = $_POST['kelas'];
					$_POST['siswa_jenjang'] = $_POST['siswa_jenjang'];
					$s = $this->Siswa_model->update_without_data($_POST);
					if ($u > 0 && $s > 0) {
						Flash::flasher('Berhasil', 'User berhasil, diubah.', 'success');
						header('Location:' . base_url() . 'user');
						exit;
					} else if ($u > 0) {
						Flash::flasher('Berhasil', 'User berhasil, diubah.', 'success');
						header('Location:' . base_url() . 'user');
						exit;
					} else if ($s > 0) {
						Flash::flasher('Berhasil', 'User berhasil, diubah.', 'success');
						header('Location:' . base_url() . 'user');
						exit;
					} else {
						Flash::flasher('Berhasil', 'User berhasil diubah.', 'success');
						header('Location:' . base_url() . 'user');
						exit;
					}
				} else if ($_POST['jenjang'] != '') {
					$u = $this->User_model->update($_POST);
					$_POST['guru_uid'] = $_POST['id'];
					$_POST['guru_jenjang'] = $_POST['jenjang'];
					$g = $this->Guru_model->update_without_data($_POST);
					if ($u > 0 && $g > 0) {
						Flash::flasher('Berhasil', 'User berhasil, diubah.', 'success');
						header('Location:' . base_url() . 'user');
						exit;
					} else if ($u > 0) {
						Flash::flasher('Berhasil', 'User berhasil, diubah.', 'success');
						header('Location:' . base_url() . 'user');
						exit;
					} else if ($g > 0) {
						Flash::flasher('Berhasil', 'User berhasil, diubah.', 'success');
						header('Location:' . base_url() . 'user');
						exit;
					} else {
						Flash::flasher('Berhasil', 'User berhasil diubah.', 'success');
						header('Location:' . base_url() . 'user');
						exit;
					}
				} else {
					if ($this->User_model->update($_POST) > 0) {
						Flash::flasher('Berhasil', 'User berhasil, diubah.', 'success');
						header('Location:' . base_url() . 'user');
						exit;
					} else {
						Flash::flasher('Gagal', 'User gagal diubah.', 'danger');
						header('Location:' . base_url() . 'user');
						exit;
					}
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
				if ($_POST['kelas'] != '') {
					$insert_id = $this->User_model->create($_POST);
					if ($insert_id > 0) {
						$_POST['siswa_uid'] = $insert_id;
						$_POST['siswa_kelas'] = $_POST['kelas'];
						$_POST['siswa_jenjang'] = $_POST['siswa_jenjang'];
						if ($this->Siswa_model->add_without_data($_POST) > 0) {
							Flash::flasher('Berhasil', 'User berhasil, ditambahkan.', 'success');
							header('Location:' . base_url() . 'user');
							exit;
						} else {
							Flash::flasher('Gagal', 'User berhasil ditambahkan, namun data siswa gagal ditambahkan.', 'danger');
							header('Location:' . base_url() . 'user');
							exit;
						}
					} else {
						Flash::flasher('Gagal', 'User berhasil ditambahkan, namun data siswa gagal ditambahkan.', 'danger');
						header('Location:' . base_url() . 'user');
						exit;
					}
				} else if ($_POST['jenjang'] != '') {
					$insert_id = $this->User_model->create($_POST);
					if ($insert_id > 0) {
						$_POST['guru_uid'] = $insert_id;
						$_POST['guru_jenjang'] = $_POST['jenjang'];
						if ($this->Guru_model->add_without_data($_POST) > 0) {
							Flash::flasher('Berhasil', 'User berhasil, ditambahkan.', 'success');
							header('Location:' . base_url() . 'user');
							exit;
						} else {
							Flash::flasher('Gagal', 'User berhasil ditambahkan, namun data guru gagal ditambahkan.', 'danger');
							header('Location:' . base_url() . 'user');
							exit;
						}
					} else {
						Flash::flasher('Gagal', 'User berhasil ditambahkan, namun data guru gagal ditambahkan.', 'danger');
						header('Location:' . base_url() . 'user');
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
		}

		$this->view('dashboard/v_header');
		$this->view('user/v_user', $data);
		$this->view('dashboard/v_footer');
	}

	public function ajax_get_ubah() {
		if ($_POST) {
			if ($_POST['id'] != '') {
				$query = $this->User_model->get_single($_POST['id']);
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