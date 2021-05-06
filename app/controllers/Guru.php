<?php

class Guru extends Controller {

	public function __construct() {
		if (!isset($_SESSION['login'])) { header('Location: ' . base_url()); }
		if ($_SESSION['role'] != 1) { header('Location:' . base_url()); }
		$this->Jenjang_model = $this->model('Jenjang_model');
		$this->Guru_model = $this->model('Guru_model');
		$this->Kelas_model = $this->model('Kelas_model');
		$this->User_model = $this->model('User_model');
	}

	// @param $id = ID Jenjang
	public function index($id = NULL) {
		$data['jenjang'] = $this->Jenjang_model->get_orderby('jenjang_id ASC');

		if (!is_null($id)) {
			if (is_numeric($id)) {
				foreach ($data['jenjang'] as $key => $jenjang) {
					if ($id == $jenjang['jenjang_id']) {
						$data['guru'] = $this->Guru_model->get_all(['guru_jenjang', $jenjang['jenjang_id']]);
					}
				}
			} else {
				header('Location: ' . base_url() . 'guru');
			}
		} else {
			$data['guru'] = $this->Guru_model->get_all(['guru_jenjang', 1]);
		}

		$this->view('dashboard/v_header');
		$this->view('guru/v_daftar_guru', $data);
		$this->view('dashboard/v_footer');
	}

	public function add() {
		$data['jenjang'] = $this->Jenjang_model->get();
		$data['kelas'] = $this->Kelas_model->get();

		$this->view('dashboard/v_header');
		$this->view('guru/v_form_guru', $data);
		$this->view('dashboard/v_footer');
	}

	// @param ID = ID guru
	public function detail($id = NULL) {
		$data = [];
		$data['jenjang'] = $this->Jenjang_model->get();
		$data['kelas'] = $this->Kelas_model->get();
		if (!is_null($id)) {
			if (is_numeric($id)) {
				$data['guru'] = $this->Guru_model->get_by(['guru_id', $id]);
				$data['user'] = $this->User_model->get_by(['id', $data['guru']->guru_uid]);
			} else {
				header('Location: ' . base_url() . 'guru');
			}
		} else {
			header('Location: ' . base_url() . 'guru');
		}

		$this->view('dashboard/v_header');
		$this->view('guru/v_detail_guru', $data);
		$this->view('dashboard/v_footer');
	}

