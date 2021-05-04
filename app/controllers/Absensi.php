<?php

class Absensi extends Controller {

	public function __construct() {
		if (!isset($_SESSION['login'])) { header('Location: ' . base_url()); }
		$this->Absensi_model = $this->model('Absensi_model');
		$this->Kelas_model = $this->model('Kelas_model');
		$this->Jenjang_model = $this->model('Jenjang_model');
	}

	public function index() {
		if ($_SESSION['role'] != 1) {
			$this->view('home/v_header');
			$where = NULL;

			if ($_SESSION['role'] == 2) {
				if ($_POST) {
					if ($_POST['by_bulan'] != '' && $_POST['by_tahun'] != '') {
						$bt = date($_POST['by_tahun'] . '-' . $_POST['by_bulan'] . '-01');
						$where = date('Y-m-t', strtotime($bt));
					} else if ($_POST['by_bulan'] != '') {
						$b = date('Y-' . $_POST['by_bulan'] . '-01');
						$where = date('Y-m-t', strtotime($b));
					} else if ($_POST['by_tahun'] != '') {
						$where = date($_POST['by_tahun'] . '-m-t');
					}
				}
				$absensi = $this->Absensi_model->get_guru_bydate($where, ['absen_user', $_SESSION['id']]);
				$data['absensi'] = $absensi;
				$this->view('absensi/v_absensi_guru', $data);
			} else if ($_SESSION['role'] == 3) {
				if ($_POST) {
					if ($_POST['by_bulan'] != '' && $_POST['by_tahun'] != '') {
						$bt = date($_POST['by_tahun'] . '-' . $_POST['by_bulan'] . '-01');
						$where = date('Y-m-t', strtotime($bt));
					} else if ($_POST['by_bulan'] != '') {
						$b = date('Y-' . $_POST['by_bulan'] . '-01');
						$where = date('Y-m-t', strtotime($b));
					} else if ($_POST['by_tahun'] != '') {
						$where = date($_POST['by_tahun'] . '-m-t');
					}
				}
				$absensi = $this->Absensi_model->get_siswa_bydate($where, ['absen_user', $_SESSION['id']]);
				$data['absensi'] = $absensi;
				$this->view('absensi/v_absensi_siswa', $data);
			}

			$this->view('home/v_footer');
		} else {
			$this->view('dashboard/v_header');
			$this->view('absensi/v_absensi');
			$this->view('dashboard/v_footer');
		}
	}

	public function guru() {
		if ($_SESSION['role'] != 1) { header('Location: ' . base_url()); }
		$absensi = $this->Absensi_model->get_guru();
		$data['jenjang'] = $this->Jenjang_model->get();

		if ($_POST) {
			if (isset($_POST['by_jenjang']) && $_POST['by_jenjang'] != '') {
				$absensi = $this->Absensi_model->get_guru(['guru_jenjang', $_POST['by_jenjang']]);
			} else if ($_POST['by_bulan'] != '' && $_POST['by_tahun'] != '') {
				$bt = date($_POST['by_tahun'] . '-' . $_POST['by_bulan'] . '-01');
				$bulan_tahun = date('Y-m-t', strtotime($bt));
				$absensi = $this->Absensi_model->get_guru_bydate($bulan_tahun);
			} else if ($_POST['by_bulan'] != '') {
				$b = date('Y-' . $_POST['by_bulan'] . '-01');
				$bulan = date('Y-m-t', strtotime($b));
				$absensi = $this->Absensi_model->get_guru_bydate($bulan);
			} else if ($_POST['by_tahun'] != '') {
				$tahun = date($_POST['by_tahun'] . '-m-t');
				$absensi = $this->Absensi_model->get_guru_bydate($tahun);
			} 
		}

		$data['absensi'] = $absensi;
		
		$this->view('dashboard/v_header');
		$this->view('absensi/v_absensi_guru', $data);
		$this->view('dashboard/v_footer');
	}

	public function siswa() {
		if ($_SESSION['role'] != 1) { header('Location: ' . base_url()); }
		$absensi = $this->Absensi_model->get_siswa();
		$data['kelas'] = $this->Kelas_model->get_kelas();

		if ($_POST) {
			if (isset($_POST['by_kelas']) && $_POST['by_kelas'] != '') {
				$absensi = $this->Absensi_model->get_siswa(['siswa_kelas', (int)$_POST['by_kelas']]);
			} else if ($_POST['by_bulan'] != '' && $_POST['by_tahun'] != '') {
				$bt = date($_POST['by_tahun'] . '-' . $_POST['by_bulan'] . '-01');
				$bulan_tahun = date('Y-m-t', strtotime($bt));
				$absensi = $this->Absensi_model->get_siswa_bydate($bulan_tahun);
			} else if ($_POST['by_bulan'] != '') {
				$b = date('Y-' . $_POST['by_bulan'] . '-01');
				$bulan = date('Y-m-t', strtotime($b));
				$absensi = $this->Absensi_model->get_siswa_bydate($bulan);
			} else if ($_POST['by_tahun'] != '') {
				$tahun = date($_POST['by_tahun'] . '-m-t');
				$absensi = $this->Absensi_model->get_siswa_bydate($tahun);
			} 
		}

		$data['absensi'] = $absensi;
		
		$this->view('dashboard/v_header');
		$this->view('absensi/v_absensi_siswa', $data);
		$this->view('dashboard/v_footer');
	}

	public function post_absen() {
		if ($_POST) {
			if ($_POST['absen_user'] != '' && $_POST['absen_jenis'] != '' && $_POST['absen_waktu'] != '') {
				if ($_POST['absen_user'] == $_SESSION['id']) {
					if ($this->Absensi_model->add($_POST)) {
						Flash::flasher('Berhasil', 'Absen berhasil ditambahkan.', 'success');
						header('Location: ' . base_url() . 'absensi');
						exit;
					} else {
						Flash::flasher('Gagal', 'Absen gagal ditambahkan.', 'danger');
						header('Location: ' . base_url() . 'absensi');
						exit;
					}
				} else {
					Flash::flasher('Gagal', 'Absen gagal data pengguna tidak sama.', 'danger');
					header('Location: ' . base_url() . 'absensi');
					exit;
				}
			} else {
				Flash::flasher('Gagal', 'Absen gagal data yang diperlukan tidak ditemukan.', 'danger');
				header('Location: ' . base_url() . 'absensi');
				exit;
			}
		} else {
			Flash::flasher('Gagal', 'Absen gagal data yang diperlukan tidak ditemukan.', 'danger');
			header('Location: ' . base_url() . 'kelas');
			exit;
		}
	}

}