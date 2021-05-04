<?php

class Jurusan_model {
	private $table = 'tb_jurusan';
	private $db;

	public function __construct() {
		$this->db = new Model;
	}

	public function get() {
		$this->db->query('
			SELECT * FROM ' . $this->table . '
			LEFT JOIN tb_jenjang ON jenjang_id = jurusan_jenjang
		');
		return $this->db->result();
	}

	public function get_jurusan_sma() {
		$this->db->query("SELECT * FROM " . $this->table . " WHERE jurusan_jenjang = 3 ORDER BY jurusan_id");
		return $this->db->result();
	}

	public function get_jurusan_smk() {
		$this->db->query("SELECT * FROM " . $this->table . " WHERE jurusan_jenjang = 4 ORDER BY jurusan_id");
		return $this->db->result();
	}

	public function add($data) {
		$query = "INSERT INTO ".$this->table." (jurusan_nama, jurusan_jenjang) VALUES (:jurusan_nama, :jurusan_jenjang)";
		$this->db->query($query);
		$this->db->bind('jurusan_nama', $data['jurusan_nama']);
		$this->db->bind('jurusan_jenjang', $data['jurusan_jenjang']);
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