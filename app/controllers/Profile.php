<?php

class Profile extends Controller {

	public function __construct() {
		// Check session login
		if (!isset($_SESSION['login'])) { header('Location: ' . base_url()); }

		$this->User_model = $this->model('User_model');
		$this->Jenjang_model = $this->model('Jenjang_model');
		$this->Kelas_model = $this->model('Kelas_model');
		$this->Guru_model = $this->model('Guru_model');
		$this->Siswa_model = $this->model('Siswa_model');
	}

	public function index() {
		$data['user'] = $this->User_model->get_by(['id', $_SESSION['id']]);
		$data['guru'] = $this->Guru_model->get_by(['guru_uid', $_SESSION['id']]);
		$data['siswa'] = $this->Siswa_model->get_by(['siswa_uid', $_SESSION['id']]);
		$data['jenjang'] = $this->Jenjang_model->get();
		$data['kelas'] = $this->Kelas_model->get();

		// Check role user
		if ($_SESSION['role'] == 1) {
			$this->view('dashboard/v_header');
			$this->view('profile/v_profile_admin', $data);
			$this->view('dashboard/v_footer');
		} else {
			if ($_SESSION['role'] == 2) {
				$this->view('home/v_header');
				$this->view('profile/v_profile_guru', $data);
				$this->view('home/v_footer');
			} else if ($_SESSION['role'] == 3) {
				$this->view('home/v_header');
				$this->view('profile/v_profile_siswa', $data);
				$this->view('home/v_footer');
			}
		}
	}

	public function update_guru() {
		$data['guru'] = $this->Guru_model->get_by(['guru_uid', $_SESSION['id']]);
		// Setting upload photo
		$extension = ['png', 'jpg', 'jpeg'];
		$size = 1044070;

		if ($_POST) {
			if ($_FILES['guru_foto']['name'] != '' && $_FILES['guru_foto']['size'] != 0) {
				// Photo upload
				$name_photo = $_FILES['guru_foto']['name'];
				$x = explode('.', $name_photo);
				$ext = strtolower(end($x));
				$size_photo = $_FILES['guru_foto']['size'];
				$tmp_photo = $_FILES['guru_foto']['tmp_name'];
				// Check extension
				if (in_array($ext, $extension)) {
					if ($size_photo < $size) {
						// Move photo location and
						move_uploaded_file($tmp_photo, 'uploads/profile/' . $name_photo);
						// Change value post photo
						$_POST['guru_foto'] = $name_photo;
						
						// Check complete or update profile
						if ($_POST['guru_id'] != '') {
							if ($this->Guru_model->update($_POST) > 0) {
								Flash::flasher('Berhasil', 'Profile berhasil disimpan', 'success');
								header('Location: ' . base_url() . 'profile');
								exit;
							} else {
								Flash::flasher('Gagal', 'Profile gagal diubah', 'danger');
								header('Location: ' . base_url() . 'profile');
								exit;
							}
						} else {
							if ($this->Guru_model->add($_POST) > 0) {
								Flash::flasher('Berhasil', 'Profile berhasil disimpan', 'success');
								header('Location: ' . base_url() . 'profile');
								exit;
							} else {
								Flash::flasher('Gagal', 'Profile gagal diubah', 'danger');
								header('Location: ' . base_url() . 'profile');
								exit;
							}
						}
					} else {
						Flash::flasher('Gagal', 'Ukuran foto melebihi ukuran yang sudah ditentukan.', 'danger');
						header('Location: ' . base_url() . 'profile');
						exit;
					}
				} else {
					Flash::flasher('Gagal', 'Ekstensi foto tidak diperbolehkan.', 'danger');
					header('Location: ' . base_url() . 'profile');
					exit;
				}
			} else {
				$_POST['guru_foto'] = (isset($data['guru']->guru_foto) ? $data['guru']->guru_foto : 'user-default.png');
				if ($_POST['guru_id'] != '') {
					$this->Guru_model->update($_POST);
					Flash::flasher('Berhasil', 'Profile berhasil disimpan', 'success');
					header('Location: ' . base_url() . 'profile');
					exit;
				} else {
					if ($this->Guru_model->add($_POST) > 0) {
						Flash::flasher('Berhasil', 'Profile berhasil disimpan', 'success');
						header('Location: ' . base_url() . 'profile');
						exit;
					} else {
						Flash::flasher('Gagal', 'Profile gagal diubah', 'danger');
						header('Location: ' . base_url() . 'profile');
						exit;
					}
				}
			}
		}
	}

