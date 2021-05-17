<?php

class Cbt extends Controller {

	public function __construct() {
		if (!isset($_SESSION['login'])) { header('Location: ' . base_url()); }
		$this->CBT_master_model = $this->model('CBT_master_model');
		$this->Soal_model = $this->model('Soal_model');
		$this->Jawaban_model = $this->model('Jawaban_model');
		$this->Kelas_model = $this->model('Kelas_model');
		$this->Ujian_model = $this->model('Ujian_model');
		$this->Guru_model = $this->model('Guru_model');
		$this->Siswa_model = $this->model('Siswa_model');
	}

	public function index() {
		if ($_SESSION['role'] == 3) { header('Location: ' . base_url() . 'cbt/ujian'); }

		$where_topik = NULL;
		if ($_SESSION['role'] == 2)
			$where_topik = ['topik_pembuat', $_SESSION['id']];

		$data['topik'] = $this->CBT_master_model->get_topik($where_topik);

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
		if ($_SESSION['role'] == 3) { header('Location: ' . base_url() . 'cbt/ujian'); }

		$where_soal = NULL;
		$where_topik = NULL;
		if ($_SESSION['role'] == 2) {
			$where_topik = ['topik_pembuat', $_SESSION['id']];
			$where_soal = ['soal_pembuat', $_SESSION['id']];
		}

		$data['soal'] = $this->CBT_master_model->get_soal($where_soal);
		$data['topik'] = $this->CBT_master_model->get_topik($where_topik);

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
		if ($_SESSION['role'] == 3) { header('Location: ' . base_url() . 'cbt/ujian'); }

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
	public function get_total_jawaban() {
		if ($_POST) {
			if ($_POST['topik_id'] != '') {
				$gs = $this->CBT_master_model->get_soal(['soal_topik', $_POST['topik_id']]);
				$a = [];
				foreach ($gs as $key => $value) {
					if ($value['soal_tipe'] == 1) {
						array_push($a, $value['soal_id']);
					}
				}
				$gj = $this->CBT_master_model->get_jawaban(NULL, implode(",", $a), FALSE);

				echo json_encode(['total' => count($gj)]);
			}
		}
	}

	public function ujian() {
		$where_ujian = NULL;
		$where_ujian_siswa = NULL;
		if ($_SESSION['role'] == 2) {
			$where_ujian = ['ujian_pembuat', $_SESSION['id']];
		}

		if ($_SESSION['role'] == 3) {
			$data_siswa = $this->Siswa_model->get_all(['siswa_uid', $_SESSION['id']], TRUE);
			$where_ujian = ['group_kelas', $data_siswa->siswa_kelas];
			$where_ujian_siswa = ['users_siswa', $data_siswa->siswa_id];
		}

		$data['ujian'] = $this->Ujian_model->get($where_ujian);
		$data['ujian_users'] = $this->Ujian_model->get_users($where_ujian_siswa, NULL, TRUE);

		if ($_SESSION['role'] != 1) {
			$this->view('home/v_header');
			$this->view('cbt/v_ujian', $data);
			$this->view('home/v_footer');
		} else {
			$this->view('dashboard/v_header');
			$this->view('cbt/v_ujian', $data);
			$this->view('dashboard/v_footer');
		}
	}
	public function form_ujian($id = NULL) {
		$data['kelas'] = $this->Kelas_model->get();
		$data['topik'] = $this->CBT_master_model->get_topik();
		$data['guru'] = $this->Guru_model->get_all();

		if (!is_null($id))
			if (is_numeric($id))
				if (count($this->Ujian_model->get(['ujian_id', $id])) > 0)
					$data['ujian'] = $this->Ujian_model->get(['ujian_id', $id], TRUE);

		if ($_POST) {
			// Waktu ujian mulai -akhir
			$dt_time = explode(" - ", $_POST['ujian_startend_date']);

			$_POST['ujian_waktu_mulai'] = $dt_time[0];
			$_POST['ujian_waktu_akhir'] = $dt_time[1];

			if ($_SESSION['role'] == 2) 
				$_POST['ujian_pembuat'] = $_SESSION['id'];

			if (isset($_POST['ujian_id'])) {
				// Cek ujian sedang berlangsung/dipakai atau tidak
				if (empty($this->Ujian_model->check($_POST['ujian_id']))) {
					$this->Ujian_model->update($_POST);
					$this->Ujian_model->update_group($_POST);
					$this->Ujian_model->update_topik($_POST);

					Flash::flasher('Berhasil', 'Ujian berhasil diubah.', 'success');
					header('Location: ' . base_url() . 'cbt/ujian');
					exit;
				} else {
					Flash::flasher('Gagal', 'Ujian gagal diubah, karena ujian sedang berlangsung atau sedang digunakan.', 'danger');
					header('Location: ' . base_url() . 'cbt/ujian');
					exit;
				}
			} else {
				// code insert..
				$insert_ujian = $this->Ujian_model->insert($_POST);
				if ($insert_ujian > 0) {
					$_POST['group_ujian'] = $insert_ujian;
					if ($this->Ujian_model->insert_group($_POST) > 0) {
						$_POST['ut_ujian'] = $insert_ujian;
						if ($this->Ujian_model->insert_topik($_POST) > 0) {
							Flash::flasher('Berhasil', 'Ujian berhasil dibuat.', 'success');
							header('Location: ' . base_url() . 'cbt/ujian');
							exit;
						} else {
							Flash::flasher('Gagal', 'Topik ujian gagal dibuat, silahkan hapus ujian dan buat ulang.', 'danger');
							header('Location: ' . base_url() . 'cbt/ujian');
							exit;
						}
					} else {
						Flash::flasher('Gagal', 'Grup kelas ujian gagal dibuat, silahkan hapus ujian dan buat ulang.', 'success');
						header('Location: ' . base_url() . 'cbt/ujian');
						exit;
					}
				} else {
					Flash::flasher('Gagal', 'Ujian gagal dibuat.', 'danger');
					header('Location: ' . base_url() . 'cbt/form_ujian');
					exit;
				}
			}
		}

		if ($_SESSION['role'] != 1) {
			$this->view('home/v_header');
			$this->view('cbt/v_form_ujian', $data);
			$this->view('home/v_footer');
		} else {
			$this->view('dashboard/v_header');
			$this->view('cbt/v_form_ujian', $data);
			$this->view('dashboard/v_footer');
		}
	}
	public function detail_ujian($id = NULL) {
		if ($_SESSION['role'] == 3) { header('Location: ' .base_url() .'cbt/ujian'); }
		$data['kelas'] = $this->Kelas_model->get();
		$data['topik'] = $this->CBT_master_model->get_topik();
		$data['guru'] = $this->Guru_model->get_all();

		if (!is_null($id))
			if (is_numeric($id))
				if (count($this->Ujian_model->get(['ujian_id', $id])) > 0)
					$data['ujian'] = $this->Ujian_model->get(['ujian_id', $id], TRUE);

		$where_pembuat = NULL;
		if ($_SESSION['role'] == 2)
			$where_pembuat = ['ujian_pembuat', $_SESSION['id']];

		$data['list_siswa'] = $this->CBT_master_model->get_all_hasil_ujian_siswa(['ujian_id', $id], $where_pembuat);

		if ($_SESSION['role'] != 1) {
			$this->view('home/v_header');
			$this->view('cbt/v_detail_ujian', $data);
			$this->view('home/v_footer');
		} else {
			$this->view('dashboard/v_header');
			$this->view('cbt/v_detail_ujian', $data);
			$this->view('dashboard/v_footer');
		}
	}
	public function delete_ujian() {
		if ($_POST) {
			if (isset($_POST['ujian_id'])) {
				if (empty($this->Ujian_model->check($_POST['ujian_id']))) {
					if ($this->Ujian_model->delete($_POST['ujian_id']) > 0) {
						Flash::flasher('Berhasil', 'Ujian berhasil dihapus.', 'success');
						header('Location: ' . base_url() . 'cbt/ujian');
						exit;
					} else {
						Flash::flasher('Gagal', 'Ujian gagal dihapus.', 'danger');
						header('Location: ' . base_url() . 'cbt/ujian');
						exit;
					}
				} else {
					Flash::flasher('Gagal', 'Ujian gagal dihapus, karena ujian sedang digunakan atau sedang berlangsung.', 'danger');
					header('Location: ' . base_url() . 'cbt/ujian');
					exit;
				}
			}
		}
	}
	public function confirm_ujian() {
		if ($_POST) {
			if (isset($_POST['ujian_id'])) {
				$data_ujian = $this->Ujian_model->get(['ujian_id', $_POST['ujian_id']], TRUE);
				$post_users = [
					'users_ujian' => $_POST['ujian_id'],
					'users_siswa' => $this->Siswa_model->get_all(['siswa_uid', $_SESSION['id']], TRUE)->siswa_id,
					'users_status' => 1,
					'users_tgl_pengerjaan' => date('Y-m-d H:i:s')
				];
				$insert_users = $this->Ujian_model->insert_users($post_users);
				if ($insert_users > 0) {
					$ujian_topik = $this->Ujian_model->get(['ujian_id', $_POST['ujian_id']], TRUE);
					if ($ujian_topik->ut_soal_acak == 1) {
						$ujian_soal = $this->CBT_master_model->get_soal(['soal_topik', $ujian_topik->ut_topik]);
					}
					
					$order_soal = 0;
					foreach ($ujian_soal as $key => $soal) {
						$post_soal = [
							'us_users' => $insert_users,
							'us_soal' => $soal['soal_id'],
							'us_nilai' => $data_ujian->ujian_nilai_kosong,
							'us_order' => ++$order_soal
						];

						$insert_soal = $this->Ujian_model->insert_soal($post_soal);
					}

					$data_soal = $this->Ujian_model->get_soal(['us_users', $insert_users]);
					foreach ($data_soal as $key => $soal) {
						if ($soal['soal_tipe'] == 1) {
							if ($ujian_topik->ut_soal_acak == 1) {
								$order_jawaban = 0;
								$data_jawaban = $this->CBT_master_model->get_jawaban(['jawaban_soal', $soal['soal_id']]);
								foreach ($data_jawaban as $key => $jawaban) {
									$post_jawaban = [
										'uj_soal' => $soal['us_id'],
										'uj_jawaban' => $jawaban['jawaban_id'],
										'uj_selected' => 0,
										'uj_order' => ++$order_jawaban
									];

									$insert_jawaban = $this->Ujian_model->insert_jawaban($post_jawaban);
								}
							}
						}
					}
				}

				if (count($this->Ujian_model->get_jawaban(['us_users', $insert_users])) > 0) {
					Flash::flasher('Berhasil', 'Selamat mengerjakan.', 'success');
					header('Location: ' . base_url() . 'cbt/start/' .$_POST['ujian_id']);
					exit;
				} else {
					Flash::flasher('Gagal', 'Soal ujian gagal dibuat.', 'danger');
					header('Location: ' . base_url() . 'cbt/ujian');
					exit;
				}
			}
		}
	}
	public function start($id = NULL) {
		if (!empty($id)) {
			$where_ujian_siswa = NULL;
			$data_siswa = $this->Siswa_model->get_all(['siswa_uid', $_SESSION['id']], TRUE);
			$where_ujian_siswa = ['users_siswa', $data_siswa->siswa_id];
			$ujian_users = $this->Ujian_model->get_users($where_ujian_siswa, NULL, TRUE);
			$ujian = $this->Ujian_model->get(['ujian_id', $id], TRUE);

			if (!$ujian_users) { header('Location: ' .base_url(). 'cbt/ujian'); }

			if (count($ujian_users) > 0) {
				$date = new DateTime();
                $ujian_dikerjakan = new DateTime($ujian_users->users_tgl_pengerjaan);
                $ujian_dikerjakan->modify('+' . $ujian->ujian_durasi . ' minutes');

                if ($date >= $ujian_dikerjakan) {
                	header('Location: ' . base_url() . 'cbt/ujian');
                } else {
                	$data['ujian_id'] = $id;
					$data['users_id'] = $ujian_users->users_id;
					$data['ujian_judul'] = $ujian->ujian_judul;
					$data['ujian_durasi'] = $ujian->ujian_durasi;
					$data['date'] = $date->format('Y-m-d H:i:s');

					$ujian_dikerjakan = new DateTime($ujian_users->users_tgl_pengerjaan);
					$date_diff = $ujian_dikerjakan->diff($date);

					$second_running = ($date_diff->h * 60 * 60) + ($date_diff->i * 60) + $date_diff->s;
					$second_total = $ujian->ujian_durasi * 60;

					if ($date >= $ujian_dikerjakan) {
						$second_remaining = $second_total - $second_running;
					} else {
						$second_remaining = $second_total + $second_running;
					}

					$data['second_running'] = $second_running;
					$data['second_total'] = $second_total;
					$data['second_remaining'] = $second_remaining;

					$query_soal = $this->Ujian_model->get_soal(['us_users', $ujian_users->users_id], TRUE);
					$data_soal = $this->get_list_soal($id);

					$data['total_soal'] = $data_soal['ujian_total_soal'];
					$data['list_soal'] = $data_soal['ujian_list_soal'];

					$data_soal = $this->get_soal($query_soal->us_id, $ujian_users->users_id);
					$data['data_soal'] = $data_soal['ujian_soal'];
					$data['data_jawaban'] = NULL;

					$data['us_id'] = $query_soal->us_id;
					$data['us_order'] = $query_soal->us_order;
					$data['us_ragu'] = $query_soal->us_ragu;

                	$this->view('home/v_header');
                	$this->view('cbt/v_mulai_ujian', $data);
                	$this->view('home/v_footer');
                }
			}
		}
	}
	public function result($users_id = NULL) {
		if (!empty($users_id)) {
			$query_users = $this->Ujian_model->get_users(['users_id', $users_id], NULL, TRUE);
			if (count($query_users) > 0) {
				$query_ujian = $this->Ujian_model->get(['ujian_id', $query_users->users_ujian], TRUE);
				$where_siswa = NULL;
				if ($_SESSION['role'] == 3) {
					$where_siswa = ['siswa_uid', $_SESSION['id']];
				} else {
					$where_siswa = ['siswa_id', $query_users->users_siswa];
				}

				$data_siswa = $this->Siswa_model->get_all($where_siswa, TRUE);

				$data['ujian_id'] = $query_users->users_ujian;
				$data['users_id'] = $users_id;
				$data['ujian_judul'] = $query_ujian->ujian_judul;
				$data['ujian_dikerjakan'] = $query_users->users_tgl_pengerjaan;
				$data['siswa_nama'] = $data_siswa->siswa_nama;

				$nilai = $this->Ujian_model->get_nilai($users_id, TRUE);
				$data['nilai'] = $nilai->result . ' / ' . $query_ujian->ujian_nilai_maks . ' (Nilai / Maks.Nilai)';
				$data['benar'] = ($nilai->total_soal - $nilai->jawaban_salah) . ' / ' . $nilai->total_soal . ' (Jawaban Benar / Total Soal)';
				$data['nilai_akhir'] = number_format(floatval(($nilai->result / $query_ujian->ujian_nilai_maks) * 10), 2) . ' (Nilai Akhir)';

				if ($_POST) {
					if (isset($_POST['users_id'])) {
						if ($this->Ujian_model->update_koreksi_jawaban($_POST)) {
							Flash::flasher('Berhasil', 'Jawaban berhasil dikoreksi', 'success');
							header('Location: ' . base_url() . 'cbt/result/' . $_POST['users_id']);
							exit;
						} else {
							Flash::flasher('Gagal', 'Jawaban gagal dikoreksi', 'success');
							header('Location: ' . base_url() . 'cbt/result/' . $_POST['users_id']);
							exit;
						}
					}
				}

				if ($_SESSION['role'] == 1) {
					$this->view('dashboard/v_header');
					$this->view('cbt/v_result', $data);
					$this->view('dashboard/v_footer');
				} else {
					$this->view('home/v_header');
					$this->view('cbt/v_result', $data);
					$this->view('home/v_footer');
				}
			}
		}
	}

	public function rekap() {
		if ($_SESSION['role'] != 1) {
			$this->view('home/v_header');
			$this->view('cbt/v_rekap');
			$this->view('home/v_footer');
		} else if ($_SESSION['role'] == 1) {
			$this->view('dashboard/v_header');
			$this->view('cbt/v_rekap');
			$this->view('dashboard/v_footer');
		}
	}

	public function export_soal() {
		if ($_SESSION['role'] == 3) { header('Location: ' . base_url() . 'cbt/ujian'); }

		if ($_POST) {
			// Setting upload photo
			$extension = ['xls', 'xlxs'];
			$size = 1044070;
			// Photo upload
			$file_soal = $_FILES['excel_soal']['name'];
			$x = explode('.', $file_soal);
			$ext = strtolower(end($x));
			$size_soal = $_FILES['excel_soal']['size'];
			$tmp_soal = $_FILES['excel_soal']['tmp_name'];
			// Check extension
			if (in_array($ext, $extension)) {
				if ($size_soal < $size) {
					// Change value post file soal
					$_POST['excel_soal'] = $file_soal;

					$import_soal = $this->export_excel($tmp_soal, $_POST['topik_id']);
					Flash::flasher('Information', $import_soal, 'success');
					header('Location: ' . base_url() . 'cbt/soal');
					exit;
				} else {
					Flash::flasher('Gagal', 'Ukuran file soal melebihi ketentuan.', 'danger');
					header('Location: ' . base_url() . 'cbt/export_soal');
					exit;
				}
			} else {
				Flash::flasher('Gagal', 'Ekstensi file soal tidak diperbolehkan.', 'danger');
				header('Location: ' . base_url() . 'cbt/export_soal');
				exit;
			}
		}

		$where_topik = NULL;
		if ($_SESSION['role'] == 2)
			$where_topik = ['topik_pembuat', $_SESSION['id']];

		$data['topik'] = $this->CBT_master_model->get_topik($where_topik);

		if ($_SESSION['role'] == 2) {
			$this->view('home/v_header');
			$this->view('cbt/v_export_soal', $data);
			$this->view('home/v_footer');
		} else if ($_SESSION['role'] == 1) {
			$this->view('dashboard/v_header');
			$this->view('cbt/v_export_soal', $data);
			$this->view('dashboard/v_footer');
		}
	}

	function export_excel($inputfile, $topik_id) {
		define('excel_reader', dirname(__FILE__) . '/');
		require(excel_reader . '../libraries/Excel.php');

		$excel = PHPExcel_IOFactory::load($inputfile);
        $worksheet = $excel->getSheet(0);
        $highestRow = $worksheet->getHighestRow();
        $message = '<div class="alert alert-info alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-info"></i> Information!</h4>';

         if ($highestRow > 3) {
            $totalSuccess = 0;
            $totalError = 0;
            $row = 6;
            $empty = 0;
            while ($empty < 2) {
                $empty = 0;
                $column1 = $worksheet->getCellByColumnAndRow(2, $row)->getValue();	//	type, question or answer
                $column2 = $worksheet->getCellByColumnAndRow(3, $row)->getValue();	//	detail 
                $column3 = $worksheet->getCellByColumnAndRow(4, $row)->getValue();	//	answer true or false
                $column4 = $worksheet->getCellByColumnAndRow(5, $row)->getValue();	//	level difficult
                
                if (empty($column1)) { $empty =+2; }
                if (empty($column2)) { $empty =+2; }
                if (empty($column4) and $column1 =='Q') { $empty++; }
                
                if ($empty == 0) {
                	// Change Html special char to kode
                	$column2 = htmlspecialchars($column2);

                	// Added tag br for new line
                	$column2 = str_replace("\r","<br />",$column2);
                	$column2 = str_replace("\n","<br />",$column2);
                	/**
                	 * If type question is Q / Question
                	 */
                	if ($column1 == 'Q') {
                		$soal['soal_topik'] = $topik_id;
			        	$soal['soal_detail'] = $column2;
			        	$soal['soal_tipe'] = '1'; 	// 1 Multiple Choice

                		$insert_soal = $this->Soal_model->insert($soal);
                		$soal_id = $insert_soal;
                		$totalSuccess++;


                	/**
                	 * If type question is A / Answer
                	 */
                	} else if ($column1 == 'A') {
				        $jawaban['jawaban_detail'] = $column2;
				        if (!empty($column3)) {
				        	$jawaban['jawaban_benar'] = $column3;
				        } else {
				        	$jawaban['jawaban_benar'] = '0';
				        }
				        $jawaban['jawaban_soal'] = $soal_id;

				        $this->Jawaban_model->insert($jawaban);
                	}

                } else {
                	if ($empty < 2) {
                		$message = $message.'Line of  '.$row.' failed to import : '.$column2.'<br>';
                    	$totalError++;
                	}
                }
                
                $row++;
            }
            $message = $message.'<br>Total questions which was successfully imported is '.$totalSuccess.'<br>
                            Number of questions that failed to import is '.$totalError.'<br>
                            Total number of rows processed is '.($row - 6).'<br>';
        } else {
            $message = $message.'Nothing works on IMPORT. Please check again template questions from oppidatutor.';
        }
        $message = $message.'</div>';
        
        return $message;
	}

	private function get_list_soal($id = NULL) {
		$data['ujian_total_soal'] = '';
		$data['ujian_list_soal'] = '';
		$total_soal = 0;
		$list_soal = '';
		if (!empty($id)) {
			$siswa_id = $this->Siswa_model->get_all(['siswa_uid', $_SESSION['id']], TRUE)->siswa_id;
			$query_users = $this->Ujian_model->get_users(['users_siswa', $siswa_id], ['users_ujian', $id], TRUE);

			if (count($query_users) > 0) {
				$query_soal = $this->Ujian_model->get_soal(['us_users', $query_users->users_id]);
				$total_soal = count($query_soal);
				
				if (count($query_soal) > 0) {
					foreach ($query_soal as $key => $soal) {
						if (!empty($soal['us_waktu_diubah'])) {
							if ($soal['us_ragu'] == 0) {
								$list_soal = $list_soal . '<button id="btn-soal-'.$soal['us_order'].'" onclick="soal(\''.$soal['us_id'].'\')" class="btn btn-primary" style="margin-bottom: 5px;" title="Soal no - '.$soal['us_order'].'">' .$soal['us_order']. '</button> ';
							} else {
								$list_soal = $list_soal . '<button id="btn-soal-'.$soal['us_order'].'" onclick="soal(\''.$soal['us_id'].'\')" class="btn btn-warning" style="margin-bottom: 5px;" title="Soal no - '.$soal['us_order'].'">' .$soal['us_order']. '</button> ';
							}
						} else {
							$list_soal = $list_soal . '<button id="btn-soal-'.$soal['us_order'].'" onclick="soal(\''.$soal['us_id'].'\')" class="btn btn-default btn-outline" style="margin-bottom: 5px;" title="Soal no - '.$soal['us_order'].'">' .$soal['us_order']. '</button> ';
						}
					}
				}
			}
		}

		$data['ujian_total_soal'] = $total_soal;
		$data['ujian_list_soal'] = $list_soal;

		return $data;
	}

	private function get_soal($us_id = NULL, $users_id = NULL) {
		$data['us_soal'] = '';
		$data['ujian_soal'] = '';
		$data['data'] = 0;
		if (!empty($us_id) AND !empty($users_id)) {
			// Get time from php
			$user_time = date('Y-m-d H:i:s');
			if (count($this->Ujian_model->check_status_waktu($users_id, $user_time)) > 0) {
				$data['data'] = 1;
				$query_soal = $this->Ujian_model->get_soal_by(['us_id', $us_id], TRUE, 1);
				$soal = '';
				if (count($query_soal) > 0) {
					$data['us_soal'] = $us_id;
					$data['us_ragu'] = $query_soal->us_ragu;
					$soal = '';
					$data['us_order'] = $query_soal->us_order;

					$soal = $soal . '<div class="form-group">';
					$soal = $soal . '<label>' . $query_soal->soal_detail . '</label>';
					if ($query_soal->soal_tipe == 1) {
						$query_jawaban = $this->Ujian_model->get_jawaban(['us_id', $us_id]);
						if (count($query_jawaban) > 0) {
							foreach ($query_jawaban as $jawaban) {
								// Change base url to actually address in tag img
								$temp_jawaban = $jawaban['jawaban_detail'];
								if ($jawaban['uj_selected'] == 1) {
									$soal = $soal . '<div class="radio"><label><input type="radio" onchange="jawaban()" name="uj_jawaban" value="'.$jawaban['uj_jawaban'].'" checked>' . $temp_jawaban. '</label></div>';
								} else {
									$soal = $soal . '<div class="radio"><label><input type="radio" onchange="jawaban()" name="uj_jawaban" value="'.$jawaban['uj_jawaban'].'">' . $temp_jawaban. '</label></div>';
								}
							}
						}
					} else if ($query_soal->soal_tipe == 2) {
						if (!empty($query_soal->us_jawaban_teks)) {
							$soal = $soal . '<textarea class="textarea form-control" id="uj_jawaban" name="uj_jawaban" style="width: 100%; height: 150px; font-size: 13px; line-height: 25px; border: 1px solid #dddddd; padding: 10px;" required>'.$query_soal->us_jawaban_teks.'</textarea>
	                                <button type="button" onclick="jawaban()" class="btn btn-default btn-outline" style="margin-bottom: 5px; margin-top: 10px;" title="Save Answers">Save Answers</button>
	                                ';
						} else {
							$soal = $soal . '<textarea class="textarea form-control" id="uj_jawaban" name="uj_jawaban" style="width: 100%; height: 150px; font-size: 13px; line-height: 25px; border: 1px solid #dddddd; padding: 10px;" required></textarea>
	                                <button type="button" onclick="jawaban()" class="btn btn-default btn-outline" style="margin-bottom: 5px; margin-top: 10px;" title="Save Answers">Save Answers</button>
	                                ';
						}
					}
				}
				$soal = $soal . '</div>';
				$data['ujian_soal'] = $soal;
			}
		} else {
			$data['data'] = 2;
		}

		return $data;
	}

	function get_soal_by($us_id = NULL, $users_id = NULL) {
		$data['data'] = 0;
        if (!empty($us_id) AND !empty($users_id)) {
            $data_soal = $this->get_soal($us_id, $users_id);
            $data['data'] = $data_soal['data'];
            if (!empty($data_soal['ujian_soal'])) {
                $data['ujian_soal'] = $data_soal['ujian_soal'];
                $data['us_ragu'] = $data_soal['us_ragu'];
                $data['us_soal'] = $data_soal['us_soal'];
                $data['soal_no'] = $data_soal['us_order'];
            }
        }

        echo json_encode($data);
	}
	function simpan_jawaban() {
		if ($_POST) {
			$user_time = date('Y-m-d H:i:s');
			if (count($this->Ujian_model->check_status_waktu($_POST['users_id'], $user_time)) > 0) {
				$query_soal = $this->Ujian_model->get_soal_by(['us_id', $_POST['us_id']], TRUE, 1);
				if (count($query_soal) > 0) {
					$us_waktu_diubah = date('Y-m-d H:i:s');
					$us_ragu = 0;
					$data_jawaban['us_waktu_diubah'] = $us_waktu_diubah;
					$data_jawaban['us_id'] = $_POST['us_id'];
					$data_jawaban['us_ragu'] = $us_ragu;

					if ($query_soal->soal_tipe == 1) {
						$query_ujian = $this->Ujian_model->get_ujian_by(['ujian_id', $_POST['ujian_id']], TRUE, 1);
						$query_jawaban = $this->Ujian_model->get_jawaban_by_and(['us_id', $_POST['us_id']], ['uj_jawaban', $_POST['uj_jawaban']], TRUE);

						// Update score, change time when choice correct
						if ($query_jawaban->jawaban_benar == 1) {
							$us_nilai = $query_ujian->ujian_nilai_benar;
						} else {
							$us_nilai = $query_ujian->ujian_nilai_salah;
						}

						$data_jawaban['uj_soal'] = $_POST['us_id'];
						$data_jawaban['uj_jawaban'] = $_POST['uj_jawaban'];
						$data_jawaban['us_nilai'] = $us_nilai;
						if ($this->Ujian_model->update_jawaban_benar($data_jawaban) > 0) {
							if ($this->Ujian_model->update_jawaban_salah($data_jawaban) > 0) {
								if ($this->Ujian_model->update_soalnilai($data_jawaban) > 0) {
									$response['status'] = 200;
									$response['us_order'] = $_POST['us_order'];
									$response['message'] = 'Jawaban berhasil disimpan.';
								}
							}
						}

						
					} else if ($query_soal->soal_tipe == 2) {
						// Update change time, and essay answer
						$data_jawaban['us_jawaban_teks'] = $_POST['uj_jawaban'];
						$data_jawaban['us_nilai'] = 0;

						if ($this->Ujian_model->update_jawaban_essai($data_jawaban) > 0) {
							$response['status'] = 200;
							$response['us_order'] = $_POST['us_order'];
							$response['message'] = 'Jawaban berhasil disimpan.';
						}
					}
				} else {
					$response['status'] = 500;
					$response['message'] = 'We got something wrong, please contact administrator';
				}
			} else {
				$response['status'] = 500;
				$response['message'] = 'We got something wrong, exam have been done.';
			}
		}

		echo json_encode($response);
	}
	function simpan_jawaban_waktuhabis() {
		$response['status'] = 404;
		$response['message'] = 'Tidak dapat merespon.';
		if ($_POST) {
			if ($this->Ujian_model->update_users_waktuhabis($_POST)) {
				$response['status'] = 200;
				$response['message'] = 'Ujian berhasil diupdate';
			} else {
				$response['status'] = 500;
				$response['message'] = 'Ujian gagal diupdate, ada masalah pada query.';
			}
		}

		echo json_encode($response);
	}
	function get_info_ujian() {
		$data['data'] = 0;
        $user_time = date('Y-m-d H:i:s');
        if (!empty($_POST['ujian_id'])) {
        	$data_siswa = $this->Siswa_model->get_all(['siswa_uid', $_SESSION['id']], TRUE);
            $query_ujian = $this->Ujian_model->get_users(['users_siswa', $data_siswa->siswa_id], ['users_ujian', $_POST['ujian_id']], TRUE);
            if (count($query_ujian) > 0) {
                $data['data'] = 1;
                $data['ujian_id'] = $_POST['ujian_id'];
                $data['users_id'] = $query_ujian->users_id;
                $data['ujian_judul'] = $query_ujian->ujian_judul;
                $data['soal_terjawab'] = $this->Ujian_model->get_soal_terjawab(['us_users', $query_ujian->users_id], ['us_waktu_diubah', $user_time], TRUE)->total.' soal';
                $data['soal_tidakterjawab'] = $this->Ujian_model->get_soal_tidakterjawab(['us_users', $query_ujian->users_id], TRUE)->total.' soal';
                $data['ujian_kelas'] = $this->Ujian_model->get_group(['group_ujian', $_POST['ujian_id']], ['group_kelas', $data_siswa->siswa_kelas], TRUE)->group_kelas;
            }
        }

        echo json_encode($data);
	}
	function finish() {
		if ($_POST) {
			if (!empty($_POST['checkbox-stop'])) {
				$data_users['users_ujian'] = $_POST['ujian_id'];
				$data_users['users_id'] = $_POST['users_id'];
				$data_users['users_status'] = 4;	// Selesai oleh siswa
				if ($this->Ujian_model->update_users($data_users) > 0) {
					$response['status'] = 200;
					$response['message'] = 'Ujian telah siswa selesaikan.';
				} else {
					$response['status'] = 500;
					$response['message'] = 'Ada kesalahan pada query.';
				}
			} else {
				$response['status'] = 500;
				$response['message'] = 'Silahkan setujui terlebih dahulu pemberhentian ujian.';
			}
		}

		echo json_encode($response);
	}
	function get_start() {
		$start = 0;
		if (isset($_POST['displayStart'])) {
			$start = intval($_POST['displayStart']);

			if ($start < 0)
				$start = 0;
		}

		return $start;
	}

	function get_rows() {
		$rows = 10;
		if (isset($_GET['displayLength'])) {
			$rows = intval($_GET['displayLength']);
			if ($rows < 5 || $rows > 500) {
				$rows = 10;
			}
		}

		return $rows;
	}
	public function get_result_list_jawaban() {
		$users_id = $_POST['users_id'];
    	$search = "";
    	$start = 0;
    	$rows = 10;

    	if (isset($_POST['search']['value']) && $_POST['search']['value'] != '') {
    		$search = $_POST['search']['value'];
    	}

    	$start = $this->get_start();
    	$rows = $this->get_rows();

    	$query = $this->CBT_master_model->get_datatable_soal($start, $rows, 'soal_detail', $search, $users_id);

    	$iTotal = count($this->CBT_master_model->get_datatable_count('soal_detail', $search, $users_id));

    	$output = array(
    		"sEcho" => intval($_POST['draw']),
	        "iTotalRecords" => $iTotal,
	        "iTotalDisplayRecords" => $iTotal,
	        "aaData" => array()
    	);

    	$i = array();
    	foreach ($query as $temp) {
    		$record = array();

    		$record[] = ++$i;

    		if ($temp['soal_tipe'] == 1) {
    			$record[] = 'Pilihan Ganda';
    		} else if ($temp['soal_tipe'] == 2) {
    			$record[] = 'Essai';
    		}

    		$soal = $temp['soal_detail'];
    		$soal = str_replace("[base_url]", base_url(), $soal);

    		$table_soal = '
    			<table class="table" border="0">
    				<tr>
    					<td colspan="4">'.$soal.'</td>
    				</tr>
    		';

    		if ($temp['soal_tipe'] == 1) {
    			$query_jawaban = $this->Ujian_model->get_jawaban(['uj_soal', $temp['us_id']]);
    			if (count($query_jawaban) > 0) {
    				$a = 0;
    				$table_soal = $table_soal . '
    					<tr>
    						<td width="5%"> </td>
    						<td width="5%">Kunci Jawaban</td>
    						<td width="5%">Pilihan</td>
    						<td width="5%">Jawaban</td>
    					</tr>
    				';
    				foreach ($query_jawaban as $jawaban) {
    					$temp_jawaban = $jawaban['jawaban_detail'];

    					$temp_correct = '';
    					if ($jawaban['jawaban_benar'] == 1) {
    						$temp_correct = '<b><i class="fa fa-check-square"></i></b>';
    					}

    					$temp_choice = '';
    					if ($jawaban['uj_selected'] == 1) {
    						$temp_choice = '<b><i class="fa fa-check-square"></i></b>';
    					}

    					$temp_class = '';
    					if ($jawaban['uj_selected'] == 1 && $jawaban['jawaban_benar'] == 1) {
    						$temp_class = 'style="background: #c6f6fb"';
    					}

    					$table_soal = $table_soal . '
	    					<tr '.$temp_class.'>
		                      	<td width="5%">' . ++$a . '.</td>
		                      	<td width="5%">' . $temp_correct . '</td>
		                      	<td width="5%">' . $temp_choice . '</td>
		                      	<td width="85%">' . $temp_jawaban . '</td>
		                    </tr>
    					';
    				}
    			}
    		}
    		
    		else if ($temp['soal_tipe'] == 2) {
    			$colspan = 2;
    			$koreksi = '';
    			$isi = '';
    			$bg_benar = '';

    			if ($_SESSION['role'] != 3) {
    				$koreksi = '<td>Koreksi</td>';
    				$isi = '<td>
    					<button class="btn btn-primary btn-xs" data-users="'.$users_id.'" data-soal="'.$temp['us_id'].'" onclick="benar(this)"><i class="fa fa-check-square"></i>&nbsp; Benar</button>
    					<button class="btn btn-danger btn-xs" data-users="'.$users_id.'" data-soal="'.$temp['us_id'].'" onclick="salah(this)"><i class="fa fa-times"></i>&nbsp; Salah</button>
    					</td>';
    				$colspan = 1;
    			}

    			if ($temp['us_nilai'] > 0) {
    				$bg_benar = 'style="background-color: #c6f6fb"';
    			}

    			$table_soal = $table_soal . '
	    			<tr>
		            	<td width="5%"></td>
		                <td width="5%">Nilai</td>
		                <td width="70%" colspan="'.$colspan.'">Jawaban</td>
		                '. $koreksi .'
		            </tr>
	            	<tr '.$bg_benar.'>
		            	<td width="5%"></td>
		                <td width="5%">' . $temp['us_nilai'] . '</td>
		                <td width="70%" colspan="'.$colspan.'"><div style="width:100%;"><pre style="white-space: pre-wrap;word-wrap: break-word;">' . $temp['us_jawaban_teks'] . '</pre></div></td>
		                '. $isi .'
		            </tr>
    			';
    		}

    		$table_soal = $table_soal . '</table>';
    		$record[] = $table_soal;
    		$output['aaData'][] = $record;
    	}

    	echo json_encode($output);
    }

    public function print_hasil_ujian($users_id = NULL) {
    	$data = NULL;
    	$query_users = $this->Ujian_model->get_users(['users_id', $users_id], NULL, TRUE);
		if (count($query_users) > 0) {
			$query_ujian = $this->Ujian_model->get(['ujian_id', $query_users->users_ujian], TRUE);
			$where_siswa = NULL;
			if ($_SESSION['role'] == 3) {
				$where_siswa = ['siswa_uid', $_SESSION['id']];
			} else {
				$where_siswa = ['siswa_id', $query_users->users_siswa];
			}

			$data_siswa = $this->Siswa_model->get_all($where_siswa, TRUE);

			$data['users_id'] = $users_id;
			$data['ujian_judul'] = $query_ujian->ujian_judul;
			$data['ujian_dikerjakan'] = $query_users->users_tgl_pengerjaan;
			$data['siswa_nama'] = $data_siswa->siswa_nama;

			$nilai = $this->Ujian_model->get_nilai($users_id, TRUE);
			$data['nilai'] = $nilai->result . ' / ' . $query_ujian->ujian_nilai_maks . ' (Nilai / Maks.Nilai)';
			$data['benar'] = ($nilai->total_soal - $nilai->jawaban_salah) . ' / ' . $nilai->total_soal . ' (Jawaban Benar / Total Soal)';
			$data['nilai_akhir'] = number_format(floatval(($nilai->result / $query_ujian->ujian_nilai_maks) * 10), 2) . ' (Nilai Akhir)';

		}

    	if (!empty($users_id)) {
			$query = $this->CBT_master_model->get_soal_hasil_ujian($users_id);
	    	
	    	foreach ($query as $temp) {
	    		$record = array();

	    		if ($temp['soal_tipe'] == 1) {
	    			$record[] = 'Pilihan Ganda';
	    		} else if ($temp['soal_tipe'] == 2) {
	    			$record[] = 'Essai';
	    		}

	    		$soal = $temp['soal_detail'];

	    		$table_soal = '
	    			<table class="table" border="0">
	    				<tr>
	    					<td colspan="4">'.$soal.'</td>
	    				</tr>
	    		';

	    		if ($temp['soal_tipe'] == 1) {
	    			$query_jawaban = $this->Ujian_model->get_jawaban(['uj_soal', $temp['us_id']]);
	    			if (count($query_jawaban) > 0) {
	    				$a = 0;
	    				$table_soal = $table_soal . '
	    					<tr>
	    						<td width="5%"> </td>
	    						<td width="5%">Kunci Jawaban</td>
	    						<td width="5%">Pilihan</td>
	    						<td width="5%">Jawaban</td>
	    					</tr>
	    				';
	    				foreach ($query_jawaban as $jawaban) {
	    					$temp_jawaban = $jawaban['jawaban_detail'];

	    					$temp_correct = '';
	    					if ($jawaban['jawaban_benar'] == 1) {
	    						$temp_correct = '<img src="'.base_url().'assets/img/checklist.png" style="width: 14px;" />';
	    					}

	    					$temp_choice = '';
	    					if ($jawaban['uj_selected'] == 1) {
	    						$temp_choice = '<img src="'.base_url().'assets/img/checklist.png" style="width: 14px;" />';
	    					}

	    					$temp_class = '';
	    					if ($jawaban['uj_selected'] == 1 && $jawaban['jawaban_benar'] == 1) {
	    						$temp_class = 'style="background-color: #c6f6fb !important;"';
	    					}

	    					$table_soal = $table_soal . '
		    					<tr '.$temp_class.'>
			                      	<td width="5%">' . ++$a . '.</td>
			                      	<td width="5%">' . $temp_correct . '</td>
			                      	<td width="5%">' . $temp_choice . '</td>
			                      	<td width="85%">' . $temp_jawaban . '</td>
			                    </tr>
	    					';
	    				}
	    			}
	    		}
	    		
	    		else if ($temp['soal_tipe'] == 2) {
	    			$bg_benar = '';
	    			if ($temp['us_nilai'] > 0) {
	    				$bg_benar = 'style="background-color: #c6f6fb"';
	    			}

	    			$table_soal = $table_soal . '
		    			<tr>
			            	<td width="5%"></td>
			                <td width="5%">Score</td>
			                <td width="90%" colspan="2">Answers</td>
			            </tr>
		            	<tr '.$bg_benar.'>
			            	<td width="5%"></td>
			                <td width="5%">' . $temp['us_nilai'] . '</td>
			                <td width="90%" colspan="2"><div style="width:100%;"><pre style="white-space: pre-wrap;word-wrap: break-word;">' . $temp['us_jawaban_teks'] . '</pre></div></td>
			            </tr>
	    			';
	    		}

	    		$table_soal = $table_soal . '</table>';
	    		$record[] = $table_soal;
	    		$data['aaData'][] = $record;
	    	}
	    }

	    $this->view('cbt/v_print_hasil', $data);
    }
}