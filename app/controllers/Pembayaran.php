<?php

class Pembayaran extends Controller {

	public function __construct() {
		if (!isset($_SESSION['login'])) { header('Location: ' . base_url()); }
		if ($_SESSION['role'] == 2) { header('Location:' . base_url()); }

		$this->Siswa_model = $this->model('Siswa_model');
		$this->Pembayaran_model = $this->model('Pembayaran_model');
		$this->check_profile = $this->Siswa_model->get_by(['siswa_uid', $_SESSION['id']]);
	}

	public function index() {
		if ($_SESSION['role'] > 1) {
			$data['pembayaran'] = $this->Pembayaran_model->get(['pembayaran_siswa', $this->check_profile->siswa_id]);

			$this->view('home/v_header');
			$this->view('pembayaran/v_pembayaran_siswa', $data);
			$this->view('home/v_footer');
		} else {
			$data['pembayaran'] = $this->Pembayaran_model->get();

			$this->view('dashboard/v_header');
			$this->view('pembayaran/v_pembayaran', $data);
			$this->view('dashboard/v_footer');
		}
	}

	public function process() {
		if ($_POST) {
			$_POST['pembayaran_siswa'] = $this->check_profile->siswa_id;
			// Setting upload photo
			$extension = ['png', 'jpg', 'jpeg', 'pdf'];
			$size = 1044070;
			// Photo upload
			$bukti_photo = $_FILES['pembayaran_bukti']['name'];
			$x = explode('.', $bukti_photo);
			$ext = strtolower(end($x));
			$size_photo = $_FILES['pembayaran_bukti']['size'];
			$tmp_photo = $_FILES['pembayaran_bukti']['tmp_name'];
			// Check extension
			if (in_array($ext, $extension)) {
				if ($size_photo < $size) {
					// Move photo location and
					move_uploaded_file($tmp_photo, 'uploads/bukti/' . $bukti_photo);
					// Change value post photo
					$_POST['pembayaran_bukti'] = $bukti_photo;

					// Check complete or update bukti
					if ($_POST['pembayaran_id'] != '') {
						if ($this->Pembayaran_model->update($_POST) > 0) {
							Flash::flasher('Berhasil', 'Bukti pembayaran berhasil disimpan', 'success');
							header('Location: ' . base_url() . 'pembayaran');
							exit;
						} else {
							Flash::flasher('Gagal', 'Bukti pembayaran gagal diubah', 'danger');
							header('Location: ' . base_url() . 'pembayaran');
							exit;
						}
					} else {
						if ($this->Pembayaran_model->add($_POST) > 0) {
							Flash::flasher('Berhasil', 'Bukti pembayaran berhasil disimpan', 'success');
							header('Location: ' . base_url() . 'pembayaran');
							exit;
						} else {
							Flash::flasher('Gagal', 'Bukti pembayaran gagal diubah', 'danger');
							header('Location: ' . base_url() . 'pembayaran');
							exit;
						}
					}
				}
			} else {
				Flash::flasher('Gagal', 'Ekstensi file bukti tidak diperbolehkan.', 'danger');
				header('Location: ' . base_url() . 'pembayaran');
				exit;
			}
		}
	}

	public function accept($id = NULL) {
		if ($_SESSION['role'] == 1) {
			if (!is_null($id)) {
				if (is_numeric($id)) {
					if ($this->Pembayaran_model->accept($id) > 0) {
						Flash::flasher('Berhasil', 'Pembayaran berhasil diverifikasi.', 'success');
						header('Location: ' . base_url() . 'pembayaran');
						exit;
					} else {
						Flash::flasher('Gagal', 'Pembayaran gagal diverifikasi, ada masalah pada query.', 'danger');
						header('Location: ' . base_url() . 'pembayaran');
						exit;
					}
				} else {
					Flash::flasher('Gagal', 'Proses verifikasi gagal, tipe ID bukan numeric.', 'danger');
					header('Location: ' . base_url() . 'pembayaran');
					exit;
				}
			} else {
				Flash::flasher('Gagal', 'Proses verifikasi gagal, ID tidak ditemukan.', 'danger');
				header('Location: ' . base_url() . 'pembayaran');
				exit;
			}
		} else {
			Flash::flasher('Gagal', 'Hanya untuk administrator.', 'danger');
			header('Location: ' . base_url() . 'pembayaran');
			exit;
		}
	}

	public function reject($id = NULL) {
		if ($_SESSION['role'] == 1) {
			if (!is_null($id)) {
				if (is_numeric($id)) {
					if ($this->Pembayaran_model->reject($id) > 0) {
						Flash::flasher('Berhasil', 'Pembayaran berhasil ditolak.', 'success');
						header('Location: ' . base_url() . 'pembayaran');
						exit;
					} else {
						Flash::flasher('Gagal', 'Pembayaran gagal ditolak, ada masalah pada query.', 'danger');
						header('Location: ' . base_url() . 'pembayaran');
						exit;
					}
				} else {
					Flash::flasher('Gagal', 'Proses penolakan gagal, tipe ID bukan numeric.', 'danger');
					header('Location: ' . base_url() . 'pembayaran');
					exit;
				}
			} else {
				Flash::flasher('Gagal', 'Proses penolakan gagal, ID tidak ditemukan.', 'danger');
				header('Location: ' . base_url() . 'pembayaran');
				exit;
			}
		} else {
			Flash::flasher('Gagal', 'Hanya untuk administrator.', 'danger');
			header('Location: ' . base_url() . 'pembayaran');
			exit;
		}
	}
}