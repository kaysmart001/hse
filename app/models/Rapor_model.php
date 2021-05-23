<?php

class Rapor_model {
	private $table = 'tb_rapor';
	private $db;

	public function __construct() {
		$this->db = new Model;
	}

	public function get_by($jenjang = NULL, $siswa = NULL, $single = FALSE) {
		$this->db->query(
			"SELECT * FROM " 
			. $this->table .
			" INNER JOIN tb_siswa ON siswa_id = rapor_siswa " .
			" INNER JOIN tb_jenjang ON jenjang_id = siswa_jenjang " .
			" INNER JOIN tb_kelas ON kelas_id = siswa_kelas " .
			" INNER JOIN tb_tingkat ON tingkat_id = kelas_tingkat "
			. (!is_null($jenjang) ? " WHERE " . $jenjang[0] . '=:' . $jenjang[0] : "")
			. (!is_null($siswa) ? " AND " . $siswa[0] . '=:' . $siswa[0] : "")
			. ""
		);

		if (!is_null($jenjang)) {
			$this->db->bind($jenjang[0], $jenjang[1]);
		}
		if (!is_null($siswa)) {
			$this->db->bind($siswa[0], $siswa[1]);
		}

		if ($single) {
			$method = $this->db->row();
		} else {
			$method = $this->db->result();
		}

		return $method;
	}

	public function add($data) {
		$query = "INSERT INTO " . $this->table . " (rapor_siswa, rapor_semester, rapor_file) VALUES (:rapor_siswa, :rapor_semester, :rapor_file)";
		$this->db->query($query);
		$this->db->bind('rapor_siswa', $data['rapor_siswa']);
		$this->db->bind('rapor_semester', $data['rapor_semester']);
		$this->db->bind('rapor_file', $data['rapor_file']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function update($data) {
		$query = "UPDATE " . $this->table . " SET rapor_siswa=:rapor_siswa, rapor_semester=:rapor_semester, rapor_file=:rapor_file WHERE rapor_id=:rapor_id";
		$this->db->query($query);
		$this->db->bind('rapor_siswa', $data['rapor_siswa']);
		$this->db->bind('rapor_semester', $data['rapor_semester']);
		$this->db->bind('rapor_file', $data['rapor_file']);
		$this->db->bind('rapor_id', $data['rapor_id']);

		$this->db->execute();

		return $this->db->rowCount();
	}

	public function delete($id) {
		$query = "DELETE FROM " . $this->table . " WHERE rapor_id=:rapor_id";
		$this->db->query($query);
		$this->db->bind('rapor_id', $id);
		$this->db->execute();

		return $this->db->rowCount();
	}
}