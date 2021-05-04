<?php

class Kelas extends Controller {

	public function __construct() {
		if (!isset($_SESSION['login'])) { header('Location: ' . base_url()); }
		if ($_SESSION['role'] != 1) { header('Location: ' . base_url()); }

		$this->Kelas_model = $this->model('Kelas_model');
		$this->Jenjang_model = $this->model('Jenjang_model');
		$this->Tingkat_model = $this->model('Tingkat_model');
		$this->Jurusan_model = $this->model('Jurusan_model');
	}

	public function index() {
		$data['jenjang'] = $this->Jenjang_model->get();
		$data['tingkat'] = $this->Tingkat_model->get();
		$data['kelas'] = $this->Kelas_model->get();

		if ($_POST) {
			if (isset($_POST['kelas_id'])) {
				// Update
				if ($this->Kelas_model->update($_POST) > 0) {
					Flash::flasher('Berhasil', 'Kelas berhasil diubah', 'success');
					header('Location: ' . base_url() . 'kelas');
					exit;
				} else {
					Flash::flasher('Gagal', 'Kelas gagal diubah', 'danger');
					header('Location: ' . base_url() . 'kelas');
					exit;
				}
			} else if (isset($_POST['kelas_id_delete'])) {
				// Delete
				if ($this->Kelas_model->delete($_POST['kelas_id_delete']) > 0) {
					Flash::flasher('Berhasil', 'Kelas berhasil dihapus', 'success');
					header('Location: ' . base_url() . 'kelas');
					exit;
				} else {
					Flash::flasher('Gagal', 'Kelas gagal dihapus', 'danger');
					header('Location: ' . base_url() . 'kelas');
					exit;
				}
			} else {
				// Insert
				if ($this->Kelas_model->add($_POST) > 0) {
					Flash::flasher('Berhasil', 'Kelas berhasil ditambahkan', 'success');
					header('Location: ' . base_url() . 'kelas');
					exit;
				} else {
					Flash::flasher('Gagal', 'Kelas gagal ditambahkan', 'danger');
					header('Location: ' . base_url() . 'kelas');
					exit;
				}
			}
		}

		$this->view('dashboard/v_header');
		$this->view('kelas/v_kelas', $data);
		$this->view('dashboard/v_footer');
	}

	public function jenjang() {
		$data['jenjang'] = $this->Jenjang_model->get();

		if ($_POST) {
			if (isset($_POST['jenjang_id'])) {
				// Update
				if ($this->Jenjang_model->update($_POST) > 0) {
					Flash::flasher('Berhasil', 'Jenjang berhasil diubah', 'success');
					header('Location: ' . base_url() . 'kelas/jenjang');
					exit;
				} else {
					Flash::flasher('Gagal', 'Jenjang gagal diubah', 'danger');
					header('Location: ' . base_url() . 'kelas/jenjang');
					exit;
				}
			} else if (isset($_POST['jenjang_id_delete'])) {
				// Delete
				if ($this->Jenjang_model->delete($_POST['jenjang_id_delete']) > 0) {
					Flash::flasher('Berhasil', 'Jenjang berhasil dihapus', 'success');
					header('Location: ' . base_url() . 'kelas/jenjang');
					exit;
				} else {
					Flash::flasher('Gagal', 'Jenjang gagal dihapus', 'danger');
					header('Location: ' . base_url() . 'kelas/jenjang');
					exit;
				}
			} else {
				// Insert
				if ($this->Jenjang_model->add($_POST) > 0) {
					Flash::flasher('Berhasil', 'Jenjang berhasil ditambahkan', 'success');
					header('Location: ' . base_url() . 'kelas/jenjang');
					exit;
				} else {
					Flash::flasher('Gagal', 'Jenjang gagal ditambahkan', 'danger');
					header('Location: ' . base_url() . 'kelas/jenjang');
					exit;
				}
			}
		}

		$this->view('dashboard/v_header');
		$this->view('kelas/v_jenjang', $data);
		$this->view('dashboard/v_footer');
	}

