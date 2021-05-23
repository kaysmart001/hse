<?php

class Ujian_model {
	private $table_ujian = 'tb_ujian';
	private $table_group = 'tb_ujian_group';
	private $table_topik = 'tb_ujian_topik';
	private $table_users = 'tb_ujian_users';
	private $table_soal = 'tb_ujian_soal';
	private $table_jawaban = 'tb_ujian_jawaban';
	private $db;

	public function __construct() {
		$this->db = new Model;
	}

	public function get($by = NULL, $single = FALSE) {
		$this->db->query(
			'SELECT * FROM ' . 
			$this->table_ujian . 
			' INNER JOIN tb_ujian_group ON group_ujian = ujian_id ' .
			' INNER JOIN tb_kelas ON kelas_id = group_kelas ' .
			' INNER JOIN tb_ujian_topik ON ut_ujian = ujian_id ' .
			' INNER JOIN tb_jenjang ON jenjang_id = kelas_jenjang ' .
			' INNER JOIN tb_tingkat ON tingkat_id = kelas_tingkat ' .
			(!is_null($by) ? " WHERE " . $by[0] . '=:' . $by[0] : "") .
			' ORDER BY ujian_id DESC');
		if (!is_null($by)) {
			$this->db->bind($by[0], $by[1]);
		}

		if ($single) {
			$method = $this->db->row();
		} else {
			$method = $this->db->result();
		}
		return $method;
	}
	public function get_withdt($by = NULL, $sdate, $edate, $single = FALSE) {
		$this->db->query(
			'SELECT * FROM ' . 
			$this->table_ujian . 
			' INNER JOIN tb_ujian_group ON group_ujian = ujian_id ' .
			' INNER JOIN tb_kelas ON kelas_id = group_kelas ' .
			' INNER JOIN tb_ujian_topik ON ut_ujian = ujian_id ' .
			' INNER JOIN tb_jenjang ON jenjang_id = kelas_jenjang ' .
			' INNER JOIN tb_tingkat ON tingkat_id = kelas_tingkat ' .
			(!is_null($by) ? " WHERE " . $by[0] . '=:' . $by[0] : "") .
			(!is_null($sdate) ? " AND ujian_waktu_mulai = '" . $sdate . "'" : "") .
			(!is_null($edate) ? " AND ujian_waktu_akhir = '" . $edate . "'" : "") .
			' ORDER BY ujian_id DESC');
		if (!is_null($by)) {
			$this->db->bind($by[0], $by[1]);
		}

		if ($single) {
			$method = $this->db->row();
		} else {
			$method = $this->db->result();
		}
		return $method;
	}
	public function get_ujian_by($by = NULL, $single = FALSE, $limit = NULL) {
		$this->db->query(
			'SELECT * FROM ' . 
			$this->table_ujian . 
			' INNER JOIN tb_ujian_group ON group_ujian = ujian_id ' .
			' INNER JOIN tb_kelas ON kelas_id = group_kelas ' .
			' INNER JOIN tb_ujian_topik ON ut_ujian = ujian_id ' .
			' INNER JOIN tb_jenjang ON jenjang_id = kelas_jenjang ' .
			(!is_null($by) ? " WHERE " . $by[0] . '=:' . $by[0] : "") .
			' ORDER BY ujian_id DESC' . 
			(!is_null($limit) ? " LIMIT " . $limit : "")
		);
		if (!is_null($by)) {
			$this->db->bind($by[0], $by[1]);
		}

		if ($single) {
			$method = $this->db->row();
		} else {
			$method = $this->db->result();
		}
		return $method;
	}
	public function get_soal($by = NULL, $single = FALSE) {
		$this->db->query(
			'SELECT * FROM ' . 
			$this->table_soal . 
			' INNER JOIN tb_ujian_users ON users_id = us_users ' .
			' INNER JOIN tb_soal ON soal_id = us_soal ' .
			(!is_null($by) ? " WHERE " . $by[0] . '=:' . $by[0] : "") .
			' ORDER BY us_id ASC');
		if (!is_null($by)) {
			$this->db->bind($by[0], $by[1]);
		}

		if ($single) {
			$method = $this->db->row();
		} else {
			$method = $this->db->result();
		}
		return $method;
	}
	public function get_soal_by($by = NULL, $single = FALSE, $limit = NULL) {
		$this->db->query(
			'SELECT * FROM ' . 
			$this->table_soal . 
			' INNER JOIN tb_ujian_users ON users_id = us_users ' .
			' INNER JOIN tb_soal ON soal_id = us_soal ' .
			(!is_null($by) ? " WHERE " . $by[0] . '=:' . $by[0] : "") .
			' ORDER BY us_id ASC' .
			(!is_null($limit) ? " LIMIT " . $limit : '')
		);
		if (!is_null($by)) {
			$this->db->bind($by[0], $by[1]);
		}

		if ($single) {
			$method = $this->db->row();
		} else {
			$method = $this->db->result();
		}
		return $method;
	}
	public function get_soal_terjawab($by = NULL, $waktu = NULL, $single = FALSE) {
		$this->db->query(
        	"SELECT COUNT(*) AS total FROM " . 
        	$this->table_soal .
        	(!is_null($by) ? " WHERE " . $by[0] . '=:' . $by[0] : "") .
        	(!is_null($waktu) ? " AND " . $waktu[0] . '!=:' . $waktu[0] : "")
        );

        if (!is_null($by)) {
			$this->db->bind($by[0], $by[1]);
		}

		if (!is_null($waktu)) {
			$this->db->bind($waktu[0], $waktu[1]);
		}

		if ($single) {
			$method = $this->db->row();
		} else {
			$method = $this->db->result();
		}
		return $method;
	}
	public function get_soal_tidakterjawab($by = NULL, $single = FALSE) {
		$this->db->query(
        	"SELECT COUNT(*) AS total FROM " . 
        	$this->table_soal .
        	(!is_null($by) ? " WHERE " . $by[0] . '=:' . $by[0] : "") .
        	" AND us_waktu_diubah IS NULL "
        );

        if (!is_null($by)) {
			$this->db->bind($by[0], $by[1]);
		}

		if ($single) {
			$method = $this->db->row();
		} else {
			$method = $this->db->result();
		}
		return $method;
	}
	public function get_jawaban($by = NULL, $single = FALSE) {
		$this->db->query(
			'SELECT * FROM ' . 
			$this->table_jawaban . 
			' INNER JOIN tb_jawaban ON jawaban_id = uj_jawaban ' .
			' INNER JOIN tb_ujian_soal ON us_id = uj_soal ' .
			' INNER JOIN tb_ujian_users ON users_id = us_users ' .
			(!is_null($by) ? " WHERE " . $by[0] . '=:' . $by[0] : "") .
			' ORDER BY us_order DESC');
		if (!is_null($by)) {
			$this->db->bind($by[0], $by[1]);
		}

		if ($single) {
			$method = $this->db->row();
		} else {
			$method = $this->db->result();
		}
		return $method;
	}
	public function get_jawaban_by_and($us_id = NULL, $uj_jawaban = NULL, $single = FALSE) {
		$this->db->query(
			'SELECT * FROM ' . 
			$this->table_jawaban . 
			' INNER JOIN tb_jawaban ON jawaban_id = uj_jawaban ' .
			' INNER JOIN tb_ujian_soal ON us_id = uj_soal ' .
			' INNER JOIN tb_ujian_users ON users_id = us_users ' .
			(!is_null($us_id) ? " WHERE " . $us_id[0] . '=:' . $us_id[0] : "") .
			(!is_null($uj_jawaban) ? " AND " . $uj_jawaban[0] . '=:' . $uj_jawaban[0] : "") .
			' ORDER BY us_order DESC');
		
		if (!is_null($us_id)) {
			$this->db->bind($us_id[0], $us_id[1]);
		}

		if (!is_null($uj_jawaban)) {
			$this->db->bind($uj_jawaban[0], $uj_jawaban[1]);
		}

		if ($single) {
			$method = $this->db->row();
		} else {
			$method = $this->db->result();
		}
		return $method;
	}
	public function get_users($by = NULL, $ujian = NULL, $single = FALSE) {
		$this->db->query(
			'SELECT * FROM ' . 
			$this->table_users . 
			' INNER JOIN tb_ujian ON ujian_id = users_ujian ' .
			(!is_null($by) ? " WHERE " . $by[0] . '=:' . $by[0] : "") .
			(!is_null($ujian) ? " AND " . $ujian[0] . '=:' . $ujian[0] : "") .
			' ORDER BY users_id DESC');
		if (!is_null($by)) {
			$this->db->bind($by[0], $by[1]);
		}

		if (!is_null($ujian)) {
			$this->db->bind($ujian[0], $ujian[1]);
		}

		if ($single) {
			$method = $this->db->row();
		} else {
			$method = $this->db->result();
		}
		return $method;
	}
	public function get_group($by = NULL, $ujian = NULL, $single = FALSE) {
		$this->db->query(
			"SELECT * FROM " .
			$this->table_group .
			" INNER JOIN tb_ujian ON ujian_id = group_ujian" . 
			" INNER JOIN tb_kelas ON kelas_id = group_kelas" .
			(!is_null($by) ? " WHERE " . $by[0] . '=:' . $by[0] : "") .
			(!is_null($ujian) ? " AND " . $ujian[0] . '=:' . $ujian[0] : "")
		);

		if (!is_null($by)) {
			$this->db->bind($by[0], $by[1]);
		}

		if (!is_null($ujian)) {
			$this->db->bind($ujian[0], $ujian[1]);
		}

		if ($single) {
			$method = $this->db->row();
		} else {
			$method = $this->db->result();
		}
		return $method;
	}
	public function get_nilai($users_id, $single = FALSE) {
		$this->db->query('SELECT SUM(us_nilai) AS result, COUNT(CASE  WHEN us_nilai = 0 THEN 1 END) AS jawaban_salah, COUNT(*) AS total_soal FROM ' . $this->table_soal . ' WHERE us_users =:us_users');
        $this->db->bind('us_users', $users_id);

        if ($single) {
        	$method = $this->db->row();
        } else {
        	$method = $this->db->result();
        }

        return $method;
	}

