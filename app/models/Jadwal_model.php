<?php

class Jadwal_model {
	private $table = 'tb_jadwal';
	private $db;

	public function __construct() {
		$this->db = new Model;
	}

	public function get($by = NULL, $single = FALSE) {
		$this->db->query(
			"SELECT * FROM "
			. $this->table . 
			"
			JOIN tb_kelas ON kelas_id = jadwal_kelas
			JOIN tb_mapel ON mapel_id = jadwal_mapel
			JOIN tb_jenjang ON jenjang_id = kelas_jenjang
			JOIN tb_tingkat ON tingkat_id = kelas_tingkat
			"
			. (!is_null($by) ? " WHERE " . $by[0] . "=:" . $by[0] : "") .
			"
			ORDER BY jadwal_id DESC
			"
		);

		if ($by) {
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
		$query = "INSERT INTO " . $this->table . " (jadwal_hari, jadwal_mulai, jadwal_akhir, jadwal_kelas, jadwal_mapel) VALUES (:jadwal_hari, :jadwal_mulai, :jadwal_akhir, :jadwal_kelas, :jadwal_mapel)";
		$this->db->query($query);
		$this->db->bind('jadwal_hari', $data['jadwal_hari']);
		$this->db->bind('jadwal_mulai', $data['jadwal_mulai']);
		$this->db->bind('jadwal_akhir', $data['jadwal_akhir']);
		$this->db->bind('jadwal_kelas', $data['jadwal_kelas']);
		$this->db->bind('jadwal_mapel', $data['jadwal_mapel']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function update($data) {
		$query = "UPDATE " . $this->table . " SET jadwal_hari=:jadwal_hari, jadwal_mulai=:jadwal_mulai, jadwal_akhir=:jadwal_akhir, jadwal_kelas=:jadwal_kelas, jadwal_mapel=:jadwal_mapel WHERE jadwal_id=:jadwal_id";
		$this->db->query($query);
		$this->db->bind('jadwal_hari', $data['jadwal_hari']);
		$this->db->bind('jadwal_mulai', $data['jadwal_mulai']);
		$this->db->bind('jadwal_akhir', $data['jadwal_akhir']);
		$this->db->bind('jadwal_kelas', $data['jadwal_kelas']);
		$this->db->bind('jadwal_mapel', $data['jadwal_mapel']);
		$this->db->bind('jadwal_id', $data['jadwal_id']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function delete($id) {
		$query = "DELETE FROM " . $this->table . " WHERE jadwal_id=:jadwal_id";
		$this->db->query($query);
		$this->db->bind('jadwal_id', $id['id']);
		$this->db->execute();

		return $this->db->rowCount();
	}
}