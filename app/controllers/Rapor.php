<?php

class Rapor extends Controller {

	public function __construct() {
		if (!isset($_SESSION['login'])) { header('Location: ' . base_url()); }
		$this->Jenjang_model = $this->model('Jenjang_model');
		$this->Siswa_model = $this->model('Siswa_model');
		$this->Guru_model = $this->model('Guru_model');
		$this->Rapor_model = $this->model('Rapor_model');
	}

	// @param id = ID jenjang
	public function index($id = NULL) {
		$data['jenjang'] = $this->Jenjang_model->get_orderby('jenjang_id ASC');

		if (!is_null($id)) {
			if (is_numeric($id)) {
				if ($_SESSION['role'] == 1) {
					$wj = ['siswa_jenjang', $id];
					$ws = NULL;
				} else if ($_SESSION['role'] == 2) {
					$wj = ['siswa_jenjang', $id];
					$ws = NULL;
				} else if ($_SESSION['role'] == 3) {
					$wj = ['siswa_jenjang', $id];
					$ws = ['siswa_uid', $_SESSION['id']];
				}
			} else {
				header('Location: ' . base_url() . 'rapor');
			}
		} else {
			$wj = ['siswa_jenjang', 1];
			$ws = NULL;

			if ($_SESSION['role'] == 2) {
				$check_profile = $this->Guru_model->get_by(['guru_uid', $_SESSION['id']]);
				$wj = ['siswa_jenjang', $check_profile->guru_jenjang];
			} else if ($_SESSION['role'] == 3) {
				$check_profile = $this->Siswa_model->get_by(['siswa_uid', $_SESSION['id']]);
				$wj = ['siswa_jenjang', $check_profile->siswa_jenjang];
				$ws = ['rapor_siswa', $check_profile->siswa_id];
			}
		}

		$data['siswa'] = $this->Siswa_model->get_all($wj);
		$data['rapor'] = $this->Rapor_model->get_by($wj, $ws);

		if ($_SESSION['role'] > 1) {
			$this->view('home/v_header');
			$this->view('rapor/v_rapor', $data);
			$this->view('home/v_footer');
		} else if ($_SESSION['role'] == 1) {
			$this->view('dashboard/v_header');
			$this->view('rapor/v_rapor', $data);
			$this->view('dashboard/v_footer');
		}
	}

	public function add_update() {
		if ($_POST) {
			$data['rapor'] = $this->Rapor_model->get_by(NULL, ['rapor_id', $_POST['rapor_id']], TRUE);
			// Setting upload photo
			$extension = ['png', 'jpg', 'jpeg', 'pdf'];
			$size = 1044070;
			if ($_FILES['rapor_file']['name'] != '' && $_FILES['rapor_file']['size'] != 0) {
				// Photo upload
				$name_rapor = $_FILES['rapor_file']['name'];
				$x = explode('.', $name_rapor);
				$ext = strtolower(end($x));
				$size_rapor = $_FILES['rapor_file']['size'];
				$tmp_rapor = $_FILES['rapor_file']['tmp_name'];
				// Check extension
				if (in_array($ext, $extension)) {
					if ($size_photo < $size) {
						// Move photo location and
						move_uploaded_file($tmp_rapor, 'uploads/rapor/' . $name_rapor);
						// Change value post photo
						$_POST['rapor_file'] = $name_rapor;

						// Check complete or update profile
						if ($_POST['rapor_id'] != '') {
							if ($this->Rapor_model->update($_POST) > 0) {
								Flash::flasher('Berhasil', 'Rapor berhasil disimpan', 'success');
								header('Location: ' . base_url() . 'rapor/' . $_POST['jenjang_id']);
								exit;
							} else {
								Flash::flasher('Gagal', 'Rapor gagal diubah', 'danger');
								header('Location: ' . base_url() . 'rapor/' . $_POST['jenjang_id']);
								exit;
							}
						} else {
							if ($this->Rapor_model->add($_POST) > 0) {
								Flash::flasher('Berhasil', 'Rapor berhasil ditambahkan', 'success');
								header('Location: ' . base_url() . 'rapor/' . $_POST['jenjang_id']);
								exit;
							} else {
								Flash::flasher('Gagal', 'Rapor gagal ditambahkan', 'danger');
								header('Location: ' . base_url() . 'rapor/' . $_POST['jenjang_id']);
								exit;
							}
						}
					}
				}
			} else {
				$_POST['rapor_file'] = (isset($data['rapor']->rapor_file) ? $data['rapor']->rapor_file : '');
				if ($_POST['rapor_id'] != '') {
					Flash::flasher('Berhasil', 'Rapor berhasil disimpan', 'success');
					header('Location: ' . base_url() . 'rapor/' . $_POST['jenjang_id']);
					exit;
				} else {
					if ($this->Rapor_model->add($_POST) > 0) {
						Flash::flasher('Berhasil', 'Rapor berhasil ditambahkan', 'success');
						header('Location: ' . base_url() . 'rapor/' . $_POST['jenjang_id']);
						exit;
					} else {
						Flash::flasher('Gagal', 'Rapor gagal ditambahkan', 'danger');
						header('Location: ' . base_url() . 'rapor/' . $_POST['jenjang_id']);
						exit;
					}
				}
			}
		}
	}

	public function delete() {
		if ($_POST) {
			if (isset($_POST['rapor_id_delete'])) {
				if ($_POST['rapor_id_delete'] != '') {
					if ($this->Rapor_model->delete($_POST['rapor_id_delete']) > 0) {
						Flash::flasher('Berhasil', 'Rapor berhasil dihapus', 'success');
						header('Location: ' . base_url() . 'rapor/' . $_POST['jenjang_id']);
						exit;
					} else {
						Flash::flasher('Gagal', 'Rapor gagal dihapus', 'danger');
						header('Location: ' . base_url() . 'rapor/' . $_POST['jenjang_id']);
						exit;
					}
				} else {
					Flash::flasher('Gagal', 'Rapor gagal dihapus, ID Rapor tidak ada.', 'danger');
					header('Location: ' . base_url() . 'rapor/' . $_POST['jenjang_id']);
					exit;
				}
			} else {
				Flash::flasher('Gagal', 'Rapor gagal dihapus, ID tidak ditemukan', 'danger');
				header('Location: ' . base_url() . 'rapor/' . $_POST['jenjang_id']);
				exit;
			}
		}
	}
}