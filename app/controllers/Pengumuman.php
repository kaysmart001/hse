<?php

class Pengumuman extends Controller {

	public function __construct() {
		if (!isset($_SESSION['login'])) { header('Location: ' . base_url()); }
		$this->Pengumuman_model = $this->model('Pengumuman_model');
		$this->Jenjang_model = $this->model('Jenjang_model');
		$this->Kelas_model = $this->model('Kelas_model');
		$this->Guru_model = $this->model('Guru_model');
		$this->Siswa_model = $this->model('Siswa_model');
	}

	public function index() {
		if ($_SESSION['role'] > 1) {

			if ($_SESSION['role'] == 2) {
				$check_profile = $this->Guru_model->get_by(['guru_uid', $_SESSION['id']]);
				$data['pengumuman'] = $this->Pengumuman_model->get(['pengumuman_jenjang', $check_profile->guru_jenjang], 'pengumuman_waktu DESC');
			} else if ($_SESSION['role'] == 3) {
				$check_profile = $this->Siswa_model->get_by(['siswa_uid', $_SESSION['id']]);
				$data['pengumuman'] = $this->Pengumuman_model->get(['pengumuman_jenjang', $check_profile->siswa_jenjang], 'pengumuman_waktu DESC');
			}

			$this->view('home/v_header');
			$this->view('pengumuman/v_pengumuman_siswa', $data);
			$this->view('home/v_footer');
		} else {
			$data['jenjang'] = $this->Jenjang_model->get_orderby('jenjang_id ASC');

			$this->view('dashboard/v_header');
			$this->view('pengumuman/v_pengumuman', $data);
			$this->view('dashboard/v_footer');
		}
	}

	// @param ID (jenjang_id)
	public function jenjang($id = NULL) {
		if (is_numeric($id)) {
			$data['pengumuman'] = $this->Pengumuman_model->get(['pengumuman_jenjang', $id], 'pengumuman_waktu DESC');
			$data['jenjang'] = $this->Jenjang_model->get_orderby('jenjang_id ASC');
			$data['kelas'] = $this->Kelas_model->get_kelas();

			if ($_POST) {
				if (isset($_POST['pengumuman_id'])) {
					if ($this->Pengumuman_model->update($_POST) > 0) {
						Flash::flasher('Berhasil', 'Pengumuman berhasil diubah.', 'success');
						header('Location: ' . base_url() . 'pengumuman/jenjang/' . $_POST['pengumuman_jenjang']);
						exit;
					} else {
						Flash::flasher('Gagal', 'Pengumuman gagal diubah.', 'danger');
						header('Location: ' . base_url() . 'pengumuman/jenjang/' . $_POST['pengumuman_jenjang']);
						exit;
					}
				} else if (isset($_POST['delete_type'])) {
					if ($this->Pengumuman_model->delete($_POST) > 0) {
						Flash::flasher('Berhasil', 'Pengumuman berhasil dihapus.', 'success');
						header('Location: ' . base_url() . 'pengumuman/jenjang/' . $_POST['pengumuman_jenjang']);
						exit;
					} else {
						Flash::flasher('Gagal', 'Pengumuman gagal dihapus.', 'danger');
						header('Location: ' . base_url() . 'pengumuman/jenjang/' . $_POST['pengumuman_jenjang']);
						exit;
					}
				} else {
					if ($this->Pengumuman_model->add($_POST) > 0) {
						Flash::flasher('Berhasil', 'Pengumuman berhasil ditambahkan.', 'success');
						header('Location: ' . base_url() . 'pengumuman/jenjang/' . $_POST['pengumuman_jenjang']);
						exit;
					} else {
						Flash::flasher('Gagal', 'Pengumuman gagal ditambahkan.', 'danger');
						header('Location: ' . base_url() . 'pengumuman/jenjang/' . $_POST['pengumuman_jenjang']);
						exit;
					}
				}
			}

			$this->view('dashboard/v_header');
			$this->view('pengumuman/v_pengumuman_siswa', $data);
			$this->view('dashboard/v_footer');
		} else {
			header('Location: ' . base_url() . 'pengumuman');
		}
	}
}