	public function add_update() {
		// Setting upload photo
		$extension = ['png', 'jpg', 'jpeg'];
		$size = 1044070;

		if ($_POST) {
			$data['guru'] = $this->Guru_model->get_by(['guru_uid', $_POST['guru_uid']]);
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
								header('Location: ' . base_url() . 'guru/detail/' . $_POST['guru_id']);
								exit;
							} else {
								Flash::flasher('Gagal', 'Profile gagal diubah', 'danger');
								header('Location: ' . base_url() . 'guru/detail/' . $_POST['guru_id']);
								exit;
							}
						} else {
							$user_login = [
								'username' => $_POST['username'],
								'email' => $_POST['email'],
								'password' => $_POST['password'],
								'role' => 2
							]; 
							$insert_user = $this->User_model->create($user_login);
							if ($insert_user > 0) {
								$_POST['guru_uid'] = $insert_user;
								if ($this->Guru_model->add($_POST) > 0) {
									Flash::flasher('Berhasil', 'User dan Profile berhasil dibuat', 'success');
									header('Location: ' . base_url() . 'guru/' . $_POST['guru_jenjang']);
									exit;
								} else {
									Flash::flasher('Berhasil', 'User berhasil disimpan, namun profile gagal dibuat.', 'success');
									header('Location: ' . base_url() . 'guru/' . $_POST['guru_jenjang']);
									exit;
								}
							} else {
								Flash::flasher('Gagal', 'Profile gagal dibuat, last ID tidak didapatkan.', 'danger');
								header('Location: ' . base_url() . 'guru/' . $_POST['guru_jenjang']);
								exit;
							}
						}
					} else {
						Flash::flasher('Gagal', 'Ukuran foto melebihi ukuran yang sudah ditentukan.', 'danger');
						header('Location: ' . base_url() . 'guru/detail/' . $_POST['guru_id']);
						exit;
					}
				} else {
					Flash::flasher('Gagal', 'Ekstensi foto tidak diperbolehkan.', 'danger');
					header('Location: ' . base_url() . 'guru/detail/' . $_POST['guru_id']);
					exit;
				}
			} else {
				$_POST['guru_foto'] = (isset($data['guru']->guru_foto) ? $data['guru']->guru_foto : 'user-default.png');
				if ($_POST['guru_id'] != '') {
					$this->Guru_model->update($_POST);
					Flash::flasher('Berhasil', 'Profile berhasil disimpan', 'success');
					header('Location: ' . base_url() . 'guru/detail/' . $_POST['guru_id']);
					exit;
				} else {
					$_POST['guru_foto'] = 'user-default.png';
					$user_login = [
						'username' => $_POST['username'],
						'email' => $_POST['email'],
						'password' => $_POST['password'],
						'role' => 2
					]; 
					$insert_user = $this->User_model->create($user_login);
					if ($insert_user > 0) {
						$_POST['guru_uid'] = $insert_user;
						if ($this->Guru_model->add($_POST) > 0) {
							Flash::flasher('Berhasil', 'User dan Profile berhasil dibuat', 'success');
							header('Location: ' . base_url() . 'guru/' . $_POST['guru_jenjang']);
							exit;
						} else {
							Flash::flasher('Berhasil', 'User berhasil disimpan, namun profile gagal dibuat.', 'success');
							header('Location: ' . base_url() . 'guru/' . $_POST['guru_jenjang']);
							exit;
						}
					} else {
						Flash::flasher('Gagal', 'Profile gagal dibuat, last ID tidak didapatkan.', 'danger');
						header('Location: ' . base_url() . 'guru/' . $_POST['guru_jenjang']);
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
			header('Location: ' . base_url() . 'guru/detail/' . $_POST['guru_id']);
			exit;
		} else {
			Flash::flasher('Gagal', 'Username & email gagal diubah, id tidak ditemukan.', 'success');
			header('Location: ' . base_url() . 'guru/detail/' . $_POST['guru_id']);
			exit;
		}
	}

	public function change_password() {
		if (isset($_POST['password_user']) || $_POST['password_user'] != '') {
			if ($this->User_model->change_password($_POST['password_user'], $_POST['password']) > 0) {
				Flash::flasher('Berhasil', 'Password berhasil diubah', 'success');
				header('Location: ' . base_url() . 'guru/detail/' . $_POST['password_guru']);
				exit;
			} else {
				Flash::flasher('Gagal', 'Password gagal diubah', 'danger');
				header('Location: ' . base_url() . 'guru/detail/' . $_POST['password_guru']);
				exit;
			}
		} else {
			Flash::flasher('Gagal', 'Password gagal diubah, id user tidak ditemukan.', 'danger');
			header('Location: ' . base_url() . 'guru/detail/' . $_POST['password_guru']);
			exit;
		}
	}

	public function delete() {
		if ($_POST) {
			if (isset($_POST['guru_id_delete'])) {
				if ($this->Guru_model->delete($_POST['guru_id_delete']) > 0) {
					if ($this->User_model->delete($_POST['guru_uid_delete']) > 0) {
						Flash::flasher('Berhasil', 'Guru berhasil dihapus', 'success');
						header('Location: ' . base_url() . 'guru' . $_POST['guru_jenjang']);
						exit;
					} else {
						Flash::flasher('Peringatan', 'Guru berhasil dihapus, namun data user login tidak.', 'danger');
						header('Location: ' . base_url() . 'guru/' . $_POST['guru_jenjang']);
						exit;
					}
				} else {
					Flash::flasher('Gagal', 'Guru gagal dihapus', 'danger');
					header('Location: ' . base_url() . 'guru/' . $_POST['guru_jenjang']);
					exit;
				}
			} else {
				Flash::flasher('Gagal', 'Guru gagal dihapus, ID tidak ditemukan', 'danger');
				header('Location: ' . base_url() . 'guru/' . $_POST['guru_jenjang']);
				exit;
			}
		}
	}
}