	public function insert($data) {
		$query = 'INSERT INTO ' . $this->table_ujian . ' (
			ujian_judul, 
			ujian_deskripsi, 
			ujian_waktu_mulai, 
			ujian_waktu_akhir,
			ujian_durasi,
			ujian_hasil_siswa,
			ujian_detail_siswa,
			ujian_nilai_benar,
			ujian_nilai_salah,
			ujian_nilai_kosong,
			ujian_nilai_maks,
			ujian_status,
			ujian_pembuat
			) VALUES (
			:ujian_judul, 
			:ujian_deskripsi, 
			:ujian_waktu_mulai, 
			:ujian_waktu_akhir,
			:ujian_durasi,
			:ujian_hasil_siswa,
			:ujian_detail_siswa,
			:ujian_nilai_benar,
			:ujian_nilai_salah,
			:ujian_nilai_kosong,
			:ujian_nilai_maks,
			:ujian_status,
			:ujian_pembuat)';

		$this->db->query($query);
		$this->db->bind('ujian_judul', $data['ujian_judul']);
		$this->db->bind('ujian_deskripsi', ($data['ujian_deskripsi'] != '' ? $data['ujian_deskripsi'] : ''));
		$this->db->bind('ujian_waktu_mulai', $data['ujian_waktu_mulai']);
		$this->db->bind('ujian_waktu_akhir', $data['ujian_waktu_akhir']);
		$this->db->bind('ujian_durasi', $data['ujian_durasi']);
		$this->db->bind('ujian_hasil_siswa', 1);
		$this->db->bind('ujian_detail_siswa', 1);
		$this->db->bind('ujian_nilai_benar', $data['ujian_nilai_benar']);
		$this->db->bind('ujian_nilai_salah', $data['ujian_nilai_salah']);
		$this->db->bind('ujian_nilai_kosong', $data['ujian_nilai_kosong']);
		$this->db->bind('ujian_nilai_maks', $data['ut_total_soal']);
		$this->db->bind('ujian_status', $data['ujian_status']);
		$this->db->bind('ujian_pembuat', $data['ujian_pembuat']);