	public function update_siswa() {
		$data['siswa'] = $this->Siswa_model->get_by(['siswa_uid', $_SESSION['id']]);
		// Setting upload photo
		$extension = ['png', 'jpg', 'jpeg'];
		$size = 1044070;

		if ($_POST) {
			if ($_FILES['siswa_foto']['name'] != '' && $_FILES['siswa_foto']['size'] != 0) {
				// Photo upload
				$name_photo = $_FILES['siswa_foto']['name'];
				$x = explode('.', $name_photo);
				$ext = strtolower(end($x));
				$size_photo = $_FILES['siswa_foto']['size'];
				$tmp_photo = $_FILES['siswa_foto']['tmp_name'];
				// Check extension
				if (in_array($ext, $extension)) {
					if ($size_photo < $size) {
						// Move photo location and
						move_uploaded_file($tmp_photo, 'uploads/profile/' . $name_photo);
						// Change value post photo
						$_POST['siswa_foto'] = $name_photo;
						
						// Check complete or update profile
						if ($_POST['siswa_id'] != '') {
							if ($this->Siswa_model->update($_POST) > 0) {
								Flash::flasher('Berhasil', 'Profile berhasil disimpan', 'success');
								header('Location: ' . base_url() . 'profile');
								exit;
							} else {
								Flash::flasher('Gagal', 'Profile gagal diubah', 'danger');
								header('Location: ' . base_url() . 'profile');
								exit;
							}
						} else {
							if ($this->Siswa_model->add($_POST) > 0) {
								Flash::flasher('Berhasil', 'Profile berhasil disimpan', 'success');
								header('Location: ' . base_url() . 'profile');
								exit;
							} else {
								Flash::flasher('Gagal', 'Profile gagal diubah', 'danger');
								header('Location: ' . base_url() . 'profile');
								exit;
							}
						}
					} else {
						Flash::flasher('Gagal', 'Ukuran foto melebihi ukuran yang sudah ditentukan.', 'danger');
						header('Location: ' . base_url() . 'profile');
						exit;
					}
				} else {
					Flash::flasher('Gagal', 'Ekstensi foto tidak diperbolehkan.', 'danger');
					header('Location: ' . base_url() . 'profile');
					exit;
				}
			} else {
				$_POST['siswa_foto'] = (isset($data['siswa']->siswa_foto) ? $data['siswa']->siswa_foto : 'user-default.png');
				if ($_POST['siswa_id'] != '') {
					$this->Siswa_model->update($_POST);
					Flash::flasher('Berhasil', 'Profile berhasil disimpan', 'success');
					header('Location: ' . base_url() . 'profile');
					exit;
				} else {
					if ($this->Siswa_model->add($_POST) > 0) {
						Flash::flasher('Berhasil', 'Profile berhasil disimpan', 'success');
						header('Location: ' . base_url() . 'profile');
						exit;
					} else {
						Flash::flasher('Gagal', 'Profile gagal diubah', 'danger');
						header('Location: ' . base_url() . 'profile');
						exit;
					}
				}
			}
		}
	}

	public function change_useremail() {
		if (isset($_POST['id']) || $_POST['id'] != '') {
			$this->User_model->update($_POST);
			Flash::flasher('Berhasil', 'Username & email berhasil diubah', 'success');
			header('Location: ' . base_url() . 'profile');
			exit;
		} else {
			Flash::flasher('Gagal', 'Username & email gagal diubah, id tidak ditemukan.', 'success');
			header('Location: ' . base_url() . 'profile');
			exit;
		}
	}

	public function change_password() {
		if (isset($_POST['password_user']) || $_POST['password_user'] != '') {
			if ($this->User_model->change_password($_POST['password_user'], $_POST['password']) > 0) {
				Flash::flasher('Berhasil', 'Password berhasil diubah', 'success');
				header('Location: ' . base_url() . 'profile');
				exit;
			} else {
				Flash::flasher('Gagal', 'Password gagal diubah', 'danger');
				header('Location: ' . base_url() . 'profile');
				exit;
			}
		} else {
			Flash::flasher('Gagal', 'Password gagal diubah, id user tidak ditemukan.', 'danger');
			header('Location: ' . base_url() . 'profile');
			exit;
		}
	}

}