<?php

class Jadwal extends Controller {

	public function __construct() {
		if (!isset($_SESSION['login'])) { header('Location: ' . base_url()); }
		$this->Jadwal_model = $this->model('Jadwal_model');
		$this->Kelas_model = $this->model('Kelas_model');
		$this->Guru_model = $this->model('Guru_model');
		$this->Mapel_model = $this->model('Mapel_model');
	}

	public function index() {
		$data['jadwal'] = $this->Jadwal_model->get();
		$data['mapel'] = $this->Mapel_model->get();
		$data['kelas'] = $this->Kelas_model->get_kelas();

		$this->view('dashboard/v_header');
		$this->view('jadwal/v_jadwal', $data);
		$this->view('dashboard/v_footer');
	}

	public function process() {
		if ($_POST) {
			if (isset($_POST['jadwal_id'])) {
				if ($this->Jadwal_model->update($_POST) > 0) {
					Flash::flasher('Berhasil', 'Jadwal berhasil diubah.', 'success');
					header('Location: ' . base_url() . 'jadwal');
					exit;
				} else {
					Flash::flasher('Gagal', 'Jadwal gagal diubah.', 'danger');
					header('Location: ' . base_url() . 'jadwal');
					exit;
				}
			} else if (isset($_POST['delete_type'])) {
				if ($this->Jadwal_model->delete($_POST) > 0) {
					Flash::flasher('Berhasil', 'Jadwal berhasil dihapus.', 'success');
					header('Location: ' . base_url() . 'jadwal');
					exit;
				} else {
					Flash::flasher('Gagal', 'Jadwal gagal dihapus.', 'danger');
					header('Location: ' . base_url() . 'jadwal');
					exit;
				}
			} else {
				if ($this->Jadwal_model->add($_POST) > 0) {
					Flash::flasher('Berhasil', 'Jadwal berhasil ditambahkan.', 'success');
					header('Location: ' . base_url() . 'jadwal');
					exit;
				} else {
					Flash::flasher('Gagal', 'Jadwal gagal ditambahkan.', 'danger');
					header('Location: ' . base_url() . 'jadwal');
					exit;
				}
			}
		}
	}

	public function ajax_get_ubah() {
		if($_POST) {
			if ($_POST['id'] != '') {
				$query = $this->Jadwal_model->get(['jadwal_id', $_POST['id']], TRUE);
				$data['status'] = 200;
				$data['message'] = 'Berhasil mengambil data';
				$data['data'] = $query;
			} else {
				$data['status'] = 404;
				$data['message'] = 'ID jadwal tidak ada.';
			}
		}

		echo json_encode($data);
	}

	public function mapel() {
		if ($_SESSION['role'] > 1)
			header('Location: ' . base_url() . 'jadwal');

		$data['mapel'] = $this->Mapel_model->get();
		$data['guru'] = $this->Guru_model->get();

		if ($_POST) {
			if (isset($_POST['mapel_id'])) {
				if ($this->Mapel_model->update($_POST) > 0) {
					Flash::flasher('Berhasil', 'Mapel berhasil diubah.', 'success');
					header('Location: ' . base_url() . 'jadwal/mapel');
					exit;
				} else {
					Flash::flasher('Gagal', 'Mapel gagal diubah.', 'danger');
					header('Location: ' . base_url() . 'jadwal/mapel');
					exit;
				}
			} else if (isset($_POST['delete_type'])) {
				if ($this->Mapel_model->delete($_POST['id']) > 0) {
					Flash::flasher('Berhasil', 'Mapel berhasil dihapus.', 'success');
					header('Location: ' . base_url() . 'jadwal/mapel');
					exit;
				} else {
					Flash::flasher('Gagal', 'Mapel gagal dihapus.', 'danger');
					header('Location: ' . base_url() . 'jadwal/mapel');
					exit;
				}
			} else {
				if ($this->Mapel_model->add($_POST) > 0) {
					Flash::flasher('Berhasil', 'Mapel berhasil ditambahkan.', 'success');
					header('Location: ' . base_url() . 'jadwal/mapel');
					exit;
				} else {
					Flash::flasher('Gagal', 'Mapel gagal ditambahkan.', 'danger');
					header('Location: ' . base_url() . 'jadwal/mapel');
					exit;
				}
			}
		}

		$this->view('dashboard/v_header');
		$this->view('jadwal/v_mapel', $data);
		$this->view('dashboard/v_footer');
	}
}