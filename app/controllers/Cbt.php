<?php

class Cbt extends Controller {

	public function __construct() {
		if (!isset($_SESSION['login'])) { header('Location: ' . base_url()); }
		if ($_SESSION['role'] == 3) { header('Location: ' . base_url()); }
		$this->CBT_master_model = $this->model('CBT_master_model');
	}

	public function index() {
		$data['topik'] = $this->CBT_master_model->get_topik();

		if ($_SESSION['role'] == 2) {
			$this->view('home/v_header');
			$this->view('cbt/v_index', $data);
			$this->view('home/v_footer');
		} else if ($_SESSION['role'] == 1) {
			$this->view('dashboard/v_header');
			$this->view('cbt/v_index', $data);
			$this->view('dashboard/v_footer');
		}
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
		$data['soal'] = $this->CBT_master_model->get_soal();
		$data['topik'] = $this->CBT_master_model->get_topik();

		if ($_SESSION['role'] == 2) {
			$this->view('home/v_header');
			$this->view('cbt/v_soal', $data);
			$this->view('home/v_footer');
		} else if ($_SESSION['role'] == 1) {
			$this->view('dashboard/v_header');
			$this->view('cbt/v_soal', $data);
			$this->view('dashboard/v_footer');
		}
	}
	public function cud_soal() {
		if ($_POST) {
			if (isset($_POST['soal_id'])) {
				if ($this->CBT_master_model->update_soal($_POST) > 0) {
					Flash::flasher('Berhasil', 'Soal berhasil diubah', 'success');
					header('Location: ' . base_url() . 'cbt/soal');
					exit;
				} else {
					Flash::flasher('Gagal', 'Soal gagal diubah', 'danger');
					header('Location: ' . base_url() . 'cbt/soal');
					exit;
				}
			} else if (isset($_POST['soal_id_delete'])) {
				if ($this->CBT_master_model->delete_soal($_POST['soal_id_delete']) > 0) {
					Flash::flasher('Berhasil', 'Soal berhasil dihapus', 'success');
					header('Location: ' . base_url() . 'cbt/soal');
					exit;
				} else {
					Flash::flasher('Gagal', 'Soal gagal dihapus', 'danger');
					header('Location: ' . base_url() . 'cbt/soal');
					exit;
				}
			} else {
				if ($this->CBT_master_model->add_soal($_POST) > 0) {
					Flash::flasher('Berhasil', 'Soal berhasil dibuat', 'success');
					header('Location: ' . base_url() . 'cbt/soal');
					exit;
				} else {
					Flash::flasher('Gagal', 'Soal gagal dibuat', 'danger');
					header('Location: ' . base_url() . 'cbt/soal');
					exit;
				}
			}
		}
	}

	public function jawaban($id = NULL) {
		if (!is_null($id)) {
			if (is_numeric($id)) {
				$soal = $this->CBT_master_model->get_soal(['soal_id', $id], TRUE);
				$jawaban = $this->CBT_master_model->get_jawaban(['jawaban_soal', $id]);

				if (count($soal) > 0) {
					$data['soal'] = $soal;
					$data['jawaban'] = $jawaban;
				} else {
					$data['soal'] = [];
					$data['jawaban'] = [];
				}

				if ($_SESSION['role'] == 2) {
					$this->view('home/v_header');
					$this->view('cbt/v_jawaban', $data);
					$this->view('home/v_footer');
				} else if ($_SESSION['role'] == 1) {
					$this->view('dashboard/v_header');
					$this->view('cbt/v_jawaban', $data);
					$this->view('dashboard/v_footer');
				}
			} else {
				header('Location: ' . base_url() . 'cbt/soal');
			}
		} else {
			header('Location: ' . base_url() . 'cbt/soal');
		}
	}
	public function cud_jawaban() {
		if ($_POST) {
			if (isset($_POST['jawaban_id'])) {
				if ($this->CBT_master_model->update_jawaban($_POST) > 0) {
					Flash::flasher('Berhasil', 'Jawaban berhasil diubah', 'success');
					header('Location: ' . base_url() . 'cbt/jawaban/' . $_POST['jawaban_soal']);
					exit;
				} else {
					Flash::flasher('Gagal', 'Jawaban gagal diubah', 'danger');
					header('Location: ' . base_url() . 'cbt/jawaban/' . $_POST['jawaban_soal']);
					exit;
				}
			} else if (isset($_POST['jawaban_id_delete'])) {
				if ($this->CBT_master_model->delete_jawaban($_POST['jawaban_id_delete']) > 0) {
					Flash::flasher('Berhasil', 'Jawaban berhasil dihapus', 'success');
					header('Location: ' . base_url() . 'cbt/jawaban/' . $_POST['jawaban_soal']);
					exit;
				} else {
					Flash::flasher('Gagal', 'Jawaban gagal dihapus', 'danger');
					header('Location: ' . base_url() . 'cbt/jawaban/' . $_POST['jawaban_soal']);
					exit;
				}
			} else {
				if ($this->CBT_master_model->add_jawaban($_POST) > 0) {
					Flash::flasher('Berhasil', 'Jawaban berhasil dibuat', 'success');
					header('Location: ' . base_url() . 'cbt/jawaban/' . $_POST['jawaban_soal']);
					exit;
				} else {
					Flash::flasher('Gagal', 'Jawaban gagal dibuat', 'danger');
					header('Location: ' . base_url() . 'cbt/jawaban/' . $_POST['jawaban_soal']);
					exit;
				}
			}
		}
	}

	public function ujian() {
		if ($_SESSION['role'] == 2) {
			$this->view('home/v_header');
			$this->view('cbt/v_ujian');
			$this->view('home/v_footer');
		} else if ($_SESSION['role'] == 1) {
			$this->view('dashboard/v_header');
			$this->view('cbt/v_ujian');
			$this->view('dashboard/v_footer');
		}
	}

	public function rekap() {
		if ($_SESSION['role'] == 2) {
			$this->view('home/v_header');
			$this->view('cbt/v_rekap');
			$this->view('home/v_footer');
		} else if ($_SESSION['role'] == 1) {
			$this->view('dashboard/v_header');
			$this->view('cbt/v_rekap');
			$this->view('dashboard/v_footer');
		}
	}
}