	public function tingkat() {
		$data['tingkat'] = $this->Tingkat_model->get();

		if ($_POST) {
			if (isset($_POST['tingkat_id'])) {
				// Update
				if ($this->Tingkat_model->update($_POST) > 0) {
					Flash::flasher('Berhasil', 'Tingkat berhasil diubah', 'success');
					header('Location: ' . base_url() . 'kelas/tingkat');
					exit;
				} else {
					Flash::flasher('Gagal', 'Tingkat gagal diubah', 'danger');
					header('Location: ' . base_url() . 'kelas/tingkat');
					exit;
				}
			} else if (isset($_POST['tingkat_id_delete'])) {
				// Delete
				if ($this->Tingkat_model->delete($_POST['tingkat_id_delete']) > 0) {
					Flash::flasher('Berhasil', 'Tingkat berhasil dihapus', 'success');
					header('Location: ' . base_url() . 'kelas/tingkat');
					exit;
				} else {
					Flash::flasher('Gagal', 'Tingkat gagal dihapus', 'danger');
					header('Location: ' . base_url() . 'kelas/tingkat');
					exit;
				}
			} else {
				// Insert
				if ($this->Tingkat_model->add($_POST) > 0) {
					Flash::flasher('Berhasil', 'Tingkat berhasil ditambahkan', 'success');
					header('Location: ' . base_url() . 'kelas/tingkat');
					exit;
				} else {
					Flash::flasher('Gagal', 'Tingkat gagal ditambahkan', 'danger');
					header('Location: ' . base_url() . 'kelas/tingkat');
					exit;
				}
			}
		}

		$this->view('dashboard/v_header');
		$this->view('kelas/v_tingkat', $data);
		$this->view('dashboard/v_footer');
	}

	public function jurusan() {
		$data['jurusan'] = $this->Jurusan_model->get();
		$data['jenjang'] = $this->Jenjang_model->get();

		if ($_POST) {
			if (isset($_POST['jurusan_id'])) {
				// Update
				if ($this->Jurusan_model->update($_POST) > 0) {
					Flash::flasher('Berhasil', 'Jurusan berhasil diubah', 'success');
					header('Location: ' . base_url() . 'kelas/jurusan');
					exit;
				} else {
					Flash::flasher('Gagal', 'Jurusan gagal diubah', 'danger');
					header('Location: ' . base_url() . 'kelas/jurusan');
					exit;
				}
			} else if (isset($_POST['jurusan_id_delete'])) {
				// Delete
				if ($this->Jurusan_model->delete($_POST['jurusan_id_delete']) > 0) {
					Flash::flasher('Berhasil', 'Jurusan berhasil dihapus', 'success');
					header('Location: ' . base_url() . 'kelas/jurusan');
					exit;
				} else {
					Flash::flasher('Gagal', 'Jurusan gagal dihapus', 'danger');
					header('Location: ' . base_url() . 'kelas/jurusan');
					exit;
				}
			} else {
				// Insert
				if ($this->Jurusan_model->add($_POST) > 0) {
					Flash::flasher('Berhasil', 'Jurusan berhasil ditambahkan', 'success');
					header('Location: ' . base_url() . 'kelas/jurusan');
					exit;
				} else {
					Flash::flasher('Gagal', 'Jurusan gagal ditambahkan', 'danger');
					header('Location: ' . base_url() . 'kelas/jurusan');
					exit;
				}
			}
		}

		$this->view('dashboard/v_header');
		$this->view('kelas/v_jurusan', $data);
		$this->view('dashboard/v_footer');
	}

	public function ajax_get_jurusan() {
		if ($_POST['jenjang'] == 3 || $_POST['jenjang_nama'] == 'SMA') {
			$data = $this->Jurusan_model->get_jurusan_sma();
		} else if ($_POST['jenjang'] == 4 || $_POST['jenjang_nama'] == 'SMK') {
			$data = $this->Jurusan_model->get_jurusan_smk();
		}

		echo json_encode($data);
	}

	public function ajax_get_ubah() {
		if ($_POST['kelas_id']) {
			$query = $this->Kelas_model->get_by(['kelas_id', $_POST['kelas_id']]);

			$data['status'] = 200;
			$data['message'] = 'Berhasil mengambil data';
			$data['data'] = $query;
		} else {
			$data['status'] = 200;
			$data['message'] = 'Berhasil mengambil data';
		}

		echo json_encode($data);
	}
}