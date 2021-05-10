<?php

class Cbt extends Controller {

	public function __construct() {
		if (!isset($_SESSION['login'])) { header('Location: ' . base_url()); }
		$this->CBT_master_model = $this->model('CBT_master_model');
	}

	public function index() {
		$data['topik'] = $this->CBT_master_model->get_topik();

		$this->view('dashboard/v_header');
		$this->view('cbt/v_index', $data);
		$this->view('dashboard/v_footer');
	}

	public function cud_topik() {
		if ($_POST) {
			if (isset($_POST['topik_id'])) {
				if ($this->CBT_master_model->update_topik($_POST) > 0) {
					Flash::flasher('Berhasil', 'Topik berhasil diubah', 'success');
					header('Location: ' . base_url() . 'cbt');
					exit;
				} else {
					Flash::flasher('Gagal', 'Topik gagal diubah', 'danger');
					header('Location: ' . base_url() . 'cbt');
					exit;
				}
			} else if (isset($_POST['topik_id_delete'])) {
				if ($this->CBT_master_model->delete_topik($_POST['topik_id_delete']) > 0) {
					Flash::flasher('Berhasil', 'Topik berhasil dihapus', 'success');
					header('Location: ' . base_url() . 'cbt');
					exit;
				} else {
					Flash::flasher('Gagal', 'Topik gagal dihapus', 'danger');
					header('Location: ' . base_url() . 'cbt');
					exit;
				}
			} else {
				if ($this->CBT_master_model->add_topik($_POST) > 0) {
					Flash::flasher('Berhasil', 'Topik berhasil dibuat', 'success');
					header('Location: ' . base_url() . 'cbt');
					exit;
				} else {
					Flash::flasher('Gagal', 'Topik gagal dibuat', 'danger');
					header('Location: ' . base_url() . 'cbt');
					exit;
				}
			}
		}
	}

	public function soal() {
		$this->view('dashboard/v_header');
		$this->view('cbt/v_soal');
		$this->view('dashboard/v_footer');
	}

	public function ujian() {
		$this->view('dashboard/v_header');
		$this->view('cbt/v_ujian');
		$this->view('dashboard/v_footer');
	}

	public function rekap() {
		$this->view('dashboard/v_header');
		$this->view('cbt/v_rekap');
		$this->view('dashboard/v_footer');
	}
}