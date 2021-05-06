<?php

class Siswa extends Controller {

	public function __construct() {
		if (!isset($_SESSION['login'])) { header('Location: ' . base_url()); }
		if ($_SESSION['role'] != 1) { header('Location:' . base_url()); }
		$this->Jenjang_model = $this->model('Jenjang_model');
		$this->Siswa_model = $this->model('Siswa_model');
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
						$data['siswa'] = $this->Siswa_model->get_all(['siswa_jenjang', $jenjang['jenjang_id']]);
					}
				}
			} else {
				header('Location: ' . base_url() . 'siswa');
			}
		} else {
			$data['siswa'] = $this->Siswa_model->get_all(['siswa_jenjang', 1]);
		}

		$this->view('dashboard/v_header');
		$this->view('siswa/v_daftar_siswa', $data);
		$this->view('dashboard/v_footer');
	}

	// @param ID = ID siswa
	public function detail($id = NULL) {
		$data = [];
		$data['jenjang'] = $this->Jenjang_model->get();
		$data['kelas'] = $this->Kelas_model->get();
		if (!is_null($id)) {
			if (is_numeric($id)) {
				$data['siswa'] = $this->Siswa_model->get_by(['siswa_id', $id]);
				$data['user'] = $this->User_model->get_by(['id', $data['siswa']->siswa_uid]);
			} else {
				header('Location: ' . base_url() . 'siswa');
			}
		} else {
			header('Location: ' . base_url() . 'siswa');
		}

		$this->view('dashboard/v_header');
		$this->view('siswa/v_detail_siswa', $data);
		$this->view('dashboard/v_footer');
	}

	public function add() {
		$data['jenjang'] = $this->Jenjang_model->get();
		$data['kelas'] = $this->Kelas_model->get();
		
		$this->view('dashboard/v_header');
		$this->view('siswa/v_form_siswa', $data);
		$this->view('dashboard/v_footer');
	}

	public function add_update() {
		// Setting upload photo
		$extension = ['png', 'jpg', 'jpeg'];
		$size = 1044070;

		if ($_POST) {
			$data['siswa'] = $this->Siswa_model->get_by(['siswa_uid', $_POST['siswa_uid']]);
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
								header('Location: ' . base_url() . 'siswa/detail/' . $_POST['siswa_id']);
								exit;
							} else {
								Flash::flasher('Gagal', 'Profile gagal diubah', 'danger');
								header('Location: ' . base_url() . 'siswa/detail/' . $_POST['siswa_id']);
								exit;
							}
						} else {
							$user_login = [
								'username' => $_POST['username'],
								'email' => $_POST['email'],
								'password' => $_POST['password'],
								'role' => 3
							]; 
							$insert_user = $this->User_model->create($user_login);
							if ($insert_user > 0) {
								$_POST['siswa_uid'] = $insert_user;
								if ($this->Siswa_model->add($_POST) > 0) {
									Flash::flasher('Berhasil', 'User dan Profile berhasil dibuat', 'success');
									header('Location: ' . base_url() . 'siswa/' . $_POST['siswa_jenjang']);
									exit;
								} else {
									Flash::flasher('Berhasil', 'User berhasil disimpan, namun profile gagal dibuat.', 'success');
									header('Location: ' . base_url() . 'siswa/' . $_POST['siswa_jenjang']);
									exit;
								}
							} else {
								Flash::flasher('Gagal', 'Profile gagal dibuat, last ID tidak didapatkan.', 'danger');
								header('Location: ' . base_url() . 'siswa/' . $_POST['siswa_jenjang']);
								exit;
							}
						}
					} else {
						Flash::flasher('Gagal', 'Ukuran foto melebihi ukuran yang sudah ditentukan.', 'danger');
						header('Location: ' . base_url() . 'siswa/detail/' . $_POST['siswa_id']);
						exit;
					}
				} else {
					Flash::flasher('Gagal', 'Ekstensi foto tidak diperbolehkan.', 'danger');
					header('Location: ' . base_url() . 'siswa/detail/' . $_POST['siswa_id']);
					exit;
				}
			} else {
				$_POST['siswa_foto'] = (isset($data['siswa']->siswa_foto) ? $data['siswa']->siswa_foto : 'user-default.png');
				if ($_POST['siswa_id'] != '') {
					$this->Siswa_model->update($_POST);
					Flash::flasher('Berhasil', 'Profile berhasil disimpan', 'success');
					header('Location: ' . base_url() . 'siswa/detail/' . $_POST['siswa_id']);
					exit;
				} else {
					$_POST['siswa_foto'] = 'user-default.png';
					$user_login = [
						'username' => $_POST['username'],
						'email' => $_POST['email'],
						'password' => $_POST['password'],
						'role' => 3
					]; 
					$insert_user = $this->User_model->create($user_login);
					if ($insert_user > 0) {
						$_POST['siswa_uid'] = $insert_user;
						if ($this->Siswa_model->add($_POST) > 0) {
							Flash::flasher('Berhasil', 'User dan Profile berhasil dibuat', 'success');
							header('Location: ' . base_url() . 'siswa/' . $_POST['siswa_jenjang']);
							exit;
						} else {
							Flash::flasher('Berhasil', 'User berhasil disimpan, namun profile gagal dibuat.', 'success');
							header('Location: ' . base_url() . 'siswa/' . $_POST['siswa_jenjang']);
							exit;
						}
					} else {
						Flash::flasher('Gagal', 'Profile gagal dibuat, last ID tidak didapatkan.', 'danger');
						header('Location: ' . base_url() . 'siswa/' . $_POST['siswa_jenjang']);
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
			header('Location: ' . base_url() . 'siswa/detail/' . $_POST['siswa_id']);
			exit;
		} else {
			Flash::flasher('Gagal', 'Username & email gagal diubah, id tidak ditemukan.', 'success');
			header('Location: ' . base_url() . 'siswa/detail/' . $_POST['siswa_id']);
			exit;
		}
	}

	public function change_password() {
		if (isset($_POST['password_user']) || $_POST['password_user'] != '') {
			if ($this->User_model->change_password($_POST['password_user'], $_POST['password']) > 0) {
				Flash::flasher('Berhasil', 'Password berhasil diubah', 'success');
				header('Location: ' . base_url() . 'siswa/detail/' . $_POST['password_siswa']);
				exit;
			} else {
				Flash::flasher('Gagal', 'Password gagal diubah', 'danger');
				header('Location: ' . base_url() . 'siswa/detail/' . $_POST['password_siswa']);
				exit;
			}
		} else {
			Flash::flasher('Gagal', 'Password gagal diubah, id user tidak ditemukan.', 'danger');
			header('Location: ' . base_url() . 'siswa/detail/' . $_POST['password_siswa']);
			exit;
		}
	}

	public function delete() {
		if ($_POST) {
			if (isset($_POST['siswa_id_delete'])) {
				if ($this->Siswa_model->delete($_POST['siswa_id_delete']) > 0) {
					if ($this->User_model->delete($_POST['siswa_uid_delete']) > 0) {
						Flash::flasher('Berhasil', 'Siswa berhasil dihapus', 'success');
						header('Location: ' . base_url() . 'siswa/' . $_POST['siswa_jenjang']);
						exit;
					} else {
						Flash::flasher('Peringatan', 'Siswa berhasil dihapus, namun data user login tidak.', 'danger');
						header('Location: ' . base_url() . 'siswa/' . $_POST['siswa_jenjang']);
						exit;
					}
				} else {
					Flash::flasher('Gagal', 'Siswa gagal dihapus', 'danger');
					header('Location: ' . base_url() . 'siswa/' . $_POST['siswa_jenjang']);
					exit;
				}
			} else {
				Flash::flasher('Gagal', 'Siswa gagal dihapus, ID tidak ditemukan', 'danger');
				header('Location: ' . base_url() . 'siswa/' . $_POST['siswa_jenjang']);
				exit;
			}
		}
	}
}