		$this->db->execute();

		return $this->db->insert_id();
	}
	public function insert_group($data) {
		$query = 'INSERT INTO ' . $this->table_group . ' (group_ujian, group_kelas) VALUES (:group_ujian, :group_kelas)';
		$this->db->query($query);
		$this->db->bind('group_ujian', $data['group_ujian']);
		$this->db->bind('group_kelas', $data['group_kelas']);

		$this->db->execute();

		return $this->db->rowCount();
	}
	public function insert_topik($data) {
		$query = 'INSERT INTO ' . $this->table_topik . ' (ut_ujian, ut_topik, ut_total_soal, ut_total_jawaban, ut_jawaban_acak, ut_soal_acak) VALUES (:ut_ujian, :ut_topik, :ut_total_soal, :ut_total_jawaban, :ut_jawaban_acak, :ut_soal_acak)';
		$this->db->query($query);
		$this->db->bind('ut_ujian', $data['ut_ujian']);
		$this->db->bind('ut_topik', $data['ut_topik']);
		$this->db->bind('ut_total_soal', $data['ut_total_soal']);
		$this->db->bind('ut_total_jawaban', $data['ut_total_jawaban']);
		$this->db->bind('ut_jawaban_acak', $data['ut_jawaban_acak']);
		$this->db->bind('ut_soal_acak', $data['ut_soal_acak']);

		$this->db->execute();

		return $this->db->rowCount();
	}
	public function insert_users($data) {
		$query = 'INSERT INTO ' . $this->table_users . ' (users_ujian, users_siswa, users_status, users_tgl_pengerjaan) VALUES (:users_ujian, :users_siswa, :users_status, :users_tgl_pengerjaan)';
		$this->db->query($query);
		$this->db->bind('users_ujian', $data['users_ujian']);
		$this->db->bind('users_siswa', $data['users_siswa']);
		$this->db->bind('users_status', $data['users_status']);
		$this->db->bind('users_tgl_pengerjaan', $data['users_tgl_pengerjaan']);

		$this->db->execute();

		return $this->db->insert_id();
	}
	public function insert_soal($data) {
		$query = 'INSERT INTO ' . $this->table_soal . ' (us_users, us_soal, us_nilai, us_order) VALUES (:us_users, :us_soal, :us_nilai, :us_order)';
		$this->db->query($query);
		$this->db->bind('us_users', $data['us_users']);
		$this->db->bind('us_soal', $data['us_soal']);
		$this->db->bind('us_nilai', $data['us_nilai']);
		$this->db->bind('us_order', $data['us_order']);

		$this->db->execute();

		return $this->db->rowCount();
	}
	public function insert_jawaban($data) {
		$query = 'INSERT INTO ' . $this->table_jawaban . ' (uj_soal, uj_jawaban, uj_selected, uj_order) VALUES (:uj_soal, :uj_jawaban, :uj_selected, :uj_order)';
		$this->db->query($query);
		$this->db->bind('uj_soal', $data['uj_soal']);
		$this->db->bind('uj_jawaban', $data['uj_jawaban']);
		$this->db->bind('uj_selected', $data['uj_selected']);
		$this->db->bind('uj_order', $data['uj_order']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function update($data) {
		$query = 'UPDATE ' . $this->table_ujian . '
			SET 
			ujian_judul=:ujian_judul, 
			ujian_deskripsi=:ujian_deskripsi, 
			ujian_waktu_mulai=:ujian_waktu_mulai, 
			ujian_waktu_akhir=:ujian_waktu_akhir,
			ujian_durasi=:ujian_durasi,
			ujian_hasil_siswa=:ujian_hasil_siswa,
			ujian_detail_siswa=:ujian_detail_siswa,
			ujian_nilai_benar=:ujian_nilai_benar,
			ujian_nilai_salah=:ujian_nilai_salah,
			ujian_nilai_kosong=:ujian_nilai_kosong,
			ujian_nilai_maks=:ujian_nilai_maks,
			ujian_status=:ujian_status,
			ujian_pembuat=:ujian_pembuat
			WHERE ujian_id=:ujian_id
		';

		$this->db->query($query);
		$this->db->bind('ujian_judul', $data['ujian_judul']);
		$this->db->bind('ujian_deskripsi', ($data['ujian_deskripsi'] != '' ? $data['ujian_deskripsi'] : ''));
		$this->db->bind('ujian_waktu_mulai', $data['ujian_waktu_mulai']);
		$this->db->bind('ujian_waktu_akhir', $data['ujian_waktu_akhir']);
		$this->db->bind('ujian_durasi', $data['ujian_durasi']);
		$this->db->bind('ujian_hasil_siswa', 1);
		$this->db->bind('ujian_detail_siswa', 1);
		$this->db->bind('ujian_nilai_benar', $data['ujian_nilai_benar']);
		$this->db->bind('ujian_nilai_salah', $data['ujian_nilai_salah']);
		$this->db->bind('ujian_nilai_kosong', $data['ujian_nilai_kosong']);
		$this->db->bind('ujian_nilai_maks', $data['ut_total_soal']);
		$this->db->bind('ujian_status', $data['ujian_status']);
		$this->db->bind('ujian_pembuat', $data['ujian_pembuat']);
		$this->db->bind('ujian_id', $data['ujian_id']);

		$this->db->execute();

		return $this->db->rowCount();
	}
	public function update_group($data) {
		$query = 'UPDATE ' . $this->table_group . ' SET group_kelas=:group_kelas WHERE group_ujian=:group_ujian';
		$this->db->query($query);
		$this->db->bind('group_kelas', $data['group_kelas']);
		$this->db->bind('group_ujian', $data['group_ujian']);

		$this->db->execute();

		return $this->db->rowCount();
	}
	public function update_topik($data) {
		$query = 'UPDATE ' . $this->table_topik . ' SET ut_ujian=:ut_ujian, ut_topik=:ut_topik, ut_total_soal=:ut_total_soal, ut_total_jawaban=:ut_total_jawaban, ut_jawaban_acak=:ut_jawaban_acak, ut_soal_acak=:ut_soal_acak WHERE ut_id=:ut_id';
		$this->db->query($query);
		$this->db->bind('ut_ujian', $data['ut_ujian']);
		$this->db->bind('ut_topik', $data['ut_topik']);
		$this->db->bind('ut_total_soal', $data['ut_total_soal']);
		$this->db->bind('ut_total_jawaban', $data['ut_total_jawaban']);
		$this->db->bind('ut_jawaban_acak', $data['ut_jawaban_acak']);
		$this->db->bind('ut_soal_acak', $data['ut_soal_acak']);
		$this->db->bind('ut_id', $data['ut_id']);

		$this->db->execute();

		return $this->db->rowCount();
	}
	public function update_jawaban_benar($data) {
		$query = 'UPDATE ' . $this->table_jawaban . ' SET uj_selected=:uj_selected, uj_posisi=:uj_posisi WHERE uj_soal=:uj_soal AND uj_jawaban=:uj_jawaban';
        $this->db->query($query);
        $this->db->bind('uj_selected', 1);
        $this->db->bind('uj_posisi', 1);
        $this->db->bind('uj_soal', $data['uj_soal']);
        $this->db->bind('uj_jawaban', $data['uj_jawaban']);

        $this->db->execute();

        return $this->db->rowCount();
	}
	public function update_jawaban_salah($data) {
		$query = 'UPDATE ' . $this->table_jawaban . ' SET uj_selected=:uj_selected, uj_posisi=:uj_posisi WHERE uj_soal=:uj_soal AND uj_jawaban!=:uj_jawaban';
        $this->db->query($query);
        $this->db->bind('uj_selected', 0);
        $this->db->bind('uj_posisi', 0);
        $this->db->bind('uj_soal', $data['uj_soal']);
        $this->db->bind('uj_jawaban', $data['uj_jawaban']);

        $this->db->execute();

        return $this->db->rowCount();
	}
	public function update_soalnilai($data) {
		$query = 'UPDATE ' . $this->table_soal . ' SET us_waktu_diubah=:us_waktu_diubah, us_ragu=:us_ragu, us_nilai=:us_nilai WHERE us_id=:us_id';
        $this->db->query($query);
        $this->db->bind('us_waktu_diubah', $data['us_waktu_diubah']);
        $this->db->bind('us_ragu', $data['us_ragu']);
        $this->db->bind('us_nilai', $data['us_nilai']);
        $this->db->bind('us_id', $data['us_id']);

        $this->db->execute();

        return $this->db->rowCount();
	}
	public function update_jawaban_essai($data) {
		$query = 'UPDATE ' . $this->table_soal . ' SET us_waktu_diubah=:us_waktu_diubah, us_ragu=:us_ragu, us_nilai=:us_nilai, us_jawaban_teks=:us_jawaban_teks WHERE us_id=:us_id';
        $this->db->query($query);
        $this->db->bind('us_waktu_diubah', $data['us_waktu_diubah']);
        $this->db->bind('us_ragu', $data['us_ragu']);
        $this->db->bind('us_nilai', $data['us_nilai']);
        $this->db->bind('us_jawaban_teks', $data['us_jawaban_teks']);
        $this->db->bind('us_id', $data['us_id']);

        $this->db->execute();

        return $this->db->rowCount();
	}
	public function update_users($data) {
		$query = "UPDATE " . $this->table_users . " SET users_status=:users_status WHERE users_ujian=:users_ujian AND users_id=:users_id";
		$this->db->query($query);
		$this->db->bind('users_status', $data['users_status']);
		$this->db->bind('users_ujian', $data['users_ujian']);
		$this->db->bind('users_id', $data['users_id']);

		$this->db->execute();

		return $this->db->rowCount();
	}
	public function update_koreksi_jawaban($data) {
		$query = "UPDATE " . $this->table_soal . " SET us_nilai=:us_nilai, us_komentar=:us_komentar WHERE us_id=:us_id AND us_users=:us_users";
		$this->db->query($query);
		$this->db->bind('us_nilai', $data['us_nilai']);
		$this->db->bind('us_id', $data['us_id']);
		$this->db->bind('us_komentar', 'sudah dikoreksi');
		$this->db->bind('us_users', $data['users_id']);

		$this->db->execute();

		return $this->db->rowCount();
	}
	public function update_users_waktuhabis($data) {
		$query = "UPDATE " . $this->table_users . " SET users_status=:users_status WHERE users_id=:users_id";
		$this->db->query($query);
		$this->db->bind('users_status', 3);
		$this->db->bind('users_id', $data['users_id']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function check($id) {
		$this->db->query(
			'SELECT * FROM ' . 
			$this->table_users . 
			' WHERE users_ujian=:users_ujian');
		
		$this->db->bind('users_ujian', $id);
		
		return $this->db->result();
	}

	public function delete($id) {
		$query = "DELETE FROM " . $this->table_ujian . " WHERE ujian_id=:ujian_id";
		$this->db->query($query);
		$this->db->bind('ujian_id', $id);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function delete_ujian_siswa($users_id) {
		$query = "DELETE FROM " . $this->table_users . " WHERE users_id=:users_id";
		$this->db->query($query);
		$this->db->bind('users_id', $users_id);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function check_status_waktu($users_id, $users_time) {
		$this->db->query("SELECT COUNT(users_id) AS result FROM " 
			. $this->table_users . 
			" INNER JOIN tb_ujian ON ujian_id = users_ujian" . 
			" WHERE (users_id=:users_id AND users_status=:users_status AND TIMESTAMPADD(MINUTE, ujian_durasi, users_tgl_pengerjaan) > '".$users_time."')");
        $this->db->bind('users_id', $users_id);
        $this->db->bind('users_status', 1);

        return $this->db->result();
	}
}