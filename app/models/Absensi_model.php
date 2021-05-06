<?php

class Absensi_model {
	private $table = 'tb_absen';
	private $db;

	public function __construct() {
		$this->db = new Model;
	}

	public function get() {
		$this->db->query('SELECT * FROM ' . $this->table . ' ORDER BY absen_id DESC');
		return $this->db->result();
	}

	public function get_siswa($by = NULL, $single = FALSE) {
		$this->db->query("
			SELECT 
			id,
			username,
			email,
			role,
			siswa_nama,
			siswa_jenjang,
			siswa_kelas,
			absen_jenis,
			absen_keterangan,
			absen_waktu,
			jenjang_nama,
			kelas_nama
			FROM " . $this->table . "
			LEFT JOIN tb_user ON id = absen_user
			LEFT JOIN tb_siswa ON siswa_uid = id
			LEFT JOIN tb_jenjang ON jenjang_id = siswa_jenjang
			LEFT JOIN tb_kelas ON kelas_id = siswa_kelas
			WHERE role = 3 
			" . (!is_null($by) ? " AND " . $by[0] . "=:" . $by[0] : "") 
			. " ORDER BY absen_waktu DESC");
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

	public function get_siswa_bydate($by_date = NULL, $by = NULL, $single = FALSE) {
		$this->db->query("
			SELECT 
			id,
			username,
			email,
			role,
			siswa_nama,
			siswa_jenjang,
			siswa_kelas,
			absen_jenis,
			absen_keterangan,
			absen_waktu,
			jenjang_nama,
			kelas_nama
			FROM " . $this->table . "
			LEFT JOIN tb_user ON id = absen_user
			LEFT JOIN tb_siswa ON siswa_uid = id
			LEFT JOIN tb_jenjang ON jenjang_id = siswa_jenjang
			LEFT JOIN tb_kelas ON kelas_id = siswa_kelas
			WHERE role = 3 
			" 
			. (!is_null($by_date) ? " AND absen_waktu <= :absen_waktu " : "")
			. (!is_null($by) ? " AND " . $by[0] . "=:" . $by[0] : "")
			. " ORDER BY absen_waktu DESC");

		if (!is_null($by_date)) {
			$this->db->bind('absen_waktu', $by_date);
		}

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

	public function get_guru($by = NULL, $single = FALSE) {
		$this->db->query("
			SELECT 
			id,
			username,
			email,
			role,
			guru_nama,
			guru_jenjang,
			absen_jenis,
			absen_keterangan,
			absen_waktu,
			jenjang_nama
			FROM " . $this->table . "
			LEFT JOIN tb_user ON id = absen_user
			LEFT JOIN tb_guru ON guru_uid = id
			LEFT JOIN tb_jenjang ON jenjang_id = guru_jenjang
			WHERE role = 2 
			" . (!is_null($by) ? " AND " . $by[0] . "=:" . $by[0] : "") 
			. " ORDER BY absen_waktu DESC ");
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

	public function get_guru_bydate($by_date = NULL, $by = NULL, $single = FALSE) {
		$this->db->query("
			SELECT 
			id,
			username,
			email,
			role,
			guru_nama,
			guru_jenjang,
			absen_jenis,
			absen_keterangan,
			absen_waktu,
			jenjang_nama
			FROM " . $this->table . "
			LEFT JOIN tb_user ON id = absen_user
			LEFT JOIN tb_guru ON guru_uid = id
			LEFT JOIN tb_jenjang ON jenjang_id = guru_jenjang
			WHERE role = 2 
			" 
			. (!is_null($by_date) ? " AND absen_waktu <= :absen_waktu " : "")
			. (!is_null($by) ? " AND " . $by[0] . "=:" . $by[0] : "")
			. " ORDER BY absen_waktu DESC");

		if (!is_null($by_date)) {
			$this->db->bind('absen_waktu', $by_date);
		}

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

	public function add($data) {
		$query = "INSERT INTO ".$this->table." (absen_user, absen_jenis, absen_waktu) VALUES (:absen_user, :absen_jenis, :absen_waktu)";
		$this->db->query($query);
		$this->db->bind('absen_user', $data['absen_user']);
		$this->db->bind('absen_jenis', $data['absen_jenis']);
		$this->db->bind('absen_waktu', $data['absen_waktu']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function update($data) {
		$query = "UPDATE ".$this->table." SET jurusan_nama=:jurusan_nama, jurusan_jenjang=:jurusan_jenjang WHERE jurusan_id=:jurusan_id";
		$this->db->query($query);
		$this->db->bind('jurusan_nama', $data['jurusan_nama']);
		$this->db->bind('jurusan_jenjang', $data['jurusan_jenjang']);
		$this->db->bind('jurusan_id', $data['jurusan_id']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function delete($id) {
		$query = "DELETE FROM " . $this->table . " WHERE jurusan_id=:jurusan_id";
		$this->db->query($query);
		$this->db->bind('jurusan_id', $id);
		$this->db->execute();

		return $this->db->rowCount();
	}
}